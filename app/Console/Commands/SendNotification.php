<?php

namespace App\Console\Commands;

use App\Events\NewNotificationEvent;
use Illuminate\Console\Command;

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
       event(new NewNotificationEvent("testing from backend"));
    }
}
