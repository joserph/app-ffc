<h2>Editar finca</h2>
@include('farm.form')

<button wire:click="update" class="btn btn-sm btn-primary">
    Actualizar
</button>

<button wire:click="default" class="btn btn-sm btn-secondary">
    Cancelar
</button>