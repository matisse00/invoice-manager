<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $fillable = [
        'invoice_number', 'invoice_date', 'sell_date', 'payment_date', 'payer_name', 'payer_address', 'payer_nip'
    ];

    public function users()
    {
        return $this->belongsTo(Company::class);
    }
}
