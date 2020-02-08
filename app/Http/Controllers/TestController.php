<?php

namespace App\Http\Controllers;

use App\Account;
use App\Facades\PaymentService;
use App\Transaction;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;


class TestController extends Controller
{
    public function index(Request $filters)
    {

        //return view('admin.pages.test');
        $pdf = PDF::loadView('admin.pages.test');

        $f = public_path();
        $pdf->save($f . '\hello.pdf');

//        $pdf->download('hello.pdf')->getOriginalContent();

        return $this->mail();

        return $pdf->download('hello.pdf');

        $html =  view( 'admin.pages.payment.done' )->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->stream();
    }

    public function mail()
    {

        $subject = "тема письма";
        $user_email = 'zhenyauk@gmail.com';
        $message ="Текст сообщения";
// текст сообщения, здесь вы можете вставлять таблицы, рисунки, заголовки, оформление цветом и т.п.


        $filename = "hello.pdf";
// название файла

        $filepath = public_path() . "/hello.pdf";
// месторасположение файла


//исьмо с вложением состоит из нескольких частей, которые разделяются разделителем

        $boundary = "--".md5(uniqid(time()));
// генерируем разделитель

        $mailheaders = "MIME-Version: 1.0;\r\n";
        $mailheaders .="Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
// разделитель указывается в заголовке в параметре boundary

        $mailheaders .= "From: $user_email <$user_email>\r\n";
        $mailheaders .= "Reply-To: $user_email\r\n";

        $multipart = "--$boundary\r\n";
        $multipart .= "Content-Type: text/html; charset=utf8\r\n";
        $multipart .= "Content-Transfer-Encoding: base64\r\n";
        $multipart .= "\r\n";
        $multipart .= chunk_split(base64_encode( $message ));
// первая часть само сообщение

// Закачиваем файл
        $fp = fopen($filepath,"r");
        if (!$fp)
        {
            print "Не удается открыть файл22";
            exit();
        }
        $file = fread($fp, filesize($filepath));
        fclose($fp);
// чтение файла


        $message_part = "\r\n--$boundary\r\n";
        $message_part .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";
        $message_part .= "Content-Transfer-Encoding: base64\r\n";
        $message_part .= "Content-Disposition: attachment; filename=\"$filename\"\r\n";

        $message_part .= chunk_split(base64_encode($file));
        $message_part .= "\r\n--$boundary--\r\n";
// второй частью прикрепляем файл, можно прикрепить два и более файла

        $multipart .= $message_part;

        if( mail('zhenyauk@gmail.com',$subject,$multipart,$mailheaders) ){
            echo "OK...";
        }
// отправляем письмо

//удаляем файлы через 60 сек.
        if (time_nanosleep(5, 0)) {
            unlink($filepath);
        }
// удаление файла


    }
}
