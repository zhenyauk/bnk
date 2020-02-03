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
        $data = $this->getTransactions($request);
        return view('admin.pages.transaction-1', $data);
    }

    public function getIn(Request $request)
    {
        $data = $this->getAllTransactions($request, 'IN');
        return view('admin.pages.transactions-in', $data);
    }

    public function getOut(Request $request)
    {
        $data = $this->getTransactions($request, 'OUT');
        return view('admin.pages.transactions-in', $data);
    }

    public function arhive(Request $request)
    {
        $data = $this->getTransactions($request);
        return view('admin.pages.transaction-2', $data);
    }


    public function getTransactions($request, $type = null)
    {
        $transactions = Transaction::query();

        if($request->has('account')){
            $account = Account::find($request->account);
            $transactions->where('account_id', $request->account)->whereUserId(Auth::id());
        }else{
            $account = Auth::user()->account;
            $transactions->where('account_id', $account->id)->whereUserId(Auth::id());
        }

        $accounts = Auth::user()->accounts;

        $data = [];

        if($request->has('from_date')){
            if($request->from_date != null){
                $data['from_date'] = $request->from_date;
                $transactions->where('created_at','>' , $request->from_date);
            }
        }

        if($request->has('to_date')){
            if($request->to_date != null){
                $data['to_date'] = $request->to_date;
                $transactions->where('created_at','<' , $request->to_date);
            }
        }

        if($request->has('search')){
            if($request->search != null){
                $data['search'] = $request->search;
                $transactions->where('description','like' , '%' . $request->search . '%');
            }
        }

        if($type != null){
            $transactions->where('type' , $type);
        }

        $data['transactions'] = $transactions->get();
        $data['trans'] = Transaction::orderBy('id', 'desc')->first();
        $data['accounts'] = $accounts;
        $data['account'] = $account;
        return $data;
    }




    public function getAllTransactions($request, $type = null)
    {
        $transactions = Transaction::query();

        $account = Auth::user()->account;
        $accounts = Auth::user()->accounts;


        $data = [];

        if($request->has('from_date')){
            if($request->from_date != null){
                $data['from_date'] = $request->from_date;
                $transactions->where('created_at','>' , $request->from_date);
            }
        }

        if($request->has('to_date')){
            if($request->to_date != null){
                $data['to_date'] = $request->to_date;
                $transactions->where('created_at','<' , $request->to_date);
            }
        }

        if($request->has('search')){
            if($request->search != null){
                $data['search'] = $request->search;
                $transactions->where('description','like' , '%' . $request->search . '%');
            }
        }

        if($type != null){
            $transactions->where('type' , $type);
        }

        $data['transactions'] = $transactions->get();


        $data['trans'] = Transaction::orderBy('id', 'desc')->first();
        $data['accounts'] = $accounts;
        $data['account'] = $account;
        return $data;
    }



}
