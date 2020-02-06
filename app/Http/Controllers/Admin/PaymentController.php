<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
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
