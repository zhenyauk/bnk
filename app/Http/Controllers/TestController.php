<?php

namespace App\Http\Controllers;

use App\Account;
use App\Facades\PaymentService;
use App\Transaction;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $filters)
    {
        $trans = Transaction::query();

        if($filters->has('from_date')){
            $trans->where('updated_at','>' , $filters->from_date);
        }

        if($filters->has('to_date')){
            $trans->where('updated_at','>' , $filters->to_date);
        }



        dd($trans->get());

    }
}
