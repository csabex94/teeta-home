<?php

namespace App\Console\Commands;

use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Console\Command;

class SendEmails extends Command {

    protected $event;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendEmails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily emails with all the future events notice.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EventRepositoryInterface $event) {
        parent::__construct();
        $this->event = $event;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        
    }

}