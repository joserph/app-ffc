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
                              <h5 class="card-title">Resumen coordinación</h5>
                              <table class="table table-hover table-sm">
                                 @php
                                     $totalFulls = 0; $totalHb = 0; $totalQb = 0; $totalEb = 0; $totalPieces = 0;
                                 @endphp
                                 <thead>
                                    <tr class="gris">
                                        <th>Cliente</th>
                                        <th class="text-center">PCS</th>
                                        <th class="text-center">HB</th>
                                        <th class="text-center">QB</th>
                                        <th class="text-center">EB</th>
                                    </tr>
                                </thead>
                                 @foreach($clientsCoordination as  $key => $client)
                                 
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
                                       
                                       @endif
                                     @endforeach
                                     @php
                                       $totalFulls+= $tFulls;
                                       $totalHb+= $tHb;
                                       $totalQb+= $tQb;
                                       $totalEb+= $tEb;
                                    @endphp
                                    <tr>
                                       <td>{{ $client['name'] }}</td>
                                       <td class="text-center">{{ $tPieces }}</td>
                                       <td class="text-center">{{ $tHb }}</td>
                                       <td class="text-center">{{ $tQb }}</td>
                                       <td class="text-center">{{ $tEb }}</td>
                                   </tr>
                                 </tbody>
                                 <tfoot>
                                 @endforeach
                                 @php
                                     $totalPieces+= $totalHb + $totalQb + $totalEb;
                                 @endphp
                                     <tr>
                                         <th>Total Global:</th>
                                         <th class="text-center">{{ $totalPieces }}</th>
                                         <th class="text-center">{{ $totalHb }}</th>
                                         <th class="text-center">{{ $totalQb }}</th>
                                         <th class="text-center">{{ $totalEb }}</th>
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
                    <table class="table table-sm">
                        @php
                            $totalFulls = 0; $totalHb = 0; $totalQb = 0; $totalEb = 0; $totalPcsr = 0; $totalHbr = 0; $totalQbr = 0;
                            $totalEbr = 0; $totalFullsr = 0; $totalDevr = 0; $totalMissingr = 0;
                        @endphp
                        @foreach($clientsCoordination as $client)
                        <thead>
                            <tr>
                                <th colspan="15" class="sin-border"></th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th class="text-center medium-letter">AWB</th>
                                <th class="text-center medium-letter" colspan="14">{{ $client['name'] }}</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="gris">
                              <th class="text-center">Finca</th>
                              <th class="text-center">HAWB</th>
                              <th class="text-center">Variedad</th>
                              <th class="text-center">PCS</th>
                              <th class="text-center">HB</th>
                              <th class="text-center">QB</th>
                              <th class="text-center">EB</th>
                              <th class="text-center">FULL</th>
                              <th class="text-center">PCS</th>
                              <th class="text-center">HB</th>
                              <th class="text-center">QB</th>
                              <th class="text-center">EB</th>
                              <th class="text-center">FULL</th>
                              <th class="text-center">Dev</th>
                              <th class="text-center">Faltantes</th>
                              <th class="text-center" colspan="2">Aciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tPieces = 0; $tFulls = 0; $tHb = 0; $tQb = 0; $tEb = 0; $totalPieces = 0; $tPcsR = 0;
                                 $tHbr = 0; $tQbr = 0; $tEbr = 0; $tFullsR = 0; $tDevR = 0; $tMissingR = 0;
                            @endphp
                            @foreach($coordinations as $item)
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
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editarItem{{ $item->id }}">
                                       <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <td width="20px" class="text-center">
                                       {{ Form::open(['route' => ['coordination.destroy', $item->id], 'method' => 'DELETE']) }}
                                          {{ Form::button('<i class="fas fa-trash-alt"></i> ', ['type' => 'submit', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Eliminar usuario', 'class' => 'btn btn-sm btn-outline-danger', 'onclick' => 'return confirm("¿Seguro de eliminar la coordinación?")']) }}
                                       {{ Form::close() }}
                                    </td>
                               </td>
                            </tr>
                            <div class="modal fade" id="editarItem{{ $item->id }}" tabindex="-1" aria-labelledby="editarItemLabel" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="editarItemLabel">Editar item de coordinación</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       {{ Form::model($item, ['route' => ['coordination.update', $item->id], 'class' => 'form-horizontal', 'method' => 'PUT']) }}
                                          <div class="modal-body">
                                             @include('coordination.formEdit')
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                             <button type="submit" class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Crear Empresa">
                                                <i class="fas fa-sync"></i> Actualizar
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

@section('scripts')
   <script>
      $('#id_farmEdit').select2({
         theme: 'bootstrap4',
      });

      $('#id_farm').select2({
         theme: 'bootstrap4',
      });
      $('#id_farm').select2({
         theme: 'bootstrap4',
      });
   </script>
@endsection

@endsection
