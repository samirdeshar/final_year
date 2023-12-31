<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booker_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bookings_id')->constrained('bookings','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('member_name')->nullable();
            $table->longText('member_email')->nullable();
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
        Schema::dropIfExists('booker_details');
    }
}
