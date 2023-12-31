<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Admin\Post\PostCategory;
use App\Models\Admin\Post\PostTag;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Support\ImageSupport;
use App\Models\Admin\Post\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $post_cat=null;
    protected $post_tag=null;
    protected $post=null;

    public function __construct(PostCategory $post_cat,PostTag $post_tag,Post $post)
    {
        $this->post_cat=$post_cat;
        $this->post_tag=$post_tag;
        $this->post=$post;
    }
    public function index(Request $request)
    {
    if ($request->user()->Can("view-post")) {
        return view('admin.post.index')
        ->with('posts',$this->post->get())
        ->with('n',1);
        }
        else
        {
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
        if ($request->user()->Can("create-post")) {
        $cat=$this->post_cat->get();

        $tag=$this->post_tag->get();


        return view('admin.post.form')
        ->with('post_cat',$cat)
        ->with('post_tag',$tag);
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
    public function store(PostRequest $request)
    {
        if ($request->user()->Can("create-post")) {
        $data = $request->all();
       DB::beginTransaction();
       try {
            $data['user_id']=auth()->user()->id;
            $data['slug']=$this->post->getSlugs($request->title);

            $this->post->fill($data);
            $this->post->save();

        DB::commit();
        Toastr::success('Successfully Post Created', 'Success !!!', ['positionClass'=>'toast-top-right']);
       }catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
            return back()->withInput();
       }
        return redirect()->route('post.index');
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
    public function edit(Post $post, Request $request)
    {
        if ($request->user()->Can("edit-post")) {
        $cat=$this->post_cat->get();

        $tag=$this->post_tag->get();

        return view('admin.post.form')
        ->with('data',$post)
        ->with('post_cat',$cat)
        ->with('post_tag',$tag);
        }
        else
        {
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
    public function update(PostUpdateRequest $request,Post $post)
    {
        if ($request->user()->Can("edit-post")) {
        $data = $request->all();
       DB::beginTransaction();
       try {
            $data['user_id']=auth()->user()->id;
            $post->fill($data);
            $post->save();
        DB::commit();
        Toastr::success('Successfully Post Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
       }catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
            return back()->withInput();
       }
        return redirect()->route('post.index');
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
    public function destroy(Post $post, Request $request)
    {
        if ($request->user()->Can("remove-post")) {
        $image=$post->image;
        $del=$post->delete();
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

        return redirect()->route('post.index');
        }
        else
        {
            return back();
        }

    }

    public function updateStatus(Request $request,$id,$status)
    {
        $this->post=$this->post->findOrFail($id);

        if($status=='active')
        {
            $this->post->status='inactive';
        }
        else
        {
            $this->post->status='active';
        }

        $status=$this->post->save();
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

    public function toPost(Request $request)
    {


        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

            return redirect()->route('post.index')->with('error', 'Plz Select At Least One To Make Change');

        }

        if($request->multiple_action !='delete')
        {
            $this->post->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);

            // deleteImage($this->post->image,'post/thumbnail');
            Toastr::success('Successsfully  Post Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);


        }
        else
        {

            $this->post->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Post  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('post.index')->with('success', 'Successfuly Post has updated');
    }


    public function getPostStatus(Request $request,$status)
    {
        if($status !='all')
        {
            $this->post=$this->post->where('status',$status)->orderBy('id','Desc')->get();
        }
        else
        {
            $this->post=$this->post->orderBy('id','Desc')->get();
        }

       return view('admin.post.index')
       ->with('posts',$this->post)
       ->with('n',1);


    }
}
