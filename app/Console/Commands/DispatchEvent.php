<?php

namespace App\Console\Commands;

use App\Events\RedirectUrl;
use Illuminate\Console\Command;

class DispatchEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dispatch-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        RedirectUrl::dispatch();
    }
}
