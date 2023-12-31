<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_num');
            $table->longText('street_address')->nullable();
            $table->string('country');
            $table->string('city')->nullable();
            $table->integer('no_adults');
            $table->integer('no_children')->nullable();
            $table->string('passport')->nullable();
            $table->string('find_mega')->nullable();
            $table->enum('travelled',['yes','no'])->default('no');
            $table->enum('insuranced',['yes','no'])->default('no');
            $table->enum('terms_of_use',['yes','no'])->default('no');
            $table->longText('comments')->nullable();
            $table->enum('subscribe',['yes','no'])->default('no');
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
        Schema::dropIfExists('bookings');
    }
}
