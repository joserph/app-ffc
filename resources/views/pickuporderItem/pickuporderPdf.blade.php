<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Pick Up Order - {{ $headpickup->carrier_num }}</title>
   <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">-->
   <style>
        @page {
         margin: 0cm 0cm;
         font-size: 1em;
      }

      body {
         font-family: Arial, Helvetica, sans-serif;
         margin: 3cm 1cm 1cm;
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
         page-break-before: auto;
      }
      .small-letter{
         font-size: 9px;
         font-weight: normal;
      }
      .medium-letter{
         font-size: 10px;
         font-weight: normal;
      }
      .large-letter{
         font-size: 10px;
         font-weight: normal;
      }
        /* USADO */
        img{
            margin-top: -30px;
            margin-left: 205px;
        }
        .addreestitle{
            text-align: center;
            margin-top: -40px;
        }
        .title{
            text-align: center;
            font-style: italic;
        }

        .head1{
            padding: 2px;
            
        }
        .headDate1{
            display: inline;
            font-size: 10px;
        }
        .headDate{
            width: 47.4%;
            border: 3px solid;
            border-radius: 10px;
            display: inline-block;
            padding: 0px;
            list-style:none;
        }
        .headDate2{
            width: 47.25%;
            border: 3px solid;
            border-radius: 10px;
            display: inline-block;
            padding: 0px;
            margin: 10px;
            list-style:none;
        }
        .headD1{
            height: 0;
            color: #fff;
        }
        .headD{
            border: 1px solid;
            border-top-color: #000;
            display: block;
            padding: 0.45rem 1rem;
        }
        .headT2{
            background-color: #000;
        }
        .headT1{
            background-color: #000;
            color: #fff;
            text-align: center;
            padding-bottom: 14px;
            padding-top: 14px;
            font-size: 13px;
        }
        .headT{
            padding-bottom: 18px;
            padding-top: 18px;
            padding-left: 10px;
            padding-right: 10px;
            /*height: 80px;*/
            width: 100%;
            /*margin-bottom: -10px;
            margin-top: -10px;*/
            text-align: justify;
        }
        .location{
            width: 48.8%;
            border: 3px solid;
            border-radius: 10px;
            display: inline-block;
            margin: 1px;
            list-style:none;
        }
        .loc{
            background-color: #000;
            color: #fff;
            padding-bottom: 14px;
            padding-top: 14px;
            padding-left: 10px;
            font-size: 13px;
        }
        .address, .address_{
            padding-bottom: 18px;
            padding-top: 18px;
            padding-left: 10px;
            padding-right: 10px;
            width: 100%;
            text-align: justify;
        }
        .address span{
            margin-left: 60px;
        }
        .address_ span{
            margin-left: 110px;
        }
        .num_carrier{
            text-align: right;
            color: red;
        }
        /*table, tr {
            width: 100%;
            border: 1px solid;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #04AA6D;
            color: white;
        }*/
        table {
            border-collapse: separate;
            border-spacing: 0;
            min-width: 350px;
        }
        table tr th,
        table tr td {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        table tr th:first-child,
        table tr td:first-child {
            border-left: 1px solid #000;
        }
        table tr th:first-child,
        table tr td:first-child {
            border-left: 1px solid #000;
        }
        table tr th {
            background: #000;
            text-align: center;
            border-top: solid 1px #000;
            color: #fff;
        }

        /* top-left border-radius */
        table tr:first-child th:first-child {
            border-top-left-radius: 6px;
        }

        /* top-right border-radius */
        table tr:first-child th:last-child {
            border-top-right-radius: 6px;
        }

        /* bottom-left border-radius */
        table tr:last-child td:first-child {
            border-bottom-left-radius: 6px;
        }

        /* bottom-right border-radius */
        table tr:last-child td:last-child {
            border-bottom-right-radius: 6px;
        }
        footer{
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: -2cm;
            height: 6cm;
            background-color: #125478;
            color: #fff;
            text-align: center;
            line-height: 35px;
            display: inline;
            padding-left: 40px;
            padding-right: 40px;
        }
        .f_signed{
            border: 1px solid #000;
            border-radius: 5px;
            width: 49.6%;
            /*padding: 10px;
            margin: 10px;
            height: 90px;*/
            margin-bottom: 50px;
            display: inline-block;
            
        }
        .sign{
            text-align: left;
            margin-top: -10px;
            margin-left: 10px;
        }
        .disp{
            text-align: left;
            margin-top: -10px;
            margin-left: 40px;
        }
        .manager{
            text-align: right;
            margin-bottom: 5px;
            margin-right: 10px;
        }
        .dispat{
            border: 1px solid #000;
            border-radius: 5px;
            width: 49.6%;
            /*padding: 10px;
            margin: 10px;
            height: 90px;*/
            margin-bottom: 50px;
            display: inline-block;
        }
        .spacio{
            
        }
        .date{
            text-align: left;
            margin-bottom: 5px;
            margin-right: 10px;
            margin-left: 40px;
            margin-top: -10px;
        }
        .date span{
            margin-left: 100px;
        }
        .time{
            text-align: right;
            margin-bottom: 5px;
            margin-right: 10px;
        }
        .f_inland{
            position: relative;
            /*border: 1px solid #000;
            border-radius: 2px;*/
            width: 49.6%;
            display: inline-block;
            margin-top: 10px;
        }
        .prep{
            position: relative;
            margin-left: -500px;
            margin-top: -50px;
            border: 1px solid #000;
            border-radius: 2px;
            width: 120px;
            padding: 0cm;
        }
        .prepaid{
            margin-top: -50px;
            padding: 0cm;
            margin: 0cm;
            font-size: 12px;
            padding-top: 1px;
        }
        .f_inland img{
            position: relative;
            margin-right: 1790px;
            margin-top: 190px;
        }
        .prepaid_botton{
            padding: 0cm;
            margin: 0cm;
            font-size: 12px;
            margin-top: -20px;
            /*margin-bottom: -20px*/
        }
        .f_delivery{
            border: 1px solid #000;
            border-radius: 2px;
            margin-right: -300px;
            margin-top: -350px;
        }
        .f_delivery img{
            position: relative;
            margin-right: 1000px;
            margin-top: -890px;
        }
        .dis{
            font-size: 13px;
            color: yellow;
        }
   </style>
</head>
<body>
    <header>
        <img src="images/logo-ffc.png" alt="">
        <p class="addreestitle">741 San Pedro Street, Los Angeles, CA 90014</p>
        <h2 class="title">ORIGINAL PICK UP ORDER</h2>
        <p class="num_carrier">CARRIER #14</p>
        <div class="head1">
            <div class="headDate1">
                <ul class="headDate">
                    <li class="headD">DATE: 01-22-2022</li>
                    <li class="headD">LOADING STARTING DATE: 01-02-2022 / 11:00 AM</li>
                    <li class="headD">CARRIER COMPANY: Parakeet Llc.</li>
                    <li class="headD">DRIVER'S NAME: José Ávila</li>
                </ul>
            </div>
            <div class="headDate1">
                <div class="headDate2">
                    <div class="headT1">IMPORTANT NOTE</div>
                    <div class="headT">THE MERCHADISE DESCRIBED BELOW, AS WELL AS THE INFORMATION IN THIS DOCUMENT, MUST BE HANDLED WITH EXTREME RESPONSIBILITY.</div>
                </div>
            </div>
        </div>
        <br>
        <div class="head1">
            <div class="headDate1">
                <div class="location">
                    <div class="loc">PICK UP LOCATIONS: <span>FLORAL LOGISTICS</span></div>
                    <div class="address">ADDRESS: <br>
                        <span>3400 NV 74th Ave,</span> <br><span>Miami, FL 33122</span> <br><span>United States</span>
                    </div>
                </div>  
                <div class="location">
                    <div class="loc">CONSIGNED TO: <span>SOUTH AMERICAN GLOBAL</span></div>
                    <div class="address_">DROP OFF ADDRESS: <br>
                        <span>3400 NV 74th Ave,</span> <br><span>Miami, FL 33122</span> <br><span>United States</span>
                    </div>
                </div>
            </div>
        </div>

        
        <table class="tabla">
            <thead>
                <tr>
                    <th>AWB NUMBER</th>
                    <th>DESCRIPTION</th>
                    <th># OF PIECES</th>
                    <th>#OF PALLETS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $t_pieces = 0;
                    $t_pallets = 0;
                @endphp
                @foreach ($pickupitem as $item)
                    <tr>
                        <td>{{ $item->awb }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->pieces }}</td>
                        <td>{{ $item->pallets }}</td>
                    </tr>
                    @php
                        $t_pieces += $item->pieces;
                        $t_pallets += $item->pallets;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>TOTAL:</td>
                    <td>
                        @if ($t_pieces != null)
                            {{ $t_pieces }}
                        @endif
                    </td>
                    <td>
                        @if ($t_pallets != null)
                            {{ $t_pallets }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <footer>
            <div class="f_signed">
                <p class="sign">Signed by dispatcher:</p>
                <p class="spacio">-</p>
                <p class="manager">José Gabriel Hidalgo C.</p>
            </div>
            
            <div class="dispat">
                <p class="disp">Signed by dispatcher:</p>
                <p class="spacio">-</p>
                <hr>
                <p class="date">Date: <span>Time:</span></p>
            </div>
            <div class="f_inland">
                <img src="images/arrow.png" alt="" width="200">
                <div class="prep">
                    <p class="prepaid">PREPAID/COLLECT</p>
                    <p class="prepaid_botton">Prepaid</p>
                </div>
            </div>
            <div class="f_delivery">
                <img src="images/arrow.png" alt="" width="1000">
                <p class="dis">DELIVERY CLERK: <br> DISPATCH TO CARRIER <br> SHOWN ABOVE</B></p>
            </div>
        </footer>
        

    </header>
    <main>
      
    </main>
</body>
</html>