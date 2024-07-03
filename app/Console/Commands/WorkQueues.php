<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WorkQueues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:work-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The Work has been started';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call("queue:work", [
            '--stop-when-empty' => true,
        ]);
    }
}
