@can('haveaccess', 'farm.index')
<h2>Listado de Fincas</h2>
<div class="table-responsive">
   <table class="table table-sm table-hover">
    <thead>
       <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Dirección</th>
          <th scope="col">Estado</th>
          <th scope="col">Ciudad</th>
          <th scope="col">País</th>
          <th class="text-center" colspan="2">@can('haveaccess', 'farm.edit') Editar @endcan  @can('haveaccess', 'farm.destroy')/ Eliminar @endcan</th>
       </tr>
    </thead>
    <tbody>
       @foreach ($farms as $farm)
         <tr>
            <td>{{ $farm->name }}</td>
            <td>{{ $farm->phone }}</td>
            <td>{{ $farm->address }}</td>
            <td>{{ $farm->state }}</td>
            <td>{{ $farm->city }}</td>
            <td>{{ $farm->country }}</td>
            <td colspan="2" class="text-center">
               @can('haveaccess', 'farm.edit')
               <button wire:click="edit({{ $farm->id }})" class="btn btn-sm btn-outline-warning">
                  <i class="far fa-edit"></i>
               </button>
               @endcan
               @can('haveaccess', 'farm.destroy')
               <button wire:click="destroy({{ $farm->id }})" class="btn btn-sm btn-outline-danger">
                  <i class="fas fa-trash"></i>
               </button>
               @endcan
            </td>
         </tr>
       @endforeach
    </tbody>
 </table>
 {{ $farms->links() }}
</div>
@endcan