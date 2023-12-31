<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingExtraFieldColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('adventure1_title')->nullable();
            $table->string('outbound_sub_title')->nullable();
            $table->string('adventure1_sub_title')->nullable();
            $table->string('adventure1_background_text')->nullable();
            $table->string('outbound_title')->nullable();
            $table->string('outbound_image')->nullable();
            $table->text('adventure1_image')->nullable();
            $table->text('outbound_background_text')->nullable();
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
            $table->dropColumn('adventure1_title');
            $table->dropColumn('outbound_sub_title');
            $table->dropColumn('adventure1_sub_title');
            $table->dropColumn('adventure1_background_text');
            $table->dropColumn('outbound_title');
            $table->dropColumn('outbound_image');
            $table->dropColumn('adventure1_image');
            $table->dropColumn('outbound_background_text');
        });
    }
}
