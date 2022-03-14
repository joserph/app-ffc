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
            width: 47.2%;
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
            font-size: 13px;
        }
        .address{
            padding-bottom: 18px;
            padding-top: 18px;
            padding-left: 10px;
            padding-right: 10px;
            width: 100%;
            text-align: justify;
        }
        
   </style>
</head>
<body>
    <header>
        <img src="images/logo-ffc.png" alt="">
        <p class="addreestitle">741 San Pedro Street, Los Angeles, CA 90014</p>
        <h2 class="title">ORIGINAL PICK UP ORDER</h2>
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
                    <div class="loc">IMPORTANT NOTE</div>
                    <div class="address">ADDRESS: <span>3400 NV 74th Ave,</span></div>
                </div>  
                <div class="location">
                    <div class="loc">IMPORTANT NOTE</div>
                    <div class="address">THE MERCHADISE DESCRIBED BELOW, AS WELL AS THE INFORMATION IN THIS DOCUMENT, MUST BE HANDLED WITH EXTREME RESPONSIBILITY.</div>
                </div>
            </div>
        </div>

        
        <table>
            <th>
                <td>DATE:</td>
            </th>
            
            <th>
                <td>LOADING STARTING</td>
            </th>
            <th>
                <td>CARRIERS COMPANY</td>
            </th>
            <th>
                <td>DRIVER'S NAME:</td>
            </th>
        </table>
    </header>
    <main>
      
    </main>
</body>
</html>