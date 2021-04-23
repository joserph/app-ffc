<div class="row">
    <div class="col-md-12 form-group">
        {{ Form::label('id_farm', 'Finca', ['class' => 'control-label']) }}
        <div class="input-group mb-12">
            {{ Form::select('id_farm', $farmsList, null, ['class' => 'form-control select-farm', 'placeholder' => 'Seleccione finca']) }}
        </div>
    </div>

    <div class="col-md-12 form-group">
        {{ Form::label('id_client', 'Cliente', ['class' => 'control-label']) }}
        <div class="input-group mb-12">
            {{ Form::select('id_client', $clientsList, null, ['class' => 'form-control select-client', 'placeholder' => 'Seleccione cliente']) }}
        </div>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('hb', 'HB', ['class' => 'control-label']) }}
        <div class="input-group mb-12">
            {{ Form::text('hb', 0, ['class' => 'form-control grupo', 'id' => 'hb_', 'value' => '0']) }}
        </div>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('qb', 'QB', ['class' => 'control-label']) }}
        <div class="input-group mb-12">
            {{ Form::text('qb', 0, ['class' => 'form-control grupo', 'id' => 'qb_']) }}
        </div>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('eb', 'EB', ['class' => 'control-label']) }}
        <div class="input-group mb-12">
            {{ Form::text('eb', 0, ['class' => 'form-control grupo', 'id' => 'eb_']) }}
        </div>
    </div>
    <div class="col-md-6 form-group">
        {{ Form::label('quantity', 'Total', ['class' => 'control-label']) }}
        <div class="input-group mb-12">
            {{ Form::number('quantity', 0, ['class' => 'form-control', 'id' => 'total_', 'readonly']) }}
        </div>
    </div>
    <div class="col-md-6 form-group">
        {{ Form::label('piso', 'Piso', ['class' => 'control-label']) }}
        <div class="input-group mb-12">
            {{ Form::checkbox('piso', 'value', false) }}
        </div>
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



