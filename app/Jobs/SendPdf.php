<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use PDF;

class SendPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $trans;
    protected $acc;
    protected $data2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($acc, $trans,  $data2)
    {
        $this->acc = $acc;
        $this->trans = $trans;
        $this->data2 = $data2;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $trans = $this->trans;
        $acc = $this->acc;
        $data2 = $this->data2;

        $pdf = PDF::loadView('admin.pdf.new', compact('trans', 'acc', 'data2'));

        $f = public_path();

        $pdf->save($f . '/print.pdf');

        $data = [
            'name' => 'Eugene',
            'attach' =>  public_path() . "/print.pdf"
        ];

        //$this->password(public_path() . "/hello2.pdf");

        Mail::to($data2['email'])
            ->send(new SendMail($data));
    }
}
