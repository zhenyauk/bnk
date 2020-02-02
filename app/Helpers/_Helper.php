<?php

namespace App\Helpers;

use App\Leftmenu;
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


}