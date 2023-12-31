<?php
namespace App\Http\Controllers\Admin\Contact;

use Illuminate\Http\Request;
use App\Models\Frontend\Contact;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $folder_name = "admin.messages.";
    public function index()
    {
        $messages = Contact::orderByDesc('created_at')->get();
        $data = [
            'messages'=>$messages,
            'n'=>'1'
        ];
        return view($this->folder_name.'messages', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frontend\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frontend\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frontend\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frontend\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$contact)
    {
        $contact=Contact::findOrFail($contact);
        DB::beginTransaction();
        try {
           $contact->delete();
           DB::commit();
           Toastr::success('Successfully Deleted', 'Thank You');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
        }
        return back();
    }
}
