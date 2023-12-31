<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('icon')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo2')->nullable();
            $table->string('site_name')->nullable();
            $table->text('sitename2')->nullable();
            $table->string('quatation')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('pinterest_link')->nullable();
            $table->string('google_plus')->nullable();
            $table->string('address')->nullable();
            $table->longText('location_url')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact')->nullable();
            $table->string('contact_second')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();


            $table->longText('trip_title')->nullable();
            $table->longText('trip_sub_title')->nullable();
            $table->longText('trip_background_text')->nullable();
            $table->string('trip_banner_image')->nullable();

            $table->string('certificate_image')->nullable();
            $table->string('payment_image')->nullable();


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

            $table->longText('copyright')->nullable();

            $table->text('email2')->nullable();
            $table->longText('address2')->nullable();
            $table->string('contact4')->nullable();
            $table->string('contact5')->nullable();
            $table->string('contact6')->nullable();
            $table->text('logo3')->nullable();

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
        Schema::dropIfExists('settings');
    }
}
