<?php

namespace App\Http\Controllers\Admin\Faqs;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Faqs\GeneralFaq;
use App\Models\Admin\Faqs\GenralFaq;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;

class GeneralFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $folder_name = "admin.faqs.";
    public function index(Request $request)
    {
        if ($request->user()->can('view-generalfaq')) {
            $generalFaqs = GeneralFaq::orderByDesc('created_at')->get();
            $data = [
                'generalFaqs' => $generalFaqs,
            ];
            return view($this->folder_name . 'index', $data)->with('n', '1');
        } else {
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
        if ($request->user()->can("create-generalfaq")) {
            return view($this->folder_name . 'form');
        } else {
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
    public function store(Request $request)
    {
        if ($request->user()->can("create-generalfaq")) {
            $input = $request->all();
            DB::beginTransaction();
            try {
                $input['user_id'] = \Auth::id();
                $input['slug'] = Str::slug($request->title . rand(00000, 99999));

                GeneralFaq::create($input);
                DB::commit();
                Toastr::success('Successfully Updated.', 'Success !!!');
            } catch (\Throwable $th) {
                DB::rollBack();
                Toastr::warning($th->getMessage(), 'OOPs !!!');
                return back()->withInput();
            }
            return redirect()->route('generalFaq.index');
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Faqs\GeneralFaq  $generalFaq
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralFaq $generalFaq)
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Faqs\GeneralFaq  $generalFaq
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralFaq $generalFaq, Request $request)
    {
        if ($request->user()->can("edit-generalfaq")) {
            $new = [
                'data' => $generalFaq,
            ];
            return view($this->folder_name . 'form', $new);
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Faqs\GeneralFaq  $generalFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeneralFaq $generalFaq)
    {
        if ($request->user()->can("edit-generalfaq")) {
            $input = $request->all();
            DB::beginTransaction();
            try {
                $generalFaq->update($input);
                DB::commit();
                Toastr::succes('Successfully Updated !!!', 'Success');
            } catch (\Throwable $th) {
                DB::rollBack();
                Toastr::warning($th->getMessage(), 'OOPs !!!');
                return back()->withInput();
            }
            return redirect()->route('generalFaq.index');
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Faqs\GeneralFaq  $generalFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralFaq $generalFaq, Request $request)
    {
        if ($request->user()->can("remove-generalfaq")) {
            try {
                $generalFaq->delete();
                Toastr::warning('Succefully Deleted', 'Success !!!');
            } catch (\Throwable $th) {
                Toastr::warning($th->getMessage(), 'OOPs !!!');
                return back();
            }
            return back();
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    public function updateStatus(GeneralFaq $generalFaq, Request $request, $id)
    {
        if ($request->user()->can("edit-generalfaq")) {
            try {
                $generalFaq = GeneralFaq::findorFail($id);

                if ($generalFaq->status == 'active') {

                    $generalFaq->status = 'inactive';
                } else {
                    $generalFaq->status = 'active';
                }
                $generalFaq->save();
                Toastr::success('Successfully General FAQ Status Updated', 'Success !!!', ['positionClass' => 'toast-top-right']);
                return back();
            } catch (\Throwable $th) {
                Toastr::warning('Sorry ! There Was A Problem While Updating Travel Info Status', 'Error !!!', ['positionClass' => 'toast-top-right']);
                return back();
            }
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    public function searchStatus(Request $request, GeneralFaq $generalFaq)
    {
        if ($request->status != 'all') {
            $generalFaqs =  $generalFaq->where('status', $request->status)->get();
        } else {
            $generalFaqs = $generalFaq->orderByDesc('created_at')->get();
        }
        return view($this->folder_name . 'index')->with('generalFaqs', $generalFaqs)->with('n', '1');
    }

    public function destroyBulk(Request $request, GeneralFaq $generalFaq)
    {
        if ($request->user()->can("remove-generalfaq")) {
            if ($request->selects == null) {
                Toastr::warning('Error  Plz Select At Least One To Make Change !', 'Error !!!', ['positionClass' => 'toast-top-right']);
                return back();
            }
            if ($request->multiple_action != 'delete') {
                try {
                    $generalFaq->whereIn('id', $request->selects)->update([
                        'status' => $request->multiple_action
                    ]);
                    Toastr::Success('Succesfully Status has been Updated.', 'Success');
                    return back();
                } catch (\Throwable $th) {
                    Toastr::warning($th->getMessage(), 'OOPs !!!');
                    return back();
                }
            } else {
                try {
                    $generalFaq->whereIn('id', $request->selects)->delete();
                    Toastr::warning('Succesfully Deleted.', 'Success');
                    return back();
                } catch (\Throwable $th) {
                    Toastr::warning($th->getMessage(), 'OOPs !!!');
                    return back();
                }
            }
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }
}
