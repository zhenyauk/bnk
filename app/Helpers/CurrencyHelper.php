<?php

namespace App\Helpers;

use App\Account;

class CurrencyHelper{

    public static $eur = 1;
    public static $doll = 0.9;

    public static $currency_2 = 1.11;      // Евро к Доллару
    public static $currency_1 = 0.896;       // Доллар к Евро


    const EURO = 1;
    const DOLLAR = 2;

    public static $comision_1 = 'Общая';
    public static $comision_2 = 'Все расходы возложены на Отправителя';
    public static $comision_3 = 'Все расходы возложены на Получателя';

    public static $comision_1_amount = 40;
    public static $comision_2_amount = 80;
    public static $comision_3_amount = 0;
    public static $comision_4_amount = 110;



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

    public static function getAccountCurrencyCode($id)
    {
        if($acc = Account::find($id))
            return self::getCurrencyCode($acc->currency_id);
    }

    public static function getCurrencyCode($id)
    {
        if($id === 1)
            return "EUR";

        if($id === 2)
            return "USD";
    }

    public static function getComisionTitle($id)
    {
        if($id == 1)
            return self::$comision_1;

        if($id == 2)
            return self::$comision_2;

        if($id == 3)
            return self::$comision_3;

        return 'Unknow';
    }

    public static function getComission($type, $amout)
    {
        $type = (int) $type;

        if($amout > 5000){
            if($type === 1)
                return self::$comision_1_amount;

            if($type === 2)
                return self::$comision_2_amount;

            if($type === 3)
                return self::$comision_3_amount;
        }else{

            if($type === 1)
                return self::$comision_4_amount;

            if($type === 2)
                return (self::$comision_4_amount / 2);

            if($type === 3)
                return self::$comision_3_amount;

        }
    }

}