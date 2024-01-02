<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskDetailForm extends Form
{
    public $task;
    public $repeat_id;
    public $taskName; 
    public $taskContent; 
    public $taskTags = [];
    public $taskCreated_at; 
    public $taskCompleted_at; 

    public function detail($taskId) {
        $task = Task::find($taskId);
        $this->taskName = $task->name;
        $this->taskContent = $task->content;
        $this->repeat_id = $task->repeat_id;
        $this->taskTags = $task->tags->pluck('id')->toArray();
        $this->taskCreated_at = $task->created_at->format('d-m-Y');

        if ($task->completed_at) {
            $this->taskCompleted_at = Carbon::parse($task->completed_at)->format('d-m-Y');
        } else {
            $this->taskCompleted_at = NULL;
        }
        
    }
}

