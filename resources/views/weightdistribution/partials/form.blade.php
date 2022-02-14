<div class="row">
    <div class="col-sm-3">
        {{ Form::label('report_w', 'Reported Weight', ['class' => 'control-label']) }}
        {{ Form::text('report_w', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('large', 'Largo', ['class' => 'control-label']) }}
        {{ Form::number('large', 0, ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('width', 'Ancho', ['class' => 'control-label']) }}
        {{ Form::number('width', 0, ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('high', 'Alto', ['class' => 'control-label']) }}
        {{ Form::number('high', 0, ['class' => 'form-control']) }}
    </div>
    
    {{ Form::hidden('id_user', Auth::user()->id, ['id' => 'id_user']) }}
    {{ Form::hidden('update_user', Auth::user()->id, ['id' => 'update_user']) }}
    {{ Form::hidden('id_flight', $flight->id, ['id' => 'id_flight']) }}
    {{ Form::hidden('id_distribution', $item->id, ['id' => 'id_distribution']) }}
    
</div>

