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

      /*.farms{
         width: 280px;
      }
      table, th, td{
         border: 1px solid black;
      }
      .sin-border{
         border-top: 1px solid white;
         border-right: 1px solid white;
         border-bottom: 1px solid black;
         border-left: 1px solid white;
      }
      .hawb{
         width: 70px;
      }
      .coordinado{
         background-color: rgb(217, 244, 255);
      }
      .recibido{
         background-color: rgb(191, 255, 231);
      }
      .faltante{
         background-color: rgb(255, 255, 175);
      }
      .text-rojo{
         color: red;
      }
      .variety{
         width: 70px;
      }
      .pcs-num{
         width: 30px;
      }
      .missing{
         width: 55px;
      }
      .blue{
         background-color: #00b0f0;
      }
      .yellow{
         background-color: #ffff00;
      }
      .green{
         background-color: #00b050;
      }
      .green-l{
         background-color: #e2efda;
      }
      .peach{
         background-color: #fff2cc;
      }
      

      header {
         position: fixed;
         top: 0cm;
         left: 0cm;
         right: 0cm;
         height: 2cm;
         background-color: #F93855;
         color: white;
         text-align: center;
         line-height: 30px;
      }

      footer {
         position: fixed;
         bottom: 0cm;
         left: 0cm;
         right: 0cm;
         height: 2cm;
         background-color: #F93855;
         color: white;
         text-align: center;
         line-height: 35px;
      }
      .imgc{
         position: fixed;
         margin: 20px, 20px, 20px, 20px;
      }
      .info{
         position: fixed;
         margin-left: 800px;
         margin-top: 10px;
         color: #000;
      }
      .awb1{
         width: 70px;
         padding: 0;
         margin: 0;
      }
      .sin-border-full{
         border-top: 1px solid white;
         border-right: 1px solid white;
         border-bottom: 1px solid white;
         border-left: 1px solid white;
      }
      .titu{
         margin-top: 20px;
         margin-left: 40px;
         margin-right: 30px;
      }*/
        .head1{
            /*padding: 20px;*/
            
        }
        .headDate{
            width: 40%;
            border: 3px solid;
            border-radius: 10px;
            display: inline-block;
            padding: 0px;
            margin: 10px;
            list-style:none;
        }
        .headD{
            border: 1px solid;
            border-top-color: #000;
            display: block;
            padding: 0.75rem 1.25rem;
        }
        /*.card{
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: 10px;
        }
        .list-group{
            border-bottom-width: 0;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .list-group-flush{
            border-radius: 10px;
        }
        .list-group-item{
            position: relative;
            display: block;
            padding: 0.75rem 1.25rem;
            background-color: #fff;
            border: 1px solid rgba(0,0,0,.125);
        }*/
        .headDate2{
            width: 40%;
            border: 3px solid;
            border-radius: 10px;
            display: inline-block;
            padding: 0px;
            margin: 10px;
            list-style:none;
            
        }
        .headT{
            display: inline-block;
            padding: 50px;
        }
   </style>
</head>
<body>
    <header>
        <img src="images/logo-ffc.png" alt="">
        <p class="addreestitle">741 San Pedro Street, Los Angeles, CA 90014</p>
        <h2 class="title">ORIGINAL PICK UP ORDER</h2>
        <div class="head1">
            <ul class="headDate">
                <li class="headD">asjdasjdias</li>
                <li class="headD">asjdasjdias</li>
                <li class="headD">asjdasjdias</li>
                <li class="headD">asjdasjdias</li>
            </ul>
            <div class="headDate2">
                <div class="headT">asjdasjdias</div>
                <div class="headT">asjdasjdias</div>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                
              <li class="list-group-item">An item</li>
              <li class="list-group-item">A second item</li>
              <li class="list-group-item">A third item</li>
            </ul>
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