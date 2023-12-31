<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('cat_id')->nullable();
            $table->integer('sub_cat_id')->nullable();
            $table->integer('contact_no')->nullable();
            $table->string('status')->default('inactive')->comment('inactive|active');
            $table->string('image')->nullable();
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->string('designation')->nullable();
            $table->string('email')->nullable();
            $table->longText('fb_link')->nullable();
            $table->longText('twitter_link')->nullable();
            $table->longText('instagram_link')->nullable();
            $table->integer('in_order')->nullable();
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
        Schema::dropIfExists('awards');
    }
}
