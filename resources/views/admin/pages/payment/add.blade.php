@extends('layouts.cabinet')

@section('title') Детали счета {{$account->nubmer}}@stop

@section('content')


    <div class="main-content main-content_height" style="min-height: 700px;">
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

                <form class="selected">
                    <div class="select__row">

                        <div class="select__row_text">
                            <span class="red">*</span> Со счета
                        </div>

                        <div class="select__row_item">
                            <select class="select select_js select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option>
                                    Описание Номер Доступный остаток
                                </option>
                                <option>
                                    Описание Номер Доступный остаток
                                </option>
                            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-3w4d-container"><span class="select2-selection__rendered" id="select2-3w4d-container" title="
                                    Описание Номер Доступный остаток
                                ">
                                    Описание Номер Доступный остаток
                                </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>

                    </div>

                    <div class="select__tab tab-widget">

                        <a href="#" class="select__tab_check tab-widget__link active">
                            <input type="radio" name="radio">
                            На личный счет
                        </a>

                        <a href="#" class="select__tab_check tab-widget__link">
                            <input type="radio" name="radio">
                            На счет другого клиента
                        </a>


                        <div class="select__tab__content-list tab active">
                            <div class="select__row_item">
                                <select class="select select_js select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                    <option>
                                        Описание Номер Доступный остаток
                                    </option>
                                    <option>
                                        Описание Номер Доступный остаток
                                    </option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-u0ns-container"><span class="select2-selection__rendered" id="select2-u0ns-container" title="
                                        Описание Номер Доступный остаток
                                    ">
                                        Описание Номер Доступный остаток
                                    </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>

                        <div class="select__tab__content-list tab">
                            <div class="select__row_item-list">
                                Счет <input type="text">
                            </div>
                            <div class="select__row_item-list">
                                Наименование Получателя <input type="text">
                            </div>
                        </div>

                    </div>

                    <div class="line-req">
                        <label><input type="checkbox"> Сохранить реквизиты получателя под названием:</label>
                        <input type="text">
                    </div>

                    <div class="textarea-content">
                        <div class="textarea__item">
                            <div class="textarea-block">
                                Адрес Получателя
                            </div>
                            <textarea class="textarea textarea_default">
                            </textarea>
                        </div>

                        <div class="textarea__item">

                            <div class="textarea-block">Сумма</div>
                            <textarea class="textarea textarea_default">
                            </textarea>
                        </div>
                        <div class="textarea__item">
                            <div class="textarea-block">
                                Валюта
                            </div>
                            <select class="select">
                                <option>Рубли</option>
                                <option>Рубли</option>
                            </select>
                        </div>
                        <div class="textarea__item">
                            <div class="textarea-block">
                                Детали платежа
                            </div>
                            <textarea class="textarea textarea_default">
                                </textarea>
                        </div>




                    </div>

                    <div class="line-req">
                        <label><input type="checkbox"> Сохранить платеж в мои Ярлыки как; </label>
                        <input type="text">
                    </div>

                    <div class="line-yellow">
                        Пожалуйста, укажите дату выполнения данного платежа:
                    </div>

                    <span>
                        Выполнить заявку:
                    </span>

                    <div class="selected__data">
                        <div class="price-input">
                            Выберите дату: <input class="myInput" id="myDatePicker-1" data-lang="ru" data-years="1995-2030" data-sundayfirst="false">
                        </div>
                    </div>

                    <div class="form__button">
                        <a href="price-2-1.html" class="btn btn_blue">
                            Далее
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>




@stop