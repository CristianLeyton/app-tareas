<x-dialog-modal  wire:model="taskDetail.open">
    <x-slot name="title">
        
        <span class="">
            <p class="text-indigo-600 font-bold">Resumen de la tarea:</p>
        </span>
    </x-slot>  
    <x-slot name="content">
        <div class="border p-4 rounded bg-slate-100 text-gray-700">
        <p class= "text-end">Fecha de creación: <span class="">{{$taskDetail->taskCreated_at}}</span></p>

        <div class="mb-3">
                <span class="text-indigo-500">Nombre:</span> {{$taskDetail->taskName}}
        </div>

        <div class="mb-3 h-auto">
            <span class="text-indigo-500">Detalles:</span> {{$taskDetail->taskContent}}
        </div>


        @if ($taskDetail->taskTags)
        <div class="mb-3">
            <span class="text-indigo-500">Etiquetas:</span>

                    @foreach ($task->tags as $tag)
                        @foreach ($taskDetail->taskTags as $taskTag)
                        <?php
                        if($tag['id'] == $taskTag){
                            echo '<span class="" style="color:#'.$tag->color.'"><i class="bx bxs-bookmark-star" style="transform: scale(1.1)"></i>'.ucfirst($tag->name).'</span>';
                        }
                        ?>  
                        @endforeach
                    @endforeach

        </div>

        @else

        <p class="mb-3" >La tarea <span class='font-bold'>no tiene etiquetas asociadas.</span></p>

        @endif
        

        <div class="mb-3">
            @if ($taskDetail->repeat_id != 1)
                La tarea se repite 
                <?php foreach ($repeats as $repeat)
                if($taskDetail->repeat_id == $repeat->id){
                    echo "<span class='font-bold'>".$repeat->name."</span>";
                }
                ?>.
            @else
                <p>La tarea <span class='font-bold'> no se repite. </span></p>
            @endif
        </div>
    </div>
    </x-slot>  
       
    <x-slot name="footer">
        <div class="flex gap-3">
        <x-secondary-button wire:click="$set('taskDetail.open',false)">Cerrar</x-secondary-button>
        </div>
    </x-slot>
</x-dialog-modal>