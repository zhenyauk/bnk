<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {

    }

    public function add(Request $request)
    {
        if($request->has('account')){
            $account = Account::whereId($request->account)->where('user_id', Auth::id())->first();
        }else{
            $account = Auth::user()->account;
        }

        $accounts = Auth::user()->accounts;

        return view('admin.pages.payment.add', compact('accounts', 'account'));
    }



    public function store(Request $request)
    {
        dd($request->all());
    }
}
