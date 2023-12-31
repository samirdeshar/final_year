<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldTripColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->text('trip_style')->nullable();
            $table->text('trip_duration1')->nullable();
            $table->text('accomodation')->nullable();
            $table->text('trip_outline')->nullable();
            $table->text('package')->nullable();
            $table->text('note')->nullable();
            $table->text('destination')->nullable();
            $table->text('hotel_category')->nullable();
            $table->text('max_altitude')->nullable();
            $table->text('min_pax')->nullable();
            $table->text('travel_mode')->nullable();
            $table->text('trek_type')->nullable();
            $table->text('meals')->nullable();
            $table->text('total_trip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
           $table->dropColumn('trip_style');
           $table->dropColumn('trip_duration1');
           $table->dropColumn('accomodation');
           $table->dropColumn('trip_outline');
           $table->dropColumn('package');
           $table->dropColumn('note');
           $table->dropColumn('destination');
           $table->dropColumn('hotel_category');
           $table->dropColumn('max_altitude');
           $table->dropColumn('min_pax');
           $table->dropColumn('travel_mode');
           $table->dropColumn('trek_type');
           $table->dropColumn('meals');
           $table->dropColumn('total_trip');
        });
    }
}
