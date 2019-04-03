<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceCollection;
use App\Http\Resources\DetailsCollection;
use App\Invoice;

class ApiController extends Controller
{
    public function index($company)
    {
        return InvoiceCollection::collection(Invoice::all()->where('company_id', $company));
    }

    public function show($company, $invoice)
    {
        return DetailsCollection::collection(Invoice::all()->where('id', $invoice));
    }
}
