<form wire:submit="saveTag">
    <x-dialog-modal wire:model="tagCreate.open">
        <x-slot name="title">
            <p class="text-indigo-600 font-bold">Nueva etiqueta:</p>
        </x-slot>  
        <x-slot name="content">

                <div class="mb-4">
                    <x-label for="">
                        Nombre:
                    </x-label>
                    <x-input placeholder="Ingrese el nombre de la etiqueta" class="w-full" wire:model.live="tagCreate.tagName"/>
                    <x-input-error for="tagCreate.tagName"/>
                </div>
    
                <div class="mb-4 flex items-center gap-3">
                    <x-label for="">
                        Color:
                    </x-label>
                    <input value="" type="color" class="p-1 border border-slite-600" wire:model.live="tagCreate.tagColor" style="width:35px; height: 35px;"></input>
                    <x-input-error for="tagCreate.tagColor"/>
                </div>
    
        </x-slot> 
        <x-slot name="footer">
            <div class="flex justify-end gap-2">
                <x-secondary-button wire:click="$set('tagCreate.open',false)">
                    Cancelar
                </x-secondary-button>
                <x-primary-button>
                    Guardar
                </x-primary-button>
            </div>
        </x-slot>          
    </x-dialog-modal>
</form>