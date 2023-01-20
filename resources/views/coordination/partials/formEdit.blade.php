<div class="row">
    <div class="col-md-3 form-group">
        {{ Form::label('id_farm', 'Finca', ['class' => 'control-label']) }}
        {{-- {{ Form::select('id_farm', $farms, null, ['class' => 'form-control select-farm', 'placeholder' => 'Seleccione finca', 'id' => 'id_farmEdit']) }} --}}
        <select class="form-control" name="id_farm" id="id_farm">
            <option value="">Seleccione finca</option>
            @foreach($farmsList as $itemFarm)
                <option value="{{ $itemFarm->id }}" {{ $itemFarm->id == $item->id_farm ? 'selected' : '' }}>{{ $itemFarm->name }} {{ $itemFarm->tradename }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 form-group">
        {{ Form::label('id_client', 'Cliente', ['class' => 'control-label']) }}
        {{-- {{ Form::select('id_client', $clients, null, ['class' => 'form-control select-client', 'placeholder' => 'Seleccione cliente']) }} --}}
        <select class="form-control" name="id_client" id="id_client">
            <option value="">Seleccione cliente</option>
            @foreach($clientsList as $itemClient)
              <option value="{{ $itemClient->id }}" {{ $itemClient->id == $item->id_client ? 'selected' : '' }}>{{ str_replace('SAG-', '', $itemClient->name) }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3 form-group">
        {{ Form::label('variety_id', 'Variedad', ['class' => 'control-label']) }}
        {{ Form::select('variety_id', $varieties, null, ['class' => 'form-control select-product', 'placeholder' => 'Seleccione tipo']) }}
    </div>
    <div class="col-sm-3">
        {{ Form::label('hawb', 'HAWB', ['class' => 'control-label']) }}
        {{ Form::text('hawb', null, ['class' => 'form-control']) }}
    </div>
    <h5 class="col-sm-12">
        <p class="lead">Coordinado</p>
        <hr>
    </h5>
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
    
    <h5 class="col-sm-12">
        <br>
        <p class="lead">Recibido</p>
        <hr>
    </h5>
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

