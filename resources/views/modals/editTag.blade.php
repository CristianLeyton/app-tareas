<form wire:submit="updateTag">
    <x-dialog-modal wire:model="tagEdit.open">
        <x-slot name="title">
            <p class="text-indigo-600 font-bold">Editar etiqueta:</p>
        </x-slot>  
        <x-slot name="content">

                <div class="mb-4">
                    <x-label for="">
                        Nombre:
                    </x-label>
                    <x-input placeholder="Ingrese el nombre de la etiqueta" class="w-full" wire:model.live="tagEdit.tagName"/>
                    <x-input-error for="tagEdit.tagName"/>
                </div>
    
                <div class="mb-4 flex items-center gap-3">
                    <x-label for="">
                        Color:
                    </x-label>
                    <x-input type="text" value="" wire:model.live="tagEdit.tagColor"></x-input>
                    <input value="" type="color" class="p-1 border border-slite-600" wire:model.live="tagEdit.tagColor" style="width:40px; height: 40px;"></input>
                    <x-input-error for="tagEdit.tagColor"/>
                </div>
    
        </x-slot> 
        <x-slot name="footer">
            <div class="flex justify-end gap-2">
                <x-secondary-button wire:click="$set('tagEdit.open',false)">
                    Cancelar
                </x-secondary-button>
                <x-primary-button>
                    Guardar
                </x-primary-button>
            </div>
        </x-slot>          
    </x-dialog-modal>
</form>