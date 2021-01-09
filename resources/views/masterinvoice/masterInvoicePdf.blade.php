<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
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
    </style>
</head>
<body>
    <h1 class="text-center">COMERCIAL INVOICE</h1>
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
             <th class="text-center medium-letter">Fulls</th>
             <th class="text-center medium-letter">Pcs</th>
             <th class="text-center farms medium-letter">Farms</th>
             <th class="text-center medium-letter">Desciption</th>
             <th class="text-center medium-letter c-width">Hawb</th>
             <th class="text-center medium-letter">Stems</th>
             <th class="text-center medium-letter">Bunch</th>
             <th class="text-center medium-letter">Price</th>
             <th class="text-center medium-letter">Total USD</th>
         </tr>
     </thead>
     <tbody>
         @php
             $fulls = 0; $pcs = 0; $stems = 0; $total = 0;
         @endphp
         @foreach ($invoiceItems as $key => $item)
             @php
                 $fulls+= $item['fulls'];
                 $pcs+= $item['pieces'];
                 $stems+= $item['stems'];
                 $total+= $item['total'];
             @endphp
             <tr>
                 <td class="text-center small-letter">{{ number_format($item['fulls'], 3, '.','') }}</td>
                 <td class="text-center small-letter">{{ $item['pieces'] }}</td>
                 <td class="text-left small-letter">{{ $item['name'] }}</td>
                 <td class="text-center small-letter">{{ $item['variety'] }}</td>
                 <td class="text-center small-letter">{{ $item['hawb'] }}</td>
                 <td class="text-center small-letter">{{ number_format($item['stems'], 0, '','.') }}</td>
                 <td class="text-center small-letter">{{ $item['bunches'] }}</td>
                 <td class="text-center small-letter">{{ number_format($item['price'], 2, ',','') }}</td>
                 <td class="text-center small-letter">{{ number_format($item['total'], 2, ',','.') }}</td>
             </tr>
         @endforeach
     </tbody>
     <tfoot>
      <tr>
          <th class="text-center small-letter">{{ number_format($fulls, 3, '.','') }}</th>
          <th class="text-center small-letter">{{ $pcs }}</th>
          <th colspan="3" class="text-right small-letter">TOTAL:</th>
          <th class="text-center small-letter">{{ number_format($stems, 0, '','.') }}</th>
          <th colspan="2" class="text-center small-letter"></th>
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
                <td class="small-letter text-center">{{ strtoupper($lc_active->name) }}</td>
                <td class="small-letter text-center">{{ strtoupper($company->name) }}</td>
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