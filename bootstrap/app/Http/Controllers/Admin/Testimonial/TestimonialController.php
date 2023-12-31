<?php
namespace App\Http\Controllers\Admin\Testimonial;



use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Http\Requests\TestimonialUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Testimonial\Testimonial;
use App\Support\ImageSupport;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $folder_name = "admin.testimonial.";
    public function index(Request $request)
    {
        if ($request->user()->can("view-testimonial")) {
        $testimonials = Testimonial::orderByDesc('created_at')->get();
        $data = [
            'testimonials' => $testimonials,
        ];
        return view($this->folder_name.'index', $data)->with('n', '1');
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
        if ($request->user()->can("create-testimonial")) {
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
    public function store(TestimonialRequest $request)
    {
        if ($request->user()->can("create-testimonial")) {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $input['user_id']=\Auth::id();
            $input['slug']=Str::slug($request->title. rand(00000, 99999));

            // return $input;
             Testimonial::create($input);
             DB::commit();
             Toastr::success('Successfully Saved.', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
            return back()->withInput();
        }
        return redirect()->route('testimonial.index');
        }
        else
        {
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Testimonial\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Testimonial\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial, Request $request)
    {
        if ($request->user()->can("edit-testimonial")) {
        $new = [
            'data' => $testimonial,
        ];
        return view($this->folder_name.'form', $new);
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
     * @param  \App\Models\Admin\Testimonial\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial)
    {

        if ($request->user()->can("edit-testimonial")) {
        $input = $request->all();

        DB::beginTransaction();
        try {

            $testimonial->fill($input);
            $testimonial->save();
            DB::commit();
            Toastr::success('Successfully Updated !!!', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
            return back()->withInput();
        }
        return redirect()->route('testimonial.index');
        }
        else
        {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Testimonial\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial, Request $request)
    {
        if($request->user()->can("remove-testimonial")){
        $testimonial->delete();
        Toastr::warning('Succesfully Deleted !', 'Deleted');
        return redirect()->route('testimonial.index');
        }
    }

    public function updateStatus(Testimonial $request, $id,)
    {
        $testimonial = Testimonial::findorFail($id);

        if($testimonial->status == 'active')
        {
            $testimonial->status = 'inactive';
        }else
        {
            $testimonial->status = 'active';
        }
        $testimonial->save();

        if($testimonial->status)
        {
            Toastr::success('Successfully Testimonial Status Updated', 'Success !!!', ['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Testimonial Status', 'Error !!!', ['positionClass'=>'toast-top-right']);
        }

        return redirect()->route('testimonial.index');
    }
}
