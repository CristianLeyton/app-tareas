<form wire:submit="updateTask">
    <x-dialog-modal wire:model="taskEdit.open">
        <x-slot name="title">
            <p class="text-indigo-600 font-bold"> Editar tarea:</p>
        </x-slot>  
        <x-slot name="content">
                <div class="mb-4">
                    <x-label for="">
                        Nombre:
                    </x-label>
                    <x-input placeholder="{{$taskEdit->taskName}}" class="w-full" wire:model.live="taskEdit.taskName"/>
                    <x-input-error for="taskEdit.taskName"/>
                </div>
    
                <div class="mb-4">
                    <x-label for="">
                        Detalles:
                    </x-label>
                    <x-textarea placeholder="{{$taskEdit->taskContent}}" class="w-full" wire:model.live="taskEdit.taskContent"></x-textarea>
                    <x-input-error for="taskEdit.taskContent"/>
                </div>
    
                <div class="mb-4">
                    <x-label>
                        Repetir:
                    </x-label>
                    <x-select class="w-full" wire:model="taskEdit.repeat_id">
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
                            <x-checkbox wire:model="taskEdit.taskTags" value="{{$tag->id}}"/>
                                <span class="mr-2" style="color: #{{$tag->color}}">{{Str::ucfirst($tag->name)}}<i class='bx bxs-bookmark-star' style="transform: scale(1.1)"></i></span>
                            </label> 
                            @endforeach
                        </li>
                        
                    </ul>
                    <x-input-error for=""/>
                </div>
        </x-slot> 
        <x-slot name="footer">
            <div class="flex justify-end gap-2">
                <x-secondary-button wire:click="$set('taskEdit.open',false)">
                    Cancelar
                </x-secondary-button>
                <x-primary-button>
                    Actualizar
                </x-primary-button>
            </div>
        </x-slot>          
    </x-dialog-modal>
</form>