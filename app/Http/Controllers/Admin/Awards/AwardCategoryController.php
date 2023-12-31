<?php

namespace App\Http\Controllers\Admin\Awards;
use App\Http\Controllers\Controller;
use App\Models\Admin\Award\AwardsCategory;
use Illuminate\Support\Str;
use App\Support\ImageSupport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;

use Illuminate\Http\Request;

class AwardCategoryController extends Controller
{
    protected $awardscategory=null;

    public function __construct(AwardsCategory $awardscategory)
    {
        $this->awardscategory=$awardscategory;
    }

    public function index(Request $request)
    {
        if (($request->user()->can("view-teamcategory")) || ($request->user()->can("create-teamcategory"))) {

        $parent_cat=$this->awardscategory->whereNull('parent_id')->get();


        return view('admin.awards.award_category')
        ->with('team_cats',$this->awardscategory->get())
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
        if (($request->user()->can("view-teamcategory")) || ($request->user()->can("create-teamcategory"))) {
            $parent_cat=$this->awardscategory->whereNull('parent_id')->get();


            return view('admin.awards.award_category')
            ->with('team_cats',$this->awardscategory->get())
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
        if ($request->user()->can("create-teamcategory")) {
            // dd($request->all());
        $data = $request->all();
        DB::beginTransaction();
        try {
             $data['user_id']=auth()->user()->id;
             $data['slug']=$this->awardscategory->getSlugs($request->name);



             $this->awardscategory->fill($data);
             $this->awardscategory->save();




         DB::commit();
         Toastr::success('Successfully Category Created', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }catch (\Throwable $th) {
             DB::rollBack();
             Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
             return back()->withInput();
        }
         return redirect()->route('awardscategory.index');
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
    public function edit(AwardsCategory $awardscategory, Request $request)
    {

        if ($request->user()->can("edit-teamcategory")) {

        $parent_cat=$this->awardscategory->whereNull('parent_id')->get();
        return view('admin.awards.award_category',)
        ->with('data',$awardscategory)
        ->with('parent_cat',$parent_cat);
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
    public function update(Request $request,AwardsCategory $awardscategory)
    {

        if ($request->user()->can("edit-teamcategory")) {
        $data = $request->all();
        $request->validate([
                        'name' => 'required|string',
                        'description' => 'nullable|string',
                    ]);
        DB::beginTransaction();
        try {
             $data['slug'] = Str::slug($data['name']);

             $awardscategory->fill($data);
             $awardscategory->save();
         DB::commit();
         Toastr::success('Successfully Category Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }catch (\Throwable $th) {
             DB::rollBack();
             Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
             return back()->withInput();
        }
         return redirect()->route('awardscategory.index');
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
    public function destroy(AwardsCategory $awardscategory, Request $request)
    {
        // dd($awardscategory);
        if ($request->user()->can("remove-teamcategory")) {
        $del=$awardscategory->delete();
        if($del)
        {
            Toastr::success('Successfully Category Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleteing Category', 'Error !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('awardscategory.index');
        }
        else
        {
            return back();
        }
    }

    public function toAwardsCat(Request $request)
    {

        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

            return redirect()->route('awardscategory.index')->with('error', 'Plz Select At Least One To Make Change');

        }

        if($request->multiple_action !='delete')
        {
            $this->awardscategory->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Category Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);


        }
        else
        {

            $this->awardscategory->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Category  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('awardscategory.index')->with('success', 'Successfuly News has updated');
    }
}
