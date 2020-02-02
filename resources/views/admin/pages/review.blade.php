@extends('layouts.cabinet')

@section('content')
    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12" id="vue-app">

                <div class="overview__line">
                    <h2 class="overview__title">Обзор</h2>
                </div>

                <div class="table table__name">
                    <span>Просмотр краткой сводки по Вашему портфелю и получение детальной информации о движениях по счету.</span>
                </div>

                <div class="table" v-if="accountList">
                    <div class="table__head">
                        <div class="table__head_col">Вид счета</div>
                        <div class="table__head_col">Количество</div>
                        <div class="table__head_col">Общая сумма</div>
                    </div>
                    @isset($types)
                        @foreach($types as $type)
                            <div class="table__list @if($loop->iteration % 2 )  table__list-gray  @endif  " >
                            <div class="table__list_col">
                                <a href="/accounts/{{$type->id}}">{{$type->title}}</a>
                            </div>
                            <div class="table__list_col table__list_col-center">{{$count[$loop->iteration - 1]}}</div>
                            <div class="table__list_col table__list_col-right">
                                {{$amount[$loop->iteration - 1]}} EUR
                            </div>
                        </div>
                        @endforeach
                    @endisset


                </div>

                <div class="table__buttons">
                    <a class="btn" href="#">Файл в формате Excel</a>

                    <a class="btn" href="#">Сохранить в HTML</a>

                    <a class="btn" href="#">Печать</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection