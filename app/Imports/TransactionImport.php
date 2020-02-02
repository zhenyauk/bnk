<?php

namespace App\Imports;

use App\Account;
use App\Transaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;


class TransactionImport implements ToModel
{

    public $account = 1;


    public function model(array $row)
    {
        if($row[5] == null && $row[4] == null )
            return ;

        if($row[5] == null){
            $amount = floatval($row[4]);
            $type = 'OUT';
        }else{
            $amount = floatval($row[5]);
            $type = 'IN';
        }

        $date = \App\Helpers\_Helper::excellTime($row[0]);

        $description = $row[2];

        $transaction =  new Transaction([
            'type'     => $type,
            'user_id'     => Auth::id(),
            'amount'    => $amount,
            'description'    => $description,
            'balance' => floatval($row[7]),
            'account_id' => $this->account,
            'updated_at' => $date
        ]);

        $acc = Account::find($this->account);
        $acc->balance_current = $transaction->balance;
        $acc->balance_available_current = $transaction->balance;
        $acc->last_transaction_date = $date;
        $acc->save();


        return $transaction;
    }
}
