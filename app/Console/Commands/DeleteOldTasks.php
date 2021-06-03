<?php

namespace App\Console\Commands;

use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Console\Command;

class DeleteOldTasks extends Command {

    protected $task;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete-old-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes tasks that are not daily, and older than 2-3 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TaskRepositoryInterface $task) {
        parent::__construct();
        $this->task = $task;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $this->task->deletePreviousTasks(false);
    }
}
