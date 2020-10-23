@extends('layouts.principal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">Editar permiso
                </div>

                <div class="card-body">
                    
                   @include('custom.message')

                    {{ Form::model($permission, ['route' => ['permission.update', $permission->id], 'class' => 'form-horizontal', 'method' => 'PUT']) }}
                        @include('permission.partials.formE')
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-12">
                               <button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-sync"></i> Actualizar</button>
                            </div>
                         </div>
                    {{ Form::close() }}
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
