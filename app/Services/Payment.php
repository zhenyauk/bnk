<?php

namespace App\Services;

use App\Account;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;

class Payment
{
    public $error_1 = 'На вашем счету недостаточно средств! ';
    public $error_2 = 'Неправильный счет клиента!';
    public $error_3 = 'Валюта счета получателя отличается от валюты счета отправителя!';



    public function FromClientToClient( $client_id, $amount = 0, $bill_id, $client_bill_id )
    {

        //Есть ли деньги на счету, можно отключить эту опцию
        if( ! $this->canMake($amount, $bill_id) )
            return $this->error_1;

        // Счет плательщика
        $payer_account = Account::findOrFail($bill_id);

        // Достаем информацию о клиенте и его счете
        $client = User::findOrFail($client_id);
        $client_account = Account::findOrFail($client_bill_id);

        $this->checkBillOwner($client->id, $client_account->id);

        // Проверка одинаковых валют
        if($payer_account->currency_id !== $client_account->currency_id)
            return $this->error_3;

        // Начало транзакции
        DB::beginTransaction();
        try {

            # Списываем со счета Юзера, который проводит эту операцию
            $payer_account->balance_current = $payer_account->balance_current - $amount;

            $payer_account->balance_available_current = $payer_account->balance_available_current - $amount;

            # Зачисляем на счет клиента
            $client_account->balance_current = $client_account->balance_current + $amount;

            $client_account->balance_available_current = $client_account->balance_available_current + $amount;


            // Сохраняем
            if( $payer_account->save() )
                $client_account->save();



            // Сохраняем в историю платажей
            $payment_1 = $this->makeTransaction(Auth::user()->id, $amount, 'OUT', $payer_account->currency_id);
            $payment_2 = $this->makeTransaction($client_id->id, $amount, 'IN', $client_account->currency_id);

            DB::commit();

            return ['Списан с' => $payment_1 ,'Сохранен на' => $payment_2];


        }
        catch (\Exception $e) {
            // Rollback Transaction

            DB::rollback();

            return ['error'=>'Возникли ошибки во время выполнения операции'];
        }

    }



    public function makePayment( $client_id, $amount = 0, $bill_id, $client_bill_id )
    {

        //Есть ли деньги на счету, можно отключить эту опцию
        if( ! $this->canMake($amount, $bill_id) )
            return $this->error_1;

        // Счет плательщика
        $payer_account = Account::findOrFail($bill_id);

        // Достаем информацию о клиенте и его счете
        $client = User::findOrFail($client_id);
        $client_account = Account::findOrFail($client_bill_id);

        $this->checkBillOwner($client->id, $client_account->id);

        // Проверка одинаковых валют
        if($payer_account->currency_id !== $client_account->currency_id)
            return $this->error_3;

        // Начало транзакции
        DB::beginTransaction();
        try {

            # Списываем со счета Юзера, который проводит эту операцию
            $payer_account->balance_current = $payer_account->balance_current - $amount;

            $payer_account->balance_available_current = $payer_account->balance_available_current - $amount;

            # Зачисляем на счет клиента
            $client_account->balance_current = $client_account->balance_current + $amount;

            $client_account->balance_available_current = $client_account->balance_available_current + $amount;


            // Сохраняем
            if( $payer_account->save() )
                $client_account->save();



            // Сохраняем в историю платажей
            $payment_1 = $this->makeTransaction(Auth::user()->id, $amount, 'OUT', $payer_account->currency_id);
            $payment_2 = $this->makeTransaction($client_id->id, $amount, 'IN', $client_account->currency_id);

            DB::commit();

            return ['Списан с' => $payment_1 ,'Сохранен на' => $payment_2];


        }
        catch (\Exception $e) {
            // Rollback Transaction

            DB::rollback();

            return ['error'=>'Возникли ошибки во время выполнения операции'];
        }

    }





    public function makeTransaction($user_id, $amount, $type, $currency_id)
    {
        $trans = new Transaction();
        $trans->type = $type;
        $trans->amount = $amount;
        $trans->user_id = $user_id;
        $trans->currency_id = $currency_id;
        if( $trans->save() )
            return $trans;
    }


    public function makeError($error = 'Ошибка')
    {
        return $error;
    }


    public function canMake($amount,  $bill_id)
    {
        $account = Account::findOrFail($bill_id);

        $this->checkBillOwner(Auth::id(), $account->user->id);

        if($amount < $account->balance_current)
            return true;
        return false;
    }


    public function checkBillOwner($user_id, $bill_id)
    {
        if($user_id !== $bill_id)
            return $this->error_2;
    }
}