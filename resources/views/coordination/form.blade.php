<div class="row">
    <div class="col-md-4 form-group">
        {{ Form::label('id_farm', 'Finca', ['class' => 'control-label']) }}
        {{ Form::select('id_farm', $farms, null, ['class' => 'form-control select-farm', 'placeholder' => 'Seleccione finca', 'v-model' => 'id_farm']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.id_farm">El campo Finca es obligatorio.</span>
        <span class="text-danger" v-for="error in errors" v-if="error.fa_cl_de">La conbinación de Finca, Cliente y Variedad esta duplicada.</span>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('id_client', 'Cliente', ['class' => 'control-label']) }}
        {{ Form::select('id_client', $clients, null, ['class' => 'form-control select-client', 'placeholder' => 'Seleccione cliente', 'v-model' => 'id_client']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.id_client">El campo Cliente es obligatorio.</span>
        <span class="text-danger" v-for="error in errors" v-if="error.fa_cl_de">La conbinación de Finca, Cliente y Variedad esta duplicada.</span>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('variety_id', 'Variedad', ['class' => 'control-label']) }}
        {{ Form::select('variety_id', $varieties, null, ['class' => 'form-control select-product', 'placeholder' => 'Seleccione tipo', 'v-model' => 'variety_id']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.variety_id">El campo Variedad es obligatorio.</span>
        <span class="text-danger" v-for="error in errors" v-if="error.fa_cl_de">La conbinación de Finca, Cliente y Variedad esta duplicada.</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('hb', 'HB', ['class' => 'control-label']) }}
        {{ Form::number('hb', null, ['class' => 'form-control', 'v-model' => 'hb']) }}
    </div>
    <div class="col-sm-3">
        {{ Form::label('qb', 'QB', ['class' => 'control-label']) }}
        {{ Form::number('qb', null, ['class' => 'form-control', 'v-model' => 'qb']) }}
    </div>
    <div class="col-sm-3">
        {{ Form::label('eb', 'EB', ['class' => 'control-label']) }}
        {{ Form::number('eb', null, ['class' => 'form-control', 'v-model' => 'eb']) }}
    </div>
    <div class="col-sm-3">
        {{ Form::label('hawb', 'HAWB', ['class' => 'control-label']) }}
        {{ Form::text('hawb', null, ['class' => 'form-control', 'v-model' => 'hawb']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.hawb }}</span>
    </div>
    <hr>
    
    
    {{ Form::hidden('id_user', Auth::user()->id, ['id' => 'id_user']) }}
    {{ Form::hidden('update_user', Auth::user()->id, ['id' => 'update_user']) }}
    {{ Form::hidden('id_load', $load->id, ['id' => 'id_load']) }}
</div>