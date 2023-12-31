<?php
namespace App\Utility;

class HelperClass{

    public static function country()
    {
        return[
            'Nepal'
        ];
    }

    public static function destination()
    {
        return[
            'Kathmandu',
            'Lalitpur',
            'Bhaktapur',
            'Nagarkot',
            'Dhulikhel',
            'Bandipur',
            'Pokhara',
            'Chitwan',
            'Lumbini',
            'Bandipur'
        ];
    }

    public static function adults($param)
    {
        $data=[];
        $j=0;
        if($param==1)
        {
            $j=1;
        }
        for($i=$j;$i<=29;$i++)
            {
                $data[]=$i;
            }
        return $data;
    }
}

