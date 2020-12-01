@can('haveaccess', 'varieties.index')
<h2>Listado tipos de variedades</h2>
<div class="table-responsive">
   <table class="table table-sm table-hover">
    <thead>
       <tr>
          <th scope="col">Nombre</th>
          <th class="text-center" colspan="2">@can('haveaccess', 'variety.edit') Editar @endcan  @can('haveaccess', 'variety.destroy')/ Eliminar @endcan</th>
       </tr>
    </thead>
    <tbody>
       @foreach ($varieties as $variety)
         <tr>
            <td>{{ $variety->name }}</td>
            <td colspan="2" class="text-center">
               @can('haveaccess', 'variety.edit')
               <button wire:click="edit({{ $variety->id }})" class="btn btn-sm btn-outline-warning">
                  <i class="far fa-edit"></i>
               </button>
               @endcan
               @can('haveaccess', 'variety.destroy')
               <button wire:click="destroy({{ $variety->id }})" class="btn btn-sm btn-outline-danger">
                  <i class="fas fa-trash"></i>
               </button>
               @endcan
            </td>
         </tr>
       @endforeach
    </tbody>
 </table>
 {{ $varieties->links() }}
</div>
@endcan