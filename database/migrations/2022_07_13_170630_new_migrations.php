<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class NewMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared(file_get_contents(database_path('/migrations/dumps/kmdb_migrations_7_13.sql')));
        \DB::unprepared(file_get_contents(database_path('/migrations/dumps/kmdb_migrations_7_14.sql')));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arrival_commodities');
        Schema::dropIfExists('daily_arrival_log');
    }
}
