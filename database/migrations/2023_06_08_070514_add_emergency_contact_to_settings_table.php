<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmergencyContactToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('emergency_name_1')->nullable();
            $table->string('emergency_name_2')->nullable();
            $table->string('emergency_contact_1')->nullable();
            $table->string('emergency_contact_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('emergency_name_1');
            $table->dropColumn('emergency_name_2');
            $table->dropColumn('emergency_contact_1');
            $table->dropColumn('emergency_contact_2');
        });
    }
}
