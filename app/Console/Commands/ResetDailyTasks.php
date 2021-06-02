<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class ResetDailyTasks extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset daily tasks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $tasks = Task::where('daily', 1)->get();
        
        foreach($tasks as $task) {
            $task->completed = 0;
            $task->save();
        }
    }
}
