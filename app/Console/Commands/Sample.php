<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Sample extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sample';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sample command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Sample Command Execute!!");
    }
}
