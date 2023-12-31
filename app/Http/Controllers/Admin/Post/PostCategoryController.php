<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Post\PostCategory;
use Kamaln7\Toastr\Facades\Toastr;
class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $postcategory=null;
    public function __construct(PostCategory $postcategory)
    {
        $this->postcategory=$postcategory;
    }
    public function index(Request $request)
    {
        if (($request->user()->can("create-postcategory")) || ($request->user()->can("view-postcategory"))) {
        $parent_cat=$this->postcategory->whereNull('parent_id')->get();

        return view('admin.post.post_category')
        ->with('post_cats',$this->postcategory->get())
        ->with('n',1)
        ->with('parent_cat',$parent_cat);
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
        if (($request->user()->can("create-postcategory")) || ($request->user()->can("view-postcategory"))) {
            $parent_cat=$this->postcategory->whereNull('parent_id')->get();

            return view('admin.post.post_category')
            ->with('post_cats',$this->postcategory->get())
            ->with('n',1)
            ->with('parent_cat',$parent_cat);
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
        if ($request->user()->can("create-postcategory")) {
        $rules=$this->postcategory->getRules();
        $request->validate($rules);

        $data=$request->all();
        $data['user_id']=auth()->user()->id;
        $data['slug']=$this->postcategory->getSlugs($request->name);

        $this->postcategory->fill($data);
        $status=$this->postcategory->save();

        if($status)
        {
            Toastr::success('Category Added Successfully!', 'Success !!!');
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Creating Category ', 'Error !!!');
        }

        return redirect()->route('postcategory.index');
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
    public function edit(PostCategory $postcategory, Request $request)
    {
        if ($request->user()->can("edit-postcategory")) {
        $parent_cat=$this->postcategory->whereNull('parent_id')->get();
        return view('admin.post.post_category')
        ->with('parent_cat',$parent_cat)
        ->with('data',$postcategory);
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
    public function update(Request $request,PostCategory $postcategory)
    {
        if ($request->user()->can("edit-postcategory")) {
        $rules=$postcategory->getRules();
        $request->validate($rules);

        $data=$request->all();
        $postcategory->fill($data);
        $status=$postcategory->save();

        if($status)
        {
            Toastr::success('Category Updated Successfully!', 'Success !!!');
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Category ', 'Error !!!');
        }

        return redirect()->route('postcategory.index');
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
    public function destroy(PostCategory $postcategory)
    {
        $del=$postcategory->delete();
        if($del)
        {
            Toastr::success('Category Deleted Successfully!', 'Success !!!');
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Category ', 'Error !!!');
        }

        return redirect()->route('postcategory.index');
    }

    public function toPostCat(Request $request)
    {

        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

            return redirect()->route('postcategory.index')->with('error', 'Plz Select At Least One To Make Change');

        }

        if($request->multiple_action !='delete')
        {
            $this->postcategory->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Category Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);


        }
        else
        {

            $this->postcategory->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Category  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('postcategory.index')->with('success', 'Successfuly News has updated');
    }
}
