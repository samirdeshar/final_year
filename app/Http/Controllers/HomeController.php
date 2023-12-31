<?php

namespace App\Http\Controllers;

use App\Models\Admin\Banner\Banner;
use App\Models\Admin\Post\Post;
use App\Models\Admin\Team\Team;
use App\Models\Admin\Trip\Trip;
use App\Models\Frontend\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->can("view-dashboard")) {

            $memebers = Team::where('status', 'active')->get();
            $posts = Post::where('status', 'active')->get();
            $messages = Contact::all();

            $data = [
                'members'=>$memebers,
                'posts'=>$posts,
                'messages'=>$messages,
            ];
            return view('layouts.backend_layout.dashboard', $data);
        }
        else
        {
            return view('layouts.backend_layout.user-dashboard');
        }
    }
}
