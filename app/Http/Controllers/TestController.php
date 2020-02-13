<?php

namespace App\Http\Controllers;

use App\Account;
use App\Facades\PaymentService;
use App\Transaction;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Dompdf\Options;
use Dompdf\Dompdf;


class TestController extends Controller
{
    public function index(Request $filters)
    {
        return 'hello';
    }

    public function makePdf($trans)
    {
        $data = [
            'name' => 'Eugene',
            'attach' =>  public_path() . "/hello2.pdf"
        ];



        Mail::to('zhenyauk@gmail.com')
            ->send(new SendMail($data));

        echo "OK";
        die;

        $pdf = PDF::loadView('admin.pages.test', compact('trans'));

        return $pdf->stream();

        $f = public_path();
        $pdf->save($f . '\hello2.pdf');

        $data = [
            'name' => 'Eugene',
            'attach' =>  public_path() . "/hello2.pdf"
        ];


        ///

        return ;
        //return view('admin.pages.test');


    }

}
