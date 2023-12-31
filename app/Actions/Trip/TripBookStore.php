<?php
namespace App\Actions\Trip;

use App\Models\TripBook;
use Illuminate\Http\Request;

class TripBookStore{

    protected $request;

    public function __construct(Request $request=null)
    {
        $this->request=$request;
    }

    public function store()
    {
        $data=TripBook::create($this->request->all());
        return $data;
    }

    public function guest($dataValue)
    {
        $data=TripBook::create($dataValue);
        return $data;
    }
}