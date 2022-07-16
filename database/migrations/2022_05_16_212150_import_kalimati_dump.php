<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImportKalimatiDump extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('articles');
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->uuid('article_uuid')->unique();
            $table->string('slug', 255)->unique();
            $table->string('title_en', 255)->index();
            $table->string('title_np', 255)->index();
            $table->longText('content_en');
            $table->longText('content_excerpt_en');
            $table->longText('content_np');
            $table->longText('content_excerpt_np');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->enum('comment_status', ['open', 'closed'])->default('open');
            $table->text('article_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Set up the foreign keys.
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
        DB::unprepared(file_get_contents(database_path('/migrations/dumps/kmdb_dump.sql')));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop tables.
        Schema::dropIfExists('articles');
        Schema::dropIfExists('commodities');
        Schema::dropIfExists('daily_price_log');
        Schema::dropIfExists('traders_due');
    }
}
