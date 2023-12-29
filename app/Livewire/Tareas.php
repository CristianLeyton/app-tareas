<?php

namespace App\Livewire;

use App\Models\Repeat;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tareas extends Component
{
    //Variables para cerrar y abrir los cuatro modales
    public $open = false;
    public $editOpen = false;
    public $destroyOpen = false;
    public $detailOpen = false;

    //Variables que contienen los datos de las tablas de la DB
    public $repeats, $tags, $tasks;

    //Variables para Crear una nueva tarea
    public $user_id;
    public $repeat_id= null;
    public $taskName; 
    public $taskContent; 
    public $taskCompleted_at;
    public $taskTags = [];
    public $completed;

    //Inicializa las variables que necesito
    public function mount(){
        $this->repeats = Repeat::all();//Trae todos los datos de la tabla 
        $this->tags = Tag::all();
        $this->tasks = Task::all();
        $this->user_id = Auth::id();
    }

    public function saveTask() {
        //$this->validate();//Ejecuto las validaciones
        $post = Task::create([ //Creo la tarea
            'user_id' => $this->user_id,
            'repeat_id' => $this->repeat_id,
            'name' => $this->taskName,  // Asumo que $taskName es la variable correcta aquí
            'content' => $this->taskContent,
        ]);
        $post->tags()->attach($this->taskTags);//Enlazo las etiquetas
        // Resetea las propiedades indicadas
        $this->reset(['repeat_id', 'taskName', 'taskContent', 'taskTags','open']);
        $this->tasks = Task::all();
    }


    public function render()
    {
        return view('livewire.tareas');
    }
}
