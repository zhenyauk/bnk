<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Exports\AccountExport;
use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ExportController extends Controller
{
    # export
    public function transactions( $id )
    {
        return Excel::download(new TransactionExport($id), 'transactions_' . $id . '.xlsx');
    }

    public function transactionsIn( $id )
    {
        return Excel::download(new TransactionExport($id, 'IN'), 'transactions_' . $id . '.xlsx');
    }

    public function transactionsOut( $id )
    {
        return Excel::download(new TransactionExport($id, 'OUT'), 'transactions_' . $id . '.xlsx');
    }

    public function accounts()
    {
        return Excel::download(new AccountExport(Auth::id()) , 'accounts.xlsx');
    }


}
