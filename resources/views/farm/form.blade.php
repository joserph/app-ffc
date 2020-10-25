
<form class="form-inline">
    <div class="form-group mb-8">
        <div class="">
            {{ Form::label('name', 'Nombre', ['class' => 'control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="form-group mb-4">
        <div class="">
            {{ Form::label('phone', 'Telefono', ['class' => 'control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
    </div>
</form>

<div class="form-group">
    {{ Form::label('name', 'Nombre', ['class' => 'col-sm-8 control-label']) }}
    <div class="col-sm-8">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('name', 'Nombre', ['class' => 'col-sm-8 control-label']) }}
    <div class="col-sm-8">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('name', 'Nombre', ['class' => 'col-sm-8 control-label']) }}
    <div class="col-sm-8">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>