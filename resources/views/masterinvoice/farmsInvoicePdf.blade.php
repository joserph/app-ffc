<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMERCIAL INVOICE </title>
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
        h1{
            font-size: 39px;
        }
        
         .medio{
            width: 120px;
         }
         .espacio{
            width: 10px;
         }
         .completo{
            width: 243px;
         }
         .mitad{
            width: 340px;
         }
         .sin-border1{
            border-top: 1px solid white;
            border-right: 1px solid white;
            border-bottom: 1px solid white;
            border-left: 1px solid white;
        }
        .sin-border2{
            border-top: 1px solid white;
            border-right: 1px solid white;
            border-bottom: 1px solid black;
            border-left: 1px solid white;
        }
        .sin-border3{
            border-top: 1px solid white;
            border-right: 1px solid black;
            border-bottom: 1px solid white;
            border-left: 1px solid white;
        }
        .sin-border4{
            border-top: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid white;
            border-left: 1px solid black;
        }
         .altura{
            height: 50px;
         }
    </style>
</head>
<body>
   @foreach ($invoiceItems as $item)
      <h1 class="text-center">COMERCIAL INVOICE</h1>
      <table>
         <tr>
            <th>Grower Name & Address</th>
            <th class="espacio sin-border1"> </th>
            <th class="medio sin-border1">Farm Code</th>
            <th class="medio sin-border1">Date</th>
         </tr>
         <tr>
            <td class="sin-border4 medium-letter">ROSAS DE MULALO</td>
            <td class="sin-border1"></td>
            <td class="sin-border1"></td>
            <td class="text-center sin-border1 medium-letter">22/06/2021</td>
         </tr>
         <tr>
            <td class="sin-border4 medium-letter">CANNAVALLE GUACHALA S/N CAYAMBE, ECUADOR</td>
            <td class="sin-border1"></td>
            <th class="sin-border1">Country Code</th>
            <th class="sin-border1">Invoice Nº</th>
         </tr>
         <tr>
            <td class="medium-letter">PHONE: 593-26004491</td>
            <td class="sin-border1"></td>
            <td class="sin-border1"></td>
            <td class="sin-border1"></td>
         </tr>
      </table>
      <br>
      <table>
         <tr>
            <th>Marketing Name / Marca De Comercialización</th>
            <th class="espacio sin-border1"> </th>
            <th class="completo sin-border2">B/L N#</th>
         </tr>
         <tr>
            <td class="sin-border4 medium-letter">SAG-MIAS FLOWERS</td>
            <td class="sin-border3"></td>
            <td class="text-center medium-letter">DOLQGYQY9072 SD</td>
         </tr>
         <tr>
            <td class="sin-border4 medium-letter">732 SAN JULIAN ST LOS ANGELES CAL</td>
            <td class="sin-border1"></td>
            <th class="sin-border2">Carrier</td>
         </tr>
         <tr>
            <td class="medium-letter">PHONE: 1 232 3199310</td>
            <td class="sin-border3"></td>
            <td class="text-center medium-letter">DOLE NAPORTEC</td>
         </tr>
      </table>
      <br>
      <table>
         <tr>
            <th>Foreign Purchaser Consignee</th>
            <th class="espacio sin-border1"> </th>
            <th class="completo sin-border2">Hawb</th>
         </tr>
         <tr>
            <td class="sin-border4 medium-letter">SOUTH AMERICAN GLOBAL SHIPING AND TRANSPORT INC</td>
            <td class="sin-border3"></td>
            <td class="text-center medium-letter">309 0140 2632</td>
         </tr>
         <tr>
            <td class="sin-border4 medium-letter">DIRECCION:741 SAN PEDRO STREET LOS ANGELES CA 900014 US</td>
            <td class="sin-border1"></td>
            <th class="sin-border2">#Refrendo</th>
         </tr>
         <tr>
            <td class="medium-letter">TELEFONOS: 2132204061</td>
            <td class="sin-border3"></td>
            <td></td>
         </tr>
      </table>
      <br>
      <table>
         <tr>
            <th>Pcs</th>
            <th>Bxs</th>
            <th>Product Description</th>
            <th>Atpa</th>
            <th>Hts #</th>
            <th>Units</th>
            <th>Stems</th>
            <th>Price</th>
            <th>Price Total</th>
         </tr>
         <tr>
            <td class="text-center medium-letter">2</td>
            <td class="text-center medium-letter">1.00</td>
            <td class="medium-letter">ROSES</td>
            <td class="text-center medium-letter">-</td>
            <td class="text-center medium-letter">-</td>
            <td class="text-center medium-letter">26</td>
            <td class="text-center medium-letter">650</td>
            <td class="text-center medium-letter">0.14</td>
            <td class="text-center medium-letter">91.00</td>
         </tr>
         <tr>
            <td class="text-center medium-letter">2</td>
            <td class="text-center medium-letter">1.00</td>
            <td class="text-center medium-letter" colspan="3">Total</td>
            <td class="text-center medium-letter">26</td>
            <td class="text-center medium-letter" colspan="2"></td>
            <td class="text-center medium-letter">91.00</td>
         </tr>
      </table>
      <br>
      <table>
         <tr>
            <th colspan="2">TOTAL</th>
         </tr>
         <tr>
            <th>Product Description</th>
            <th>Stems</th>
         </tr>
         <tr>
            <td class="text-center medium-letter">ROSES</td>
            <td class="text-center medium-letter">650</td>
         </tr>
      </table>
      <br>
      <table>
         <tr>
            <th class="mitad">Name and title of person preparing invoice</th>
            <th class="espacio sin-border3"> </th>
            <th class="mitad">Freight Forwarder</th>
         </tr>
         <tr>
            <td class="sin-border4"></td>
            <td class="sin-border3"></td>
            <td class="sin-border4 medium-letter">FRESH LOGISTICS</td>
         </tr>
         <tr>
            <td class="sin-border4"></td>
            <td class="sin-border3"></td>
            <td class="sin-border4 medium-letter">Av. Nicolás Baquero s/n junto al puente conector Alpachaca. </td>
         </tr>
         <tr>
            <td class="sin-border4"></td>
            <td class="sin-border3"></td>
            <td class="sin-border4 medium-letter"></td>
         </tr>
         <tr>
            <td></td>
            <td class="sin-border3"></td>
            <td class="medium-letter">QUITO-ECUADOR</td>
         </tr>
      </table>
      <br>
      <table>
         <tr>
            <th class="mitad altura"> </th>
            <th class="espacio sin-border3"> </th>
            <th class="mitad"> </th>
         </tr>
         <tr>
            <th>Customs Use Only</th>
            <th class="sin-border3"></th>
            <th>Usda Aphis Ppq Use Only</th>
         </tr>
      </table>
      <div style="page-break-after:always;"></div>
   @endforeach
   


</body>
</html>