<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use PDF;
use ZipArchive;

class StatementController extends Controller
{
    public function index()
    {
        $accounts = Auth::user()->accounts;
        return view('admin.pages.statement.statement', compact('accounts'));
    }

    public function post(Request $request)
    {
        $acc_id = $request->account[0];

        $account = Account::find($acc_id);

        if( $account->user_id != Auth::id() )
            return abort('403');



        return $this->send($account, $request->email);


    }



    public function send($acc, $email)
    {
        if( null == count($trans = $acc->transactions) )
            abort('403');


        $pdf = PDF::loadView('admin.pages.test', compact('trans', 'acc'));

        //return $pdf->stream();

        $f = public_path();
        $pdf->save($f . '\print.pdf');

        $data = [
            'name' => 'Eugene',
            'attach' =>  public_path() . "/print.pdf"
        ];

        //$this->password(public_path() . "/hello2.pdf");

        Mail::to($email)
            ->send(new SendMail($data));

        echo "Отправлен : "  .  '<a href = \'/' . public_path() .  "/hello2.pdf" . '\'>ФАЙЛ</a>'  ;
    }


}
