<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('fb_link2')->nullable();
            $table->string('twitter_link2')->nullable();
            $table->string('linkedin_link2')->nullable();
            $table->string('insta_link2')->nullable();
            $table->string('youtube_link2')->nullable();
            $table->string('pinterest_link2')->nullable();
            $table->string('google_plus2')->nullable();
            $table->string('address_intl')->nullable();
            $table->longText('location_url_intl')->nullable();
            $table->string('email_intl')->nullable();
            $table->string('phone_intl')->nullable();
            $table->string('contact_intl')->nullable();
            $table->string('contact_inquiry_heading1')->nullable();
            $table->string('contact_inquiry_heading2')->nullable();
            $table->string('contact_inquiry_heading3')->nullable();
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
            $table->dropColumn('fb_link2');
            $table->dropColumn('twitter_link2');
            $table->dropColumn('linkedin_link2');
            $table->dropColumn('insta_link2');
            $table->dropColumn('youtube_link2');
            $table->dropColumn('pinterest_link2');
            $table->dropColumn('google_plus2');
            $table->dropColumn('address_intl');
            $table->dropColumn('location_url_intl');
            $table->dropColumn('email_intl');
            $table->dropColumn('phone_intl');
            $table->dropColumn('contact_intl');
            $table->dropColumn('contact_inquiry_heading1');
            $table->dropColumn('contact_inquiry_heading2');
            $table->dropColumn('contact_inquiry_heading3');
        });
    }
}
