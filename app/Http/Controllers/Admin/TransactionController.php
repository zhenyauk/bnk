<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('account')){
            $transactions = Transaction::where('account_id', $request->account)->whereUserId(Auth::id())->get();
        }else{
            $default_account = Auth::user()->account;
            $transactions = Transaction::where('account_id', $default_account->id)->whereUserId(Auth::id())->get();
        }

        $accounts = Auth::user()->accounts;

        $trans = Transaction::orderBy('id', 'desc')->first();
        return view('admin.pages.transaction-1', compact('transactions', 'trans', 'accounts'));
    }

    public function arhive(Request $request)
    {
        if($request->has('account')){
            $transactions = Transaction::where('account_id', $request->account)->whereUserId(Auth::id())->get();
            $account = Account::findOrFail($request->account);
        }else{
            $default_account = Auth::user()->account;
            $transactions = Transaction::where('account_id', $default_account->id)->whereUserId(Auth::id())->get();

            $account = Account::findOrFail($default_account->id);
        }

        $trans = Transaction::orderBy('id', 'desc')->first();
        $accounts = Auth::user()->accounts;

        return view('admin.pages.transaction-2', compact('transactions', 'trans', 'accounts', 'account'));
    }



}
