<?php
namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Support\ImageSupport;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use Yajra\DataTables\EloquentDataTable;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $folder_name = "admin.setting.";
    public function index(Request $request)
    {
        if ($request->user()->can('create-setting')) {
        $setting = Setting::find(1);
        if ($setting == null) {
            return redirect()->route('setting.create');
        }
        return redirect()->route('setting.edit', $setting);
        }
        else
        {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
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
        if ($request->user()->can("create-setting")) {
        $setting = Setting::find(1);
        if ($setting == null) {
            return view($this->folder_name.'form');
        }
        return redirect()->route('setting.edit', $setting);
        }
        else
        {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        if ($request->user()->can("create-setting")) {
        $input = $request->all();
        $input['user_id']=\Auth::id();
        DB::beginTransaction();
        try {
            $input['user_id']=\Auth::id();
            Setting::create($input);
            DB::commit();
            Toastr::success('Successfully Saved.', 'Success !!!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
            return back()->withInput();
        }

        return back();
        }
        else
        {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting, Request $request)
    {
        if ($request->user()->can("edit-setting")) {
        $data = [
            'setting'=> $setting,
        ];
        return view($this->folder_name.'form', $data);
        }
        else
        {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request, Setting $setting)
    {

        if ($request->user()->can("edit-setting")) {
        $input = $request->all();
        DB::beginTransaction();
        try {

            $setting->update($input);
            DB::commit();
            Toastr::success('Successfully Updated.', 'Success !!!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
            return back()->withInput();
        }

        return back();
        }
        else
        {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
