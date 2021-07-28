@extends('layouts.principal')

@section('title') Cargas | Sistema de Carguera v1.1 @stop

@section('content')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Cargas
               @can('haveaccess', 'load.create')
                  <a href="{{ route('load.create') }}" class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i></a>
               @endcan
            </h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
               <li class="breadcrumb-item active">Cargas</li>
            </ol>
         </div>
      </div>
   </div><!-- /.container-fluid -->
</section>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- /.col -->
         <div class="col-md-12">
            @can('haveaccess', 'load.index')
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">Lista de Cargas</h3>
                     <div class="card-tools">
                        {{ $loads->links() }}
                     </div>
                  </div>
   
                  @include('custom.message') 
   
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                     <table class="table table-sm">
                        <thead class="thead-dark">
                           <tr>
                              <th scope="col">Embarque</th>
                              <th scope="col">BL</th>
                              <th scope="col">Transportista</th>
                              <th scope="col">Fecha Salida</th>
                              <th scope="col">Fecha Llegada</th>
                              <th scope="col">Estatus</th>
                              <th class="text-center" width="80px" colspan="3">@can('haveaccess', 'load.show')Ver @endcan @can('haveaccess', 'load.edit')Editar @endcan @can('haveaccess', 'load.destroy')Eliminar @endcan</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($loads as $load)
                              @php
                                 $llegada = strtotime($load->arrival_date);
                                 $salida = strtotime($load->date);
                                 $dife = ($llegada - $salida);
                              @endphp
                              -{{ date('d/m/Y', strtotime($dife)) }}
                              <tr>
                                 <td>{{ $load->shipment }}</td>
                                 <td>{{ $load->bl }}</td>
                                 <td>{{ $load->carrier }}</td>
                                 <td>{{ date('d/m/Y', strtotime($load->date)) }}</td>
                                 <td>{{ date('d/m/Y', strtotime($load->arrival_date)) }}</td>
                                 <td><div class="progress mb-3">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="15" style="width: 5%">
                                      <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                  </div></td>
                                 <td width="45px" class="text-center">
                                    @can('haveaccess', 'load.show')
                                       <a href="{{ route('load.show', $load->id) }}" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>
                                    @endcan
                                 </td>
                                 <td width="45px" class="text-center">
                                    @can('haveaccess', 'load.edit')
                                       <a href="{{ route('load.edit', $load->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    @endcan
                                 </td>
                                 <td width="45px" class="text-center">
                                    @can('haveaccess', 'load.destroy')
                                       {{ Form::open(['route' => ['load.destroy', $load->id], 'method' => 'DELETE']) }}
                                          {{ Form::button('<i class="fas fa-trash-alt"></i> ' . '', ['type' => 'submit', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Eliminar carga', 'class' => 'btn btn-sm btn-outline-danger', 'onclick' => 'return confirm("¿Seguro de eliminar la carga?")']) }}
                                       {{ Form::close() }}
                                    @endcan
                                 </td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <!-- /.card-body -->
               </div>
            @endcan
            <!-- /.card -->
         </div>
      </div>
   </div>
</section>











@endsection
