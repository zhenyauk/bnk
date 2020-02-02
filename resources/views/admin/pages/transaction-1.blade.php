@extends('layouts.cabinet')

@section('content')

    <div class="main-content main-content_height" style="height: 600px; overflow: scroll;">
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 class="overview__title">
                        Движение средств по счету
                    </h2>
                </div>

                <div class="card card__content">
                    <div class="card__content_blue">
                        <div class="card__list">
                            <div class="name">
                                Счет:
                            </div>
                            <div class="price">
                                <form id="account_select_form" action="{{route('transaction.show')}}" method="post">
                                    @csrf
                                    <select name="account" id="account_select">
                                        @isset($accounts)
                                            @foreach($accounts as $item)
                                                <option value="{{$item->id}}">{{$item->number}}  {{$item->iban}} {{$item->balance_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}</option>
                                            @endforeach
                                        @endisset
                                    </select>

                                </form>
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">
                                IBAN:
                            </div>
                            <div class="price">
                                CY89008001700000000001955310
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">
                                Валюта:
                            </div>
                            <div class="price">
                                EUR
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">
                                Текущий баланс:
                            </div>
                            <div class="price">
                               {{$trans->balance}} EUR
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">
                                Доступный остаток:
                            </div>
                            <div class="price">
                                {{$trans->balance}} EUR
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">
                                Критерий поиска:
                            </div>
                            <div class="price price_row">
                                <div class="price-input">
                                    C: <input class="myInput" id="myDatePicker-1" data-lang="ru" data-years="1995-2030" data-sundayfirst="false">
                                </div>
                                <div class="price-input">
                                    По: <input class="myInput" id="myDatePicker-1" data-lang="ru" data-years="1995-2030" data-sundayfirst="false">
                                </div>
                            </div>
                        </div>

                        <div class="table__buttons table__buttons_offset">
                            <a class="btn">Поиск</a>
                        </div>
                    </div>

                    <div class="table table_center table_offset">
                        <div class="table__head">
                            <div class="table__head_col">
                                Дата выполнения операции
                            </div>

                            <div class="table__head_col">
                                Детали платежа
                            </div>

                            <div class="table__head_col">
                                Сумма
                            </div>
                            <div class="table__head_col">
                                Остаток
                            </div>
                            <div class="table__head_col">
                                Дата валютирования
                            </div>
                            <div class="table__head_col">
                                Комментарии
                            </div>
                        </div>
                        @isset($transactions)
                        @foreach($transactions as $item)
                            <div class="table__list @if($loop->iteration % 2) table__list-gray @endif">
                            <div class="table__list_col">
                                <input type="radio" name="table">
                                <a href="overview-t1-d.html"> {{$item->updated_at->format('d-m-Y')}} </a>
                            </div>
                            <div class="table__list_col table__list_col-center">
                               {{$item->type}}
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
                                {!! $item->description !!}
                            </div>

                        </div>
                        @endforeach
                        @endisset


                    </div>

                    <div class="pagination pagination_offset">
                        Страница 2: <a href="#">Предыдущее</a> <a href="#">Следующая</a>
                    </div>

                </div>




                <div class="table__buttons table__buttons_offset">
                    <a class="btn" href="#">Назад</a>
                    <a class="btn" href="overview-t1-dt-2.html">Детали</a>
                </div>
                <div class="table__buttons ">
                    <a class="btn" download="" href="#">Файл в формате Excel</a>

                    <a class="btn" download="" href="#">Сохранить в HTML</a>

                    <a class="btn" href="#">Печать</a>
                </div>

            </div>
        </div>

    </div>




@stop