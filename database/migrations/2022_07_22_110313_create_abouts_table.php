<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('slogan');
            $table->string('background_text');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->longText('description')->nullable();
            $table->string('team_title')->nullable();
            $table->string('team_backgroundtext')->nullable();
            $table->longText('team_description')->nullable();
            $table->longText('team_features')->nullable();
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
        Schema::dropIfExists('abouts');
    }
}
