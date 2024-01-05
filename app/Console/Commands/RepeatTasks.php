<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RepeatTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repeat-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comprueba si es necesario quitar el "completed" de la tarea.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $completedTasks = Task::where('completed', true)->get();  
        $incompletedTasks = Task::where('completed', false)->get();

        foreach ($completedTasks as $task) {
            $diff = date_diff($task->created_at, $today)->format('%a');
            if ($task->repeats->days != 0 && $diff >= $task->repeats->days ) {
                $task->update([ //Quito la marca de tarea completada
                    'completed' => false,
                    'completed_at' => NULL,
                    'expired' => false
                ]);
            }
        }

        foreach ($incompletedTasks as $task) {
            $diff = date_diff($task->created_at, $today)->format('%a');
            if ($task->repeats->days != 0 && $diff >= $task->repeats->days ) {
                $task->update([ //Quito la marca de tarea completada
                    'expired' => true
                ]);
            }
        }
    }  
}
