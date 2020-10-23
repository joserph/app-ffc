<div class="form-group row">
    {{ Form::label('name', 'Nombre', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('email', 'Correo', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Correo']) }}
    </div>
</div>

@if (Auth::user()->roles[0]->full_access != 'no')
<div class="form-group row">
    {{ Form::label('roles', 'Role', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('roles', $roles, null, ['class' => 'form-control', 'placeholder' => 'Seleccione role']) }}
    </div>
</div>
@else 
    {{ Form::hidden('roles', $user->roles[0]->id)}}
@endif
