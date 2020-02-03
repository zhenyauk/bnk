@extends('layouts.cabinet')

@section('content')

    <div class="main-content main-content_height portfolio" style="height:600px; overflow: scroll ">
        <div class="row">
            <div class="col col--lg-12">
                <div class="overview__line">
                    <h2 class="overview__title">Перевод между счетами</h2>
                </div>
                <div class="card card__content">


                    <div class="table table_center table_offset">
                        <div class="table__head">
                            <div class="table__head_col">С</div>
                            <div class="table__head_col">На</div>
                            <div class="table__head_col">Счет</div>
                            <div class="table__head_col">Тип/Валюта</div>
                            <div class="table__head_col">Доступный остаток</div>
                            <div class="table__head_col">Текущий баланс</div>
                        </div>

                        @isset($accounts)
                        @foreach($accounts as $item)
                            <div class="table__list ">
                                <div class="table__list_col">
                                    <input type="radio" name="from_bill" data-id="{{$item->id}}">

                                </div>
                                <div class="table__list_col table__list_col-center" >
                                    <input type="radio" name="to_bill" data-id="{{$item->id}}>
                                </div>
                                <div class="table__list_col table__list_col-right" >
                                    {{$item->number}}
                                </div>
                                <div class="table__list_col table__list_col-right">
                                    {{$item->accounttype->title}} / {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}
                                </div>
                                <div class="table__list_col table__list_col-right">
                                {{$item->balance_current}}
                                {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}
                                </div>
                                <div class="table__list_col table__list_col-right">
                                    {{$item->balance_current}}
                                    {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}
                                </div>
                            </div>
                        @endforeach
                        @endisset

                    </div>

                    <div class="" style="padding-top:30px; margin-bottom: 100px" >

                        <div class="form-group">
                            <label for="amount">Сумма перевода</label><br>
                            <input style="margin-top:4px;" type="text" name="amount" class="form-control">
                        </div>

                        <div class="form-group" style="margin-top:10px; margin-bottom: 10px">
                            <label for="amount">Назначение платежа</label><br>
                            <textarea  name="" id="" cols="20" rows="3"></textarea>
                        </div>

                        <button  type="submit" class="btn btn-success">Далее</button>

                    </div>




            </div>
        </div>
    </div>


@stop

@section('menu')
    {!! \App\Helpers\_Helper::getMenu('second') !!}
@stop