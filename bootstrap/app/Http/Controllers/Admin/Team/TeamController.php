<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Http\Requests\TeamUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Admin\Team\TeamCategory;
use App\Models\Admin\Team\Team;
use Kamaln7\Toastr\Facades\Toastr;
use App\Support\ImageSupport;
use Illuminate\Support\Facades\DB;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $team=null;
    protected $teamcategory=null;
    public function __construct(Team $team,TeamCategory $teamcategory)
    {
        $this->team=$team;
        $this->teamcategory=$teamcategory;
    }
    public function index(Request $request)
    {
        if ($request->user()->can("view-teammember")) {
        return view('admin.team.index')
        ->with('teams',$this->team->get())
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
        if ($request->user()->can("create-teammember")) {
        $parent_cat=$this->teamcategory->whereNull('parent_id')->get();

        return view('admin.team.form')
        ->with('parentCat',$parent_cat);
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
    public function store(TeamRequest $request)
    {
        if ($request->user()->can("create-teammember")) {
        $data=$request->all();

        DB::beginTransaction();
        try {

             $data['slug']=$this->team->getSlugs($request->name);
             $this->team->fill($data);
             $this->team->save();
         DB::commit();
         Toastr::success('Successfully Team Member Added', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }catch (\Throwable $th) {
             DB::rollBack();
             Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
             return back()->withInput();
        }
         return redirect()->route('team.index');
        }
        else
        {
            Toastr::warning("You Can't Do It");
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
    public function edit(Team $team, Request $request)
    {

        if ($request->user()->can("edit-teammember")) {
            $parent_cat = $this->teamcategory->whereNull('parent_id')->get();
            return view('admin.team.form')->with('parentCat',$parent_cat)->with('data',$team);
        }else{

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamUpdateRequest $request,Team $team)
    {
        if ($request->user()->can("edit-teammember")) {
        $data=$request->all();
        DB::beginTransaction();
        try {
             $team->fill($data);
             $team->save();
         DB::commit();
         Toastr::success('Successfully Team Member Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }catch (\Throwable $th) {
             DB::rollBack();
             Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
             return back()->withInput();
        }
         return redirect()->route('team.index');
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
    public function destroy(Team $team, Request $request)
    {
        if ($request->user()->can("remove-teammember")) {
       $image=$team->image;
       $del=$team->delete();
       if($del)
        {
            if($image && $image !=null)
            {
                deleteImage($image,'team/thumbnail');
            }
            Toastr::success('Successfully Team Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Team', 'Error !!!', ['positionClass'=>'toast-top-right']);
        }
        return redirect()->route('team.index');
        }
        else
        {
            return back();
        }

    }

    public function updateStatus(Request $request,$id,$status)
    {
        $this->team=$this->team->findOrFail($id);

        if($status=='active')
        {
            $this->team->status='inactive';
        }
        else
        {
            $this->team->status='active';
        }

        $status=$this->team->save();
        if($status)
        {
            Toastr::success('Successfully Team Status Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Team Status', 'Error !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->back();
    }

    public function getTeamStatus(Request $request,$status)
    {
        if($status !='all')
        {
            $this->team=$this->team->where('status',$status)->orderBy('id','Desc')->get();
        }
        else
        {
            $this->team=$this->team->orderBy('id','Desc')->get();
        }

       return view('admin.team.index')
       ->with('teams',$this->team)
       ->with('n',1);


    }

    public function toTeam(Request $request)
    {
        if ($request->user()->can("remove-teammember")) {
        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

            return redirect()->route('team.index')->with('error', 'Plz Select At Least One To Make Change');

        }

        if($request->multiple_action !='delete')
        {
            $this->team->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);

            // deleteImage($this->post->image,'post/thumbnail');
            Toastr::success('Successsfully  Team Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);


        }
        else
        {

            $this->team->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Team  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('team.index')->with('success', 'Successfuly team has updated');
        }
         else
        {
        return back();
    }

    }



}
