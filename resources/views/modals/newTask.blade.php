<form wire:submit="saveTask" class="">
    <x-dialog-modal wire:model="taskCreate.open">
        <x-slot name="title">
            <div class="flex justify-between">
            <p class="text-indigo-600 font-bold">Nueva tarea:</p>
                <div class="text-indigo-600" wire:loading wire:target="saveTask"> 
                    <p class="opacity-70 text-sm">Guardando... <i class='bx bx-loader-circle bx-spin' style="font-size: 18px"></i></i> </p>
                </div>
            </div>
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
                        <span class="flex justify-between">
                            Repetir: 
                            <i class='bx bx-info-circle text-indigo-600 mb-1 alerta' style="font-size: 20px"></i>                       
                            <p class="info">Si completa la tarea, esta volvera a la lista de "pendientes" una vez pasado el tiempo indicado. <br> Si no la completa, aparecerá como "vencida".</p>
                        </span>
                    </x-label>
                    <x-select class="w-full" wire:model="taskCreate.repeat_id">
                        @foreach ($repeats as $repeat)
                        <option value="{{$repeat->id}}">
                            {{ucfirst($repeat->name)}}
                        </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="taskCreate.repeat_id"/>
                </div>
    
                <div class="mb-4">
                    <x-label>
                        Etiquetas:
                    </x-label>
                    <div class="grid gap-2 grid-cols-3 sm:grid-cols-4">
                            @foreach ($tags as $tag)
                        <label wire.key="tag{{$tag->id}}"  class="flex gap-1 items-center border py-1 px-2 rounded" >
                            <x-checkbox wire:model="taskCreate.taskTags" value="{{$tag->id}}"/>
                            <div class="flex justify-between items-center w-full">
                            <span class="mr-2" style="color: {{$tag->color}}">{{Str::ucfirst($tag->name)}}</span>
                            <i class='bx bxs-bookmark-star' style="transform: scale(1.4); color: {{$tag->color}};"></i>
                            </div>
                        </label> 
                            @endforeach      
                    </div>      
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