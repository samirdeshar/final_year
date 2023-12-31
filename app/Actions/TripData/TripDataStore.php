<?php
namespace App\Actions\TripData;

use App\Models\TripData;
use Illuminate\Http\Request;
use App\Models\Admin\Trip\Trip;

class TripDataStore{

    protected $request;
    protected $trip;

    public function __construct(Request $request,Trip $trip)
    {
        $this->request=$request;
        $this->trip=$trip;
    }

    public function store()
    {
        $data=$this->request->all();
        $data['trip_id']=$this->trip->id;
        $value=TripData::create($data);
    }
}