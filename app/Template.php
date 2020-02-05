<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'to_bill',
        'recipier_name',
        'recipier_phone',
        'recipier_country',
        'recipient_amount',
        'recipient_currency_id',
        'recipier_bank',
        'recipier_info',
    ];
}
