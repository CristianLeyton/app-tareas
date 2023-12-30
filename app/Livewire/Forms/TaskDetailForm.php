<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskDetailForm extends Form
{
    public $open = false;
    public $task;
    public $repeat_id;
    public $taskName; 
    public $taskContent; 
    public $taskTags = [];
    public $taskCreated_at; 

    public function detail($taskId) {
        $this->open = true;
        $task = Task::find($taskId);
        $this->taskName = $task->name;
        $this->taskContent = $task->content;
        $this->repeat_id = $task->repeat_id;
        $this->taskTags = $task->tags->pluck('id')->toArray();
        $this->taskCreated_at = $task->created_at->format('d-m-Y');
    }
}

