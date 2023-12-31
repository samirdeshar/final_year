<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamCategoryRequest;
use App\Http\Requests\TeamCategoryUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Support\ImageSupport;
use App\Models\Admin\Team\TeamCategory;

class TeamCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $teamcategory=null;

    public function __construct(TeamCategory $teamcategory)
    {
        $this->teamcategory=$teamcategory;
    }

    public function index(Request $request)
    {
        if (($request->user()->can("view-teamcategory")) || ($request->user()->can("create-teamcategory"))) {
        $parent_cat=$this->teamcategory->whereNull('parent_id')->get();


        return view('admin.team.team_category')
        ->with('team_cats',$this->teamcategory->get())
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
            $parent_cat=$this->teamcategory->whereNull('parent_id')->get();


            return view('admin.team.team_category')
            ->with('team_cats',$this->teamcategory->get())
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
    public function store(TeamCategoryRequest $request)
    {
        if ($request->user()->can("create-teamcategory")) {
        $data = $request->all();
        DB::beginTransaction();
        try {
             $data['user_id']=auth()->user()->id;
             $data['slug']=$this->teamcategory->getSlugs($request->name);



             $this->teamcategory->fill($data);
             $this->teamcategory->save();




         DB::commit();
         Toastr::success('Successfully Category Created', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }catch (\Throwable $th) {
             DB::rollBack();
             Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
             return back()->withInput();
        }
         return redirect()->route('teamcategory.index');
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
    public function edit(TeamCategory $teamcategory, Request $request)
    {
        if ($request->user()->can("edit-teamcategory")) {
        $parent_cat=$this->teamcategory->whereNull('parent_id')->get();
        return view('admin.team.team_category')
        ->with('data',$teamcategory)
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
    public function update(TeamCategoryUpdateRequest $request,TeamCategory $teamcategory)
    {

        if ($request->user()->can("edit-teamcategory")) {
        $data = $request->all();
        DB::beginTransaction();
        try {
             $teamcategory->fill($data);
             $teamcategory->save();
         DB::commit();
         Toastr::success('Successfully Category Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }catch (\Throwable $th) {
             DB::rollBack();
             Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
             return back()->withInput();
        }
         return redirect()->route('teamcategory.index');
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
    public function destroy(TeamCategory $teamcategory, Request $request)
    {
        if ($request->user()->can("remove-teamcategory")) {
        $del=$teamcategory->delete();
        if($del)
        {
            Toastr::success('Successfully Category Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleteing Category', 'Error !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('teamcategory.index');
        }
        else
        {
            return back();
        }
    }

    public function toTeamCat(Request $request)
    {

        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

            return redirect()->route('teamcategory.index')->with('error', 'Plz Select At Least One To Make Change');

        }

        if($request->multiple_action !='delete')
        {
            $this->teamcategory->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Category Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);


        }
        else
        {

            $this->teamcategory->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Category  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('teamcategory.index')->with('success', 'Successfuly News has updated');
    }
}
