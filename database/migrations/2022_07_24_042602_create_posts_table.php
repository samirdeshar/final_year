<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('tag_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('cat_id')->nullable();
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->longText('summary')->nullable();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->string('image')->nullable();
            $table->longText('meta_titles')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_descriptions')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
