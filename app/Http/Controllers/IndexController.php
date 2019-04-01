<?php

namespace App\Http\Controllers;

use App\Company;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
