<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Str;
use Kamaln7\Toastr\Facades\Toastr;
class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $photo = null;
    public function __construct(Photo $photo)

     {
        $this->photo = $photo;
     }
     public function index(Request $request, Photo $photo)
     {
         if ($request->user()->can("view-post")) {
             return view('admin.photo.index')
                 ->with('data', $this->photo->orderBy('id', 'asc')->get())
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
            return view('admin.photo.form');

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
        // dd($request->all());
        if ($request->user()->Can("create-post")) {
            $data = $request->all();
           DB::beginTransaction();
           try {
                $data['user_id']=auth()->user()->id;
                $data['slug'] = Str::slug($data['title']);

                $this->photo->fill($data);
                $this->photo->save();
            DB::commit();
            Toastr::success('Successfully Photo Created', 'Success !!!', ['positionClass'=>'toast-top-right']);
           }catch (\Throwable $th) {
                DB::rollBack();
                Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
                return back()->withInput();
           }
            return redirect()->route('photo.index');
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
            $data = Photo::findorfail($id);

            return view('admin.photo.form',compact('data'));
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
    public function update(Request $request, Photo $photo)
    {
         // dd($request->all());
         if ($request->user()->can("edit-teammember")) {
            $data=$request->all();
            DB::beginTransaction();
            try {
                   $data['slug'] = Str::slug($data['title']);
                 $photo->fill($data);
                 $photo->save();
             DB::commit();
             Toastr::success('Successfully photo  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
            }catch (\Throwable $th) {
                 DB::rollBack();
                 Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
                 return back()->withInput();
            }
             return redirect()->route('photo.index');
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
    public function destroy(Photo $photo, Request $request)
    {
        // dd('test');
        if ($request->user()->Can("remove-post")) {
        $image=$photo->image;
        $del=$photo->delete();
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

        return redirect()->route('photo.index');
        }
        else
        {
            return back();
        }

    }

    public function updateStatus(Request $request,$id,$status)
    {
        $this->photo=$this->photo->findOrFail($id);

        if($status=='active')
        {
            $this->photo->status='inactive';
        }
        else
        {
            $this->photo->status='active';
        }

        $status=$this->photo->save();
        if($status)
        {
            Toastr::success('Successfully Post Status Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Post Status', 'Error !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->back();
    }

    public function toPhoto(Request $request)
    {


        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

            return redirect()->route('photo.index')->with('error', 'Plz Select At Least One To Make Change');

        }

        if($request->multiple_action !='delete')
        {
            $this->photo->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);

            // deleteImage($this->post->image,'post/thumbnail');
            Toastr::success('Successsfully  photo Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);


        }
        else
        {

            $this->photo->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Post  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('photo.index')->with('success', 'Successfuly Post has updated');
    }


    public function getphotoStatus(Request $request,$status)
    {
        if($status !='all')
        {
            $this->photo=$this->photo->where('status',$status)->orderBy('id','Desc')->get();
        }
        else
        {
            $this->photo=$this->photo->orderBy('id','Desc')->get();
        }

       return view('admin.photo.index')
       ->with('photo',$this->photo)
       ->with('n',1);


    }
}
