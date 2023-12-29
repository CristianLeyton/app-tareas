<div class="">
    {{-- Header --}}
    <div class="flex justify-between">
        <x-primary-button wire:click="$set('open',true)">Nueva tarea</x-primary-button>
        <div class="flex gap-3">
        <x-label for="etiquetas">Filtar:
        <x-select name="etiquetas" id="" class="text-sm">
            <option value="">Etiqueta</option>
            <option value="">Etiqueta 1</option>
        </x-select>
        </x-label>
        <x-label for="fecha">Ordenar:
            <x-select name="fecha" id="" class="text-sm">
                <option value="">Fecha</option>
                <option value="">Etiqueta 1</option>
            </x-select>
            </x-label>
        </div>    
    </div>  
    {{-- Tabla de tareas --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 mt-2">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="p-4">
                        Completada
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre 
                    </th>
                    <th scope="col" class="px-6 py-3 hidden sm:inline-block">
                        Etiquetas
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr class="bg-white border-b  hover:bg-gray-50  ">
                    <td class="w-4 p-4">
                        <div class="flex items-center justify-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                        {{$task->name}}
                    </th>
                    <td class="px-6 py-4 hidden sm:inline-block" >
                        @foreach ($task->tags as $tag)
                        <span class="" style="color: #{{$tag->color}}"><i class='bx bxs-bookmark-star' style="transform: scale(1.1)"></i>{{Str::ucfirst($tag->name)}}</span>
                        @endforeach
                        {{-- {{ $task->tags()->pluck('name')->join(', ')}} --}}
                    </td>
                    <td class="text-center" >
                        <x-secondary-button wire:click="$set('detailOpen',true)">
                            <box-icon type="" name="detail" color="gray" size="xs" style="transform: scale(1.4)"></box-icon>
                        </x-secondary-button>
                        <x-button wire:click="$set('editOpen',true)">
                            <box-icon type="solid" name="edit" color="white" size="xs" style="transform: scale(1.4)"></box-icon>
                        </x-button>
                        <x-danger-button wire:click="$set('destroyOpen',true)">
                            <box-icon type="solid" name="trash" color="white" size="xs" style="transform: scale(1.4)"></box-icon>
                        </x-danger-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500  mb-4 md:mb-0 block w-full md:inline md:w-auto">Mostrando <span class="font-semibold text-gray-900 ">1</span> de <span class="font-semibold text-gray-900 ">1</span></span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 ">Anterior</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">1</a>
                </li>
                
            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 ">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
    
    {{-- MODAL NUEVA TAREA --}}

    @include('..modals.newTask')

    {{-- MODAL EDITAR TAREA --}}

    @include('..modals.editTask')

    {{-- MODAL DETALLES --}}

    @include('..modals.detailTask')

    {{-- MODAL ELIMINAR --}}

    <x-confirmation-modal  wire:model="destroyOpen">
        <x-slot name="title">
            ¿Eliminar tarea?
        </x-slot>  
        <x-slot name="content">
            ¿Estás seguro? ¡Esta acción no se puede revertir!
        </x-slot>  
           
        <x-slot name="footer">
            <div class="flex gap-3">
            <x-danger-button> Eliminar </x-danger-button>
            <x-secondary-button wire:click="$set('destroyOpen',false)">Cancelar</x-secondary-button>
            </div>
        </x-slot>
    </x-confirmation-modal>
    
</div>
