<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class clearDues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dues:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears all Trader Dues from the Database.';

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
     * @return int
     */
    public function handle()
    {
        \DB::table('traders_due')->truncate();
        $this->info('[Success] Cleared all trader dues from the database!');

        return 0;
    }
}
