<x-dialog-modal  wire:model="detailOpen">
    <x-slot name="title">
        <span class="flex justify-between">
            <p>Detalles de la tarea:</p>
            <p>Fecha de creación:</p>
        </span>
    </x-slot>  
    <x-slot name="content">
        <div class="mb-4">
            <x-label for="">
                Nombre:
            </x-label>
            <x-input disabled placeholder="Nombre de la tarea" class="w-full" wire:model.live=""/>
            <x-input-error for=""/>
        </div>

        <div class="mb-4">
            <x-label for="">
                Detalles:
            </x-label>
            <x-textarea disabled placeholder="Detalles de la tarea" class="w-full" wire:model.live=""></x-textarea>
            <x-input-error for=""/>
        </div>

        <div class="mb-4">
            <x-label>
                Repetir cada:
            </x-label>
            <x-select  class="w-full" wire:model.live="">
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
        <div class="flex gap-3">
        <x-secondary-button wire:click="$set('detailOpen',false)">Cerrar</x-secondary-button>
        </div>
    </x-slot>
</x-dialog-modal>