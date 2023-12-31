<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainYourSelvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_your_selves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('train_description')->nullable();
            $table->string('train_banner_image')->nullable();
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
        Schema::dropIfExists('train_your_selves');
    }
}
