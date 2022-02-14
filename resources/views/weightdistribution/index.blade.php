@extends('layouts.principal')

@section('title') Pesos Aéreos | Sistema de Carguera v1.1 @stop

@section('content')
<section class="content-header">
    <div class="container-fluid">
       <div class="row mb-2">
          <div class="col-sm-6">
             <h1>Coordinaciones Aéreas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{ route('flight.index') }}">Vuelos</a></li>
               <li class="breadcrumb-item"><a href="{{ route('flight.show', $flight->id) }}">AWB {{ $flight->awb }}</a></li>
               <li class="breadcrumb-item active">Coordinaciones Aéreas</li>
            </ol>
          </div>
       </div>
    </div><!-- /.container-fluid -->
 </section>


  <!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div class="row justify-content-center">
         <div class="col-12">

            @include('custom.message') 

            <div class="card">
               <div class="card-header">
                  Coordinaciones Vuelo AWB {{ $flight->awb }}
               </div>
               
               <div class="card-body">
                  <!-- tabla de coordinaciones -->
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered border-primary">
                        @php
                            $totalFulls = 0; $totalHb = 0; $totalQb = 0; $totalEb = 0; $totalPcsr = 0; $totalHbr = 0; $totalQbr = 0;
                            $totalEbr = 0; $totalFullsr = 0; $totalDevr = 0; $totalMissingr = 0;
                        @endphp
                        @foreach($clientsDistribution as $client)
                        <thead>
                            <tr>
                                <th colspan="22" class="sin-border"></th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th class="text-center medium-letter">AWB</th>
                                <th class="text-center medium-letter" colspan="21">{{ $client['name'] }}</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="gris">
                              <th class="text-center transfLavel">Transferir</th>
                              <th class="text-center">Finca</th>
                              <th class="text-center">HAWB</th>
                              <th class="text-center">Variedad</th>
                              <th class="text-center table-secondary">PCS</th>
                              <th class="text-center table-secondary">HB</th>
                              <th class="text-center table-secondary">QB</th>
                              <th class="text-center table-secondary">EB</th>
                              <th class="text-center table-secondary">FULL</th>
                              <th class="text-center table-success">PCS</th>
                              <th class="text-center table-success">HB</th>
                              <th class="text-center table-success">QB</th>
                              <th class="text-center table-success">EB</th>
                              <th class="text-center table-success">FULL</th>
                              <th class="text-center table-warning">Dev</th>
                              <th class="text-center">Faltantes</th>
                              <th class="text-center">Observación</th>
                              <th class="text-center"></th>
                              <th class="text-center">Reported Weight</th>
                              <th class="text-center">Largo</th>
                              <th class="text-center">Ancho</th>
                              <th class="text-center">Alto</th>
                              <th class="text-center">Aciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tPieces = 0; $tFulls = 0; $tHb = 0; $tQb = 0; $tEb = 0; $totalPieces = 0; $tPcsR = 0;
                                 $tHbr = 0; $tQbr = 0; $tEbr = 0; $tFullsR = 0; $tDevR = 0; $tMissingR = 0;
                            @endphp
                            
                            @foreach($distributions as $item)
                            @if($client['id'] == $item->id_client)
                            @php
                                $tPieces+= $item->pieces;
                                $tFulls+= $item->fulls;
                                $tHb+= $item->hb;
                                $tQb+= $item->qb;
                                $tEb+= $item->eb;
                                $tPcsR+= $item->pieces_r;
                                 $tHbr+= $item->hb_r;
                                 $tQbr+= $item->qb_r;
                                 $tEbr+= $item->eb_r;
                                 $tFullsR+= $item->fulls_r;
                                 $tDevR+= $item->returns;
                                 $tMissingR+= $item->missing;
                            @endphp
                            <tr>
                               <!--<td class="text-center"><input type="checkbox" class="transf" name="{{ $item->id }}" value="{{ $item->id }}" placeholder="{{ $item->name }} - {{ $client['name'] }} - {{ $item->pieces }}"></td>-->
                                <td class="farms">{{ $item->name }}</td>
                                <td class="text-center">{{ $item->hawb }}</td>
                                <td class="text-center">{{ $item->variety->name }}</td>
                                <td class="text-center">{{ $item->pieces }}</td>
                                <td class="text-center">{{ $item->hb }}</td>
                                <td class="text-center">{{ $item->qb }}</td>
                                <td class="text-center">{{ $item->eb }}</td>
                                <td class="text-center">{{ number_format($item->fulls, 3, '.','') }}</td>
                                <td class="text-center">{{ $item->pieces_r }}</td>
                                <td class="text-center">{{ $item->hb_r }}</td>
                                <td class="text-center">{{ $item->qb_r }}</td>
                                <td class="text-center">{{ $item->eb_r }}</td>
                                <td class="text-center">{{ number_format($item->fulls_r, 3, '.','') }}</td>
                                <td class="text-center">{{ $item->returns }}</td>
                                <td class="text-center">{{ $item->missing }}</td>
                                <td class="text-center text-danger"><small>
                                    @if($item->id_marketer)
                                       COMPRA DE {{ strtoupper($item->marketer->name) }} 
                                    @endif
                                    {{ strtoupper($item->observation) }}
                                 </small></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td>.</td>
                                <td class="text-center">
                                    @can('haveaccess', 'distribution.edit')
                                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#createItem{{ $item->id }}">
                                       <i class="fas fa-plus"></i>
                                    </button>
                                    @endcan
                               </td>
                            </tr>
                            <div class="modal fade" id="createItem{{ $item->id }}" tabindex="-1" aria-labelledby="createItemLabel" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="createItemLabel">Agregar Peso</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       @include('custom.message') 
                                       {{ Form::open(['route' => 'weight-distribution.store', 'class' => 'form-horizontal']) }}
                                            <div class="modal-body">
                                            @include('weightdistribution.partials.form')
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Crear Empresa">
                                                <i class="fas fa-plus-circle"></i> Crear
                                            </button>
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                 </div>
                              </div>
                           </div>
                            @endif
                            @endforeach
                            
                            @php
                                 $totalFulls+= $tFulls;
                                 $totalHb+= $tHb;
                                 $totalQb+= $tQb;
                                 $totalEb+= $tEb;
                                 $totalPcsr+= $tPcsR;
                                 $totalHbr+= $tHbr;
                                 $totalQbr+= $tQbr;
                                 $totalEbr+= $tEbr;
                                 $totalFullsr+= $tFullsR;
                                 $totalDevr+= $tDevR;
                                 $totalMissingr+= $tMissingR;
                              @endphp
                           <tr class="gris">
                              <th class="text-center text-right" colspan="3">Total:</th>
                              <th class="text-center">{{ $tPieces }}</th>
                              <th class="text-center">{{ $tHb }}</th>
                              <th class="text-center">{{ $tQb }}</th>
                              <th class="text-center">{{ $tEb }}</th>
                              <th class="text-center">{{ number_format($tFulls, 3, '.','') }}</th>
                              <th class="text-center">{{ $tPcsR }}</th>
                              <th class="text-center">{{ $tHbr }}</th>
                              <th class="text-center">{{ $tQbr }}</th>
                              <th class="text-center">{{ $tEbr }}</th>
                              <th class="text-center">{{ number_format($tFullsR, 3, '.','') }}</th>
                              <th class="text-center">{{ $tDevR }}</th>
                              <th class="text-center">{{ $tMissingR }}</th>
                           </tr>
                        </tbody>
                        <tfoot>
                        @endforeach
                        @php
                            $totalPieces+= $totalHb + $totalQb + $totalEb;
                        @endphp
                            <tr>
                                <th colspan="8" class="sin-border"></th>
                            </tr>
                            <tr class="gris">
                                <th class="text-center" colspan="3">Total Global:</th>
                                <th class="text-center">{{ $totalPieces }}</th>
                                <th class="text-center">{{ $totalHb }}</th>
                                <th class="text-center">{{ $totalQb }}</th>
                                <th class="text-center">{{ $totalEb }}</th>
                                <th class="text-center">{{ number_format($totalFulls, 3, '.','') }}</th>
                                <th class="text-center">{{ $totalPcsr }}</th>
                                <th class="text-center">{{ $totalHbr }}</th>
                                <th class="text-center">{{ $totalQbr }}</th>
                                <th class="text-center">{{ $totalEbr }}</th>
                                <th class="text-center">{{ number_format($totalFullsr, 3, '.','') }}</th>
                                <th class="text-center">{{ $totalDevr }}</th>
                                <th class="text-center">{{ $totalMissingr }}</th>
                            </tr>
                        </tfoot>
                    </table>
                  </div>
                  <!-- fin tabla de coordinaciones -->
               </div>
            </div>
            
         </div>
         
         <div class="modal fade" id="agregarItem" tabindex="-1" aria-labelledby="agregarItemLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="agregarItemLabel">Agregar item de coordinación</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     @include('custom.message')
                     {{ Form::open(['route' => 'distribution.store', 'class' => 'form-horizontal']) }}
                        <div class="modal-body">
                           @include('distribution.partials.form')
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                           <button type="submit" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Crear Empresa">
                              <i class="fas fa-plus-circle"></i> Crear
                           </button>
                        </div>
                     {{ Form::close() }}
                  </div>
               </div>
            </div>
         </div>
         

         


      </div>
   </div>
</section>

@section('scripts')
   <script>
      $('#id_farmEdit').select2({
         theme: 'bootstrap4',
      });

      $('#id_farm').select2({
         theme: 'bootstrap4',
      });
      $('#id_client').select2({
         theme: 'bootstrap4'
      });
      $('#variety_id').select2({
         theme: 'bootstrap4'
      });

      $(document).ready(function()
      {
         $('#transfCoord').hide();
         $('.transfLavel').hide();
         $('.transf').hide();
         $('#btnTransf').hide();
         $('#switchCoord').on('change', function() {
            if ($(this).is(':checked') ) {
               $('#transfCoord').show();
               $('#transfLavel').show();
               $('.transf').show();
            } else {
               $('#transfCoord').hide();
               $('#transfLavel').hide();
               $('.transf').hide();
            }
         });
      });

      // listar fincas selecionadas
      var lista = document.getElementById('lista');
      var checks_farm = document.querySelectorAll('.transf');
      var test = [];

      $('#ListCoord').click(function()
      {
         
         lista.innerHTML = '';
         checks_farm.forEach((e)=>{
            if(e.checked == true)
            {
               var elemento = document.createElement('li');
               elemento.className = 'list-group-item';
               elemento.innerHTML = e.placeholder;
               test.push(e.value)
               lista.appendChild(elemento);
               $('#btnTransf').show();
            }
            
         });
         /*$('#btnTransf').click(function()
         {
            $.ajax({
               url: "transfer-coordination",
               type: "POST",
               data: test,
               success: function(response)
               {
                  if(response)
                  {
                     $('#transfCoord').hide();
                     $('#transfLavel').hide();
                     $('.transf').hide();
                     $('#btnTransf').hide();
                     toastr.success('Transferencia exitosa');
                  }
               }
            });
         });*/
         
         for ( x in test) {
            console.log( test[x] );
         }
      });

      
   </script>

   
@endsection

@endsection
