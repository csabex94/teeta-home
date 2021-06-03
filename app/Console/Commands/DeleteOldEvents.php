<?php

namespace App\Console\Commands;

use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Console\Command;

class DeleteOldEvents extends Command {

    protected $event;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete-old-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes events that are not daily, and older than 2-3 days';

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
        $this->event->deletePreviousEvents(false);
    }
}
