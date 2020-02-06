<?php

namespace App\Helpers;

use App\Account;

class CurrencyHelper{

    // (amount / self) * currency
    public static $eur = 1;
    public static $doll = 0.896;
    public static $dol = 0.896;
    public static $usd = 0.896;

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

    public static $status_4 = 'Создан';
    public static $status_1 = 'Выполнен';
    public static $status_2 = 'В обработке';
    public static $status_3 = 'Отменен';


    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_COMPLETED = 4;


    /**
     * @return string
     */

    public static function Calc($amount, $from_currency, $to_currency)
    {
        return (  $amount /  self::$$from_currency ) *  self::$$to_currency;
    }

    public static function Calculate($amount, $from_currency, $to_currency)
    {
        $from_currency = strtolower( self::getCurrencyCode($from_currency) );
        $to_currency = strtolower( self::getCurrencyCode($to_currency) );
        return self::Calc($amount, $from_currency, $to_currency);
    }

    public static function getStatusName($id)
    {
        if($id == 1)
            return self::$status_1;

        if($id == 2)
            return self::$status_2;

        if($id == 3)
            return self::$status_3;

        if($id == 4)
            return self::$status_4;

        return 'Unknown';
    }



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
        $id = (int) $id;

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

        if($amout < 5000){
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