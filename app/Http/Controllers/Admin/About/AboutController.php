<?php
namespace App\Http\Controllers\Admin\About;


use App\Models\Admin\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Http\Requests\AboutUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $about = null;
     public function __construct(About $about)
     {
        $this->about= $about;
     }
     protected $folder_name = "admin.about.";

    public function index(Request $request)
    {
        if ($request->user()->can("view-about")) {
        $about = About::find(1);
        if ($about !== null) {
            return redirect()->route('about.edit', $about);
        } else {
            return redirect()->route('about.create');
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
        if ($request->user()->can("create-about")) {
        $about = About::find(1);
        if ($about == null) {
            return view($this->folder_name.'form');
        }
        return redirect()->route('about.index', $about);
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
    public function store(AboutRequest $request)
    {
        if ($request->user()->can("create-about")) {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $input['user_id']=\Auth::id();
            $input['slug']=\Str::slug('about');
            // return $input;
            $this->about->create($input);
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
     * @param  \App\Models\Admin\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about, Request $request)
    {
        if ($request->user()->can("edit-about")) {
        $new = [
            'data'=>$about,
        ];

        return view($this->folder_name.'form', $new);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(AboutUpdateRequest $request, About $about)
    {
        if ($request->user()->Can("edit-about")) {
        $input = $request->all();
        DB::beginTransaction();
        try {
        $about->update($input);
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
     * @param  \App\Models\Admin\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {

    }
}
