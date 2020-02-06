<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Country;
use App\Helpers\CurrencyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Payment;
use App\Template;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {

    }

    public function addPayment(Request $request)
    {
        if($request->has('account')){
            $account = Account::whereId($request->account)->where('user_id', Auth::id())->first();
        }else{
            $account = Auth::user()->account;
        }

        $accounts = Auth::user()->accounts;

        $countries = Country::get();

        $templates = Template::whereUserId(Auth::id())->get();

        return view('admin.pages.payment.add',
            compact('accounts', 'account', 'countries', 'templates'));
    }



    public function store(PaymentRequest $request)
    {
        //dd($request->all());
        if($request->has('save'))
            $this->makeTemplate($request);
        $request->session()->put('form_data',$request->all());

        //dd( session('form_data'));
        return view('admin.pages.payment.step2');

    }

    public function step3(Request $request)
    {

        //dd(session('form_data'));

        $account = session('form_data.account');
        $comision = CurrencyHelper::getComission(session('form_data.comision'), session('form_data.amount'));


        // Проверка на акаунт, или принадлежит Юзеру
        if(!$acc = Account::whereId($account)->whereUserId(Auth::id())->first())
            return abort('403');

        if($acc->currency_id != 2){
            $comision = CurrencyHelper::Calculate(session('form_data.amount'), $acc->currency_id, 2);
        }

        //Создать платеж
        $payment = new Payment();
        $payment->fill(session('form_data'));
        $payment->save();

        $last_trans = Transaction::whereUserId(Auth::id())->whereAccountId($acc->id)->orderBy('id', 'desc')->first();

        $trans = new Transaction();
        $trans->account_id = $acc->id;
        $trans->payment_id = $payment->id;
        $trans->user_id = Auth::id();
        $trans->country_id = session('form_data.country_id');
        $trans->type = 'OUT';
        $trans->amount =  session('form_data.amount') +  $comision;

        $trans->description =  session('form_data.recipier_name')
            . ' ' . session('form_data.recipier_bank')
            . ' ' . session('form_data.bic_bank')
            . ' ' . session('form_data.recipier_info');

        $trans->status = Transaction::STATUS_NEW;
        $trans->balance = $last_trans->balance - ( session('form_data.amount') +  $comision );
        $trans->save();




        //session('form_data')
        return view('admin.pages.payment.done');
    }

    public function finish(Request $request)
    {
        return view('admin.pages.payment.step3');
    }

    public function makeTemplate($request)
    {
       $template = new Template();
       $template->fill($request->all());
       $template->user_id = Auth::id();
       $template->save();
       return $template;
    }


}
