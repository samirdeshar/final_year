<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_pages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title')->unique();
            $table->string('slug');
            $table->text('icon');
            $table->longText('description')->nullable();
            $table->enum('show_in', ['header', 'footer','both'])->nullable();
            $table->longText('summary')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_pages');
    }
}
