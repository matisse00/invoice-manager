<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'ordinalnumber', 'name', 'unit', 'amount', 'quantity', 'vat', 'netsum', 'grosssum',
    ];

    public function users()
    {
        return $this->belongsTo(Invoice::class);
    }

}
