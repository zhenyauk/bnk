<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Helpers\CurrencyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BetweenStoreRequest;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentBetweenController extends Controller
{
    public $error_1 = 'Не допускаются знаки \'$\' \'EUR\' и т.д. Сумма должна быть числом!';
    public $error_2 = 'На вашем счету недостаточно средств!';
    public $error_3 = 'Что то пошло не так';


    public function index()
    {
        $accounts = Auth::user()->accounts;
        return view('admin.pages.payment.between', compact('accounts'));
    }

    public function create()
    {
        //
    }


    public function store(BetweenStoreRequest $request)
    {
        // Проверка корректности суммы
        if(!( $amount = $this->checkAmount($request->amount) ))
            return back()->withErrors([$this->error_1]);

        // Проверка попытки подменить аккаунты
        if(!$this->checkBills($request->from_bill, $request->to_bill))
            return abort('403');

        // Проверка или есть средства на счету
        if(!( $this->checkSumm($amount, $request->from_bill) ))
            return back()->withErrors([$this->error_2]);


        if( $this->makePayment($amount, $request->from_bill, $request->to_bill) ){
            return back();
        }

        return back()->withErrors([$this->error_3]);

    }


    public function makePayment($amount, $from_id, $to_id)
    {
        $bill_from = Account::whereId($from_id)->whereUserId(Auth::id())->first();
        $bill_to = Account::whereId($to_id)->whereUserId(Auth::id())->first();

        $bill_to_currency = 'currency_' . $bill_to->currency_id;

        $bill_from->balance_current = $bill_from->balance_current - $amount;

        $bill_to->balance_current =
            $bill_to->balance_current + ( $amount * CurrencyHelper::$$bill_to_currency );

        if( $bill_from->save() )
            $bill_to->save();

        $payment_1 = $this->makeTransaction(Auth::user()->id, $amount, 'OUT', $bill_from->id);
        $payment_2 = $this->makeTransaction(Auth::user()->id, ( $amount * CurrencyHelper::$$bill_to_currency ), 'IN', $bill_to->id);



        return true;
    }


    public function makeTransaction($user_id, $amount, $type, $acc_id)
    {
        $account = Account::findOrFail($acc_id);

        $trans = new Transaction();
        $trans->account_id = $acc_id;
        $trans->type = $type;
        $trans->amount = $amount;
        $trans->user_id = $user_id;
        $trans->balance = $account->balance_current;
        $trans->description = "Перевод между своими считами";
        if( $trans->save() )
            return $trans;
    }

    public function checkBills($bill_1, $bill_2)
    {
        if( Account::whereId($bill_1)->whereUserId(Auth::id())->first()
            &&  Account::whereId($bill_2)->whereUserId(Auth::id())->first() )
            return true;
        return false;
    }

    // Проверка корректности суммы и формата суммы
    public function checkAmount($amount)
    {
        if(!is_numeric($amount)){
            if(strpos($amount, ','))
                return str_replace(',','.',$amount);
            return false;
        }
        return $amount;
    }

    // Проверка или есть средства на счету
    public function checkSumm($amount, $bill)
    {
        $account = Account::whereId($bill)->whereUserId(Auth::id())->firstOrFail();
        if($account->balance_current >= $amount)
            return true;
        return false;
    }



}
