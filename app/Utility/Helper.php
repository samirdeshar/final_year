<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\Admin\Trip\TripCategory;
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

function getTripType($value=null)
{
    $data=[
        'private',
        'group join'
    ];
    if($value !=null)
    {
        return $data[$value];
    }
    return $data;
}

function getCustomerTitle()
{
    return[
        'Mr',
        'Mrs',
        'Ms'
    ];
}

function getKnownFrom()
{
    return[
        'previous client',
        'internet search',
        'trip advisor',
        'guide books',
        'others'
    ];
}

function currentDate()
{
    return Carbon::now()->format('Y-m-d');
}


function getEnquiryType()
{
    return[
        'new booking',
        'trip information',
        'existing booking',
        'subscription',
        'general'
    ];
}




?>
