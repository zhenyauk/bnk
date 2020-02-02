<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounttype extends Model
{
    public function accounts($uid)
    {
        return $this->hasMany(Account::class)->where('user_id', $uid)->get();
    }
}
