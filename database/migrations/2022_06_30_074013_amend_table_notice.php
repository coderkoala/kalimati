<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AmendTableNotice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->enum('modal_view', ['true', 'false'])->default('false');
            $table->date('published_at')->nullable();
            $table->dropColumn('valid_upto');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert the changes above
        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn('modal_view');
            $table->dropColumn('published_at');
            $table->date('valid_upto')->nullable();
        });
    }
}
