<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('sightseeing_places')->nullable();
            $table->longText('best_time')->nullable();
            $table->longText('trip_info')->nullable();
            $table->longText('imp_note')->nullable();
            $table->longText('travel_date')->nullable();
            $table->longText('min_travel')->nullable();
            $table->longText('trip_safety')->nullable();
            $table->longText('useful_tip')->nullable();
            $table->longText('hike_trip')->nullable();
            $table->longText('optional_tour')->nullable();
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
        Schema::dropIfExists('trip_data');
    }
}
