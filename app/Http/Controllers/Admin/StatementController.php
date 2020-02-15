<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Transaction;
use Carbon\Carbon;
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

        $trans = Transaction::query();

        $trans->where('user_id', Auth::id())->where('account_id', $account->id);

        if($request->has('from_date')){
            if($request->from_date != null){
                $data['from_date'] = $this->makeDate($request->from_date);
                $trans->where('created_at','>' , $data['from_date']);
            }
        }else{
            $data['from_date'] = Carbon::today()->subYear();
            $trans->where('created_at','>' , $data['from_date']);
        }


        if($request->has('to_date')){
            if($request->to_date != null){
                $data['to_date'] = $this->makeDate($request->to_date);
                $trans->where('created_at','<' , $data['to_date']);
            }
        }else{
            $data['to_date'] = Carbon::today();
            $trans->where('created_at','<' , $data['to_date']);
        }


        $trans = $trans->get();

        $data['email'] = $request->email;


        return $this->send($account, $trans , $data);


    }



    public function send($acc, $trans,  $data2)
    {

        if( null == count($trans) )
            return "За выбранный период нет выписок!";

        //$trans = Transaction::take(70)->get();

        //return view('admin.pdf.pdf', compact('trans', 'acc', 'data2'));
        $pdf = PDF::loadView('admin.pdf.new', compact('trans', 'acc', 'data2'));


        //return $pdf->stream();

        $f = public_path();

        $pdf->save($f . '\print.pdf');

        $data = [
            'name' => 'Eugene',
            'attach' =>  public_path() . "/print.pdf"
        ];

        //$this->password(public_path() . "/hello2.pdf");



        Mail::to($data2['email'])
            ->send(new SendMail($data));

        echo "Отправлен : <a href='/print.pdf'>ФАЙЛ</a>"  ;
    }

    public function makeDate($date)
    {
        if( strpos($date, "/") ){
            $dt = Carbon::createFromFormat('d/m/Y', $date);
            return $dt->toDateString();
        }else{
            return $date;
        }
    }



}
