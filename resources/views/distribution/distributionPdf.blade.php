<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COORDINACION AÉREAS - AWB {{ $flight->bl }}</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .text-left{
            text-align: left;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            page-break-before:auto;
        }

        .small-letter{
            font-size: 8px;
            font-weight: normal;
        }
        .medium-letter{
            font-size: 9px;
        }
        .large-letter{
            font-size: 10px;
        }
        .farms{
            width: 280px;
        }
        
        table.sinb{
            margin: 0 auto;
            width: 60%;
        }
        table.sinb, th{
            border: 1px solid black;
        }
        table.sinb, td{
            border: 1px solid black;
        }
        .text-white{
            color: #fff;
        }
        .sin-border{
            border-top: 1px solid white;
            border-right: 1px solid white;
            border-bottom: 1px solid black;
            border-left: 1px solid white;
        }
        .sin-border-full{
            border-top: 1px solid white;
            border-right: 1px solid white;
            border-bottom: 1px solid white;
            border-left: 1px solid white;
        }
        .box-size{
            width: 40px;
        }
        .hawb{
            width: 70px;
        }
        .pcs-bxs{
            width: 40px;
        }
        .gris{
            background-color: #d1cfcf;
        }
        .gris2{
            background-color: #f0f0f0;
        }
        .coordinado{
            background-color: rgb(217, 244, 255);
        }
        .recibido{
            background-color: rgb(191, 255, 231);
        }
        .devolucion{
            background-color: rgb(255, 187, 200);
        }
        .faltante{
            background-color: rgb(255, 255, 175);
        }
        .text-rojo{
            color: red;
        }
        .variety{
            width: 70px;
        }
        .pcs-num{
            width: 30px;
        }
        .missing{
            width: 55px;
        }
        .blue{
            background-color: #00b0f0;
        }
        .yellow{
            background-color: #ffff00;
        }
        .green{
            background-color: #00b050;
        }
        .green-l{
            background-color: #e2efda;
        }
        .peach{
            background-color: #fff2cc;
        }
    </style>
</head>
<body>
    <table class="sin-border-full">
        <tr>
            <th class="sin-border-full">COORDINACIONES AÉREAS</th>
        </tr>
        <tr>
            <td class="sin-border-full" rowspan="3" style="width: 80%"><img src="https://freshflowercargo.com/wp-content/uploads/2020/07/cropped-cropped-FRESHFLOWERCARGO-logo-horizontal.png" alt="" width="100"></td>
            <td class="medium-letter sin-border-full">AWB</td>
            <td class="medium-letter sin-border-full">{{ $flight->awb }}</td>
        </tr>
        <tr>
            <td class="medium-letter sin-border-full">FECHA SALIDA</td>
            <td class="medium-letter sin-border-full">{{ date('d/m/Y', strtotime($flight->date)) }}</td>
        </tr>
        <tr>
            <td class="medium-letter sin-border-full">FECHA LLEGADA</td>
            <td class="medium-letter sin-border-full">{{ date('d/m/Y', strtotime($flight->arrival_date)) }}</td>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th class="medium-letter" colspan="15">COORDINACIONES AÉREAS - AWB {{ $flight->awb }}</th>
            </tr>
            <tr class="">
                <th class="text-center blue hawb medium-letter">HAWB</th>
                <th class="text-center blue medium-letter farms">FINCA</th>
                <th class="text-center blue medium-letter variety">VARIEDAD</th>
                <th class="text-center yellow medium-letter coordinado pcs-num">PCS</th>
                <th class="text-center yellow medium-letter coordinado pcs-num">HB</th>
                <th class="text-center yellow medium-letter coordinado pcs-num">QB</th>
                <th class="text-center yellow medium-letter coordinado pcs-num">EB</th>
                <th class="text-center yellow medium-letter coordinado pcs-num">FULL</th>
                <th class="text-center green medium-letter recibido pcs-num">PCS</th>
                <th class="text-center green medium-letter recibido pcs-num">HB</th>
                <th class="text-center green medium-letter recibido pcs-num">QB</th>
                <th class="text-center green medium-letter recibido pcs-num">EB</th>
                <th class="text-center green medium-letter recibido pcs-num">FULL</th>
                <th class="text-center blue medium-letter faltante missing">DIFERENCIA</th>
                <th class="text-center blue medium-letter faltante">OBSERVACIÓN</th>
            </tr>
        </thead>
    </table>
    
    <table>
        @php
            $totalFulls = 0; $totalHb = 0; $totalQb = 0; $totalEb = 0; $totalPcsr = 0; $totalHbr = 0; $totalQbr = 0;
            $totalEbr = 0; $totalFullsr = 0; $totalDevr = 0; $totalMissingr = 0;
        @endphp
        
        @foreach($clientsDistribution as $client)
            <thead>
                <tr>
                    <th class="text-center medium-letter" @foreach ($colors as $item) @if ($client['id'] == $item->id_type) style="background:{{ $item->color }}" @endif @endforeach colspan="15">{{ $client['name'] }}</th>
                </tr>
            </thead>
            
            <tbody>
                @php
                    $tPieces = 0; $tFulls = 0; $tHb = 0; $tQb = 0; $tEb = 0; $totalPieces = 0; $tPcsR = 0;
                    $tHbr = 0; $tQbr = 0; $tEbr = 0; $tFullsR = 0; $tDevR = 0; $tMissingR = 0;
                @endphp
                @foreach($coordinations as $item)
                    @if($client['id'] == $item->id_client)
                        @php
                            $tPieces+= $item->pieces;
                            $tFulls+= $item->fulls;
                            $tHb+= $item->hb;
                            $tQb+= $item->qb;
                            $tEb+= $item->eb;
                            $tPcsR+= $item->pieces_r;
                            $tHbr+= $item->hb_r;
                            $tQbr+= $item->qb_r;
                            $tEbr+= $item->eb_r;
                            $tFullsR+= $item->fulls_r;
                            $tDevR+= $item->returns;
                            $tMissingR+= $item->missing;
                        @endphp
                        <tr>
                            <td class="text-center small-letter hawb">{{ $item->hawb }}</td>
                            <td class="farms small-letter">{{ $item->name }}</td>
                            <td class="text-center small-letter variety">{{ $item->variety->name }}</td>
                            <td class="text-center small-letter pcs-num">{{ $item->pieces }}</td>
                            <td class="text-center small-letter pcs-num">{{ $item->hb }}</td>
                            <td class="text-center small-letter pcs-num">{{ $item->qb }}</td>
                            <td class="text-center small-letter pcs-num">{{ $item->eb }}</td>
                            <td class="text-center small-letter pcs-num">{{ number_format($item->fulls, 3, '.','') }}</td>
                            <td class="text-center small-letter pcs-num">{{ $item->pieces_r }}</td>
                            <td class="text-center small-letter pcs-num">{{ $item->hb_r }}</td>
                            <td class="text-center small-letter pcs-num">{{ $item->qb_r }}</td>
                            <td class="text-center small-letter pcs-num">{{ $item->eb_r }}</td>
                            <td class="text-center small-letter pcs-num">{{ number_format($item->fulls_r, 3, '.','') }}</td>
                            <td class="text-center small-letter missing">{{ $item->missing }}</td>
                            <td class="text-center small-letter text-rojo"><small>{{ strtoupper($item->observation) }}</small></td>
                        </tr>
            
                    @endif
                @endforeach
                @php
                    $totalFulls+= $tFulls;
                    $totalHb+= $tHb;
                    $totalQb+= $tQb;
                    $totalEb+= $tEb;
                    $totalPcsr+= $tPcsR;
                    $totalHbr+= $tHbr;
                    $totalQbr+= $tQbr;
                    $totalEbr+= $tEbr;
                    $totalFullsr+= $tFullsR;
                    $totalDevr+= $tDevR;
                    $totalMissingr+= $tMissingR;
                @endphp
                <tr class="">
                    <th class="text-center medium-letter" colspan="3">SUB-TOTAL:</th>
                    <th class="text-center green-l medium-letter">{{ $tPieces }}</th>
                    <th class="text-center green-l medium-letter">{{ $tHb }}</th>
                    <th class="text-center green-l medium-letter">{{ $tQb }}</th>
                    <th class="text-center green-l medium-letter">{{ $tEb }}</th>
                    <th class="text-center green-l medium-letter">{{ number_format($tFulls, 3, '.','') }}</th>
                    <th class="text-center peach medium-letter">{{ $tPcsR }}</th>
                    <th class="text-center peach medium-letter">{{ $tHbr }}</th>
                    <th class="text-center peach medium-letter">{{ $tQbr }}</th>
                    <th class="text-center peach medium-letter">{{ $tEbr }}</th>
                    <th class="text-center peach medium-letter">{{ number_format($tFullsR, 3, '.','') }}</th>
                    <th class="text-center medium-letter">{{ $tMissingR }}</th>
                    <th class="text-center medium-letter"></th>
                </tr>
            </tbody>
        @endforeach
        <tfoot>
            @php
                $totalPieces+= $totalHb + $totalQb + $totalEb;
            @endphp
            
            <tr>
                <th colspan="15" class="sin-border"></th>
            </tr>
            <tr class="">
                <th class="text-center blue medium-letter" colspan="3">TOTAL GLOBAL:</th>
                <th class="text-center yellow medium-letter">{{ $totalPieces }}</th>
                <th class="text-center yellow medium-letter">{{ $totalHb }}</th>
                <th class="text-center yellow medium-letter">{{ $totalQb }}</th>
                <th class="text-center yellow medium-letter">{{ $totalEb }}</th>
                <th class="text-center yellow medium-letter">{{ number_format($totalFulls, 3, '.','') }}</th>
                <th class="text-center green medium-letter">{{ $totalPcsr }}</th>
                <th class="text-center green medium-letter">{{ $totalHbr }}</th>
                <th class="text-center green medium-letter">{{ $totalQbr }}</th>
                <th class="text-center green medium-letter">{{ $totalEbr }}</th>
                <th class="text-center green medium-letter">{{ number_format($totalFullsr, 3, '.','') }}</th>
                <th class="text-center blue medium-letter">{{ $totalMissingr }}</th>
                <th class="text-center medium-letter"></th>
            </tr>
        </tfoot>

    </table>
</body>
</html>