<div class="row">
    <div class="col-md-6 form-group">
        {{ Form::label('name', 'Variedad', ['class' => 'control-label']) }}
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" wire:model="name">
    </div>
</div>
