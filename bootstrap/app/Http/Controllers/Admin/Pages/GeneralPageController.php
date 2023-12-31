<?php
namespace App\Http\Controllers\Admin\Pages;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralPageRequest;
use App\Http\Requests\GeneralPageUpdateRequest;
use App\Models\Admin\Pages\GeneralPage;
use App\Support\ImageSupport;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;

class GeneralPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $folder_name = "admin.pages.";
    public function index(Request $request)
    {
        if ($request->user()->can('view-generalpage')) {
        $generalPages = GeneralPage::orderByDesc('created_at')->get();
        $data = [
            'generalPages'=>$generalPages,
        ];
        return  view($this->folder_name.'index', $data)->with('n', '1');
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
        if ($request->user()->can("create-generalpage")) {
        return view($this->folder_name.'form');
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
    public function store(GeneralPageRequest $request)
    {
        if ($request->user()->can("create-generalpage")) {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $input['user_id']=\Auth::id();
            $input['slug']=Str::slug($request->title);

            GeneralPage::create($input);
            DB::commit();
            Toastr::success('Succesfully Saved.', 'Success !!!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
            return back()->withInput();
        }
        return redirect()->route('generalPage.index');
        }
        else
        {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Pages\GeneralPage  $generalPage
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralPage $generalPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Pages\GeneralPage  $generalPage
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralPage $generalPage, Request $request)
    {
       if ($request->user()->can("edit-generalpage")) {
        return view($this->folder_name.'form')->with('data', $generalPage);
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
     * @param  \App\Models\Admin\Pages\GeneralPage  $generalPage
     * @return \Illuminate\Http\Response
     */
    public function update(GeneralPageUpdateRequest $request, GeneralPage $generalPage)
    {
        if ($request->user()->can("edit-generalpage")) {
       $input = $request->all();
       DB::beginTransaction();
       try {
        $generalPage->update($input);
        DB::commit();
        Toastr::success('Successfully Updated.', 'Success !!!');
       } catch (\Throwable $th) {
        DB::rollBack();
        Toastr::warning($th->getMessage(), 'OOPs !!!');
        return back()->withInput();
       }
       return redirect()->route('generalPage.index');
        }
        else
        {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Pages\GeneralPage  $generalPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralPage $generalPage, Request $request)
    {
        if ($request->user()->can("remove-generalpage")) {

        try {
            $generalPage->delete();
            Toastr::warning('Successfully Deleted', 'Deleted !!!');
        } catch (\Throwable $th) {
            Toastr::warning($th->getMessage(), 'OOPs !!!');
            return back();
        }
        return back();
        }
        else
        {
            return back();
        }
    }
    public function updateStatus(GeneralPage $generalPage, $id)
    {
        $generalPage = GeneralPage::findorFail($id);
        if ($generalPage->status == 'active') {
            $generalPage->status = 'inactive';
        }
        else
        {
            $generalPage->status = 'active';
        }
        try {
            $generalPage->save();
            Toastr::success('Successfully Pages Status Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        } catch (\Throwable $th) {
            Toastr::warning('Sorry ! There Was A Problem While Updating Banner Status', 'Error !!!', ['positionClass'=>'toast-top-right']);
        }
        return back();
    }
    public function deleteBulk(Request $request, GeneralPage $generalPage)
    {

        if ($request->selects == null) {
            Toastr::warning('Please Selects Some Content For Actions.',);
        }
        else if ($request->multiple_action !== 'delete')
        {
            $generalPage->whereIn('id', $request->selects)->update([
                'status'=>$request->multiple_action
            ]);
        }
        else
        {
           try {
                $generalPage->whereIn('id', $request->selects)->delete();
                Toastr::Warning('Succesfully Deleted Selected Files.', 'Deleted !!!');
           } catch (\Throwable $th) {
                Toastr::warning($th->getMessage(), 'OOPs !!!');
           }
        }
        return back();
    }
    public function searchStatus(Request $request, GeneralPage $generalPage)
    {
        if ($request->status !== 'all') {
            $generalPages = $generalPage->where('status', $request->status)->get();
        }
        else
        {
            $generalPages = $generalPage->orderByDesc('created_at')->get();
        }
        $data = [
            'generalPages'=>$generalPages,
            'n'=>'1',
        ];
        return view($this->folder_name.'index', $data);
    }
}
