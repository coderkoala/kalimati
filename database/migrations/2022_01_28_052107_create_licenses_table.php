<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->index();
            $table->string('phone', 10)->index()->nullable();
            $table->string('email', 255)->index()->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->longText('license_key');
            $table->uuid('license_uuid')->unique();
            $table->json('license_data');
            $table->timestamps();
            $table->timestamp('valid_until')->nullable();
            $table->softDeletes();

            // Set up the foreign keys.
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
        try {
            // DB::unprepared('CREATE TRIGGER `tr_Generate_UUID` BEFORE INSERT ON `licenses` FOR EACH ROW SET NEW.license_uuid = UUID();');
        } catch (\Exception $e) {
            //
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licenses');
        try {
            // DB::unprepared('DROP TRIGGER `tr_Generate_UUID`');
        } catch (\Exception $e) {
            //
        }
    }
}
