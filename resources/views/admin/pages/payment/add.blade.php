@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')


    <div class="main-content main-content_height" style="min-height: 700px; overflow: scroll">
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
                       
                        <form action="{{route('payment.store')}}" method="post">
                            <p style="margin:10px 0;"><label for="">Наименование плательщика</label></p>
                            <p><textarea name="payer_name" id="" cols="20" rows="4"></textarea></p>

                            <p style="margin:10px 0;"><label for="">Номер телефона плательщика</label></p>
                            <p><input type="text" name="payer_phone"></p>


                    </div>

                    <div class="line-req">
                        <label> Пожалуйста, введите реквезиты получателя или выбирите соответствующие реквезиты из списка:</label><select
                                name="" id="">
                            <option value="">Выбирите</option>
                        </select>
                    </div>

                    <div class="textarea-content">
                        <div class="textarea__item">
                            <div class="textarea-block">
                                Адрес Получателя*
                            </div>
                            <textarea name="recipier_info" class="textarea textarea_default form-control"></textarea>
                        </div>

                        <div class="textareaitem" style="margin:10px 0">
                            <div class="textarea-block" style="float: left">
                                Страна получателя*
                            </div>
                            <select value="recipier_country">
                                @foreach($countries as $item)
                                    <option name="{{$item->id}}" id="">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="textarea__item">

                            <div class="textarea-block">Сумма*</div>
                            <input name="amount" required type="text" class="form-control" style="margin-right: 10px"> {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                        </div>
                        <p style="font-weight: bold; margin:20px 0 10px 0; ">Сведения о получателе</p>

                        <div class="textarea__item">
                            <div class="textarea-block">IBAN/Счет Получателя*</div>
                            <input type="text" required name="iban" class="form-control">
                        </div>

                        <div class="textarea__item">
                            <div class="textarea-block">Полное имя и адрес*</div>
                            <input type="text" required name="recipier_name" class="form-control">
                        </div>

                        <div class="textarea__item">
                            <div class="textarea-block">БИК Банка получателя</div>
                            <input type="text"  name="bic_bank" class="form-control">
                        </div>


                        <div class="textarea__item">
                            <div class="textarea-block">
                                Банк получателя*
                            </div>
                            <input type="text"  required name="recipier_bank">
                        </div>

                        <div class="textarea__item">
                            <div class="textarea-block">
                                Детали платежа
                            </div>
                            <textarea name="recipier_info" id="" cols="20" rows="3"></textarea>
                        </div>

                        <div class="line-req">
                            <label><input type="checkbox" name="save"> Сохранить реквизиты получателя под названием:</label>

                        </div>


                    </div>

                    @csrf
                    <div class="form__button">
                        <button type="submit" class="btn btn_blue">
                            Далее
                        </button>
                    </div>
            </form>


            </div>
        </div>

    </div>




@stop