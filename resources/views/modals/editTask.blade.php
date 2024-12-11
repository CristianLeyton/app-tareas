<form wire:submit="updateTask">
    <x-dialog-modal wire:model="openEdit">
        <x-slot name="title">
            <div class="flex justify-between">
                <p class="text-indigo-600 font-bold"> Editar tarea:</p>
                <div class="text-indigo-600" wire:loading wire:target="updateTask">
                    <p class="opacity-70 text-sm">Guardando... <i class='bx bx-loader-circle bx-spin'
                            style="font-size: 18px"></i></i> </p>
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="text-indigo-600 w-full block text-center" wire:loading wire:target="editTask">
                <i class='bx bx-loader-circle bx-spin' style="font-size: 48px"></i></i>
            </div>
            <span class="" wire:loading.class="hidden" wire:target="editTask">
                <div class="mb-4">
                    <x-label for="">
                        Nombre:
                    </x-label>
                    <x-input placeholder="{{ $taskEdit->taskName }}" class="w-full"
                        wire:model.live="taskEdit.taskName" />
                    <x-input-error for="taskEdit.taskName" />
                </div>

                <div class="mb-4">
                    <x-label for="">
                        Detalles:
                    </x-label>
                    <x-textarea placeholder="{{ $taskEdit->taskContent }}" class="w-full"
                        wire:model.live="taskEdit.taskContent"></x-textarea>
                    <x-input-error for="taskEdit.taskContent" />
                </div>

                <div class="mb-4">
                    <x-label>
                        Repetir:
                    </x-label>
                    <x-select class="w-full" wire:model="taskEdit.repeat_id">
                        @foreach ($repeats as $repeat)
                            <option value="{{ $repeat->id }}">
                                {{ ucfirst($repeat->name) }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="" />
                </div>

                <div class="mb-4">
                    <x-label>
                        Etiquetas:
                    </x-label>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($tags as $tag)
                            <label wire.key="tag{{ $tag->id }}"
                                class="flex gap-1 items-center border py-1 px-2 rounded">
                                <x-checkbox wire:model="taskEdit.taskTags" value="{{ $tag->id }}" />
                                <div class="flex justify-between items-center w-fit">
                                    <span class="mr-2"
                                        style="color: {{ $tag->color }}">{{ Str::ucfirst($tag->name) }}</span>
                                    <i class='bx bxs-bookmark-star'
                                        style="transform: scale(1.4); color: {{ $tag->color }};"></i>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error for="" />
                </div>
            </span>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end gap-2">
                <x-secondary-button wire:click="$set('openEdit',false)">
                    Cancelar
                </x-secondary-button>
                <x-primary-button>
                    Actualizar
                </x-primary-button>
            </div>
        </x-slot>

    </x-dialog-modal>
</form>
