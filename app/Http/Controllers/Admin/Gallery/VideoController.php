<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Models\Video;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $video = null;

     public function __construct(Video $video)

     {
        $this->video = $video;
     }
     public function index(Request $request, Video $video)
     {
         if ($request->user()->can("view-post")) {
             return view('admin.video.index')
                 ->with('data', $this->video->orderBy('id', 'asc')->get())
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
            return view('admin.video.form');

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

                $data['user_id']=auth()->user()->id;
                $data['slug'] = Str::slug($request->title);
                $data['video_url'] = $request->file('video_url')->store('videos', 'public');
                $data['video_url'] = asset('storage/' . $data['video_url']);

                $this->video->fill($data);
                $this->video->save();
            DB::commit();
            Toastr::success('Successfully Post Created', 'Success !!!', ['positionClass'=>'toast-top-right']);
           }catch (\Throwable $th) {
                DB::rollBack();
                Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
                return back()->withInput();
           }
            return redirect()->route('video.index');
            }
            else
            {
                return back();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        dd('test');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {

        if ($request->user()->can("edit-teammember")) {
            $data = Video::findorfail($id);
            return view('admin.video.form', compact('data'));
        }else{
            return back()->with('error','You are not allowed to edit video');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video )
    {
         // dd($request->all());
         if ($request->user()->can("edit-teammember")) {
            $data=$request->all();
            $request->validate([
                'video_url' => 'required|mimes:mp4,avi,wmv,mov|max:10240'

            ]);
            DB::beginTransaction();
            try {
                   $data['slug'] = Str::slug($data['title']);
                   $data['slug'] = Str::slug($request->title);
                   $data['video_url'] = $request->file('video_url')->store('videos', 'public');
                   $data['video_url'] = asset('storage/' . $data['video_url']);

                 $video->fill($data);
                 $video->save();
             DB::commit();
             Toastr::success('Successfully videos  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
            }catch (\Throwable $th) {
                 DB::rollBack();
                 Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
                 return back()->withInput();
            }
             return redirect()->route('video.index');
            }
            else
            {
                return back();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request,Video $video,)
    {

        if ($request->user()->can("remove-post")) {
            $del = $video->delete();

            if ($del) {
                Toastr::success('Successfully Post Deleted', 'Success !!!', ['positionClass' => 'toast-top-right']);
            } else {
                Toastr::warning('Sorry! There Was A Problem While Updating Post', 'Error !!!', ['positionClass' => 'toast-top-right']);
            }

            return redirect()->route('video.index');
        } else {
            return back();
        }
    }

    public function updateStatus(Request $request,$id,$status)
    {
        $this->video=$this->video->findOrFail($id);

        if($status=='active')
        {
            $this->video->status='inactive';
        }
        else
        {
            $this->video->status='active';
        }

        $status=$this->video->save();
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

    public function toVideo(Request $request)
    {


        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

            return redirect()->route('video.index')->with('error', 'Plz Select At Least One To Make Change');

        }

        if($request->multiple_action !='delete')
        {
            $this->video->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);

            // deleteImage($this->post->image,'post/thumbnail');
            Toastr::success('Successsfully  Video Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);


        }
        else
        {

            $this->video->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Post  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('video.index')->with('success', 'Successfuly Post has updated');
    }


    public function getVideoStatus(Request $request,$status)
    {
        if($status !='all')
        {
            $this->video=$this->video->where('status',$status)->orderBy('id','Desc')->get();
        }
        else
        {
            $this->video=$this->video->orderBy('id','Desc')->get();
        }

       return view('admin.video.index')
       ->with('video',$this->video)
       ->with('n',1);


    }
}
