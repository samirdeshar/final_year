<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips','id')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('trip_type',[0,1]);
            $table->date('arrival');
            $table->date('departure');
            $table->bigInteger('num_of_pax');
            $table->bigInteger('adults');
            $table->bigInteger('childs')->default(0);
            $table->bigInteger('infants')->default(0);
            $table->enum('title',[0,1,2])->default(0);
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('contact_num');
            $table->string('email');
            $table->string('country');
            $table->string('city');
            $table->string('passport')->nullable();
            $table->longText('additional_info')->nullable();
            $table->longText('extra_faciulity')->nullable();
            $table->enum('know_from',[0,1,2,3,4])->default(4);
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
        Schema::dropIfExists('trip_books');
    }
}
