<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceCollection;
use App\Http\Resources\DetailsCollection;
use App\Invoice;

class ApiController extends Controller
{
    public function index($company_id)
    {
        return InvoiceCollection::collection(Invoice::all()->where('company_id', $company_id));
    }

    public function show($company_id, $invoice_id)
    {
        $invoice = Invoice::all()->where('id', $invoice_id);
        if ($invoice->first()->company->id != $company_id) {
            return response([
                'Invoice does not belongs to this company.'
            ], 403);
        }
        return DetailsCollection::collection($invoice);
    }
}
