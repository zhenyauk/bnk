@extends('layouts.cabinet')

@section('title') Детали счета {{$account->nubmer}}@stop

@section('content')


    <div class="main-content main-content_height portfolio" style="height:600px; overflow: scroll ">
        <div class="row">
            <div class="col col--lg-12">
                <div class="overview__line">
                    <h2 class="overview__title">Детали счета</h2>
                </div>
                <div class="card card__content">
                    <div class="card__list">
                        <div class="name">Счет:</div>
                        <div class="price">
                            <div>
                                <form id="account_select_form" action="{{route('account.show')}}" method="post">
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
                        </div>
                    </div>
                    <div>
                        <div class="card__list">
                            <div class="name">IBAN:</div>
                            <div class="price">{{$item->iban}}</div>
                        </div>
                        <div class="card__list">
                            <div class="name">Валюта:</div>
                            <div class="price">{{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}</div>
                        </div>
                        <div class="card__list-title" style="color: rgb(221, 221, 221);"><span>Владелец:</span></div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Основной владелец:</div>
                            <div class="price">JETLUX LTD</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Debit Interest Rate:0</div>
                            <div class="price"></div>
                        </div>
                        <div class="card__list-title"><span>Детали платежа:</span></div>
                        <div class="card__list">
                            <div class="name">Текущий баланс:</div>
                            <div class="price">
                                <div>
                                    {{$account->balance_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                                </div>
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">Доступный баланс:</div>
                            <div class="price">
                                <div>
                                   {{$account->balance_available_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                                </div>
                            </div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Исходящий остаток:</div>
                            <div class="price">6 273,99 EUR</div>
                        </div>
                        <div class="card__list">
                            <div class="name">Наименьший остаток месяца:</div>
                            <div class="price">
                                <div>
                                    -38.382,22 USD
                                </div>
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">Средний остаток месяца:</div>
                            <div class="price">
                                <div>
                                    -247,15 USD
                                </div>
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">Входящий остаток текущего месяца:</div>
                            <div class="price">
                                <div>
                                    0,00 USD
                                </div>
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">Входящий остаток последнего месяца:</div>
                            <div class="price">
                                <div>
                                    0,00 USD
                                </div>
                            </div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Просроченная задолжность:</div>
                            <div class="price">0,00 EUR</div>
                        </div>
                        <div class="card__list card__list_offset" style="color: rgb(221, 221, 221);">
                            <div class="name">роцентная ставка за превышение лимита:</div>
                            <div class="price">9,5</div>
                        </div>
                        <div class="card__list">
                            <div class="name">Тип Счета:</div>
                            <div class="price">LEGAL COMMERCIAL USD</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Дата последнего депозита:</div>
                            <div class="price">9/1/2020</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Дата оприходования последнего процента:</div>
                            <div class="price">27/2/2018</div>
                        </div>
                        <div class="card__list">
                            <div class="name">Дата открытия счета:</div>
                            <div class="price">20.01.2020</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Дата предварительного формирования выписок:</div>
                            <div class="price">30/11/2019</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Дата последнего формирования выписок:</div>
                            <div class="price">31/12/2019</div>
                        </div>
                        <div class="card__list">
                            <div class="name">Дата последнего платежа:</div>
                            <div class="price">23.01.2020</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Заблокированная сумма:</div>
                            <div class="price">1877,83 EUR</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Сумма последнего депозита:</div>
                            <div class="price">47550,59 EUR</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Временный лимит:</div>
                            <div class="price">0 EUR</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Расчетный/Некапитализированный кредитовый процент:</div>
                            <div class="price">0 EUR</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Расчетный/Некапитализированный дебетовый процент:</div>
                            <div class="price">0 EUR</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Фиксированный лимит:</div>
                            <div class="price">0 EUR</div>
                        </div>
                        <div class="card__list" style="color: rgb(221, 221, 221);">
                            <div class="name">Неоплаченные чеки в сумме:</div>
                            <div class="price">0 EUR</div>
                        </div>
                    </div>
                </div>
                <div class="table__buttons table__buttons_offset"><a href="#" class="btn">Назад</a></div>
                <div class="table__buttons "><a href="#" class="btn">Файл в формате Excel</a> <a href="#" class="btn">Сохранить в HTML</a> <a href="#" class="btn">Печать</a></div>
            </div>
        </div>
    </div>


@stop