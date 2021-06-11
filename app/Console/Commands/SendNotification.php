<?php

namespace App\Console\Commands;

use App\Events\NewNotificationEvent;
use App\Models\Task;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendNotification extends Command
{
    protected $user;
    protected $signature = 'send:notification';
    protected $description = 'Sending notification to user.';

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    public function handle()
    {
        $onlineUsers = $this->user->onlineUsers();

    }
}
