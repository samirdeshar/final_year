<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingExtraColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('email2')->nullable();
            $table->longText('address2')->nullable();
            $table->string('contact4')->nullable();
            $table->string('contact5')->nullable();
            $table->string('contact6')->nullable();
            $table->text('logo3')->nullable();
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
            $table->dropColumn('email2');
            $table->dropColumn('address2');
            $table->dropColumn('logo3');
            $table->dropColumn('contact4');
            $table->dropColumn('contact5');
            $table->dropColumn('contact6');
        });
    }
}
