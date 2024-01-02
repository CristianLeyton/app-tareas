<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskEditForm extends Form
{
    public $task, $taskEditId;
    public $repeat_id;
    #[Rule('required|min:3',as: 'nombre')]
    public $taskName; 
    #[Rule('max:500',as: 'detalles')]
    public $taskContent; 
    public $taskTags = [];


    public function edit($taskId) {
        $this->taskEditId = $taskId;
        $task = Task::find($taskId);
        $this->taskName = $task->name;
        $this->taskContent = $task->content;
        $this->repeat_id = $task->repeat_id;
        $this->taskTags = $task->tags->pluck('id')->toArray();
    }

    public function update() {
        $this->validate();
        $task = Task::find($this->taskEditId);
        $task->update([
            'name' => $this->taskName,
            'content' => $this->taskContent,
            'repeat_id' => $this->repeat_id
        ]);
        $task->tags()->sync($this->taskTags); //Sincroniza las etiquetas
        $this->reset(); //Resetea todas las variables de esta clase
    }
}
