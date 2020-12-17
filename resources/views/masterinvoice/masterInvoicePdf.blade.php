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
        }
        .text-left{
            text-align: left;
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
                    @foreach ($lcompanies as $item)
                        @if($invoice_header->id_logistics_company == $item->id)
                            {{ strtoupper($item->name) }} RUC: {{ $item->ruc }} <br>
                            {{ strtoupper($item->address) }} <br>
                            TLF: {{ $item->phone }} <br>
                            {{ strtoupper($item->parish) }} - {{ strtoupper($item->country) }} <br>
                        @endif
                    @endforeach
                </td>
                <td class="small-letter">
                    {{ strtoupper($my_company->name) }} <br>
                    {{ strtoupper($my_company->address) }} <br>
                    TLF: {{ $my_company->phone }} <br>
                    {{ strtoupper($my_company->parish) }} - {{ strtoupper($my_company->country) }} <br>
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
                <td class="small-letter text-center">{{ $date_load }}</td>
                <td class="small-letter text-center">GYE</td>
                <td class="small-letter text-center">{{ $invoice_header->invoice }}</td>
                <td class="small-letter text-center">{{ $invoice_header->bl }}</td>
                <td class="small-letter text-center">{{ $invoice_header->carrier }}</td>
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
                <th class="text-center medium-letter">Hawb</th>
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
            @foreach ($comercial_invoice_items as $item)
                @php
                    $fulls+= $item->fulls;
                    $pcs+= $item->pieces;
                    $stems+= $item->stems;
                    $total+= $item->total;

                    
                @endphp
                <tr>
                    <td class="text-center small-letter">{{ number_format($item->fulls, 2, '.','') }}</td>
                    <td class="text-center small-letter">{{ $item->pieces }}</td>
                    <td class="text-left small-letter">
                        @foreach ($farms_all as $farm)
                            @if($item->id_farm == $farm->id)
                                {{ strtoupper($farm->name) }}
                            @endif
                        @endforeach
                    </td>
                    <td class="text-center small-letter">
                        @foreach ($product_all as $product)
                            @if ($item->description == $product->id)
                                {{ strtoupper($product->name) }}
                            @endif
                        @endforeach
                        
                    </td>
                    <td class="text-center small-letter">{{ $item->hawb }}</td>
                    <td class="text-center small-letter">{{ number_format($item->stems, 0, '','.') }}</td>
                    <td class="text-center small-letter">{{ $item->bunches }}</td>
                    <td class="text-center small-letter">{{ number_format($item->price, 2, ',','') }}</td>
                    <td class="text-center small-letter">{{ number_format($item->total, 2, ',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-center small-letter">{{ number_format($fulls, 2, '.','') }}</th>
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
                <td class="small-letter text-white">@foreach ($lcompanies as $item)
                        @if($invoice_header->id_logistics_company == $item->id)
                            {{ strtoupper($item->name) }}
                        @endif
                    @endforeach</td>
                <td class="small-letter text-center">@foreach ($lcompanies as $item)
                        @if($invoice_header->id_logistics_company == $item->id)
                            {{ strtoupper($item->name) }}
                        @endif
                    @endforeach</td>
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