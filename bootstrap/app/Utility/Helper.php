<?php

use App\Models\Admin\Trip\TripCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
function uploadImage($image,$dir,$thumb='100x100')
{
    list($thumb_width,$thumb_height)=explode('x',$thumb);


    $path=public_path().'/uploads/'.$dir;

    if(!File::exists($path))
    {
        File::makeDirectory($path,0777,true,true);
    }

    $image_name=ucfirst($dir)."-".date('YmdHis').rand(0,999).".".$image->getClientOriginalExtension();



    $status=$image->move($path,$image_name);


    if($status)
    {
        Image::make($path."/".$image_name)->resize($thumb_width,$thumb_height,function($constraint)
        {
            return $constraint->aspectRatio();
        })->save($path."/".$image_name);

        return $image_name;
    }
    else
    {
        return null;
    }
}

function deleteImage($image,$dir)
{
    $path=public_path().'/uploads/'.$dir.'/'.$image;

    if(File::exists($path))
    {
        try{
            unlink($path);
        }
        catch(Exception $error)
        {

        }

    }

}

function getCat($cat)
{
    $cat=TripCategory::where('id',$cat->sub_category_id)->firstOrFail();
    return $cat;
}


?>
