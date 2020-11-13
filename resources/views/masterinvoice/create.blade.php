@can('haveaccess', 'masterinvoice.create')
<h2>Crear Factura Master</h2>
@include('custom.message') 

@include('masterinvoice.formHeader')

<button wire:click="store" class="btn btn-outline-primary" id="createMasterInvoice" data-toggle="tooltip" data-placement="top" title="Crear Empresa">
    <i class="fas fa-plus-circle"></i> Crear
</button>
@endcan