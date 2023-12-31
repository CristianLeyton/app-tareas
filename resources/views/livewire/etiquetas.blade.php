<div>
    <x-primary-button class="mb-2 border-none flex gap-2" title="Crear nueva etiqueta"
        wire:click="$set('tagCreate.open',true)">
        <p class="" style="padding: 3px 0; white-space: nowrap;">Nueva etiqueta</p><box-icon type="solid" name="bookmark-plus"
            color="white" size="xs" style="transform: scale(1.4)"></box-icon>
    </x-primary-button>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 mt-2">
        <table id="" class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="p-4">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Color
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($tags as $tag)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th id="nameTask" scope="row"
                            class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            {{ Str::ucfirst($tag->name) }}
                        </th>

                        <td class="px-6 py-4 ">
                            <span class="" style="color: {{ $tag->color }}"><i class='bx bxs-bookmark-star'
                                    style="transform: scale(1.1)"></i>{{ Str::ucfirst($tag->color) }}</span>
                        </td>

                        <td class="px-6 py-4 text-center">

                            @if ($tag->id == 1 || $tag->id == 2)
                                <x-button title="Editar" class="opacity-50" style="pointer-events: none;">
                                    <box-icon type="solid" name="edit" color="white" size="xs"
                                        style="transform: scale(1.4)"></box-icon>
                                </x-button>

                                <x-danger-button title="Eliminar" class="opacity-50" style="pointer-events: none;">
                                    <box-icon type="solid" name="trash" color="white" size="xs"
                                        style="transform: scale(1.4)"></box-icon>
                                </x-danger-button>
                            @else
                                <x-button title="Editar" wire:click="editTag({{ $tag->id }})">
                                    <box-icon type="solid" name="edit" color="white" size="xs"
                                        style="transform: scale(1.4)"></box-icon>
                                </x-button>

                                <x-danger-button title="Eliminar" wire:click="confirmDestroy({{ $tag->id }})">
                                    <box-icon type="solid" name="trash" color="white" size="xs"
                                        style="transform: scale(1.4)"></box-icon>
                                </x-danger-button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $tags->links() }}
        </div>
    </div>

    @include('..modals.newTag')

    @include('..modals.editTag')

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
                <x-danger-button wire:click="destroyTag"> Eliminar </x-danger-button>
                <x-secondary-button wire:click="$set('destroyOpen',false)">Cancelar</x-secondary-button>
            </div>
        </x-slot>
    </x-confirmation-modal>

</div>
