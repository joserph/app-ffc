<div class="form-group">
    {{ Form::label('id_farm', 'Finca', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('id_farm', $farmsList, null, ['class' => 'form-control select-farm', 'placeholder' => 'Seleccione finca']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('id_client', 'Cliente', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-6">
        {{ Form::select('id_client', $clientsList, null, ['class' => 'form-control select-client', 'placeholder' => 'Seleccione cliente']) }}
    </div>
</div>

<input type="hidden" name="id_pallet" id="id_pallet" value="{{ $id_pallet }}">

<div class="form-group">
    {{ Form::label('hb', 'HB', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-2">
        {{ Form::text('hb', 0, ['class' => 'form-control grupo', 'id' => 'hb', 'value' => '0']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('qb', 'QB', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-2">
        {{ Form::text('qb', 0, ['class' => 'form-control grupo', 'id' => 'qb']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('eb', 'EB', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-2">
        {{ Form::text('eb', 0, ['class' => 'form-control grupo', 'id' => 'eb']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('quantity', 'Total', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-2">
        {{ Form::number('quantity', 0, ['class' => 'form-control', 'id' => 'total', 'readonly']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('piso', 'Piso', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-2">
        {{ Form::checkbox('piso', 'value', false) }}
    </div>
</div>
@section('scripts')
<script>
    $(document).ready(function(){
        $(".grupo").keyup(function()
        {
            var hb = $('#hb').val();
            var qb = $('#qb').val();
            var eb = $('#eb').val();
            var total = parseFloat(hb) + parseFloat(qb) + parseFloat(eb);
            $('#total').val(parseFloat(total));
            console.log(total);
        });
    });
</script>

@endsection