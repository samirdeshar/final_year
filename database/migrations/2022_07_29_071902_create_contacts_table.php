<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->enum('enquiry_type',[0,1,2,3,4,5])->default(0);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address')->nullable();
            $table->string('email');
            $table->enum('is_read', ['yes', 'no'])->default('no');
            $table->string('contact');
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
