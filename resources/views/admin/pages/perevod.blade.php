@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')



    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">
                <div class="portfolio__content">
                    <h2 class="portfolio__title">
                        Денежные перевод
                    </h2>

                    <div class="main-list">
                        <a href="">На счета клиентов AstroBank:</a>
                        <span>Перевод средств между собственными счетами или на счета третьих лиц в AstroBank</span>
                    </div>
                    <div class="main-list">
                        <a href="{{route('payment.add')}}">Денежные переводы:</a> <span>Перевод средств в другие банки на Кипре или в любую другую страну. Вы также можете просматривать подробную информацию обо всех выполненных переводах и распечатывать выписки и свифты.</span>
                    </div>
                    <div class="main-list">
                        <a href="{{route('transaction.arhive')}}">Архив денежных переводов</a> <span>Просмотр деталей и статуса всех Ваших платежных поручений. Вы также можете отменять, временно приостанавливать или повторно активировать платежные поручения.</span>
                    </div>


                </div>

            </div>
        </div>

    </div>


@stop