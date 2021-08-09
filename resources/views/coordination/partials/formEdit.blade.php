<div class="row">
    <div class="col-md-3 form-group">
        {{ Form::label('id_farm', 'Finca', ['class' => 'control-label']) }}
        {{ Form::select('id_farm', $farms, null, ['class' => 'form-control select-farm', 'placeholder' => 'Seleccione finca', 'id' => 'id_farmEdit']) }}
    </div>
    <div class="col-md-3 form-group">
        {{ Form::label('id_client', 'Cliente', ['class' => 'control-label']) }}
        {{ Form::select('id_client', $clients, null, ['class' => 'form-control select-client', 'placeholder' => 'Seleccione cliente']) }}
    </div>
    <div class="col-md-3 form-group">
        {{ Form::label('variety_id', 'Variedad', ['class' => 'control-label']) }}
        {{ Form::select('variety_id', $varieties, null, ['class' => 'form-control select-product', 'placeholder' => 'Seleccione tipo']) }}
    </div>
    <div class="col-sm-3">
        {{ Form::label('hawb', 'HAWB', ['class' => 'control-label']) }}
        {{ Form::text('hawb', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('hb', 'HB Coordinado', ['class' => 'control-label']) }}
        {{ Form::number('hb', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('qb', 'QB Coordinado', ['class' => 'control-label']) }}
        {{ Form::number('qb', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('eb', 'EB Coordinado', ['class' => 'control-label']) }}
        {{ Form::number('eb', null, ['class' => 'form-control']) }}
    </div>
    
    <hr>
    <br>
    <h5 class="col-sm-12">Recibidos</h5>
    <div class="col-sm-2">
        {{ Form::label('hb_r', 'HB Recibido', ['class' => 'control-label']) }}
        {{ Form::number('hb_r', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('qb_r', 'QB Recibido', ['class' => 'control-label']) }}
        {{ Form::number('qb_r', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('eb_r', 'EB Recibido', ['class' => 'control-label']) }}
        {{ Form::number('eb_r', null, ['class' => 'form-control']) }}
    </div>

    <div class="col-sm-2">
        {{ Form::label('returns', 'Devolución', ['class' => 'control-label']) }}
        {{ Form::number('returns', null, ['class' => 'form-control']) }}
    </div>
    
    
    {{ Form::hidden('update_user', Auth::user()->id, ['id' => 'update_user']) }}
    {{ Form::hidden('id_load', $load->id, ['id' => 'id_load']) }}
</div>

