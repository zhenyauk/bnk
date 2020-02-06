<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'user_id',
        'iban',
        'recipier_name',
        'recipier_phone',
        'recipier_name',
        'recipient_amount',
        'country_id',
        'recipier_bank',
        'amount',
        'bic_bank',
        'recipier_info',
    ];
}
