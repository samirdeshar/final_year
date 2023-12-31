<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('view-permission')){
            if ($request->ajax()) {
                $data = Permission::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $editurl = route('permission.edit', $row->id);
                        $deleteurl = route('permission.destroy', $row                                                              ->id);
                        $csrf_token = csrf_token();
                        $btn = "<a href='$editurl' class='edit btn btn-primary btn-sm'>Edit</a>
                        <form action='$deleteurl' method='POST' style='display:inline-block;'>
                        <input type='hidden' name='_token' value='$csrf_token'>
                        <input type='hidden' name='_method' value='DELETE' />
                            <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                        ";
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                }

            return view('admin.permission.index');
        }else{
            return view('admin.permission.permission');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->user()->can('create-permission')){
            return view('admin.permission.create');
        }else{
            return view('admin.permission.permission');
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
        //
        if($request->user()->can('create-permission')){
            $data = $this->validate($request, [
                'name'=>'required|string',
            ]);
            $column_name = explode(' ', $data['name']);
            $slug = Str::slug($data['name']);
            $permission = Permission::create([
                'column_name'=> $column_name[1],
                'name'=>$data['name'],
                'slug'=>$slug,
            ]);
            $permission->save();
            return redirect()->route('permission.index')->with('success', 'Permission Successfully Created');
        }else{
            return view('admin.permission.permission');
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
    public function edit($id,Request $request)
    {
        //
        if($request->user()->can('edit-permission')){
            $permission = Permission::findorfail($id);
            return view('admin.permission.edit', compact('permission'));
        }else{
            return view('admin.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->user()->can('edit-permission')){
            $permission = Permission::findorfail($id);
            $data = $this->validate($request, [
                'name'=>'required|string',
            ]);
            $slug = Str::slug($data['name']);
            $permission->update([
                'name'=>$data['name'],
                'slug'=>$slug,
            ]);
            $permission->save();
            return redirect()->route('permission.index')->with('success', 'Permission Successfully Updated');
        }else{
            return view('admin.permission.permission');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        if($request->user()->can('remove-permission')){
            $permission = Permission::findorfail($id);
            $permission->delete();
            return redirect()->route('permission.index')->with('success', 'Permission Successfully Deleted');
        }else{
            return view('admin.permission.permission');
        }
    }
}
