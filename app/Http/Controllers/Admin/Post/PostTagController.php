<?php
namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Post\PostTag;
use Kamaln7\Toastr\Facades\Toastr;
class PostTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $posttag=null;

    public function __construct(posttag $posttag)
    {
        $this->posttag=$posttag;
    }
    public function index(Request $request)
    {
        if (($request->user()->can("view-posttag")) || ($request->user()->can("create-posttag"))) {
        return view('admin.post.post_tag')
        ->with('post_tag',$this->posttag->get())
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
        if (($request->user()->can("view-posttag")) || ($request->user()->can("create-posttag"))) {
            return view('admin.post.post_tag')
            ->with('post_tag',$this->posttag->get())
            ->with('n',1);
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

        if ($request->user()->can("create-posttag")) {
        $rules=$this->posttag->getRules();
        $request->validate($rules);

        $data=$request->all();
        $data['user_id']=auth()->user()->id;
        $data['slug']=$this->posttag->getSlugs($request->name);

        $this->posttag->fill($data);
        $status=$this->posttag->save();

        if($status)
        {
            Toastr::success('Tag Added Successfully!', 'Success !!!');
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Creating Tag ', 'Error !!!');
        }

        return redirect()->route('posttag.index');
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
    public function edit(PostTag $posttag, Request $request)
    {
        if ($request->user()->can("edit-posttag")) {
        return view('admin.post.post_tag')
        ->with('data',$posttag);
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
    public function update(Request $request,PostTag $posttag)
    {
        if ($request->user()->can("edit-posttag")) {
        $rules=$posttag->getRules();
        $request->validate($rules);

        $data=$request->all();
        $posttag->fill($data);
        $status=$posttag->save();

        if($status)
        {
            Toastr::success('Tag Updated Successfully!', 'Success !!!');
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Tag ', 'Error !!!');
        }

        return redirect()->route('posttag.index');
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
    public function destroy(PostTag $posttag, Request $request)
    {
        if ($request->user()->can("remove-posttag")) {
        $del=$posttag->delete();
        if($del)
        {
            Toastr::success('Tag Deleted Successfully!', 'Success !!!');
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Tag ', 'Error !!!');
        }

        return redirect()->route('posttag.index');
        }
        else
        {
            return back();
        }

    }

    public function toPostTag(Request $request)
    {

        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

            return redirect()->route('posttag.index')->with('error', 'Plz Select At Least One To Make Change');

        }

        if($request->multiple_action !='delete')
        {
            $this->posttag->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Tag Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);


        }
        else
        {

            $this->posttag->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Tag  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('posttag.index')->with('success', 'Successfuly News has updated');
    }
}
