<?php

namespace Database\Seeders;

use App\Models\Admin\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            'user_id'=>'1',
            'icon'=>'icon.jpeg',
            'logo'=>'logo.jpeg',
            'logo2'=>'logo2.jpeg',
            'site_name'=>'Mega Adventures International Pvt. Ltd.',
            'quatation'=>'FIND US IN KATHMANDU, NEPAL',
            'fb_link'=>'link',
            'twitter_link'=>'link',
            'linkedin_link'=>'link',
            'insta_link'=>'link',
            'youtube_link'=>'link',
            'pinterest_link'=>'link',
            'google_plus'=>'link',
            'address'=>'Jyatha, Thamel, Kathmandu Nepal',
            'location_url'=>'link',
            'email'=>'info@megaadventuresintl.com',
            'phone'=>'+977-14266559',
            'contact'=>'+9779841178536 ',
            'contact_second'=>'+9779851014616',
            'meta_title'=>'Mega Adventures International Pvt. Ltd.',
            'meta_keywords'=>'Mega Adventures International Pvt. Ltd.',
            'meta_description'=>'Mega Adventures International Pvt. Ltd.',
        ]);
    }
}
