<?php

namespace App\Console\Commands;

use App\Events\NewNotificationEvent;
use App\Models\Task;
use App\Repositories\Task\TaskRepositoryInterface;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendNotification extends Command
{

    protected $signature = 'send:notification';
    protected $description = 'Sending notification to user.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $allTasks = Task::where('completed', 0)->get();
        foreach ($allTasks as $task) {
            if (Carbon::today()->eq($task->spec_date)) {
                if (date('H:i', strtotime(Carbon::now())) === date('H:i', strtotime(new Carbon($task->spec_time)))) {
                    Log::info("It's the time!!!!");
                    event(new NewNotificationEvent($task));
                } else {
                    Log::info("It's not the time!!!!");
                }
            } else {
                Log::info('Task with id:'.$task->id." is a daily task.");
            }
        }
//       event(new NewNotificationEvent("testing from backend"));
    }
}
