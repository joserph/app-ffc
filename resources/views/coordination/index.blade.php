@extends('layouts.principal')

@section('content')
<section class="content-header">
    <div class="container-fluid">
       <div class="row mb-2">
          <div class="col-sm-6">
             <h1>Coordinaciones</h1>
          </div>
          <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('load.index') }}">Cargas</a></li>
                <li class="breadcrumb-item active">Crear Carga</li>
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
                  Coordinaciones
               </div>
               <div class="card-body">
                     <div class="row">
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">{{ $load->bl }}</h5>
                              <p class="card-text">{{ $company->name }}</p>
                              <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#agregarItem">
                                 <i class="fas fa-plus-circle"></i> Crear Item
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Special title treatment</h5>
                              <table class="table table-hover table-sm">
                                 @php
                                     $totalFulls = 0; $totalHb = 0; $totalQb = 0; $totalEb = 0; $totalPieces = 0;
                                 @endphp
                                 @foreach($clientsCoordination as  $key => $client)
                                 
                                 <thead>
                                     <tr>
                                         <th>AWB</th>
                                         <th colspan="7">{{ $client['name'] }}</th>
                                     </tr>
                                 </thead>
                                 <thead>
                                     <tr class="gris">
                                         <th>Finca</th>
                                         <th>HAWB</th>
                                         <th>Variedad</th>
                                         <th>PCS</th>
                                         <th>HB</th>
                                         <th>QB</th>
                                         <th>EB</th>
                                         <th>FULL</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @php
                                         $tPieces = 0; $tFulls = 0; $tHb = 0; $tQb = 0; $tEb = 0;
                                     @endphp
                                     @foreach($coordinations as $item)
                                     @if($client['id'] == $item->id_client)
                                       @php
                                          $tPieces+= $item->pieces;
                                          $tFulls+= $item->fulls;
                                          $tHb+= $item->hb;
                                          $tQb+= $item->qb;
                                          $tEb+= $item->eb;
                                       @endphp
                                       <tr>
                                          <td>{{ $item->name }}</td>
                                          <td>{{ $item->variety->name }}</td>
                                          <td>{{ $item->hawb }}</td>
                                          <td>{{ $item->pieces }}</td>
                                          <td>{{ number_format($item->fulls, 3, '.','') }}</td>
                                          <td>{{ $item->hb }}</td>
                                          <td>{{ $item->qb }}</td>
                                          <td>{{ $item->eb }}</td>
                                       </tr>
                                       @endif
                                     @endforeach
                                     @php
                                       $totalFulls+= $tFulls;
                                       $totalHb+= $tHb;
                                       $totalQb+= $tQb;
                                       $totalEb+= $tEb;
                                       $totalPieces+= $totalHb + $totalQb + $totalEb;
                                    @endphp
                                    <tr>
                                       <th colspan="3">Total:</th>
                                       <th>{{ $tPieces }}</th>
                                       <th>{{ number_format($tFulls, 3, '.','') }}</th>
                                       <th>{{ $tHb }}</th>
                                       <th>{{ $tQb }}</th>
                                       <th>{{ $tEb }}</th>
                                   </tr>
                                 </tbody>
                                 <tfoot>
                                 @endforeach
                                     <tr>
                                         <th colspan="3">Total Global:</th>
                                         <th>{{ $totalPieces }}</th>
                                         <th>{{ number_format($totalFulls, 3, '.','') }}</th>
                                         <th>{{ $totalHb }}</th>
                                         <th>{{ $totalQb }}</th>
                                         <th>{{ $totalEb }}</th>
                                     </tr>
                                 </tfoot>
                             </table>
                            </div>
                          </div>
                        </div>
                      </div>
                  
               </div>
               <div class="card-footer">
                  <!-- tabla de coordinaciones -->
                  <div class="table-responsive">
                     <table>
                        <tr>
                            <th colspan="4" class="large-letter">CONFIRMACIÓN DE DESPACHO</th>
                        </tr>
                        <tr>
                            <th class="medium-letter text-left pcs-bxs">Date:</th>
                            <th class="small-letter text-left farms">{{ date('l, d F - Y', strtotime($load->date)) }}</th>
                            <th class="medium-letter text-left pcs-bxs">Pcs:</th>
                            <th class="small-letter text-left">{{ $totalPieces }}</th>
                        </tr>
                        <tr>
                            <th class="medium-letter text-left">Client:</th>
                            <th class="small-letter text-left">{{ $company->name }}</th>
                            <th class="medium-letter text-left">Carrier:</th>
                            <th class="small-letter text-left">MARITIMO</th>
                        </tr>
                        <tr>
                            <th class="medium-letter text-left">Awb:</th>
                            <th colspan="3" class="small-letter text-left">{{ $load->bl }}</th>
                        </tr>
                    </table>
                    <br>
                    <table class="table table-sm">
                        @php
                            $totalFulls = 0; $totalHb = 0; $totalQb = 0; $totalEb = 0;
                        @endphp
                        @foreach($clientsCoordination as $client)
                        <thead>
                            <tr>
                                <th colspan="8" class="sin-border"></th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th class="text-center medium-letter">AWB</th>
                                <th class="text-center medium-letter" colspan="7">{{ $client['name'] }}</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="gris">
                              <th>Finca</th>
                              <th>HAWB</th>
                              <th>Variedad</th>
                              <th>PCS</th>
                              <th>HB</th>
                              <th>QB</th>
                              <th>EB</th>
                              <th>FULL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tPieces = 0; $tFulls = 0; $tHb = 0; $tQb = 0; $tEb = 0; $totalPieces = 0;
                            @endphp
                            @foreach($coordinations as $item)
                            @if($client['id'] == $item->id_client)
                            @php
                                $tPieces+= $item->pieces;
                                $tFulls+= $item->fulls;
                                $tHb+= $item->hb;
                                $tQb+= $item->qb;
                                $tEb+= $item->eb;
                            @endphp
                            <tr>
                                <td class="small-letter farms">{{ $item->name }}</td>
                                <td class="small-letter text-center">{{ $item->variety->name }}</td>
                                <td class="small-letter text-center">{{ $item->hawb }}</td>
                                <td class="small-letter text-center">{{ $item->pieces }}</td>
                                <td class="small-letter text-center">{{ number_format($item->fulls, 3, '.','') }}</td>
                                <td class="small-letter text-center">{{ $item->hb }}</td>
                                <td class="small-letter text-center">{{ $item->qb }}</td>
                                <td class="small-letter text-center">{{ $item->eb }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @php
                                 $totalFulls+= $tFulls;
                                 $totalHb+= $tHb;
                                 $totalQb+= $tQb;
                                 $totalEb+= $tEb;
                                 
                              @endphp
                           <tr class="gris">
                              <th class="small-letter text-right" colspan="3">Total:</th>
                              <th class="small-letter">{{ $tPieces }}</th>
                              <th class="small-letter">{{ number_format($tFulls, 3, '.','') }}</th>
                              <th class="small-letter">{{ $tHb }}</th>
                              <th class="small-letter">{{ $tQb }}</th>
                              <th class="small-letter">{{ $tEb }}</th>
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
                                <th colspan="3">Total Global:</th>
                                <th class="small-letter">{{ $totalPieces }}</th>
                                <th class="small-letter">{{ number_format($totalFulls, 3, '.','') }}</th>
                                <th class="small-letter">{{ $totalHb }}</th>
                                <th class="small-letter">{{ $totalQb }}</th>
                                <th class="small-letter">{{ $totalEb }}</th>
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
                     <h5 class="modal-title" id="agregarItemLabel">Agregar item de la factura</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     {{ Form::open(['route' => 'coordination.store', 'class' => 'form-horizontal']) }}
                        <div class="modal-body">
                           @include('coordination.form')
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
@endsection
