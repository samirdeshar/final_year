<?php

namespace Database\Seeders;

use App\Models\Admin\Trip\TripCategory;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::insert([
            [
                "column_name"=>"user",
                "name"=>"View User",
                "slug"=>Str::slug("View User"),
            ],
            [
                "column_name"=>"user",
                "name"=>"Create User",
                "slug"=>Str::slug("Create User"),
            ],
            [
                "column_name"=>"user",
                "name"=>"Edit User",
                "slug"=>Str::slug("Edit User"),
            ],
            [
                "column_name"=>"user",
                "name"=>"Remove User",
                "slug"=>Str::slug("Remove User"),
            ],
            [
                "column_name"=>"role",
                "name"=>"View Role",
                "slug"=>Str::slug("View Role"),
            ],
            [
                "column_name"=>"role",
                "name"=>"Create Role",
                "slug"=>Str::slug("Create Role"),
            ],
            [
                "column_name"=>"role",
                "name"=>"Edit Role",
                "slug"=>Str::slug("Edit Role"),
            ],
            [
                "column_name"=>"role",
                "name"=>"Remove Role",
                "slug"=>Str::slug("Remove Role"),
            ],
            [
                "column_name"=>"permission",
                "name"=>"View Permission",
                "slug"=>Str::slug("View Permission"),
            ],
            [
                "column_name"=>"permission",
                "name"=>"Create Permission",
                "slug"=>Str::slug("Create Permission"),
            ],
            [
                "column_name"=>"permission",
                "name"=>"Edit Permission",
                "slug"=>Str::slug("Edit Permission"),
            ],
            [
                "column_name"=>"permission",
                "name"=>"Remove Permission",
                "slug"=>Str::slug("Remove Permission"),
            ],

            // Banner Seeder

            [
                "column_name"=>"banner",
                "name"=>"View Banner",
                "slug"=>Str::slug("View Banner"),
            ],
            [
                "column_name"=>"banner",
                "name"=>"Create Banner",
                "slug"=>Str::slug("Create Banner"),
            ],
            [
                "column_name"=>"banner",
                "name"=>"Edit Banner",
                "slug"=>Str::slug("Edit Banner"),
            ],
            [
                "column_name"=>"banner",
                "name"=>"Remove Banner",
                "slug"=>Str::slug("Remove Banner"),
            ],

            // Post Permission

            [
                "column_name"=>"post",
                "name"=>"View Post",
                "slug"=>Str::slug("View Post"),
            ],
            [
                "column_name"=>"post",
                "name"=>"Create Post",
                "slug"=>Str::slug("Create Post"),
            ],
            [
                "column_name"=>"post",
                "name"=>"Edit Post",
                "slug"=>Str::slug("Edit Post"),
            ],
            [
                "column_name"=>"post",
                "name"=>"Remove Post",
                "slug"=>Str::slug("Remove Post"),
            ],

            // Setting Permission
            [
                "column_name"=>"setting",
                "name"=>"Create Setting",
                "slug"=>Str::slug("Create Setting"),
            ],
            [
                "column_name"=>"setting",
                "name"=>"Edit Setting",
                "slug"=>Str::slug("Edit Setting"),
            ],

            // Pages Permission
            [
                "column_name"=>"generalpage",
                "name"=>"View Generalpage",
                "slug"=>Str::slug("View Generalpage"),
            ],
            [
                "column_name"=>"generalpage",
                "name"=>"Create Generalpage",
                "slug"=>Str::slug("Create Generalpage"),
            ],
            [
                "column_name"=>"generalpage",
                "name"=>"Edit Generalpage",
                "slug"=>Str::slug("Edit Generalpage"),
            ],
            [
                "column_name"=>"generalpage",
                "name"=>"Remove Generalpage",
                "slug"=>Str::slug("Remove Generalpage"),
            ],

            // Testimonial Permission

            [
                "column_name"=>"testimonial",
                "name"=>"View Testimonial",
                "slug"=>Str::slug("View Testimonial"),
            ],
            [
                "column_name"=>"testimonial",
                "name"=>"Create Testimonial",
                "slug"=>Str::slug("Create Testimonial"),
            ],
            [
                "column_name"=>"testimonial",
                "name"=>"Edit Testimonial",
                "slug"=>Str::slug("Edit Testimonial"),
            ],
            [
                "column_name"=>"testimonial",
                "name"=>"Remove Testimonial",
                "slug"=>Str::slug("Remove Testimonial"),
            ],

            // Partner Permission Making

            [
                "column_name"=>"partner",
                "name"=>"View Partner",
                "slug"=>Str::slug("View Partner"),
            ],
            [
                "column_name"=>"partner",
                "name"=>"Create Partner",
                "slug"=>Str::slug("Create Partner"),
            ],
            [
                "column_name"=>"partner",
                "name"=>"Edit Partner",
                "slug"=>Str::slug("Edit Partner"),
            ],
            [
                "column_name"=>"partner",
                "name"=>"Remove Partner",
                "slug"=>Str::slug("Remove Partner"),
            ],

            // About Permission Making

            [
                "column_name"=>"about",
                "name"=>"View About",
                "slug"=>Str::slug("View About"),
            ],
            [
                "column_name"=>"about",
                "name"=>"Create Testimonial",
                "slug"=>Str::slug("Create About"),
            ],
            [
                "column_name"=>"about",
                "name"=>"Edit About",
                "slug"=>Str::slug("Edit About"),
            ],
            [
                "column_name"=>"about",
                "name"=>"Remove About",
                "slug"=>Str::slug("Remove About"),
            ],

             // Postcategory Seeder
             [
                "column_name"=>"postcategory",
                "name"=>"View Postcategory",
                "slug"=>Str::slug("View Postcategory"),
            ],
            [
                "column_name"=>"postcategory",
                "name"=>"Create category",
                "slug"=>Str::slug("Create Postcategory"),
            ],
            [
                "column_name"=>"postcategory",
                "name"=>"Edit Postcategory",
                "slug"=>Str::slug("Edit Postcategory"),
            ],
            [
                "column_name"=>"postcategory",
                "name"=>"Remove Postcategory",
                "slug"=>Str::slug("Remove Postcategory"),
            ],

              // Posttag Permission

            [
                "column_name"=>"posttag",
                "name"=>"View Posttag",
                "slug"=>Str::slug("View Posttag"),
            ],
            [
                "column_name"=>"posttag",
                "name"=>"Create Posttag",
                "slug"=>Str::slug("Create Posttag"),
            ],
            [
                "column_name"=>"posttag",
                "name"=>"Edit Posttag",
                "slug"=>Str::slug("Edit Posttag"),
            ],
            [
                "column_name"=>"posttag",
                "name"=>"Remove Posttag",
                "slug"=>Str::slug("Remove Posttag"),
            ],

            // Trip permission
            [
                "column_name"=>"trip",
                "name"=>"View Trip",
                "slug"=>Str::slug("View Trip"),
            ],
            [
                "column_name"=>"trip",
                "name"=>"Create Trip",
                "slug"=>Str::slug("Create Trip"),
            ],
            [
                "column_name"=>"trip",
                "name"=>"Edit Trip",
                "slug"=>Str::slug("Edit Trip"),
            ],
            [
                "column_name"=>"trip",
                "name"=>"Remove Trip",
                "slug"=>Str::slug("Remove Trip"),
            ],

            // TripCategory Permission making

            [
                "column_name"=>"tripcategory",
                "name"=>"View Tripcategory",
                "slug"=>Str::slug("View Tripcategory"),
            ],
            [
                "column_name"=>"tripcategory",
                "name"=>"Create Tripcategory",
                "slug"=>Str::slug("Create Tripcategory"),
            ],
            [
                "column_name"=>"tripcategory",
                "name"=>"Edit Tripcategory",
                "slug"=>Str::slug("Edit Tripcategory"),
            ],
            [
                "column_name"=>"tripcategory",
                "name"=>"Remove Tripcategory",
                "slug"=>Str::slug("Remove Tripcategory"),
            ],

            // Triptag Permission Making

            [
                "column_name"=>"triptag",
                "name"=>"View Triptag",
                "slug"=>Str::slug("View Triptag"),
            ],
            [
                "column_name"=>"triptag",
                "name"=>"Create Triptag",
                "slug"=>Str::slug("Create Triptag"),
            ],
            [
                "column_name"=>"triptag",
                "name"=>"Edit Triptag",
                "slug"=>Str::slug("Edit Triptag"),
            ],
            [
                "column_name"=>"triptag",
                "name"=>"Remove Triptag",
                "slug"=>Str::slug("Remove Triptag"),
            ],

            // general faq
            [
                "column_name"=>"generalfaq",
                "name"=>"View Generalfaq",
                "slug"=>Str::slug("View Generalfaq"),
            ],
            [
                "column_name"=>"generalfaq",
                "name"=>"Create Generalfaq",
                "slug"=>Str::slug("Create Generalfaq"),
            ],
            [
                "column_name"=>"generalfaq",
                "name"=>"Edit Generalfaq",
                "slug"=>Str::slug("Edit Generalfaq"),
            ],
            [
                "column_name"=>"generalfaq",
                "name"=>"Remove Generalfaq",
                "slug"=>Str::slug("Remove Generalfaq"),
            ],

            // team member
            [
                "column_name"=>"teammember",
                "name"=>"View Teammember",
                "slug"=>Str::slug("View Teammember"),
            ],
            [
                "column_name"=>"teammember",
                "name"=>"Create Teammember",
                "slug"=>Str::slug("Create Teammember"),
            ],
            [
                "column_name"=>"teammember",
                "name"=>"Edit Teammember",
                "slug"=>Str::slug("Edit Teammember"),
            ],
            [
                "column_name"=>"teammember",
                "name"=>"Remove Teammember",
                "slug"=>Str::slug("Remove Teammember"),
            ],

            // Teeamcategory

            [
                "column_name"=>"teamcategory",
                "name"=>"View Teamcategory",
                "slug"=>Str::slug("View Teamcategory"),
            ],
            [
                "column_name"=>"teamcategory",
                "name"=>"Create Teamcategory",
                "slug"=>Str::slug("Create Teamcategory"),
            ],
            [
                "column_name"=>"teamcategory",
                "name"=>"Edit Teamcategory",
                "slug"=>Str::slug("Edit Teamcategory"),
            ],
            [
                "column_name"=>"teamcategory",
                "name"=>"Remove Teammember",
                "slug"=>Str::slug("Remove Teamcategory"),
            ],

            // Travel Info permission making

            [
                "column_name"=>"travelinfo",
                "name"=>"View Travelinfo",
                "slug"=>Str::slug("View Travelinfo"),
            ],
            [
                "column_name"=>"travelinfo",
                "name"=>"Create Travelinfo",
                "slug"=>Str::slug("Create Travelinfo"),
            ],
            [
                "column_name"=>"travelinfo",
                "name"=>"Edit Travelinfo",
                "slug"=>Str::slug("Edit Travelinfo"),
            ],
            [
                "column_name"=>"travelinfo",
                "name"=>"Remove Travelinfo",
                "slug"=>Str::slug("Remove Travelinfo"),
            ],

            // TravelCategory

            [
                "column_name"=>"travelcategory",
                "name"=>"View Travelcategory",
                "slug"=>Str::slug("View Travelcategory"),
            ],
            [
                "column_name"=>"travelcategory",
                "name"=>"Create Travelcategory",
                "slug"=>Str::slug("Create Travelcategory"),
            ],
            [
                "column_name"=>"travelcategory",
                "name"=>"Edit Travelcategory",
                "slug"=>Str::slug("Edit Travelcategory"),
            ],
            [
                "column_name"=>"travelcategory",
                "name"=>"Remove Travelcategory",
                "slug"=>Str::slug("Remove Travelcategory"),
            ],

            // Travel Trip Type

            [
                "column_name"=>"traveltriptype",
                "name"=>"View Traveltriptype",
                "slug"=>Str::slug("View Traveltriptype"),
            ],
            [
                "column_name"=>"traveltriptype",
                "name"=>"Create Traveltriptype",
                "slug"=>Str::slug("Create Traveltriptype"),
            ],
            [
                "column_name"=>"traveltriptype",
                "name"=>"Edit Traveltriptype",
                "slug"=>Str::slug("Edit Traveltriptype"),
            ],
            [
                "column_name"=>"traveltriptype",
                "name"=>"Remove Traveltriptype",
                "slug"=>Str::slug("Remove Traveltriptype"),
            ],

            // Cyber cast

            [
                "column_name"=>"cybercast",
                "name"=>"View Cybercast",
                "slug"=>Str::slug("View Cybercast"),
            ],
            [
                "column_name"=>"cybercast",
                "name"=>"Create Cybercast",
                "slug"=>Str::slug("Create Cybercast"),
            ],
            [
                "column_name"=>"cybercast",
                "name"=>"Edit Cybercast",
                "slug"=>Str::slug("Edit Cybercast"),
            ],
            [
                "column_name"=>"cybercast",
                "name"=>"Remove Cybercast",
                "slug"=>Str::slug("Remove Cybercast"),
            ],


            // Cyber cast Post

            [
                "column_name"=>"cybercastpost",
                "name"=>"View Cybercastpost",
                "slug"=>Str::slug("View Cybercastpost"),
            ],
            [
                "column_name"=>"cybercastpost",
                "name"=>"Create Cybercastpost",
                "slug"=>Str::slug("Create Cybercastpost"),
            ],
            [
                "column_name"=>"cybercastpost",
                "name"=>"Edit Cybercastpost",
                "slug"=>Str::slug("Edit Cybercastpost"),
            ],
            [
                "column_name"=>"cybercastpost",
                "name"=>"Remove Cybercastpost",
                "slug"=>Str::slug("Remove Cybercastpost"),
            ],

            // Cyber Category

            [
                "column_name"=>"cybercategory",
                "name"=>"View Cybercategory",
                "slug"=>Str::slug("View Cybercategory"),
            ],
            [
                "column_name"=>"cybercategory",
                "name"=>"Create Cybercategory",
                "slug"=>Str::slug("Create Cybercategory"),
            ],
            [
                "column_name"=>"cybercategory",
                "name"=>"Edit Cybercategory",
                "slug"=>Str::slug("Edit Cybercategory"),
            ],
            [
                "column_name"=>"cybercategory",
                "name"=>"Remove Cybercategory",
                "slug"=>Str::slug("Remove Cybercategory"),
            ],

            // Hike permission

            [
                "column_name"=>"hike",
                "name"=>"View Hike",
                "slug"=>Str::slug("View Hike"),
            ],
            [
                "column_name"=>"hike",
                "name"=>"Create Hike",
                "slug"=>Str::slug("Create Hike"),
            ],
            [
                "column_name"=>"hike",
                "name"=>"Edit Hike",
                "slug"=>Str::slug("Edit Hike"),
            ],
            [
                "column_name"=>"hike",
                "name"=>"Remove Hike",
                "slug"=>Str::slug("Remove Hike"),
            ],


            // Dashboard Permission

            [
                "column_name"=>"dashboard",
                "name"=>"View Dashboard",
                "slug"=>Str::slug("View Dashboard"),
            ],

            // Essential Or information Permission

            [
                "column_name"=>"information",
                "name"=>"View Information",
                "slug"=>Str::slug("View Information"),
            ],
            [
                "column_name"=>"information",
                "name"=>"Create Information",
                "slug"=>Str::slug("Create Information"),
            ],
            [
                "column_name"=>"information",
                "name"=>"Edit Information",
                "slug"=>Str::slug("Edit Information"),
            ],
            [
                "column_name"=>"information",
                "name"=>"Remove Information",
                "slug"=>Str::slug("Remove Information"),
            ],

            //Menu Permission

            [
                "column_name"=>"menu",
                "name"=>"View Menu",
                "slug"=>Str::slug("View Menu"),
            ],
            [
                "column_name"=>"menu",
                "name"=>"Create Menu",
                "slug"=>Str::slug("Create Menu"),
            ],
            [
                "column_name"=>"menu",
                "name"=>"Edit Menu",
                "slug"=>Str::slug("Edit Menu"),
            ],
            [
                "column_name"=>"menu",
                "name"=>"Remove Menu",
                "slug"=>Str::slug("Remove Menu"),
            ],

        ]);
    }
}
