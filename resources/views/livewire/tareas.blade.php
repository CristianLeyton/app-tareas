<div class="">
    {{-- Header --}}
    <div class="flex justify-between flex-wrap sm:flex-nowrap gap-3">

        <x-primary-button class="border-none flex gap-2" title="Crear nueva tarea"
            wire:click="$set('taskCreate.open',true)">
            <p class="" style="white-space: nowrap;">Nueva tarea</p><box-icon type="solid" name="plus-square"
                color="white" size="xs" style="transform: scale(1.4)"></box-icon>
        </x-primary-button>

        <div class="flex gap-3 justify-between sm:justify-end w-full">
            <div class="flex items-end">
                <x-label for="etiquetas">Etiquetas:
                    <x-select name="etiquetas" wire:model.live="tag" class="text-sm">
                        <option value="">Todas</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ Str::ucfirst($tag->name) }}</option>
                        @endforeach
                    </x-select>
            </div>
            <div class="flex">
                </x-label>
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
                    <tr id="task" class="bg-white border-b hover:bg-gray-50  ">
                        <td class="w-4 p-4">
                            <div class="flex items-center justify-center active:shadow-indigo-600">
                                <button wire:click="completedTask({{ $task->id }})"
                                    class="text-transparent flex justify-center items-center bg-slate-100 border border-gray-400 rounded hover:outline-none hover:ring-2 hover:ring-indigo-500 hover:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 active:text-indigo-600 "
                                    style="width: 20px; height: 20px;"><i class=' bx bxs-check-square'
                                        style="font-size: 22px"></i></button>
                            </div>
                        </td>
                        <th id="nameTask" scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            {{ $task->name }}
                        </th>
                        <td class="px-6 py-4 hidden sm:inline-block">
                            @foreach ($task->tags as $tag)
                                <span class="" style="color: {{ $tag->color }}"><i class='bx bxs-bookmark-star'
                                        style="transform: scale(1.1)"></i>{{ Str::ucfirst($tag->name) }}</span>
                            @endforeach
                            {{-- {{ $task->tags()->pluck('name')->join(', ')}} --}}
                        </td>
                        <td class="text-center">
                            <x-secondary-button title="Resumen" wire:click="detailTask({{ $task->id }})">
                                <box-icon type="" name="detail" color="gray" size="xs"
                                    style="transform: scale(1.4)"></box-icon>
                            </x-secondary-button>
                            <x-button title="Editar" wire:click="editTask({{ $task->id }})">
                                <box-icon type="solid" name="edit" color="white" size="xs"
                                    style="transform: scale(1.4)"></box-icon>
                            </x-button>
                            <x-danger-button title="Eliminar" wire:click="confirmDestroy({{ $task->id }})">
                                <box-icon type="solid" name="trash" color="white" size="xs"
                                    style="transform: scale(1.4)"></box-icon>
                            </x-danger-button>
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
            <p class="text-red-600"> ¿Eliminar tarea? </p>
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
