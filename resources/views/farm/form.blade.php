<div class="row">
    <div class="col-md-8 form-group">
        {{ Form::label('name', 'Nombre', ['class' => 'control-label']) }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('phone', 'Teléfono', ['class' => 'control-label']) }}
        {{ Form::text('phone', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-6 form-group">
        {{ Form::label('address', 'Dirección', ['class' => 'control-label']) }}
        {{ Form::text('address', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-2 form-group">
        {{ Form::label('state', 'Estado', ['class' => 'control-label']) }}
        {{ Form::text('state', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-2 form-group">
        {{ Form::label('city', 'Ciudad', ['class' => 'control-label']) }}
        {{ Form::text('city', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-2 form-group">
        {{ Form::label('country', 'País', ['class' => 'control-label']) }}
        {{ Form::text('country', null, ['class' => 'form-control']) }}
    </div>
</div>
