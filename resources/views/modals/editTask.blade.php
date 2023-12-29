<form wire:submit="" >
    <x-dialog-modal wire:model="editOpen">
        <x-slot name="title">
            Editar tarea:
        </x-slot>  
        <x-slot name="content">
                <div class="mb-4">
                    <x-label for="">
                        Nombre:
                    </x-label>
                    <x-input placeholder="Nombre de la tarea" class="w-full" wire:model.live=""/>
                    <x-input-error for=""/>
                </div>
    
                <div class="mb-4">
                    <x-label for="">
                        Detalles:
                    </x-label>
                    <x-textarea placeholder="Detalles de la tarea" class="w-full" wire:model.live=""></x-textarea>
                    <x-input-error for=""/>
                </div>
    
                <div class="mb-4">
                    <x-label>
                        Repetir cada:
                    </x-label>
                    <x-select class="w-full" wire:model.live="">
                        <option value="" disabled>
                            No repetir
                        </option>
                
                    </x-select>
                    <x-input-error for=""/>
                </div>
    
                <div class="mb-4">
                    <x-label>
                        Etiquetas:
                    </x-label>
                    <ul class="w-full flex justify-between">
                        
                        <li>
                            <label>
                            <x-checkbox wire:model.live="" value=""/>
                                tag->name
                            </label>
                        </li>
                        
                    </ul>
                    <x-input-error for=""/>
                </div>
        </x-slot> 
        <x-slot name="footer">
            <div class="flex justify-end gap-2">
                <x-secondary-button wire:click="$set('editOpen',false)">
                    Cancelar
                </x-secondary-button>
                <x-primary-button>
                    Actualizar
                </x-primary-button>
            </div>
        </x-slot>          
    </x-dialog-modal>
</form>