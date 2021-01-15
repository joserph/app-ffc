<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shipment Confirmation</title>
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
        }

        table{
            width: 100%;
        }
        .small-letter{
            font-size: 10px;
        }
        .medium-letter{
            font-size: 11px;
        }
        .farms{
            width: 300px;
        }
        
        table.sinb{
            margin: 0 auto;
            width: 60%;
        }
        table.sinb, th{
            border: 1px solid black;
            height: 15px;
        }
        table.sinb, td{
            border: 1px solid black;
            height: 13px;
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
        .box-size{
            width: 40px;
        }
        .hawb{
            width: 75px;
        }
        .pcs-bxs{
            width: 40px;
        }
        .gris{
            background-color: #A6ABAB;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th colspan="4">Shiptment Confirmation</th>
        </tr>
        <tr>
            <th>Date:</th>
            <th>{{ $load->date }}</th>
            <th>PCS</th>
            <th>{{ $totalPieces }}</th>
        </tr>
        <tr>
            <th>Client:</th>
            <th>{{ $company->name }}</th>
            <th>Carrier:</th>
            <th>MARITIMO</th>
        </tr>
        <tr>
            <th>AWB:</th>
            <th colspan="3">{{ $load->bl }}</th>
        </tr>
    </table>
    <br>
    <table>
        @foreach($clients as  $key => $client)
        <thead>
            <tr>
                <th colspan="8" class="sin-border"></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th class="text-center medium-letter">AWB</th>
                <th class="text-center medium-letter" colspan="7">{{ $client['client']['name'] }}</th>
            </tr>
        </thead>
        <thead>
            <tr class="gris">
                <th class="text-center medium-letter">Exporter</th>
                <th class="text-center medium-letter hawb">Variety</th>
                <th class="text-center medium-letter hawb">HAWB</th>
                <th class="text-center medium-letter pcs-bxs">PCS</th>
                <th class="text-center medium-letter pcs-bxs">BXS</th>
                <th class="text-center medium-letter box-size">HALF</th>
                <th class="text-center medium-letter box-size">QUART</th>
                <th class="text-center medium-letter box-size">OCT</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tPieces = 0; $tFulls = 0; $tHb = 0; $tQb = 0; $tEb = 0; $totalFulls = 0; $totalHb = 0; $totalQb = 0; $totalEb = 0;
                
            @endphp
            @foreach($invoiceItems as $item)
            @if($client['id_client'] == $item->id_client)
            @php
                $tPieces+= $item->pieces;
                $tFulls+= $item->fulls;
                $tHb+= $item->hb;
                $tQb+= $item->qb;
                $tEb+= $item->eb;
            @endphp
            <tr>
                <td class="small-letter farms">{{ $item->name }}</td>
                <td class="small-letter text-center">{{ $item->variety->name }}</td>
                <td class="small-letter text-center">{{ $item->hawb }}</td>
                <td class="small-letter text-center">{{ $item->pieces }}</td>
                <td class="small-letter text-center">{{ $item->fulls }}</td>
                <td class="small-letter text-center">{{ $item->hb }}</td>
                <td class="small-letter text-center">{{ $item->qb }}</td>
                <td class="small-letter text-center">{{ $item->eb }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        @php
            $totalFulls+= $tFulls;
            $totalHb+= $tHb;
            $totalQb+= $tQb;
            $totalEb+= $tEb;
        @endphp
        <tfoot>
            <tr class="gris">
                <th class="medium-letter text-right" colspan="3">Total:</th>
                <th class="medium-letter">{{ $tPieces }}</th>
                <th class="medium-letter">{{ $tFulls }}</th>
                <th class="medium-letter">{{ $tHb }}</th>
                <th class="medium-letter">{{ $tQb }}</th>
                <th class="medium-letter">{{ $tEb }}</th>
            </tr>
        @endforeach
            <tr>
                <th colspan="8" class="sin-border"></th>
            </tr>
            <tr class="gris">
                <th colspan="3">Total Global:</th>
                <th class="medium-letter">{{ $totalPieces }}</th>
                <th class="medium-letter">{{ $totalFulls }}</th>
                <th class="medium-letter">{{ $totalHb }}</th>
                <th class="medium-letter">{{ $totalQb }}</th>
                <th class="medium-letter">{{ $totalEb }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>