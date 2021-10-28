<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DISTRIBUCIÓN PARA DELIVERY - {{ $flight->awb }}</title>
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
         font-size: 15px;
         font-weight: normal;
      }
      header {
         position: fixed;
         /*top: 0cm;
         left: 0cm;
         right: 0cm;
         height: 2cm;
         background-color: #F93855;
         color: white;
         text-align: center;
         line-height: 30px;*/
      }
   </style>
</head>
<body>
   <header>
      <h1 class="text-center large-letter">DISTRIBUCIÓN DE CARGA {{ $flight->awb }}</h1>
   </header>
   <main>
      <table class="table">
         <thead class="thead-dark">
            
         </thead>
         <tbody>
            @foreach($clientsDistribution as $client)
               <tr>
                  <th colspan="4">{{ $client['name'] }}</th>
               </tr>
               @foreach($coordinations as $key => $item)
                  @if($client['id'] == $item->id_client)
                     <tr>
                        <td>{{ $item->hawb }}</td>
                        <td>{{ Str::limit($item->farm->name, 47) }}</td>
                        <td>{{ $item->variety->name }}</td>
                        <td>{{ $item->pieces_r }}</td>
                     </tr>
                  @endif
               @endforeach
            @endforeach
         </tbody>
      </table>
   </main>
</body>
</html>