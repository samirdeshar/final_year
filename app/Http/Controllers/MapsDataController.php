<?php

namespace App\Http\Controllers;

use App\Models\MapsData;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MapsDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $maps = null;
    public function __construct(MapsData $maps)

     {
        $this->maps = $maps;
     }
     public function index(Request $request, MapsData $maps)
     {
         if ($request->user()->can("view-post")) {
             return view('admin.mapsdata.index')
                 ->with('data', $this->maps->orderBy('id', 'asc')->get())
                 ->with('n', 1);
         } else {
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
        if ($request->user()->Can("create-post"))
        {
            return view('admin.mapsdata.form');

        }
        else
        {

            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->Can("create-post")) {
            $data = $request->all();
           DB::beginTransaction();
           try {
                // $data['user_id']=auth()->user()->id;
                $data['slug'] = Str::slug($data['name']);

                $this->maps->fill($data);
                $this->maps->save();
            DB::commit();
            Toastr::success('Successfully maps Created', 'Success !!!', ['positionClass'=>'toast-top-right']);
           }catch (\Throwable $th) {
                DB::rollBack();
                Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
                return back()->withInput();
           }
            return redirect()->route('mapsdata.index');
            }
            else
            {
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
    public function edit(Request $request, $id)
    {
        if ($request->user()->can("edit-teammember")) {
            $data = MapsData::findorfail($id);

            return view('admin.mapsdata.form',compact('data'));
        }else{
            return back()->with('error','You are not allowed to edit team');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MapsData $maps)
    {
        if ($request->user()->can("edit-teammember")) {
            $data=$request->all();
            DB::beginTransaction();
            try {
                   $data['slug'] = Str::slug($data['name']);
                 $maps->fill($data);
                 $maps->save();
             DB::commit();
             Toastr::success('Successfully maps  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
            }catch (\Throwable $th) {
                 DB::rollBack();
                 Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
                 return back()->withInput();
            }
             return redirect()->route('mapsdata.index');
            }
            else
            {
                return back();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MapsData $maps)
    {
        if ($request->user()->Can("remove-post")) {
            $image=$maps->image;
            $del=$maps->delete();
            if($del)
            {
                if($image && $image !=null)
                {
                    deleteImage($image,'post/thumbnail');
                }
                Toastr::success('Successfully Post Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::warning('Sorry ! There Was A Problem While Updating Post ', 'Error !!!', ['positionClass'=>'toast-top-right']);
            }

            return redirect()->route('mapsdata.index');
            }
            else
            {
                return back();
            }
    }


    public function updateStatus(Request $request,$id,$status)
    {
        // dd('test');
        $this->maps=$this->maps->findOrFail($id);

        if($status=='active')
        {
            $this->maps->status='inactive';
        }
        else
        {
            $this->maps->status='active';
        }

        $status=$this->maps->save();
        if($status)
        {
            Toastr::success('Successfully Maps Status Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Post Status', 'Error !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->back();
    }

    public function toMaps(Request $request)
    {


        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

            return redirect()->route('photo.index')->with('error', 'Plz Select At Least One To Make Change');

        }

        if($request->multiple_action !='delete')
        {
            $this->maps->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);

            // deleteImage($this->post->image,'post/thumbnail');
            Toastr::success('Successsfully  photo Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);


        }
        else
        {

            $this->maps->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Post  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('mapsdata.index')->with('success', 'Successfuly Post has updated');
    }


    public function getphotoStatus(Request $request,$status)
    {
        if($status !='all')
        {
            $this->maps=$this->maps->where('status',$status)->orderBy('id','Desc')->get();
        }
        else
        {
            $this->maps=$this->maps->orderBy('id','Desc')->get();
        }

       return view('admin.mapsdata.index')
       ->with('maps',$this->maps)
       ->with('n',1);


    }
}
