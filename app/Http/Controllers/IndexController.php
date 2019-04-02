<?php

namespace App\Http\Controllers;

use App\Company;
use App\Invoice;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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

        $ordered_number = Invoice::all()->count();
        $ordered_date = date('m/Y');
        $invoice_number = "$ordered_number/$ordered_date";
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

        $items = [];
        foreach ($data as $key => $item) {
            if (Str::startsWith($key, 'item_')) {
                $item_name = substr($key, 0, -1);
                $item_id = substr($key, -1);
                $items[$item_id][$item_name] = $item;
            }
        }
//        'invoice_number', 'invoice_date', 'sell_date', 'payment_date', 'payer_name', 'payer_address', 'payer_nip'
//        $validatedData = $request->validate([
//            'invoice_number' => 'required|unique:invoices,NULL,',
//            'invoice_date' =>
//            'sell_date'
//            'payment_date'
//            'payer_name'
//            'payer_addresss'
//            'payer_nio'
//        ])

//        $validator = Validator::make($request->all(),Post::$rules);

        $invoice = new Invoice;
        $invoice->invoice_number = $request->invoice_number;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->sell_date = $request->sell_date;
        $invoice->payment_date = $request->payment_date;
        $invoice->payer_name = $request->payer_name;
        $invoice->payer_address = $request->payer_address;
        $invoice->payer_nip = $request->payer_nip;
        $invoice->company()->associate($request->route('id'));
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

        return redirect()->action('IndexController@index', ['id' => $invoice->company->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param $company
     * @return \Illuminate\Http\Response
     */
    public function index($company)
    {

        $companies = Company::all();
        $invoices = DB::table('invoices')->where('company_id', $company)->orderBy('invoice_date')->paginate(20);
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
