<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Country;
use App\Http\Controllers\Controller;
use App\Template;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        return view('admin.pages.payment.add', compact('accounts', 'account', 'countries'));
    }



    public function store(Request $request)
    {
        dd($request->all());
        if($request->has('save'))
            $this->makeTemplate($request);
    }

    public function makeTemplate($request)
    {
        $template = new Template();

    }
}
