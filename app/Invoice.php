<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $fillable = [
        'invoice_number', 'invoice_date', 'sell_date', 'payment_date', 'payer_name', 'payer_address', 'payer_nip'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function netSum()
    {
        return $this->items()->sum('netsum');
    }

    public function grossSum()
    {
        return $this->items()->sum('grosssum');
    }

}
