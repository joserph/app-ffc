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
            <input type="number" name="hb" id="hb_{{ $item->id }}" value="0" class="form-control grupo">
        </div>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('qb', 'QB', ['class' => 'control-label']) }}
        <div class="input-group mb-12">
            <input type="number" name="qb" id="qb_{{ $item->id }}" value="0" class="form-control grupo">
        </div>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('eb', 'EB', ['class' => 'control-label']) }}
        <div class="input-group mb-12">
            <input type="number" name="eb" id="eb_{{ $item->id }}" value="0" class="form-control grupo">
        </div>
    </div>
    <div class="col-md-6 form-group">
        {{ Form::label('quantity', 'Total', ['class' => 'control-label']) }}
        <div class="input-group mb-12">
            <input type="number" name="quantity" id="total_{{ $item->id }}" value="0" class="form-control grupo" readonly>
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
        function mifuncion(elemento) {
            var id_pallet = elemento.getAttribute('value');
            $(document).ready(function(){
                alert(id_pallet);
                $(".grupo").keyup(function()
                {
                    var hb = $('#hb_'+id_pallet).val();
                    var qb = $('#qb_'+id_pallet).val();
                    var eb = $('#eb_'+id_pallet).val();
                    var total = parseFloat(hb) + parseFloat(qb) + parseFloat(eb);
                    $('#total_'+id_pallet).val(parseFloat(total));
                    console.log(total);
                });
            });
        }
    
</script>

@endsection



