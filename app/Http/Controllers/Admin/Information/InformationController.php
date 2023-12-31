<?php

namespace App\Http\Controllers\Admin\Information;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformationRequest;
use App\Http\Requests\InformationUpdateRequest;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Support\ImageSupport;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Information\Information;
use Illuminate\Support\Facades\Storage;
class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $information=null;
    public function __construct(Information $information)
    {
        $this->information=$information;
    }

    public function index(Request $request)
    {
        if ($request->user()->can("view-information")) {
        return view('admin.information.index')
        ->with('informations',$this->information->get())
        ->with('n',1);
        }
        else
        {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->user()->can("view-information")) {
        return view('admin.information.form');
        }
        else
        {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InformationRequest $request)
    {


            if ($request->user()->can("view-information")) {
            $data=$request->all();


            DB::beginTransaction();
            try {

                 $data['slug']=$this->information->getSlugs($request->title);
                $this->information->fill($data);
                $this->information->save();

             DB::commit();
             Toastr::success('Successfully Information Added', 'Success !!!', ['positionClass'=>'toast-top-right']);
            }catch (\Throwable $th) {
                 DB::rollBack();
                 Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
                 return back()->withInput();
            }

             return redirect()->route('information.index');
            }
            else
            {
                Toastr::warning("You can't See this Page.", "Not Authorized !!!");
                return back();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Information $information, Request $request)
    {
        if($request->user()->can("edit-information")){
        return view('admin.information.form')
        ->with('data',$information);
        }
        else
        {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InformationUpdateRequest $request,Information $information)
    {

        if ($request->user()->can("edit-information")) {
        $data=$request->all();
        DB::beginTransaction();
        try {
            $information->fill($data);
            $information->save();

         DB::commit();
         Toastr::success('Successfully Information Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }catch (\Throwable $th) {
             DB::rollBack();
             Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
             return back()->withInput();
        }

         return redirect()->route('information.index');
        }
        else
        {
            Toastr::warning("You can't Update this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Information $information, Request $request)
    {
        if ($request->ueser()->can("remove-information")) {
       $del=$information->delete();
       if($del)
        {
            Toastr::success('Successfully Information Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Team', 'Error !!!', ['positionClass'=>'toast-top-right']);
        }
        return redirect()->route('team.index');
        }
        else
        {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }


    public function updateStatus(Request $request,$id,$status)
    {
        $this->information=$this->information->findOrFail($id);

        if($status=='active')
        {
            $this->information->status='inactive';
        }
        else
        {
            $this->information->status='active';
        }

        $status=$this->information->save();
        if($status)
        {
            Toastr::success('Successfully Information Status Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Information Status', 'Error !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->back();
    }

    public function getInformationStatus(Request $request,$status)
    {
        if($status !='all')
        {
            $this->information=$this->information->where('status',$status)->orderBy('id','Desc')->get();
        }
        else
        {
            $this->information=$this->information->orderBy('id','Desc')->get();
        }

       return view('admin.information.index')
       ->with('informations',$this->information)
       ->with('n',1);


    }


    public function toInformation (Request $request)
    {

        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

            return redirect()->route('information.index')->with('error', 'Plz Select At Least One To Make Change');

        }

        if($request->multiple_action !='delete')
        {
            $this->information->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);

            Toastr::success('Successsfully  Information Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }
        else
        {
            $this->information->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Information  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('information.index')->with('success', 'Successfuly team has updated');

    }
}
