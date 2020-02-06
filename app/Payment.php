<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payer_name',
        'payer_phone',
        'amount',
        'payer_currency_id',
        'to_bill',
        'recipier_name',
        'recipier_phone',
        'recipier_country',
        'recipient_amount',
        'recipient_currency_id',
        'recipier_bank',
        'recipier_info',
        'comission',
        'comission_amount',
    ];

}
