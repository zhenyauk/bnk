<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
use App\Http\Traits\FilterTrait;


class Transaction extends Model
{
    use FilterTrait;



    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class)->withDefault();
    }

    protected $fillable = [
        'type', 'amount', 'balance', 'account_id', 'description', 'created_at' , 'updated_at', 'user_id'
    ];






}
