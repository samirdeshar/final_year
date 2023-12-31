<?php

namespace App\Http\Controllers\Admin\Awards;
use App\Http\Controllers\Controller;
use App\Models\Admin\Award\Awards;
use App\Models\Admin\Award\AwardsCategory;
use App\Http\Requests\AwardRequest;
use App\Http\Requests\TeamUpdateRequest;
use Illuminate\Support\Str;
use App\Support\ImageSupport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;

use Illuminate\Http\Request;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     protected $awards=null;
     protected $awardsCategory=null;
     public function __construct(Awards $awards,AwardsCategory $awardsCategory)
     {
         $this->awards=$awards;
         $this->awardsCategory=$awardsCategory;
     }
     public function index(Request $request)
     {
         if ($request->user()->can("view-teammember")) {
            $awards =Awards::get();
            return view('admin.awards.index', compact('awards'))
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
         $parent_cat=$this->awardsCategory->whereNull('parent_id')->get();

         return view('admin.awards.form')
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
     public function store(Request $request)
     {
        // dd($request->all());
         if ($request->user()->can("create-teammember")) {
         $data=$request->all();
         $member_count = Awards::orderBy('in_order', 'desc')->first();

         if ( $member_count ) {
             $data['in_order'] = $member_count->in_order + 1;
         } else {
             $data['in_order'] = 1;
         }

         DB::beginTransaction();
         try {

              $data['slug']=$this->awards->getSlugs($request->name);
             //  dd($data);
              $this->awards->fill($data);
              $this->awards->save();
          DB::commit();
          Toastr::success('Successfully awards Member Added', 'Success !!!', ['positionClass'=>'toast-top-right']);
         }catch (\Throwable $th) {
              DB::rollBack();
              Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
              return back()->withInput();
         }
          return redirect()->route('awards.index');
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
     public function edit(Awards $awards, Request $request,$id)
     {

         if ($request->user()->can("edit-teammember")) {
             $data = Awards::findorfail($id);
             $parent_cat = $this->awardsCategory->whereNull('parent_id')->get();
             return view('admin.awards.form', compact('data'))->with('parentCat',$parent_cat);
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
     public function update(Request $request,Awards $award)
     {
        // dd($request->all());
         if ($request->user()->can("edit-teammember")) {
         $data=$request->all();
         DB::beginTransaction();
         try {
                $data['slug'] = Str::slug($data['name']);
              $award->fill($data);
              $award->save();
          DB::commit();
          Toastr::success('Successfully awards  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
         }catch (\Throwable $th) {
              DB::rollBack();
              Toastr::warning($th->getMessage(), 'Opps !!!', ['positionClass'=>'toast-top-right']);
              return back()->withInput();
         }
          return redirect()->route('awards.index');
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
     public function destroy(Awards $award, Request $request)
     {

         if ($request->user()->can("remove-teammember")) {
        $image=$award->image;
        $del=$award->delete();
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
         return redirect()->route('awards.index');
         }
         else
         {
             return back();
         }

     }

     public function updateStatus(Request $request,$id,$status)
     {
         $this->awards=$this->awards->findOrFail($id);

         if($status=='active')
         {
             $this->awards->status='inactive';
         }
         else
         {
             $this->awards->status='active';
         }

         $status=$this->awards->save();
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

     public function getAwardsStatus(Request $request,$status)
     {
         if($status !='all')
         {
             $this->awards=$this->awards->where('status',$status)->orderBy('id','Desc')->get();
         }
         else
         {
             $this->awards=$this->awards->orderBy('id','Desc')->get();
         }

        return view('admin.awards.index')
        ->with('awards',$this->awards)
        ->with('n',1);


     }

     public function toAwards(Request $request)
     {
         if ($request->user()->can("remove-teammember")) {
         if($request->selects ==null)
         {
             Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass'=>'toast-top-right']);

             return redirect()->route('team.index')->with('error', 'Plz Select At Least One To Make Change');

         }

         if($request->multiple_action !='delete')
         {
             $this->awards->whereIn('id',$request->selects)->update([
                 'status'=>$request->multiple_action
             ]);

             // deleteImage($this->post->image,'post/thumbnail');
             Toastr::success('Successsfully  awards Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);


         }
         else
         {

             $this->awards->whereIn('id',$request->selects)->delete();
              Toastr::success('Successsfully  awards  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
         }

         return redirect()->route('awards.index')->with('success', 'Successfuly awards has updated');
         }
          else
         {
         return back();
     }

     }
     public function updateAwardsOrder(Request $request)
     {
         $awards = Awards::all();

         foreach ($awards as $award) {
             foreach ($request->order as $order) {
                 if ($order['id'] == $award->id) {
                     $award->update(['in_order' => $order['position']]);
                 }
             }
         }
             return response()->json(['message' => 'Team order updated successfully']);
         }

}
