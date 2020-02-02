<?php

namespace App\Helpers;

class CurrencyHelper{

    public static $eur = 1;
    public static $doll = 0.9;
    const EURO = 1;
    const DOLLAR = 2;


    public static function change($bill)
    {
        if($bill->currency_id === self::EURO){
            return $bill->balance_current;
        }
        elseif ($bill->currency_id === self::DOLLAR){
            return $bill->balance_current * self::$doll;
        }
    }

    public static function getCurrency($id)
    {
        if($id === 1)
            return "LEGAL COMMERCIAL EUR";

        if($id === 2)
            return "LEGAL COMMERCIAL USD";
    }

    public static function getCurrencyCode($id)
    {
        if($id === 1)
            return "EUR";

        if($id === 2)
            return "USD";
    }

}