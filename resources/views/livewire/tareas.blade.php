<div class="">
    {{-- Header --}}
    <div class="flex justify-between flex-wrap sm:flex-nowrap gap-3">
        
        <x-primary-button class="border-none" title="Crear nueva tarea" wire:click="$set('taskCreate.open',true)"><p class="" style="white-space: nowrap;">Nueva tarea</p><i class='text-lg bx bxs-plus-square bx-rotate-90' ></i></x-primary-button>
        <x-secondary-button id="btnLimpiar" onclick="window.location.reload();"><p>Limpiar</p> <i class='text-lg bx bxs-check-square' ></i></x-secondary-button>
        
        <div class="flex gap-3 justify-between sm:justify-end w-full">
        <div class="flex items-end">
        <x-label for="etiquetas">Etiquetas:
        <x-select name="etiquetas" wire:model.live="tag" class="text-sm">
            <option value="">Todas</option>
            @foreach ($tags as $tag)
                <option value="{{$tag->id}}">{{Str::ucfirst($tag->name)}}</option>
            @endforeach
        </x-select>
        </div>
        <div class="flex">
        </x-label>
        <x-label for="fecha">Mostrar primero:
            <x-select name="fecha" wire:model.live="ordenar" id="" class="text-sm">
                <option value="asc">Más antigua</option>
                <option value="desc">Más nueva</option>
            </x-select>
            </x-label>
        </div>  
        </div>  
    </div>  
    {{-- Tabla de tareas --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 mt-2">
        <table id="taskList" class="w-full text-sm text-left rtl:text-right text-gray-500 ">
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
                <tr id="task" class="bg-white border-b hover:bg-gray-50  ">
                    <td  class="w-4 p-4">
                        <div class="flex items-center justify-center">
                            <input wire:click="completedTask({{$task->id}})" id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 checkbox-task">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th  id="nameTask" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                        {{$task->name}}
                    </th>
                    <td class="px-6 py-4 hidden sm:inline-block" >
                        @foreach ($task->tags as $tag)
                        <span class="" style="color: #{{$tag->color}}"><i class='bx bxs-bookmark-star' style="transform: scale(1.1)"></i>{{Str::ucfirst($tag->name)}}</span>
                        @endforeach
                        {{-- {{ $task->tags()->pluck('name')->join(', ')}} --}}
                    </td>
                    <td class="text-center" >
                        <x-secondary-button title="Resumen" wire:click="detailTask({{$task->id}})">
                            <box-icon type="" name="detail" color="gray" size="xs" style="transform: scale(1.4)"></box-icon>
                        </x-secondary-button>
                        <x-button title="Editar" wire:click="editTask({{$task->id}})">
                            <box-icon type="solid" name="edit" color="white" size="xs" style="transform: scale(1.4)"></box-icon>
                        </x-button>
                        <x-danger-button title="Eliminar" wire:click="confirmDestroy({{$task->id}})">
                            <box-icon type="solid" name="trash" color="white" size="xs" style="transform: scale(1.4)"></box-icon>
                        </x-danger-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
           {{$tasks->links()}} 
        </div>
        {{-- <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
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
        </nav> --}}
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
            <x-danger-button wire:click="destroyTask"> Eliminar </x-danger-button>
            <x-secondary-button wire:click="$set('destroyOpen',false)">Cancelar</x-secondary-button>
            </div>
        </x-slot>
    </x-confirmation-modal>
    
</div>
