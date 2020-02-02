<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;

class Transaction extends Model
{
    const STATUS_NEW = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_COMPLETED = 4;

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    protected $fillable = [
        'type', 'amount', 'balance', 'account_id', 'description', 'updated_at', 'user_id'
    ];


}
