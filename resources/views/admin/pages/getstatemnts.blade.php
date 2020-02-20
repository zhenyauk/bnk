@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')


    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 class="overview__title">
                        Выписка со счета
                    </h2>
                </div>

                <div class="card card__content">
                    <div class="card__content_blue">

                  

                        <div class="subtitle subtitle_offset">
                            <span>
                                * Точная копия выписки по счету в формате PDF. Если у вас нет приложения Adobe Reader, вы можете загрузить его, нажав на значок
                            </span>

                            <a target="_blank" href="https://get.adobe.com/ru/reader/"><img src="images/acrobat.png" alt=""></a>
                        </div>

                    </div>

                </div>

                <div class="card card__table">
                    <div class="table">
                        <div class="table__row">
                            <div class="table__cell table__cell_blue">Дата выписки</div>
                            <div class="table__cell table__cell_blue">Период транзакций</div>
                            <div class="table__cell table__cell_blue">Точная копия (PDF)</div>
                        </div>
                        @if(count(Auth::user()->statments) > 0)
                            @foreach(Auth::user()->statments as $item)
                                <div class="table__row">
                                <div class="table__cell">{{$item->created_at->format('d.m.Y')}}</div>
                                <div class="table__cell">{{$item->from}} - {{$item->to}}</div>
                                <div class="table__cell">
                                    <a href="/statements/{{$item->url}}"><img src="images/pdf.gif" alt=""></a>
                                </div>
                            </div>
                            @endforeach
                        @else
                            Нет Выписок
                        @endif


                    </div>
                </div>

                <div class="card__button">
                    <a href="#" class="btn btn_blue"  onclick="history.back();return false;">
                        Назад
                    </a>
                </div>

            </div>
        </div>

    </div>


@stop