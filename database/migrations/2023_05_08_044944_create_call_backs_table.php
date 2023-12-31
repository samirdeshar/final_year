<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_backs', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('destination');
            $table->enum('trip_type',[0,1])->default(0);
            $table->date('trip_start');
            $table->date('trip_end');
            $table->bigInteger('price_range');
            $table->integer('adults')->default(1);
            $table->integer('childs')->default(0);
            $table->integer('infants')->default(0);
            $table->text('full_name');
            $table->text('contact_num');
            $table->string('email');
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
        Schema::dropIfExists('call_backs');
    }
}
