<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class InvoiceCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($invoice)
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'invoice_date' => $this->invoice_date,
            'sell_date' => $this->invoice_date,
            'payment_date' => $this->payment_date,
            'payer_name' => $this->payer_name,
            'payer_address' => $this->payer_address,
            'payer_nip' => $this->payer_nip
        ];
    }
}

