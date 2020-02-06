@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')


    <div class="main-content main-content_height table-width" style="height: 700px; overflow: scroll">
        <div class="row">
            <div class="col col--lg-12">
                <div class="table-block blue" style="width: 100%">
                    <div class="table-row">
                        Детали платежа
                    </div>
                </div>


                <div class="block-table">
                    Со счета
                </div>
                <div class="block-table1">
                    {{\App\Helpers\_Helper::getAccountNumber(session('form_data.account'))}}
                </div>

                <div class="block-table">
                    Наименование Плательщика
                </div>
                <div class="block-table1">
                    {{session('form_data.payer_name')}}
                </div>

                <div class="block-table">
                    Номер телефона Плательщика
                </div>
                <div class="block-table1">
                    {{session('form_data.payer_phone')}}
                </div>

                <div class="block-table">
                    Страна назначения
                </div>
                <div class="block-table1">
                    {{\App\Helpers\_Helper::getCountry(session('form_data.country_id'))}}
                </div>
                <div class="clear" style="clear: both"></div>

                <!-- Recipient -->
                <p class="info">Сведения о Получателе</p>

                <div class="block-table">
                    IBAN/Счет Получателя
                </div>
                <div class="block-table1">
                    {{session('form_data.iban')}}
                </div>

                <div class="block-table">
                    Тип счета
                </div>
                <div class="block-table1">
                    IBAN
                </div>

                <div class="block-table">
                    Полное имя и адрес
                </div>
                <div class="block-table1">
                    {{session('form_data.recipier_name')}}
                </div>

                <div class="block-table">
                    BIC Банка Получателя
                </div>
                <div class="block-table1">
                    {{session('form_data.bic_bank')}}
                </div>

                <div class="block-table">
                   Банк Получателя
                </div>
                <div class="block-table1">
                    {{session('form_data.recipier_bank')}}
                </div>
                <div class="clear"style="clear: both"></div>
                <!-- Recipient -->
                <p class="info">Подробная информация о переводе</p>

                <div class="block-table">
                    Детали платежа
                </div>
                <div class="block-table1">
                    {{session('form_data.recipier_info')}}
                </div>

                <div class="block-table">
                    Комиссия
                </div>
                <div class="block-table1">
                    {{\App\Helpers\CurrencyHelper::getComisionTitle(session('form_data.comision'))}}
                </div>
                <div class="clear" style="clear: both"></div>


                    <p class="info">В случае исполнения Вашего платежа
                    сегодня ({{date('d-m-Y')}}), с Вашего счета будет списана сумма:
                    </p>

                    <div class="block-table">
                        Основная сумма
                    </div>
                    <div class="block-table1">
                        {{ \App\Helpers\CurrencyHelper::getAccountCurrencyCode(session('form_data.account'))}}
                        {{session('form_data.amount')}}
                    </div>

                    <div class="block-table">
                        Комиссии и расходы
                    </div>
                    <div class="block-table1">
                        USD {{\App\Helpers\CurrencyHelper::getComission(session('form_data.comision'), session('form_data.amount'))}}

                    </div>

                    <div class="block-table">
                        Курс конвертации
                    </div>
                    <div class="block-table1">
                        1 USD = {{\App\Helpers\CurrencyHelper::$currency_1}} EUR

                    </div>
                    <div class="clear" style="clear: both"></div>
                <form action="/payment/finish" method="post">

                    <div class="textarea__item">
                        <input required name="conditions" type="checkbox" id="conditions"><Label for="conditions">Я прочител и принял <a href="/about">условия</a> которые применяются
                            к исходящим\входящим переводам</Label>
                    </div>


                    <div class="table__buttons " style="margin-top: 20px">
                        @csrf
                        <button class="btn btn-success" type="submit">Оформить</button>
                    </div>
                </form>

            </div>

            <div class="table__button_row">
                <div class="table__buttons table__buttons_offset">
                    <a class="" href="#" onclick="window.history.back();">Назад</a>

                </div>

            </div>


        </div>
    </div>


@stop