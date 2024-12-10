<x-dialog-modal wire:model="openDetail">
    <x-slot name="title">

        <span class="">
            <p class="text-indigo-600 font-bold">Resumen de la tarea:</p>
        </span>
    </x-slot>
    <x-slot name="content">
        <div class="text-indigo-600 w-full block text-center" wire:loading wire:target="detailTask"> 
            <i class='bx bx-loader-circle bx-spin' style="font-size: 48px"></i></i>
        </div>
        <span class="" wire:loading.class="hidden" wire:target="detailTask">
            <div class="border p-4 rounded bg-slate-100 text-gray-700">
                <div class="flex justify-between mb-3 ">
                    @if ($taskDetail->taskCompleted_at)
                        <p class= "text-indigo-600 flex items-center">
                            <i class='bx bxs-check-square mr-1' style="font-size: 24px"></i>
                            <span class="font-bold mr-1">Completada:</span> <span
                                class="">{{ $taskDetail->taskCompleted_at }}
                            
                            </span></p>
                    @endif
                    <p class= ""><span class="font-bold">Creada:</span> <span
                            class="">{{ $taskDetail->taskCreated_at }}</span></p>
                </div>
            
                <DIV class="bg-white py-1 px-4 rounded border">
                    <div class="my-3">
                        <span class="text-indigo-500">Nombre:</span> {{ $taskDetail->taskName }}
                    </div>
                    <div class="mb-3 h-auto">
                        <span class="text-indigo-500">Detalles:</span> {{ $taskDetail->taskContent }}
                    </div>


                    @if ($taskDetail->taskTags)
                        <div class="mb-3">
                            <span class="text-indigo-500">Etiquetas:</span>
                            @foreach ($taskDetail->allTags as $tag)
                             @foreach ($taskDetail->taskTags as $taskTag)
                                @if ($tag['id'] == $taskTag)
                                    <span style="color: {{ $tag->color }}">
                                        <i class="bx bxs-bookmark-star" style="transform: scale(1.1)"></i>
                                        {{ ucfirst($tag->name) }}
                                    </span>
                                @endif
                            @endforeach 
                        @endforeach
                        </div>
                    @else
                        <p class="mb-3">La tarea <span class='font-bold'>no tiene etiquetas asociadas.</span></p>
                    @endif
                    <div class="mb-3">
                        @if ($taskDetail->repeat_id != 1)
                            La tarea se repite
                            <?php foreach ($repeats as $repeat) {
                                if ($taskDetail->repeat_id == $repeat->id) {
                                    echo "<span class='font-bold'>" . $repeat->name . '</span>';
                                }
                            }
                            ?>.
                        @else
                            <p>La tarea <span class='font-bold'> no se repite. </span></p>
                        @endif
                    </div>
                </DIV>
            </div>
        </span>
        
    </x-slot>

    <x-slot name="footer">
        <div class="flex gap-3">
            <x-secondary-button wire:click="$set('openDetail',false)">Cerrar</x-secondary-button>
        </div>
    </x-slot>
</x-dialog-modal>


