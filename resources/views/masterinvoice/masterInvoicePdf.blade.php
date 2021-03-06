<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMERCIAL INVOICE {{ $invoiceheaders->bl }}</title>
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
            font-size: 8px;
        }
        .medium-letter{
            font-size: 12px;
        }
        .farms{
            width: 220px;
        }
        
        table.sinb{
            margin: 0 auto;
            width: 60%;
        }
        table.sinb, th, td{
            border: 1px solid black;
            height: 15px;
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
        .gender{
            width: 55px;
        }
        h1{
            font-size: 29px;
        }
        .client{
            width: 80px;
        }
    </style>
</head>
<body>
    <h1 class="text-center">MASTER INVOICE</h1>
    <table>
        <thead>
            <tr>
                <th class="text-center medium-letter">Grower Name & Address / Nombre y Dirección de Cultivo</th>
                <th class="text-center medium-letter">Foreign Purchaser / Comprador Extranjero</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="small-letter">
                    {{ strtoupper($lc_active->name) }} RUC: {{ $lc_active->ruc }} <br>
                    {{ strtoupper($lc_active->address) }} <br>
                    TLF: {{ $lc_active->phone }} <br>
                    {{ strtoupper($lc_active->city) }} - {{ strtoupper($lc_active->country) }} <br>
                </td>
                <td class="small-letter">
                    {{ strtoupper($company->name) }} <br>
                    {{ strtoupper($company->address) }} <br>
                    TLF: {{ $company->phone }} <br>
                    {{ strtoupper($company->city) }} - {{ strtoupper($company->country) }} <br>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th class="text-center medium-letter">Farm</th>
                <th class="text-center medium-letter">Date / Fecha</th>
                <th colspan="2" class="text-center medium-letter">Country INVOICE N°</th>
                <th class="text-center medium-letter">B/L N°</th>
                <th class="text-center medium-letter">Carrier</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="small-letter text-center">VF</td>
                <td class="small-letter text-center">{{ date('d-m-Y', strtotime($invoiceheaders->date)) }}</td>
                <td class="small-letter text-center">GYE</td>
                <td class="small-letter text-center">{{ $invoiceheaders->invoice }}</td>
                <td class="small-letter text-center">{{ $invoiceheaders->bl }}</td>
                <td class="small-letter text-center">{{ $invoiceheaders->carrier }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
      <thead>
         <tr>
             <th class="text-center small-letter">Fulls</th>
             <th class="text-center small-letter">Pcs</th>
             <th class="text-center small-letter">Bunch per box</th>
             <th class="text-center farms small-letter">Flower Provider</th>
             <th class="text-center small-letter client">Client</th>
             <th class="text-center small-letter gender">Genus</th>
             <th class="text-center small-letter gender">Species</th>
             <th class="text-center small-letter c-width">Hawb</th>
             <th class="text-center small-letter">Total Stems</th>
             <th class="text-center small-letter">Price</th>
             <th class="text-center small-letter">Total Bunch</th>
             <th class="text-center small-letter">Total USD</th>
         </tr>
     </thead>
     <tbody>
         @php
             $fulls = 0; $pcs = 0; $stems = 0; $total = 0; $bunches = 0; $promBunches = 0;
         @endphp
         @foreach ($invoiceItems as $key => $item)
             @php
                 $fulls+= $item['fulls'];
                 $pcs+= $item['pieces'];
                 $stems+= $item['stems'];
                 $bunches+= $item['bunches'];
                 $total+= $item['total'];
                 // Promedio de bunches por cajas.
                 $promBunches = $item['bunches'] / $item['pieces'];
             @endphp
             <tr>
                 <td class="text-center small-letter">{{ number_format($item['fulls'], 3, '.','') }}</td>
                 <td class="text-center small-letter">{{ $item['pieces'] }}</td>
                 <td class="text-center small-letter">{{ round($promBunches) }}</td>
                 <td class="text-left small-letter">{{ Str::limit($item['name'], '40') }}</td>
                 <td class="text-left small-letter">{{ Str::limit(str_replace('SAG-', '', $item['client']), '12') }}</td>
                 <td class="text-center small-letter">{{ $item['variety'] }}</td>
                 <td class="text-center small-letter">{{ $item['scientific_name'] }}</td>
                 <td class="text-center small-letter">{{ $item['hawb'] }}</td>
                 <td class="text-center small-letter">{{ number_format($item['stems'], 0, '','.') }}</td>
                 <td class="text-center small-letter">{{ number_format($item['price'], 2, ',','') }}</td>
                 <td class="text-center small-letter">{{ $item['bunches'] }}</td>
                 <td class="text-center small-letter">{{ number_format($item['total'], 2, ',','.') }}</td>
             </tr>
         @endforeach
     </tbody>
     <tfoot>
      <tr>
          <th class="text-center small-letter">{{ number_format($fulls, 3, '.','') }}</th>
          <th class="text-center small-letter">{{ $pcs }}</th>
          <th class="text-center"></th>
          <th colspan="5" class="text-right small-letter">TOTAL:</th>
          <th class="text-center small-letter">{{ number_format($stems, 0, '','.') }}</th>
          <th class="text-center small-letter"></th>
          <th class="text-center small-letter">{{ number_format($bunches, 0, ',','.') }}</th>
          <th class="text-center small-letter">{{ number_format($total, 2, ',','.') }}</th>
      </tr>
  </tfoot>
    </table>

    <br>
    <table class="sinb">
        <tbody>
            <tr>
                <td class="small-letter text-center">Name and title of person preparing invoice</td>
                <td class="small-letter text-center">Freight forwarder / Agencia de carga</td>
            </tr>
            <tr>
                <td class="small-letter text-center"></td>
                <td class="small-letter text-center">{{ strtoupper($lc_active->name) }}</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td class="firma"></td>
                <td class="firma"></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th class="small-letter text-center">SIGNATURE</th>
                <th class="small-letter text-center">NANDINA</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>