@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')


    <div class="main-content main-content_height" style="min-height: 700px;">
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 class="overview__title">
                        Конверсионные платежи (Этап 1 из 3)
                    </h2>
                </div>

                <div class="pin-text">
                    <span>Денежные операции, не превышающие 20.000 евро и эквивалента 5.000 евро в любой другой валюте, производятся по официально установленному Банком обменному курсу для долларов США и английских фунтов стерлингов. Обменный курс для денежных операций, превышающих указанный предел, предоставляется Казначейством Банка. Платежные инструкции, полученные до 13:00 местного времени, осуществляются в день получения. Инструкции, полученные после указанного времени, будут осуществлены на следующий после получения рабочий день.
                        Ваш доступный дневной лимит:  <b>0,00 EUR</b> (для необходимого использования первого одноразового пароля extraPIN)  100 000,00 EUR (требующий обязательного вторичного ввода пароля extra PIN при использовании генератора extra PIN) <b>500 000,00 EUR</b> (Company total daily lim</span>
                </div>


                    <div class="select__row">

                        <div class="select__row_text">
                            <span class="red">*</span> Со счета
                        </div>


                                <form id="account_select_form" action="/payment/add" method="post">
                                    @csrf
                                    <select name="account" id="account_select">
                                        @isset($accounts)
                                            @foreach($accounts as $item)
                                                <option @if($account->id === $item->id) selected @endif value="{{$item->id}}">{{$item->number}}  {{$item->iban}} {{$item->balance_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </form>


                    </div>

                    <div class="select__tab tab-widget">

                        <a href="#" class="select__tab_check tab-widget__link ">
                            <input type="radio" name="radio">
                            На личный счет
                        </a>

                        <a href="#" class="select__tab_check tab-widget__link active">
                            <input type="radio" name="radio" >
                            На счет другого клиента
                        </a>


                        <div class="select__tab__content-list tab active" style="display: none;">
                            <div class="price">
                                <form id="account_select_form3" action="sss" method="post">
                                    @csrf
                                    <select name="account" id="account_select3">
                                        @isset($accounts)
                                            @foreach($accounts as $item)
                                                <option  value="{{$item->id}}">{{$item->number}}  {{$item->iban}} {{$item->balance_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </form>
                            </div>
                        </div>

                        <div class="select__tab__content-list tab">
                            <div class="form-group">
                                <label for="account">Счет</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="select__row_item-list">
                                Наименование Получателя <input type="text">
                            </div>
                        </div>

                    </div>

                    <div class="line-req">
                        <label><input type="checkbox"> Сохранить реквизиты получателя под названием:</label>
                        <input type="text">
                    </div>

                    <div class="textarea-content">
                        <div class="textarea__item">
                            <div class="textarea-block">
                                Адрес Получателя
                            </div>
                            <textarea class="textarea textarea_default form-control"></textarea>
                        </div>

                        <div class="textarea__item">

                            <div class="textarea-block">Сумма</div>
                            <input type="text" class="form-control">
                        </div>
                        <div class="textarea__item">
                            <div class="textarea-block">
                                Валюта
                            </div>
                            {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                        </div>

                        <div class="textarea__item">
                            <div class="textarea-block">Банк получателя</div>
                            <input type="text" class="form-control">
                        </div>

                        <div class="textarea__item">
                            <div class="textarea-block">Референс платежа</div>
                            <input type="text" class="form-control">
                        </div>

                        <div class="textarea__item">
                            <div class="textarea-block">Страна</div>
                            <input type="text" class="form-control">
                        </div>


                        <div class="textarea__item">
                            <div class="textarea-block">
                                Детали платежа
                            </div>
                            <textarea class="textarea textarea_default form-control"></textarea>
                        </div>




                    </div>

                    <div class="line-req">
                        <label><input type="checkbox"> Сохранить платеж в мои Ярлыки как; </label>
                        <input type="text">
                    </div>

                    <div class="line-yellow">
                        Пожалуйста, укажите дату выполнения данного платежа:
                    </div>

                    <span>
                        Выполнить заявку:
                    </span>

                    <div class="selected__data">
                        <div class="price-input">
                            Выберите дату: <input class="myInput" id="myDatePicker-1" data-lang="ru" data-years="1995-2030" data-sundayfirst="false">
                        </div>
                    </div>

                    <div class="form__button">
                        <a href="price-2-1.html" class="btn btn_blue">
                            Далее
                        </a>
                    </div>



            </div>
        </div>

    </div>




@stop