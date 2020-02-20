<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const PERSONALITY_LEGAL = 1;
    const PERSONALITY_INDIVIDUAL = 2;
    const TYPE_CURRENT = 1;           // Текущий счет
    const TYPE_COMMERCIAL = 2;        // Расчетный счет

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function accounttype()
    {
        return $this->belongsTo(Accounttype::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }





}
