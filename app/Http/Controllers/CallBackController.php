<?php

namespace App\Http\Controllers;

use App\Events\CallBackEvent;
use App\Models\CallBack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CallBackRequest;
use Kamaln7\Toastr\Facades\Toastr;
class CallBackController extends Controller
{
    protected $callBack=null;
    public function __construct(CallBack $callBack)
    {
        $this->callBack=$callBack;
    }
    public function store(CallBackRequest $request)
    {
        
        $data=$request->all();
        $data['destination']=json_encode($request->destination);
        DB::beginTransaction();
        try{
            $this->callBack->fill($data);
            $this->callBack->save();
            event(new CallBackEvent($this->callBack));
            DB::commit();
            Toastr::success('Success', 'success !!');
            return redirect()->route('call.back');
        }catch(\Throwable $th)
        {
            DB::rollback();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
        }
    }
}
