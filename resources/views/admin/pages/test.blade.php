<style>
    body { font-family: DejaVu Sans, sans-serif; width: 700px; }
    .title-div{
        width:700px;
        border:1px solid #000;
    }
    .right-div{
        padding-left:5px ;
    }
    .left-div, .right-div{
        height: 191px;
    }

    .left-div{
        width:160px;
        float: left;
        border-right:1px solid #000;
        background: #D3D3EA;
        font-size: 13px;
        padding-left:10px;

    }
    .left-div p, .right-div p {
        padding:0;
        margin-left: 2px;
        margin-bottom: 0;
        margin-top: 2px;
        font-size: 12px;
    }
    .left-div p span{
        font-weight: bold;
    }
    .mc-1{
        float: left;
        width:440px;

    }

    #transact tr th{
        font-size: 12px;
        font-weight: normal;
    }
    #transact tr td{
       margin-bottom: 10px;
    }

</style>
<script type="text/php">
    if ( isset($pdf) ) {
        $font = Font_Metrics::get_font("helvetica", "bold");
        $pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
    }
</script>

<body>


<div class="left" style="float:left;">
    <img style="width:165px; height:75px;" src="{{ public_path('images\logo5.png')}}" alt="ss">
    <div style="font-weight: bold; font-size: 12px; margin-top:-20px">AstroBank Limited</div>
    <br>
    <div style="font-weight: bold; font-size: 12px">BIC: PIRBCY2N</div>

</div>

<div class="right" style="float: right;">
    <h2 style="font-weight: normal">Операции по счету</h2>
    <div class="line" style="text-align: right; width: 235px;  font-size: 12px">С: {{ $data2['from_date'] ?? '10-10-2019' }}</div>
    <div class="line" style="text-align: right; width: 235px; font-size: 12px ">ПО: {{ $data2['to_date'] ?? '10-10-2020' }}</div>
</div>

<div class="clear" style="clear: both"></div>
<br>
<div class="clear" style="clear: both"></div>

<div class="title-div" style="border-bottom: 1px solid #000">
    <div class="left-div">
        <p>Ваш cчет: </p>
        <br> <br><br>
        <p style="margin-top: -5px">IBAN: </p>
        <br>
        <p>Ваше отделение: </p>
        <br> <br>
        <p>Владелец: </p>
        <br> <br>

    </div>


    <div class="right-div" >
        <div class="mc-1">
            <p>Номер cчета:   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Тип </p>
            <p style="font-size: 11px">{{$acc->number}}  &nbsp  &nbsp <span style="font-size: 11px;">COMMERCIAL CURRENT ACC {{\App\Helpers\CurrencyHelper::getCurrencyCode($acc->id)}} </span></p>
            <br>

            <p>{{$acc->iban}}</p>
            <br>

            <p>INTERNATIONAL BANKING UNIT - <br> NICOSIA
            </p><p>&nbsp;</p>


            <p style="margin-top: -5px">JETLUX LTD [Основной владелец]</p>
            <br>


        </div>
        <div class="mc-2" >
            <p>Валюта</p>
            <p>{{\App\Helpers\CurrencyHelper::getCurrencyCode($acc->currency_id)}} </p>
            <br>

    </div>


</div>
</div>

<div class="clearfix" style="clear: both"></div>

    <table border="0" id="transact" style="font-size: 11px; font-weight: normal;  ">
        <tr style="color:white; margin: 0; background: #000; text-align: center; border:0" >
            <th style="width:100px; border:0;">Дата</th>
            <th style="padding: 5px">Описание операции</th>
            <th>Дата валютирования</th>
            <th style="width:40px">Списание</th>
            <th>Зачисление</th>
            <th>Баланс</th>
        </tr>

        @foreach($trans as $item)
            <tr>
                <td style="height: 90px; text-align: center">{{$item->created_at->format('d-m-Y')}}</td>
                <td style=" text-align: center; font-size: 10px">{{$item->description ?? ''}}</td>
                <td style=" text-align: center">{{$item->created_at->format('d-m-Y')}}</td>
                <td style=" text-align: center">
                    @if($item->type == 'OUT')  {{$item->amount}}  @endif
                </td>

                <td style=" text-align: center">
                    @if($item->type == 'IN') {{$item->amount}} @endif
                </td>
                <td style=" text-align: center">
                     {{$item->balance}}
                </td>


            </tr>
            @if ($loop->last)
                <tr>

                </tr>
            @endif
        @endforeach

    </table>





</body>