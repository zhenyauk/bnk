@extends('layouts.cabinet')

@section('content')

    <div class="main-content main-content_height portfolio" style="height:600px; overflow: scroll ">
        <div class="row">
            <div class="col col--lg-12">
                <div class="overview__line">
                    <h2 class="overview__title">Движение средств по счету</h2>
                </div>
                <div class="card card__content">
                    <div class="card__content_blue">
                        <div class="card__list">
                            <div class="name">Счет:</div>
                            <div class="price">
                                <div list="">
                                    <form id="account_select_form" action="{{route('transaction.arhive')}}" method="post">
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
                                <div class="price">{{$account->iban}}</div>
                            </div>
                            <div class="card__list">
                                <div class="name">Валюта:</div>
                                <div class="price">{{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}</div>
                            </div>
                            <div class="card__list">
                                <div class="name">Текущий баланс:</div>
                                <div class="price">
                                    <div>
                                        {{$account->balance_current ?? '0'}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                                    </div>
                                </div>
                            </div>
                            <div class="card__list">
                                <div class="name">Доступный остаток:</div>
                                <div class="price">
                                    <div>
                                        {{$account->balance_available_current ?? 0}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                                    </div>
                                </div>
                            </div>
                            <div class="card__list">
                                <div class="name">Критерий поиска:</div>
                                <div class="price price_row">
                                    <div class="price-input">
                                        C:
                                        <div class="vdp-datepicker">
                                            <div class="">
                                                <!----> <input type="text" readonly="readonly" autocomplete="off"> <!---->
                                            </div>
                                            <div class="vdp-datepicker__calendar" style="display: none;">
                                                <header><span class="prev">&lt;</span> <span class="day__month_btn up">Feb 2020</span> <span class="next">&gt;</span></header>
                                                <div class=""><span class="cell day-header">Mon</span><span class="cell day-header">Tue</span><span class="cell day-header">Wed</span><span class="cell day-header">Thu</span><span class="cell day-header">Fri</span><span class="cell day-header">Sat</span><span class="cell day-header">Sun</span> <span class="cell day blank"></span><span class="cell day blank"></span><span class="cell day blank"></span><span class="cell day blank"></span><span class="cell day blank"></span><span class="cell day selected weekend sat">1</span><span class="cell day today weekend sun">2</span><span class="cell day">3</span><span class="cell day">4</span><span class="cell day">5</span><span class="cell day">6</span><span class="cell day">7</span><span class="cell day weekend sat">8</span><span class="cell day weekend sun">9</span><span class="cell day">10</span><span class="cell day">11</span><span class="cell day">12</span><span class="cell day">13</span><span class="cell day">14</span><span class="cell day weekend sat">15</span><span class="cell day weekend sun">16</span><span class="cell day">17</span><span class="cell day">18</span><span class="cell day">19</span><span class="cell day">20</span><span class="cell day">21</span><span class="cell day weekend sat">22</span><span class="cell day weekend sun">23</span><span class="cell day">24</span><span class="cell day">25</span><span class="cell day">26</span><span class="cell day">27</span><span class="cell day">28</span><span class="cell day weekend sat">29</span></div>
                                            </div>
                                            <div class="vdp-datepicker__calendar" style="display: none;">
                                                <header><span class="prev">&lt;</span> <span class="month__year_btn up">2020</span> <span class="next">&gt;</span></header>
                                                <span class="cell month">January</span><span class="cell month selected">February</span><span class="cell month">March</span><span class="cell month">April</span><span class="cell month">May</span><span class="cell month">June</span><span class="cell month">July</span><span class="cell month">August</span><span class="cell month">September</span><span class="cell month">October</span><span class="cell month">November</span><span class="cell month">December</span>
                                            </div>
                                            <div class="vdp-datepicker__calendar" style="display: none;">
                                                <header><span class="prev">&lt;</span> <span>2020 - 2029</span> <span class="next">&gt;</span></header>
                                                <span class="cell year selected">2020</span><span class="cell year">2021</span><span class="cell year">2022</span><span class="cell year">2023</span><span class="cell year">2024</span><span class="cell year">2025</span><span class="cell year">2026</span><span class="cell year">2027</span><span class="cell year">2028</span><span class="cell year">2029</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-input">
                                        По:
                                        <div class="vdp-datepicker">
                                            <div class="">
                                                <!----> <input type="text" readonly="readonly" autocomplete="off"> <!---->
                                            </div>
                                            <div class="vdp-datepicker__calendar" style="display: none;">
                                                <header><span class="prev">&lt;</span> <span class="day__month_btn up">Feb 2020</span> <span class="next">&gt;</span></header>
                                                <div class=""><span class="cell day-header">Mon</span><span class="cell day-header">Tue</span><span class="cell day-header">Wed</span><span class="cell day-header">Thu</span><span class="cell day-header">Fri</span><span class="cell day-header">Sat</span><span class="cell day-header">Sun</span> <span class="cell day blank"></span><span class="cell day blank"></span><span class="cell day blank"></span><span class="cell day blank"></span><span class="cell day blank"></span><span class="cell day weekend sat">1</span><span class="cell day today weekend sun">2</span><span class="cell day">3</span><span class="cell day">4</span><span class="cell day">5</span><span class="cell day">6</span><span class="cell day">7</span><span class="cell day weekend sat">8</span><span class="cell day weekend sun">9</span><span class="cell day">10</span><span class="cell day">11</span><span class="cell day">12</span><span class="cell day">13</span><span class="cell day">14</span><span class="cell day weekend sat">15</span><span class="cell day weekend sun">16</span><span class="cell day">17</span><span class="cell day">18</span><span class="cell day">19</span><span class="cell day">20</span><span class="cell day">21</span><span class="cell day weekend sat">22</span><span class="cell day weekend sun">23</span><span class="cell day">24</span><span class="cell day">25</span><span class="cell day">26</span><span class="cell day">27</span><span class="cell day">28</span><span class="cell day selected weekend sat">29</span></div>
                                            </div>
                                            <div class="vdp-datepicker__calendar" style="display: none;">
                                                <header><span class="prev">&lt;</span> <span class="month__year_btn up">2020</span> <span class="next">&gt;</span></header>
                                                <span class="cell month">January</span><span class="cell month selected">February</span><span class="cell month">March</span><span class="cell month">April</span><span class="cell month">May</span><span class="cell month">June</span><span class="cell month">July</span><span class="cell month">August</span><span class="cell month">September</span><span class="cell month">October</span><span class="cell month">November</span><span class="cell month">December</span>
                                            </div>
                                            <div class="vdp-datepicker__calendar" style="display: none;">
                                                <header><span class="prev">&lt;</span> <span>2020 - 2029</span> <span class="next">&gt;</span></header>
                                                <span class="cell year selected">2020</span><span class="cell year">2021</span><span class="cell year">2022</span><span class="cell year">2023</span><span class="cell year">2024</span><span class="cell year">2025</span><span class="cell year">2026</span><span class="cell year">2027</span><span class="cell year">2028</span><span class="cell year">2029</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="table__buttons table__buttons_offset"><a class="btn">Поиск</a></div>
                        </div>
                    </div>

                    <div class="table table_center table_offset">
                        <div class="table__head">
                            <div class="table__head_col">Дата выполнения операции</div>
                            <div class="table__head_col">Детали платежа</div>
                            <div class="table__head_col">Сумма</div>
                            <div class="table__head_col">Остаток</div>
                            <div class="table__head_col">Дата валютирования</div>
                            <div class="table__head_col">Комментарии</div>
                        </div>


                        @foreach($transactions as $item)
                        <div class="table__list ">
                            <div class="table__list_col">
                                <input type="radio" name="table">
                                <a href="overview-t1-d.html">
                                    {{$item->updated_at->format('d-m-Y')}}
                                </a>
                            </div>
                            <div class="table__list_col table__list_col-center">
                               {{$item->description ?? ''}}
                            </div>
                            <div class="table__list_col table__list_col-right" @if($item->type === 'OUT') style="color:red" @endif>
                                @if($item->type === 'OUT') - @endif {{$item->amount}} EUR
                            </div>
                            <div class="table__list_col table__list_col-right">
                                {{$item->balance}} EUR
                            </div>
                            <div class="table__list_col table__list_col-right">
                                {{$item->updated_at->format('d-m-Y')}}
                            </div>
                            <div class="table__list_col table__list_col-right">
                                {{$item->comment ?? ''}}
                            </div>
                        </div>
                        @endforeach


                    </div>




                    <div class="pagination pagination_offset">
                        <!---->
                    </div>
                </div>
                <div class="table__buttons table__buttons_offset"><a href="#" class="btn">Назад</a></div>
                <div class="table__buttons "><a href="#" class="btn">Details</a> <a href="#" class="btn">Файл в формате Excel</a> <a href="#" class="btn">Сохранить в HTML</a> <a href="#" class="btn">Печать</a></div>
            </div>
        </div>
    </div>


@stop