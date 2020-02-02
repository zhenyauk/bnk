@extends('layouts.cabinet')

@section('title')
Обзор | {{ env('sitename', 'AstroBank') }}
@endsection

@section('content')
    <div class="main-content main-content_height portfolio">
        <div class="row">
            <div class="col col--lg-12">
                <div class="portfolio__content">
                    <h2 class="portfolio__title">Мой портфель</h2>

                    <div class="main-list">
                        <a href="/accounts">Обзор:</a>
                        <span>Просмотр краткой сводки по Вашему портфелю и получение детальной информации о движениях по счету</span>
                    </div>
                    <div class="main-list">
                        <a href="/accounts/1">Осуществление операций по счету:</a> <span>Просмотр своих счетов, балансов и деталей операций в режиме реального времени, а также получение выписки по электронной почте</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection