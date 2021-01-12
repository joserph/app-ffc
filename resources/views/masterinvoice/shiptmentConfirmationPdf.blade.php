<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Shiptment Confirmation</h1>

    <table>
        @foreach($clients as  $key => $client)
        <thead>
            
            <tr>
                <th>AWB</th>
                <th>{{ $client['client']['name'] }}</th>
            </tr>
            
        </thead>
        <thead>
            <tr>
                <th>Exporter</th>
                <th>HAWB</th>
                <th>Variety</th>
                <th>PCS</th>
                <th>BXS</th>
                <th>HB</th>
                <th>QB</th>
                <th>EB</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoiceItems as $item)
            @if($client['id_client'] == $item->id_client)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->hawb }}</td>
                <td>{{ $item->variety->name }}</td>
                <td>{{ $item->pieces }}</td>
                <td>{{ $item->fulls }}</td>
                <td>{{ $item->hb }}</td>
                <td>{{ $item->qb }}</td>
                <td>{{ $item->eb }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        @endforeach
    </table>
</body>
</html>