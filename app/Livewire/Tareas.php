<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskCreateForm;
use App\Livewire\Forms\TaskDetailForm;
use App\Livewire\Forms\TaskEditForm;
use App\Models\Repeat;
use App\Models\Tag;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tareas extends Component
{

    //En este archivo, esta todo lo necesario para crear una tarea nueva:
    public TaskCreateForm $taskCreate;

    //En este archivo, esta todo lo necesario para editar una tarea nueva:
    public TaskEditForm $taskEdit;

    //En este archivo, esta todo lo necesario para ver los detalles de una tarea:
    public TaskDetailForm $taskDetail;

    //Variables para eliminar una tarea
    public $destroyOpen = false;//Abre el modal de confirmacion
    public $taskIdDestroy; //Guarda la ID de la tarea a eliminar

    //Variables que contienen los datos de las tablas de la DB
    public $repeats, $tags, $tasks;

    public $null = NULL;
    //Inicializa las variables que necesito
    public function mount(){
        $this->taskCreate->user_id = Auth::id();//Cada tarea que cree este usuario se va a guardar con su ID
        $this->repeats = Repeat::all();//Trae todos los datos de la tabla 
        $this->tags = Tag::all();
        $this->tasks = Task::where('user_id', $this->taskCreate->user_id)->where('completed', false)->get();
    }
    
    //Para no repetir muchas veces esta linea, cree esta funcion que solo actualiza la variable que consulta las tareas del usuario
    public function reloadTasks() {
        $this->tasks = Task::where('user_id', $this->taskCreate->user_id)->where('completed', false)->get();
    }    

    //Guarda una tarea en la BD
    public function saveTask() {
        $this->taskCreate->save();
        $this->reloadTasks();
    }

    public function detailTask($taskId) {
        $this->taskDetail->open = true;
        $this->taskDetail->detail($taskId);
    }

    public function editTask($taskId) {
        $this->resetValidation();
        $this->taskEdit->edit($taskId);
    }

    public function updateTask() {
        $this->taskEdit->update();
        $this->reloadTasks();
    }

    //Confirmar para eliminar una tarea de la BD
    public function confirmDestroy($taskId) {
        $this->destroyOpen = true;
        $this->taskIdDestroy = $taskId;
    }

    //Elimina una tarea de la BD
    public function destroyTask() {
        $taskId = $this->taskIdDestroy;
        $task = Task::find($taskId);
        $task->delete();
        $this->reloadTasks();
        $this->reset('taskIdDestroy','destroyOpen');
    }

    //Cambia el estado de el atributo "completed" de la tarea
    public function completedTask($taskId) {
        $task = Task::find($taskId);
        $date =  Carbon::now();
        $completed = !$task->completed;
        $task->update([
            'completed' => $completed,
            'completed_at' => $date
        ]);
        $this->reloadTasks();
    }

    //Renderiza la vista
    public function render(){
        return view('livewire.tareas');
    }
}
