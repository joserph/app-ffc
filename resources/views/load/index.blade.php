@extends('layouts.principal')

@section('content')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Cargas
               @can('haveaccess', 'load.create')
                  <a href="{{ route('load.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Crear</a>
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
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col">Embarque</th>
                           <th scope="col">BL</th>
                           <th scope="col">Transportista</th>
                           <th scope="col">Fecha</th>
                           <th class="text-center" colspan="3">&nbsp;</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($loads as $load)
                           <tr>
                              <td>{{ $load->shipment }}</td>
                              <td>{{ $load->bl }}</td>
                              <td>{{ $load->carrier }}</td>
                              <td>{{ $load->date }}</td>
                              <td width="100px" class="text-center">
                                 @can('haveaccess', 'load.show')
                                    <a href="{{ route('load.show', $load->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Ver</a>
                                 @endcan
                              </td>
                              <td width="100px" class="text-center">
                                 @can('haveaccess', 'load.edit')
                                    <a href="{{ route('load.edit', $load->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a>
                                 @endcan
                              </td>
                              <td width="120px" class="text-center">
                                 @can('haveaccess', 'load.destroy')
                                    {{ Form::open(['route' => ['load.destroy', $load->id], 'method' => 'DELETE']) }}
                                       {{ Form::button('<i class="fas fa-trash-alt"></i> ' . 'Eliminar', ['type' => 'submit', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Eliminar permiso', 'class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("¿Seguro de eliminar el permiso?")']) }}
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
            <!-- /.card -->
         </div>
      </div>
   </div>
</section>











@endsection
