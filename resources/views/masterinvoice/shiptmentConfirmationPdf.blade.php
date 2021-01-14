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
            padding-right: 5px;
        }
        .text-left{
            text-align: left;
            padding-left: 5px;
        }
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            height: 20px;
        }
        table{
            width: 100%;
        }
        .small-letter{
            font-size: 10px;
        }
        .medium-letter{
            font-size: 13px;
        }
        .farms{
            width: 300px;
        }
        
        table.sinb{
            margin: 0 auto;
            width: 60%;
        }
        table.sinb, th, td{
            border: 1px solid black;
            height: 20px;
        }
        .text-white{
            color: #fff;
        }
        .firma{
            height: 40px;
        }
        .c-width{
            width: 80px;
        }

        .sin-border{
            border-bottom: 6px, 1px, 6px solid black;
            background-color: rgb(255, 255, 255);
        }
    </style>
</head>
<body>
    <h1>Shiptment Confirmation</h1>

    <table>
        @foreach($clients as  $key => $client)
        
        <thead>
            <tr>
                <th class="text-center medium-letter">AWB</th>
                <th class="text-center medium-letter" colspan="7">{{ $client['client']['name'] }}</th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th class="text-center medium-letter">Exporter</th>
                <th class="text-center medium-letter">Variety</th>
                <th class="text-center medium-letter">HAWB</th>
                <th class="text-center medium-letter">PCS</th>
                <th class="text-center medium-letter">BXS</th>
                <th class="text-center medium-letter">HALF</th>
                <th class="text-center medium-letter">QUART</th>
                <th class="text-center medium-letter">OCT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoiceItems as $item)
            @if($client['id_client'] == $item->id_client)
            <tr>
                <td class="small-letter">{{ $item->name }}</td>
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
        <tfoot>
            <tr>
                <th colspan="8" class="sin-border"></th>
            </tr>
        </tfoot>
        @endforeach
    </table>
</body>
</html>