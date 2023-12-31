<form wire:submit="saveTask">
    <x-dialog-modal wire:model="taskCreate.open">
        <x-slot name="title">
            <p class="text-indigo-600 font-bold">Nueva tarea:</p>
        </x-slot>  
        <x-slot name="content">

            

                <div class="mb-4">
                    <x-label for="">
                        Nombre:
                    </x-label>
                    <x-input placeholder="Ingrese el nombre de la tarea" class="w-full" wire:model.live="taskCreate.taskName"/>
                    <x-input-error for="taskCreate.taskName"/>
                </div>
    
                <div class="mb-4">
                    <x-label for="">
                        Detalles:
                    </x-label>
                    <x-textarea placeholder="De ser necesario, puede agregar detalles..." class="w-full" wire:model.live="taskCreate.taskContent"></x-textarea>
                    <x-input-error for="taskCreate.taskContent"/>
                </div>
    
                <div class="mb-4">
                    <x-label>
                        Repetir:
                    </x-label>
                    <x-select class="w-full" wire:model="taskCreate.repeat_id">
                        @foreach ($repeats as $repeat)
                        <option value="{{$repeat->id}}">
                            {{ucfirst($repeat->name)}}
                        </option>
                        @endforeach
                    </x-select>
                    <x-input-error for=""/>
                </div>
    
                <div class="mb-4">
                    <x-label>
                        Etiquetas:
                    </x-label>
                    <ul class="w-full flex justify-between">
                        
                        <li>
                            @foreach ($tags as $tag)
                            <label class="">
                            <x-checkbox wire:model="taskCreate.taskTags" value="{{$tag->id}}"/>
                            <span class="mr-2" style="color: {{$tag->color}}">{{Str::ucfirst($tag->name)}}<i class='bx bxs-bookmark-star' style="transform: scale(1.1)"></i></span>
                            </label> 
                            @endforeach
                        </li>
                        
                    </ul>
                    <x-input-error for=""/>
                </div>
        </x-slot> 
        <x-slot name="footer">
            <div class="flex justify-end gap-2">
                <x-secondary-button wire:click="$set('taskCreate.open',false)">
                    Cancelar
                </x-secondary-button>
                <x-primary-button>
                    Guardar
                </x-primary-button>
            </div>
        </x-slot>          
    </x-dialog-modal>
</form>