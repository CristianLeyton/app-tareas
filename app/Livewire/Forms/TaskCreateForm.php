<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskCreateForm extends Form
{
    public $open = false;
    public $user_id;
    public $repeat_id = 1;
    #[Rule('required|min:3',as: 'nombre')]
    public $taskName; 
    #[Rule('max:500',as: 'detalles')]
    public $taskContent; 
    public $taskCompleted_at;
    public $taskTags = [];
    public $completed;

    public function save() {
        $this->validate();//Ejecuto las validaciones
        $post = Task::create([ //Creo la tarea
            'user_id' => $this->user_id,
            'repeat_id' => $this->repeat_id,
            'name' => $this->taskName,  // Asumo que $taskName es la variable correcta aquí
            'content' => $this->taskContent,
        ]);
        $post->tags()->attach($this->taskTags);//Enlazo las etiquetas
        // Resetea las propiedades indicadas
        $this->reset(['repeat_id', 'taskName', 'taskContent', 'taskTags','open']);
    }
}
