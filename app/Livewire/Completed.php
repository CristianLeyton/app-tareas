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
use Livewire\WithPagination;

class Completed extends Component
{ use WithPagination;
    //En este archivo, esta todo lo necesario para crear una tarea nueva:
    public TaskCreateForm $taskCreate;

    //En este archivo, esta todo lo necesario para editar una tarea nueva:
    public TaskEditForm $taskEdit;
    public $openEdit = false;
    //En este archivo, esta todo lo necesario para ver los detalles de una tarea:
    public TaskDetailForm $taskDetail;
    public $openDetail = false;
    //Variables para eliminar una tarea
    public $destroyOpen = false; //Abre el modal de confirmacion
    public $taskIdDestroy; //Guarda la ID de la tarea a eliminar

    //Variables que contienen los datos de las tablas de la DB
    public $repeats, $tags;


    //Otras variables utiles
    //Aqui guardo el ID para filtrar por etiquetas
    public $tag = '';
    public $ordenar = '';
    public $destroyAllOpen = false;

    public $null = NULL;
    //Inicializa las variables que necesito
    public function mount()
    {
        $this->taskCreate->user_id = Auth::id(); //Cada tarea que cree este usuario se va a guardar con su ID
        $this->repeats = Repeat::all(); //Trae todos los datos de la tabla 
        $this->tags = Tag::where(function ($query) {
            $query->where('user_id', $this->taskCreate->user_id)
                ->orWhereNull('user_id');
        })->orderBy('name')->get();
    }

    //Guarda una tarea en la BD
    public function saveTask()
    {
        $this->taskCreate->save();
    }

    public function detailTask($taskId)
    {
        $this->taskDetail->detail($taskId);
    }

/*     public function editTask($taskId)
    {
        $this->resetValidation();
        $this->taskEdit->edit($taskId);
    } */

/*     public function updateTask()
    {
        $this->taskEdit->update();
    } */

    //Confirmar para eliminar una tarea de la BD
    public function confirmDestroy($taskId)
    {
        $this->destroyOpen = true;
        $this->taskIdDestroy = $taskId;
    }

    //Elimina una tarea de la BD
    public function destroyTask()
    {
        $taskId = $this->taskIdDestroy;
        $task = Task::find($taskId);
        $task->delete();
        $this->reset('taskIdDestroy', 'destroyOpen');
    }

    public function destroyAllTask()
    {
        Task::where('completed', true)->delete();
        $this->reset('destroyAllOpen');
    }

    //Cambia el estado de el atributo "completed" de la tarea
    public function completedTask($taskId)
    {
        $task = Task::find($taskId);
        $date =  Carbon::now();
        $completed = !$task->completed;
        $task->update([
            'completed' => $completed,
            'completed_at' => $date
        ]);
    }


    //Renderiza la vista
    public function render()
    {
        $allTasks = Task::where('user_id', $this->taskCreate->user_id)->where('completed', true)->paginate(10);

        //Ordena las tareas por fecha de creacion
        if ($this->ordenar == 'desc') {
            $tasks = Task::where('tasks.user_id', $this->taskCreate->user_id)
                ->where('tasks.completed', true)->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            //Solo trae las tareas con determinada etiqueta
            if ($this->tag) {
                $tasks = Task::where('tasks.user_id', $this->taskCreate->user_id)
                    ->where('tasks.completed', true)
                    ->whereHas('tags', function ($query) {
                        $query->where('tags.id', $this->tag);
                    })
                    ->paginate(10);
            } else {
                $tasks = $allTasks;
            }
        }

        return view('livewire.completed', compact('tasks'));
    }
}
