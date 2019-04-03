<?php

namespace App\Http\Controllers;

use App\Company;
use App\Invoice;
use App\Item;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;
use PDF;

class IndexController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = date('Y-m-d');

        $invoice_ordered_number = Invoice::all()->count() + 1;
        $invoice_ordered_date = date('m/Y');
        $invoice_number = "$invoice_ordered_number/$invoice_ordered_date";
        return view('create_invoice', [
            'companies' => Company::all(),
            'invoice_number' => $invoice_number,
            'today' => $today
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $company = $request->route('id');

        $items = [];
        foreach ($data as $key => $item) {
            if (Str::startsWith($key, 'item_')) {
                $item_name = substr($key, 0, -1);
                $item_id = substr($key, -1);
                $items[$item_id][$item_name] = $item;
            }
        }


        $validate_fields = [
            'invoice_number' => 'required',
            'invoice_date' => 'required|date_format:Y-m-d',
            'sell_date' => 'required|date_format:Y-m-d',
            'payment_date' => 'required|date_format:Y-m-d',
            'payer_name' => 'required',
            'payer_address' => 'required',
            'payer_nip' => 'required|max:13',
        ];
        foreach ($items as $key => $item) {
            $validate_fields['item_name' . $key] = 'required';
            $validate_fields['item_unit' . $key] = 'required';
            $validate_fields['item_amount' . $key] = 'required|integer';
            $validate_fields['item_quantity' . $key] = 'required|integer';
            $validate_fields['item_vat' . $key] = 'required|numeric|between:0,1.0';
        };

        $validator = Validator::make($request->all(), $validate_fields);


        if ($validator->fails()) {
            return redirect()->action('IndexController@create', ['id' => $company])->withErrors($validator);
        }

        $invoice = new Invoice;
        $invoice->invoice_number = $request->invoice_number;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->sell_date = $request->sell_date;
        $invoice->payment_date = $request->payment_date;
        $invoice->payer_name = $request->payer_name;
        $invoice->payer_address = $request->payer_address;
        $invoice->payer_nip = $request->payer_nip;
        $invoice->company()->associate($company);
        $invoice->save();

        foreach ($items as $key => $item) {
            $item_object = new Item;

            $amount = $item['item_amount'];
            $quantity = $item['item_quantity'];
            $vat = $item['item_vat'];

            $item_object->ordinalnumber = $key;
            $item_object->name = $item['item_name'];
            $item_object->unit = $item['item_unit'];
            $item_object->amount = $amount;
            $item_object->quantity = $quantity;
            $item_object->vat = $vat;
            $item_object->netsum = $amount * $quantity;
            $item_object->grosssum = $amount * (1 + $vat) * $quantity;
            $item_object->invoice()->associate($invoice->id);
            $item_object->save();
        }

        return redirect()->action('IndexController@index', ['id' => $company]);
    }

    /**
     * Display the specified resource.
     *
     * @param $company
     * @return \Illuminate\Http\Response
     */
    public function index($company)
    {
        try {
            $companies = Company::all();
            $invoices = DB::table('invoices')->where('company_id', $company)->orderBy('invoice_date')->paginate(20);

        } catch (QueryException $e) {
            abort(404);
        }

        return view('index_page', ['companies' => $companies, 'invoices' => $invoices]);
    }

    public function show($id, $invoice_id)
    {
        $invoice = Invoice::with('items')->where('id', $invoice_id)->first();
        $net_sum = $invoice->netSum();
        $gross_sum = $invoice->grossSum();
        return response()->json(['invoice' => view('invoice_details', compact('invoice', 'net_sum', 'gross_sum'))->render()], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $company = $invoice->company->id;
        $invoice->delete();
        return redirect()->action('IndexController@index', ['id' => $company]);
    }

    public function downloadPdf($id)
    {
        $invoice = Invoice::with('items')->where('id', $id)->first();
        $net_sum = $invoice->netSum();
        $gross_sum = $invoice->grossSum();
        $pdf = PDF::loadView('pdf', compact('invoice', 'net_sum', 'gross_sum'));
        return $pdf->download('invoice' . $invoice['invoice_number'] . '.pdf');
    }
}
