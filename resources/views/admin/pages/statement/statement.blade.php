@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')


    <div class="main-content main-content_height table-width" style="height: 700px; overflow: scroll">
        <div class="row">
            <div class="col col--lg-12">

                    <p style="border-bottom: 1px solid black; color:#627B9B">Выписка по счету по электронной почте</p>

                    <p style="font-weight: bold; margin-top:20px">Параметры выписки</p>

                <form autocomplete="off"  action="{{route('statement.post')}}" method="post">

                    @foreach($accounts as $item)
                        <input required type="radio" name="account[]" value="{{$item->id}}">{{$item->number}} <br>
                    @endforeach
                        <br>

                    @csrf
                    <p>С: <input type="text" class="datepicker" name="from_date"></p><br>
                    <p>ПО: <input type="text" class="datepicker" name="to_date" ></p><br>

                    <p>email: <input required type="email" class="" name="email"></p>
                    <br>
                    <p style="font-weight: bold">
                        Пароль на архив
                    </p>

                    <input type="password" name="password"><br>
                    <input type="password" name="password_confirm"><br>

                    <input type="submit" value="отправить">
                </form>
                
            </div>


@stop