<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuCategory;
use Illuminate\Support\Str;
class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list=array(
            [
                'name' => 'Trip Category',
                'slug' => Str::slug('trip-category')
            ],


        );

        foreach($list as $data)
        {
            $menucategory=new MenuCategory();
            $menucategory->fill($data);
            $menucategory->save();
        }
    }
}
