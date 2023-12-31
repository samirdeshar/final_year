<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogleAnalyticsSeoToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('fb_page_id')->nullable();
            $table->string('fb_pages_id')->nullable();
            $table->string('fb_app_id')->nullable();
            $table->string('google_analytics_code')->nullable();
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
            $table->dropColumn('fb_page_id');
            $table->dropColumn('fb_pages_id');
            $table->dropColumn('fb_app_id');
            $table->dropColumn('google_analytics_code');
        });
    }
}
