<div class="">
    {{-- Header --}}
    <div class="flex justify-between flex-wrap sm:flex-nowrap gap-3">

        <x-primary-button class="border-none flex gap-2" title="Crear nueva tarea"
            wire:click="$set('taskCreate.open',true)">
            <p class="" style="padding: 3px 0; white-space: nowrap;">Nueva tarea</p><box-icon type="solid" name="plus-square"
                color="white" size="xs" style="transform: scale(1.4)"></box-icon>
        </x-primary-button>

        <div class="flex gap-3 justify-between sm:justify-end w-full">
            <div class="flex max-w-28 sm:max-w-none">
                <x-label for="etiquetas">Etiquetas:
                    <x-select name="etiquetas" wire:change="$set('ordenar','')" wire:model.live="tag" class="text-sm">
                        <option value="">Todas</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ Str::ucfirst($tag->name) }}</option>
                        @endforeach
                    </x-select>
                </x-label>
            </div>
            <div class="flex justify-end max-w-28 sm:max-w-none">
                
                <x-label for="fecha">Mostrar primero:
                    <x-select name="fecha" wire:change="$set('tag','')" wire:model="ordenar" id=""
                        class="text-sm">
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
                        <span class="hidden sm:block text-center">
                            Completada 
                            <i wire:loading wire:target="completedTask" class='text-indigo-600 bx bx-loader-circle bx-spin ml-1 mt-1' style="font-size: 20px"></i></i>
                        </span>
                        <span class="block sm:hidden">
                            <i class=' text-indigo-600 bx bxs-check-square border border-indigo-600 rounded' style="font-size:24px;"></i>
                            <i wire:loading wire:target="completedTask" class='text-indigo-600 bx bx-loader-circle bx-spin ml-1 mt-1' style="font-size: 20px"></i></i>
                        </span>
                    </th>
                    <th scope="col" class="px-2 sm:px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 hidden lg:inline-block">
                        Etiquetas
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>

                @if (!$tasks[0])
                    <tr class="bg-white border-b ">
                        <td colspan="4" class="w-4 p-4">
                            <div class="flex items-center justify-center text-slate-500">
                                ¡No hay ninguna tarea creada!
                            </div>
                        </td>
                    </tr>
                @endif

                @foreach ($tasks as $task)
                    <tr id="task" class="bg-white border-b hover:bg-gray-50" wire:key="task{{$task->id}}">
                        <td class="w-4 p-4">
                            <div class="flex items-center justify-center active:shadow-indigo-600">
                                <button wire:click="completedTask({{ $task->id }})"
                                    class="text-transparent flex justify-center items-center bg-slate-100 border border-gray-400 rounded hover:outline-none hover:ring-2 hover:ring-indigo-500 hover:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 active:text-indigo-600 "
                                    style="width: 20px; height: 20px;"><i class=' bx bxs-check-square'
                                        style="font-size: 22px"></i>
                                </button>
                            </div>
                        </td>
                        <th id="nameTask"  scope="row"
                            class="px-2 sm:px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <span class="inline-flex" wire:click="detailTask({{ $task->id }})">
                                <p class="max-w-36 sm:max-w-36 md:max-w-80 inline-flex items-end gap-1 truncate {{$task->expired ? 'text-orange-600' : ''}} " wire:click="$set('openDetail', true)">
                                    @if ($task->expired)
                                        <i class='inline-block bx bx-calendar-exclamation text-orange-600' title="¡Tarea vencida!" style="font-size: 22px"></i>
                                    @endif    

                                    <span class="inline-block">
                                    {{ $task->name }}
                                    </span>
                                </p>
                                
                            </span> 
                        </th>
                        <td class="nowrap px-6 py-4 hidden lg:inline-block">

                            @foreach ($task->tags as $tag)
                                <span class="" style="color: {{ $tag->color }}"><i class='bx bxs-bookmark-star'
                                        style="transform: scale(1.1)"></i>{{ Str::ucfirst($tag->name) }}</span>
                            @endforeach
                            
                        </td>
                        <td class="text-center min-w-36">
                            <span wire:click="$set('openDetail', true)">
                            <x-secondary-button title="Resumen" wire:click="detailTask({{ $task->id }})">
                                <box-icon type="" name="detail" color="gray" size="xs"
                                    style="transform: scale(1.4)"></box-icon>
                            </x-secondary-button>
                            </span>
                            <span wire:click="$set('openEdit', true)">
                            <x-button title="Editar" wire:click="editTask({{ $task->id }})">
                                <box-icon type="solid" name="edit" color="white" size="xs"
                                    style="transform: scale(1.4)"></box-icon>
                            </x-button>
                            </span>
                            <span wire:click="$set('destroyOpen', true)">
                            <x-danger-button title="Eliminar" wire:click="confirmDestroy({{ $task->id }})">
                                <box-icon type="solid" name="trash" color="white" size="xs"
                                    style="transform: scale(1.4)"></box-icon>
                            </x-danger-button>
                        </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $tasks->links() }}
        </div>

    </div>

    {{-- MODAL NUEVA TAREA --}}

    @include('..modals.newTask')

    {{-- MODAL EDITAR TAREA --}}

    @include('..modals.editTask')

    {{-- MODAL DETALLES --}}

    @include('..modals.detailTask')

    {{-- MODAL ELIMINAR --}}

    <x-confirmation-modal wire:model="destroyOpen">
        <x-slot name="title">
            <div class="text-red-600" wire:loading wire:target="destroyTask"> 
                <p class="opacity-70 text-sm">Eliminando... <i class='bx bx-loader-circle bx-spin' style="font-size: 18px"></i></i> </p>
            </div>
            <p class="text-red-600"> ¿Eliminar tarea? </p>
        </x-slot>
        <x-slot name="content">
            ¿Estás seguro? ¡Esta acción no se puede revertir!
        </x-slot>
        <x-slot name="footer">
            <div class="flex gap-3">
                <div class="text-red-600 text-center" wire:loading wire:target="confirmDestroy"> 
                    <i class='bx bx-loader-circle bx-spin' style="font-size: 18px"></i></i>
                </div>
                <div wire:loading.class="hidden" wire:target="confirmDestroy">
                <x-danger-button wire:click="destroyTask"> Eliminar </x-danger-button>
                <x-secondary-button wire:click="$set('destroyOpen',false)">Cancelar</x-secondary-button>
                </div>
            </div>
        </x-slot>
    </x-confirmation-modal>

</div>
