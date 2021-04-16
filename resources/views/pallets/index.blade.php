@extends('layouts.principal')

@section('content')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Paletas
            </h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
               <li class="breadcrumb-item active">Paletas</li>
            </ol>
         </div>
      </div>
   </div><!-- /.container-fluid -->
</section>
<section class="content">
   <div class="container-fluid">
      <div class="row justify-content-center">
         <div class="col-12">
            @include('custom.message') 
            <div class="card">
               <div class="card-header">
                  Paletas ingresadas en el contenedor
               </div>
               <div class="card-body">
                  <button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Agregar nuevas paletas"><i class="fas fa-plus-circle"></i> Agregar Paleta</button>
                  <hr>
                  @foreach ($pallets as $indexKey =>$item)
                     <div class="card">
                        <div class="card-header">
                           <i class="fas fa-pallet"></i> Paleta # <span class="badge bg-dark">{{ $item->number }}</span>
                           <input type="hidden" name="prueba" id="prueba_{{ $indexKey }}" value="{{ $item->number }}">
                           <a href="{{ route('palletitems.create', $item->number) }}" class="btn btn-xs btn-info float-right" data-toggle="modal" data-target="#addPalletItem" data-toggle="tooltip" data-placement="top" title="Agregar item de paleta"><i class="fas fa-plus-circle"></i> Agregar</a>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-sm">
                                 <thead>
                                 <tr>
                                    <th class="text-center">Finca</th>
                                    <th class="text-center">Cliente</th>
                                    <th class="text-center">HB</th>
                                    <th class="text-center">QB</th>
                                    <th class="text-center">EB</th>
                                    <th class="text-center">Total</th>
                                    <th colspan="2" class="text-center">Aciones</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                    @php
                                       $hb = 0; $qb = 0; $eb = 0; $total = 0;
                                    @endphp
                                    @foreach ($palletItem as $item2)
                                       @if($item->id == $item2->id_pallet)
                                          @php 
                                             $hb+=$item2->hb;
                                             $qb+=$item2->qb;
                                             $eb+=$item2->eb;
                                             $total+=$item2->quantity;
                                          @endphp
                                          <tr>
                                             <td>
                                                @foreach ($farms as $farm)
                                                   @if($item2->id_farm == $farm->id)
                                                      {{ $farm->name }}
                                                   @endif
                                                @endforeach
                                             </td>
                                             <td class="text-center">
                                                @foreach ($clients as $client)
                                                   @if($item2->id_client == $client->id)
                                                      {{ strtoupper($client->name) }}
                                                   @endif
                                                @endforeach
                                             </td>
                                             <td class="text-center">{{ $item2->hb }}</td>
                                             <td class="text-center">{{ $item2->qb }}</td>
                                             <td class="text-center">{{ $item2->eb }}</td>
                                             <td class="text-center">{{ $item2->quantity }}</td>
                                             <td class="text-center" width="10px">
                                                <a href="{{ route('palletitems.edit', $item2->id) }}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Editar item de paleta"><i class="fas fa-edit"></i> Editar</a>
                                             </td>
                                             <td class="text-center" width="10px">
                                                {!! Form::open(['route' => ['palletitems.destroy', $item2->id], 'method' => 'DELETE', 'onclick' => 'return confirm("¿Seguro de eliminar item de paleta?")']) !!}
                                                   <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar item de paleta"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                                {!! Form::close() !!}
                                             </td>
                                          </tr>
                                       @endif
                                    @endforeach
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <th colspan="2" class="text-center">Totales</th>
                                       <th class="text-center">{{ $hb }}</th>
                                       <th class="text-center">{{ $qb }}</th>
                                       <th class="text-center">{{ $eb }}</th>
                                       <th class="text-center">{{ $total }}</th>
                                    </tr>
                                </tfoot>
                              </table>
                           </div>
                           @if(($counter - 1) == $item->counter)
                              
                                 {!! Form::open(['route' => ['pallets.destroy', $item->id], 'method' => 'DELETE']) !!}
                                    {!! Form::button('<i class="fas fa-trash-alt"></i> ' . 'Eliminar', ['type' => 'submit', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Eliminar finca', 'class' => 'btn btn-xs btn-danger pull-right', 'onclick' => 'return confirm("¿Seguro de eliminar finca?")']) !!}
                                 {!! Form::close() !!}
                              
                           @endif
                        </div>
                     </div>

                     <!-- Modal Pallets Items -->
                    <div class="modal fade" id="addPalletItem" tabindex="-1" role="dialog" aria-labelledby="addPalletItem">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="addPalletItem">Contenedor {{ $code }}</h4>
                                </div>
                                <div class="modal-body">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong><i class="fa fa-exclamation-triangle fa-fw"></i></strong> Por favor corrige los siguentes errores:<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                    
                                    {{ Form::open(['route' => 'palletitems.store', 'class' => 'form-horizontal']) }}
                                        {!! Form::hidden('id_user', \Auth::user()->id) !!}
                                        {!! Form::hidden('update_user', \Auth::user()->id) !!}
                                        {!! Form::hidden('id_load', $load->id) !!}
                                        {!! Form::hidden('id_pallet', $item->id) !!}

                                        @include('palletitems.partials.form')
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Agregar</button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Pallets Items -->
                  @endforeach
               </div>
               <div class="card-footer">
                  <button class="btn btn-default  " type="button">
                     Total HB <span class="badge">{{ $total_hb }}</span>
                  </button>
                  <button class="btn btn-primary" type="button">
                     Total QB <span class="badge">{{ $total_qb }}</span>
                  </button>
                  <button class="btn btn-info" type="button">
                     Total EB <span class="badge">{{ $total_eb }}</span>
                  </button>
                  <button class="btn btn-success" type="button">
                     Total Contenedor <span class="badge">{{ $total_container }}</span>
                  </button>
                </div>
             </div>
         </div>
      </div>
   </div>
</section>
<!-- Modal Pallets -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="agregarItemLabel">Contenedor {{ $load->shipment }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
           <div class="modal-body">
               @include('custom.message')

               {{ Form::open(['route' => 'pallets.store', 'class' => 'form-horizontal']) }}
                  <div class="modal-body">
                     @include('pallets.partials.form')
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



<section class="content">
   <div class="container-fluid">
      <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fas fa-pallet"></i> Paletas
                            
                                
                            
                        </div>
                        <div class="panel-body">
                            <ol class="breadcrumb">
                                <li><a href="{{ url('/home') }}">Inicio</a></li>
                                <li><a href="{{ route('load.index') }}">Contenedor {{ $code }}</a></li>
                                <li><a href="{{ route('load.show', $load) }}">Paletas</a></li>
                                <li class="active">Items de Paletas</li>
                            </ol>
                            
                            @foreach ($pallets as $indexKey =>$item)
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <i class="fas fa-pallet"></i> Paleta # {{ $item->number }}
                                        <input type="hidden" name="prueba" id="prueba_{{ $indexKey }}" value="{{ $item->number }}">
                                        
                                            
                                        
                                    </div>
                                    
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-condensed table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Finca</th>
                                                        <th class="text-center">Cliente</th>
                                                        <th class="text-center">HB</th>
                                                        <th class="text-center">QB</th>
                                                        <th class="text-center">EB</th>
                                                        <th class="text-center">Total</th>
                                                        <th colspan="2" class="text-center">Aciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $hb = 0; $qb = 0; $eb = 0; $total = 0;
                                                    @endphp
                                                    @foreach ($palletItem as $item2)
                                                        @if($item->id == $item2->id_pallet)
                                                        @php 
                                                            $hb+=$item2->hb;
                                                            $qb+=$item2->qb;
                                                            $eb+=$item2->eb;
                                                            $total+=$item2->quantity;
                                                        @endphp
                                                            <tr>
                                                                <td>
                                                                    @foreach ($farms as $farm)
                                                                        @if($item2->id_farm == $farm->id)
                                                                            {{ $farm->name }}
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td class="text-center">
                                                                    @foreach ($clients as $client)
                                                                        @if($item2->id_client == $client->id)
                                                                            {{ strtoupper($client->name) }}
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td class="text-center">{{ $item2->hb }}</td>
                                                                <td class="text-center">{{ $item2->qb }}</td>
                                                                <td class="text-center">{{ $item2->eb }}</td>
                                                                <td class="text-center">{{ $item2->quantity }}</td>
                                                                <td class="text-center" width="10px">
                                                                    <a href="{{ route('palletitems.edit', $item2->id) }}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Editar item de paleta"><i class="fas fa-edit"></i> Editar</a>
                                                                </td>
                                                                <td class="text-center" width="10px">
                                                                    {!! Form::open(['route' => ['palletitems.destroy', $item2->id], 'method' => 'DELETE', 'onclick' => 'return confirm("¿Seguro de eliminar item de paleta?")']) !!}
                                                                        <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar item de paleta"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                                                    {!! Form::close() !!}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2" class="text-center">Totales</th>
                                                        <th class="text-center">{{ $hb }}</th>
                                                        <th class="text-center">{{ $qb }}</th>
                                                        <th class="text-center">{{ $eb }}</th>
                                                        <th class="text-center">{{ $total }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
        
                                        
                                        @if(($counter - 1) == $item->counter)
                                            @can('pallets.destroy')
                                                {!! Form::open(['route' => ['pallets.destroy', $item->id], 'method' => 'DELETE']) !!}
                                                    {!! Form::button('<i class="fas fa-trash-alt"></i> ' . 'Eliminar', ['type' => 'submit', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Eliminar finca', 'class' => 'btn btn-xs btn-danger pull-right', 'onclick' => 'return confirm("¿Seguro de eliminar finca?")']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
        
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <button class="btn btn-default  " type="button">
                                Total HB <span class="badge">{{ $total_hb }}</span>
                            </button>
                            <button class="btn btn-primary" type="button">
                                Total QB <span class="badge">{{ $total_qb }}</span>
                            </button>
                            <button class="btn btn-info" type="button">
                                Total EB <span class="badge">{{ $total_eb }}</span>
                            </button>
                            <button class="btn btn-success" type="button">
                                Total Contenedor <span class="badge">{{ $total_container }}</span>
                            </button>
                        </div>
                    </div>
                </div>
        
        
        

         





      </div>
   </div>
</section>











@endsection