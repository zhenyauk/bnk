<?php

namespace App\Helpers;

use App\Account;
use App\Country;
use App\Leftmenu;
use App\Log;
use Carbon\Carbon;

class _Helper {

    public static function excellTime($date)
    {
        if($date != null){
            $day = date( 'd', ( $date*24*60*60 ) - ( ( 70*365.25*24*60*60 )+(25*60*60)));
            $month = date( 'm', ( $date*24*60*60 ) - ( ( 70*365.25*24*60*60 )+(25*60*60)));
            $year = date( 'Y', ( $date*24*60*60 ) - ( ( 70*365.25*24*60*60 )+(25*60*60)));

            if( $date = Carbon::createFromDate($year, $month, $day) )
                return $date;
        }
    }

    public static function getMenu($slug = 'first')
    {
        return Leftmenu::whereSlug($slug)->first()->menu_code;
    }

    public static function getCountry($id)
    {
        return Country::find($id)->name;
    }

    public static function getAccountNumber($id)
    {
        return Account::find($id)->number;
    }

    public static function addLog($user_id, $operation, $status = 'Исполнено')
    {
        $log = new Log();
        $log->user_id = $user_id;
        $log->data = "IP: " . $_SERVER['REMOTE_ADDR'] . " Дата: " . date('d-m-Y H:i:s');
        $log->operation = $operation;
        $log->status = $status;
        $log->save();
        return true;
    }

    public static function addLogWithoutUserId($operation)
    {
        $log = new Log();
        $log->data = "IP: " . $_SERVER['REMOTE_ADDR'] . " Дата: " . date('d-m-Y H:i:s');
        $log->operation = $operation;
        $log->status = "Ошибка";
        $log->save();
        return true;
    }


}