<?php
namespace App\Http\Controllers\Admin\Faqs;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaqDesignRequest;
use App\Http\Requests\FaqDesignUpdateRequest;
use App\Models\Admin\Faqs\FaqDesign;
use Illuminate\Support\Facades\Auth;

class FaqDesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $folder_name = "admin.faqs.";
    public function index(Request $request)
    {
        if (($request->user()->can("edit-generalfaq")) || ($request->user()->can("create-generalfaq"))) {
            $faqDesign = FaqDesign::find(1);
            if ($faqDesign !== null) {
                return redirect()->route('faqDesign.edit', $faqDesign);
            } else {
                return redirect()->route('faqDesign.create');
            }
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
        if (($request->user()->can("edit-generalfaq")) || ($request->user()->can("create-generalfaq"))) {
            $faqDesign = FaqDesign::find(1);
            if ($faqDesign == null) {
                return view($this->folder_name.'faqdesign');
            }
            return redirect()->route('faqDesign.index', $faqDesign);
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
    public function store(FaqDesignRequest $request)
    {
        if ($request->user()->can("create-generalfaq")) {
            $input = $request->all();
            DB::beginTransaction();
            try {
                $input['user_id']=\Auth::id();

                $input['slug']=\Str::slug('faqs');
                // return $input;
                FaqDesign::create($input);
                DB::commit();
                Toastr::success('Successfully Saved.', 'Success !!!');
            } catch (\Throwable $th) {
                DB::rollBack();
                Toastr::warning($th->getMessage(), 'OOPs !!!');
                return back()->withInput();
            }
            return  back();
            }
            else
            {
                return back();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Faqs\FaqDesign  $faqDesign
     * @return \Illuminate\Http\Response
     */
    public function show(FaqDesign $faqDesign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Faqs\FaqDesign  $faqDesign
     * @return \Illuminate\Http\Response
     */
    public function edit(FaqDesign $faqDesign, Request $request)
    {
        if (($request->user()->can("edit-generalfaq")) || ($request->user()->can("create-generalfaq"))) {
            $new = [
                'data'=>$faqDesign,
            ];
            return view($this->folder_name.'faqdesign', $new);
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
     * @param  \App\Models\Admin\Faqs\FaqDesign  $faqDesign
     * @return \Illuminate\Http\Response
     */
    public function update(FaqDesignUpdateRequest $request, FaqDesign $faqDesign)
    {
        if ($request->user()->Can("edit-generalfaq")) {
            $input = $request->all();
            DB::beginTransaction();
            try {

            $faqDesign->update($input);
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
                return back();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Faqs\FaqDesign  $faqDesign
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaqDesign $faqDesign)
    {
        //
    }
}
