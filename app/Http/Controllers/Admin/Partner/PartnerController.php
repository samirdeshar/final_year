<?php
namespace App\Http\Controllers\Admin\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Http\Requests\PartnerUpdateRequest;
use App\Models\Admin\Partner\Partner;
use App\Support\ImageSupport;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $folder_name = "admin.partner.";
    public function index(Request $request)
    {
        if ($request->user()->can("view-partner")) {
        $partners = Partner::orderByDesc('created_at')->get();
        $data = [
            'partners'=>$partners,
            'n'=>'1',
        ];
        return view($this->folder_name.'index', $data);
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
        if ($request->user()->can("create-partner")) {
        $partners = Partner::orderByDesc('created_at')->get();
        $data = [
            'partners'=>$partners,
            'n'=>'1',
        ];
        return view($this->folder_name.'index', $data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {

        if ($request->user()->can("create-partner")) {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $input['user_id']=\Auth::id();

            Partner::create($input);
            DB::commit();
            Toastr::success('Succesfully Saved.', 'Success !!!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
            return back()->withInput();
        }
        return redirect()->route('partner.index');
        }
        else
        {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Partner\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Partner\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner, Request $request)
    {
        if ($request->user()->can("edit-partner")) {
        return view($this->folder_name.'index')->with('data', $partner);
        }
        else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Partner\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        if ($request->user()->can("edit-partner")) {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $partner->update($input);
            DB::commit();
            Toastr::success('Successfully Updated.', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
            return back()->withInput();
        }
        return redirect()->route('partner.index');
        }
        else
        {
            Toastr::warning('Not Authorized.', 'You Can not Update partner');
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Partner\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner, Request $request)
    {

        if ($request->user()->can("remove-partner")) {
        try {
            $partner->delete();
            Toastr::warning('Succesfully Deleted.', 'Deleted !!!');
        } catch (\Throwable $th) {
            Toastr::warning($th->getMessage(), 'OOPs !!!');
        }
        return back();
        }
        else
        {
            return back();
        }
    }

    public function deleteBulk(Request $request, Partner $partner)
    {
        if ($request->selects == null) {
            Toastr::warning('Please Select for Quick Action.');
            return back();
        }
        else
        {
             try {
                    $partner->whereIn('id', $request->selects)->delete();
                    Toastr::success('Successsfully  Post  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-top-right']);
            } catch (\Throwable $th) {
                Toastr::warning($th->getMessage(), 'OOPs !!!');
            }
            return back();
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $partner = Partner::findorFail($id);

        if ($partner->status == 'active') {
            $partner->status = 'inactive';
        }
        else
        {
            $partner->status = 'active';
        }
       try {
            $partner->save();
            Toastr::success('Succesfully Updated Partner Status.', 'Status Updated !!!');
       } catch (\Throwable $th) {
            Toastr::warning($th->getMessage(), 'OOPs !!!');
       }
       return back();
    }
}
