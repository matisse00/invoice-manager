<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'address', 'nip', 'regon', 'type', 'account_number'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
