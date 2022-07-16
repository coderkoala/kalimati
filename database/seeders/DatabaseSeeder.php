<?php

namespace Database\Seeders;

use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'activity_log',
            'failed_jobs',
        ]);

        $this->call(AuthSeeder::class);
        $this->call(AnnouncementSeeder::class);

        Model::reguard();

        // Check if env is set to production.
        if (env('APP_ENV') === 'production') {
            \DB::unprepared(file_get_contents(database_path('/migrations/dumps/kmdb_stored_procedures.sql')));
        }

        \DB::unprepared(file_get_contents(database_path('/migrations/dumps/kmdb_prices_database.sql')));
    }
}
