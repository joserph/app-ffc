<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COORDINACION MARITIMO {{ $load->bl }}</title>
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
            font-weight: normal;
        }
        .medium-letter{
            font-size: 11px;
        }
        .large-letter{
            font-size: 14px;
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
            background-color: #d1cfcf;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th colspan="4" class="large-letter">COORDINACIONES MARITIMO</th>
        </tr>
        <tr>
            <th colspan="4" class="large-letter">{{ $load->bl }}</th>
        </tr>
    </table>
    <br>
    
    <table class="table table-sm">
        @php
            $totalFulls = 0; $totalHb = 0; $totalQb = 0; $totalEb = 0; $totalPcsr = 0; $totalHbr = 0; $totalQbr = 0;
            $totalEbr = 0; $totalFullsr = 0; $totalDevr = 0; $totalMissingr = 0;
        @endphp
        @foreach($clientsCoordination as $client)
        <thead>
            <tr>
                <th colspan="15" class="sin-border"></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th class="text-center medium-letter">AWB</th>
                <th class="text-center medium-letter" colspan="14">{{ $client['name'] }}</th>
            </tr>
        </thead>
        <thead>
            <tr class="gris">
              <th class="text-center">Finca</th>
              <th class="text-center">HAWB</th>
              <th class="text-center">Variedad</th>
              <th class="text-center">PCS</th>
              <th class="text-center">HB</th>
              <th class="text-center">QB</th>
              <th class="text-center">EB</th>
              <th class="text-center">FULL</th>
              <th class="text-center">PCS</th>
              <th class="text-center">HB</th>
              <th class="text-center">QB</th>
              <th class="text-center">EB</th>
              <th class="text-center">FULL</th>
              <th class="text-center">Dev</th>
              <th class="text-center">Faltantes</th>
              
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
                <td class="farms">{{ $item->name }}</td>
                <td class="text-center">{{ $item->hawb }}</td>
                <td class="text-center">{{ $item->variety->name }}</td>
                <td class="text-center">{{ $item->pieces }}</td>
                <td class="text-center">{{ $item->hb }}</td>
                <td class="text-center">{{ $item->qb }}</td>
                <td class="text-center">{{ $item->eb }}</td>
                <td class="text-center">{{ number_format($item->fulls, 3, '.','') }}</td>
                <td class="text-center">{{ $item->pieces_r }}</td>
                <td class="text-center">{{ $item->hb_r }}</td>
                <td class="text-center">{{ $item->qb_r }}</td>
                <td class="text-center">{{ $item->eb_r }}</td>
                <td class="text-center">{{ number_format($item->fulls_r, 3, '.','') }}</td>
                <td class="text-center">{{ $item->returns }}</td>
                <td class="text-center">{{ $item->missing }}</td>
                
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
           <tr class="gris">
              <th class="text-center text-right" colspan="3">Total:</th>
              <th class="text-center">{{ $tPieces }}</th>
              <th class="text-center">{{ $tHb }}</th>
              <th class="text-center">{{ $tQb }}</th>
              <th class="text-center">{{ $tEb }}</th>
              <th class="text-center">{{ number_format($tFulls, 3, '.','') }}</th>
              <th class="text-center">{{ $tPcsR }}</th>
              <th class="text-center">{{ $tHbr }}</th>
              <th class="text-center">{{ $tQbr }}</th>
              <th class="text-center">{{ $tEbr }}</th>
              <th class="text-center">{{ number_format($tFullsR, 3, '.','') }}</th>
              <th class="text-center">{{ $tDevR }}</th>
              <th class="text-center">{{ $tMissingR }}</th>
           </tr>
        </tbody>
        <tfoot>
        @endforeach
        @php
            $totalPieces+= $totalHb + $totalQb + $totalEb;
        @endphp
            <tr>
                <th colspan="8" class="sin-border"></th>
            </tr>
            <tr class="gris">
                <th class="text-center" colspan="3">Total Global:</th>
                <th class="text-center">{{ $totalPieces }}</th>
                <th class="text-center">{{ $totalHb }}</th>
                <th class="text-center">{{ $totalQb }}</th>
                <th class="text-center">{{ $totalEb }}</th>
                <th class="text-center">{{ number_format($totalFulls, 3, '.','') }}</th>
                <th class="text-center">{{ $totalPcsr }}</th>
                <th class="text-center">{{ $totalHbr }}</th>
                <th class="text-center">{{ $totalQbr }}</th>
                <th class="text-center">{{ $totalEbr }}</th>
                <th class="text-center">{{ number_format($totalFullsr, 3, '.','') }}</th>
                <th class="text-center">{{ $totalDevr }}</th>
                <th class="text-center">{{ $totalMissingr }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>