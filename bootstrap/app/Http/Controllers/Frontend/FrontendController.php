<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\SubscriberRequest;
use App\Models\Admin\About;
use App\Models\Admin\Banner\Banner;
use App\Models\Admin\CyberCast\CyberCast;
use App\Models\Admin\CyberCast\CyberCastPost;
use App\Models\Admin\CyberCast\CyberCategory;
use App\Models\Admin\Faqs\FaqDesign;
use App\Models\Admin\Hike\Hike;
use App\Models\Admin\Setting;
use App\Models\Admin\Team\Team;
use App\Models\Admin\Trip\Trip;
use App\Models\Frontend\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\Admin\Trip\TripCategory;
use App\Models\Admin\Trip\TripCategoryList;
use App\Models\Admin\Information\Information;
use App\Models\Admin\Pages\GeneralPage;
use App\Models\Admin\Post\Post;
use App\Models\Admin\Post\PostCategory;
use App\Models\Admin\Subscriber\Subscriber;
use App\Models\Admin\Testimonial\Testimonial;
use App\Models\Admin\WhyMega\WhyMega;
use PhpParser\Builder\Function_;
use App\Models\Menu;
use App\Models\Service\Service;


class FrontendController extends Controller
{
    protected $folder_name = "frontend.";
    protected $tripcategory=null;
    protected $tripcategorylist=null;
    protected $trip=null;
    protected $information=null;
    protected $post=null;
    protected $testimonial=null;
    protected $about=null;
    protected $generalpage=null;
    protected $why_mega=null;

    public function __construct(TripCategory $tripcategory,TripCategoryList $tripcategorylist,Trip $trip,Information $information,Post $post,Testimonial $testimonial,About $about,GeneralPage $generalpage,WhyMega $why_mega)
    {
        $this->tripcategory=$tripcategory;
        $this->tripcategorylist=$tripcategorylist;
        $this->trip=$trip;
        $this->information=$information;
        $this->post=$post;
        $this->testimonial=$testimonial;
        $this->about=$about;
        $this->generalpage=$generalpage;
        $this->why_mega=$why_mega;
    }

    public function index(){


        $banners = Banner::where('status', 'active')->orderByDesc('created_at')->get();

        $tripcategory=$this->tripcategory->where('parent_id','!=',null)->where('display',1)->get();

        $trip=$this->trip->where('status','active')->orderBY('id','DESC')->get();
        $mega_special=$this->trip->where('mega_special_trip','1')->orderBy('id','DESC')->get();
        $information=$this->information->where('status','active')->get();
        $blog=$this->post->where('status','active')->orderBy('id','DESC')->limit(4)->get();
        $testimonial=$this->testimonial->where('status','active')->orderBy('id','DESC')->limit(1)->get();
        $team_detail=$this->about->first();
        $team = Team::orderByDesc('created_at')->first();

        $hikes  = Hike::where('status', 'active')->orderByDesc('created_at')->get();
        $cybercasts = CyberCast::where('status', 'active')->orderByDesc('created_at')->take('3')->get();

        $data = [
            'banners'=>$banners,
            'hikes'=>$hikes,
            'cybercasts'=> $cybercasts,
            'team'=> $team,
        ];

        return view($this->folder_name.'index', $data)
        ->with('category',$tripcategory)
        ->with('trips',$trip)
        ->with('mega_special',$mega_special)
        ->with('informations',$information)
        ->with('blogs',$blog)
        ->with('testimonial',$testimonial)
        ->with('team_detail',$team_detail);
    }

    public function shareComment()
    {
        return view($this->folder_name.'comment');
    }

    // TripCategory/{subCategory}
    public function tripcategory(Request $request, $slug)
    {

        $category =$this->tripcategory->where('slug',$slug)->firstOrFail();



        $trips = $category->category_trip->where('status', 'active');


        return view($this->folder_name.'listing')
        ->with('category',$category)
        ->with('trips',$trips);
    }

    public function tripDispatch()
    {

        $cybercasts = CyberCast::orderByDesc("created_at")->get();
        $data = [
            'cybercasts'=>$cybercasts
        ];
        return view($this->folder_name.'tripDispatch', $data);
    }
    //Trip Dispatch or cybercast single
    public function tripDispatchSingle($slug)
    {
        $cybercast = CyberCast::where('slug', $slug)->firstOrFail();
        $data = [
            'cybercast'=> $cybercast,
        ];

        return view($this->folder_name.'tripdispatch-single', $data);
    }


    // Footer General faqs single
    public function generalfaqs()
    {
        $faqdesign = FaqDesign::find(1);
        return view($this->folder_name.'generalfaqs')->with('faqdesign', $faqdesign);
    }

    // cybercastpost Single, Uneder of single trip dispatch
    public function singleCyberCastPost($slug)
    {
        $cybercastpost = CyberCastPost::where('slug', $slug)->firstOrFail();
        $data = [
            'cybercastpost'=>$cybercastpost
        ];
        return view($this->folder_name.'cybercastpost-single', $data);
    }

 // ------------------Customer Messages Storing here-----------------
    public function contactStore(ContactRequest $request)
    {

        DB::beginTransaction();
        try {
            $setting = new Setting();
            $input = $request->all();
            $data = $input;
            $data['from'] = $input['email'];
            $data['to'] = SITE_MAIL;
            $data['content'] = $input ['message'];
            $this->sendMail($data);

           Contact::create($input);
           DB::commit();
           Toastr::success('Successfully Sent Your Message', 'Thank You');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
        }
        return back();
    }

    public function tripDetails(Request $request,$slug)
    {

        $this->trip=$this->trip->where('slug',$slug)->firstOrFail();
        $overview=$this->trip->getOverView;
        $itineary=$this->trip->getIteneary;
        // $train=$this->trip->getTrain;
        $information=$this->information->where('status','active')->get();
        $why_mega = $this->why_mega->where('status', 'active')->orderByDesc('created_at')->first();
        // $faq = $this->trip->getFaq();

        // return $faq;

        $faq = $this->trip->tripFaq;

        return view('frontend.single')
        ->with('trip',$this->trip)
        ->with('overview',$overview)
        ->with('informations',$information)
        ->with('itineary',$itineary)
        ->with('why_mega', $why_mega)
        ->with('faq', $faq);
    }

    public function detailPage(Request $request,$slug)
    {
        $this->generalpage=$this->generalpage->where('slug',$slug)->firstOrFail();
        return view('frontend.page')
        ->with('page',$this->generalpage);
    }

    public function informationDetail(Request $request,$slug)
    {
        $this->information=$this->information->where('slug',$slug)->firstOrFail();

        return view('frontend.information-detail')
        ->with('information',$this->information);
    }
    // Testimonial list view
    public function TestimonialList()
    {

        return $data;
    }

    // blog listview
    public function Blogs()
    {
        $blogs = Post::where('status', 'active')->orderByDesc('created_at')->get();
        $data = [
            'blogs'=>$blogs
        ];
        return view($this->folder_name.'blogs', $data);
    }



    public function blogCategory(Request $request,$slug)
    {
        $blogcategory = PostCategory::where('slug', $slug)->firstorFail();
        $posts = $blogcategory->posts;
        $data = [
            'blogcategory'=>$blogcategory,
            'posts'=>$posts,
        ];
        return view($this->folder_name.'blogs', $data);
    }

    public function subscribe(SubscriberRequest $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            Subscriber::create($input);
            DB::commit();
            Toastr::success('Succesfully Subscribed.', 'Thank You !!!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning($th->getMessage(), 'OOPs !!!');
        }
        return back();
    }

    // for mail Sending
    public function sendMail($data)
    {
       Mail::send('email.message.contact', $data, function($message) use($data){
        $message->subject($data['full_name']);
        $message->from($data['from']);
        $message->to($data['to']);
       });
    }
    public function getPage($slug)
    {
        $meta = Menu::where('category_slug', $slug)->first();
       switch ($slug) {
            case'testimonials':
                $testimonials = Testimonial::orderByDesc('created_at')->where('status', 'active')->get();
                 $data = [
                     'testimonials'=>$testimonials,
                ];
                return view($this->folder_name.'testimonials', $data);
                break;

            case 'about-us':
                $about = About::first();
                $teams = Team::all();
                $data = [
                    'about'=>$about,
                    'teams'=>$teams,
                ];
            return view($this->folder_name.'about', $data)->with('meta', $meta);
            break;
            case 'mega-special':
                $trip=$this->trip->where('mega_special_trip','1')->orderBy('id','DESC')->get();
                return view($this->folder_name.'megaSpecial')
                ->with('trips',$trip)->with('meta', $meta);
                break;
            case 'contact-us':
                return view($this->folder_name.'contact')->with('meta', $meta);
                break;
            case 'trip-dispatch':

                $cybercasts = CyberCast::orderByDesc("created_at")->where('status','active')->get();
                $data = [
                    'cybercasts'=>$cybercasts
                ];
                return view($this->folder_name.'tripDispatch', $data)->with('meta', $meta);
                break;
             case 'find-your-trip':
                 $trip=$this->trip->where('status','active')->get();
                 $parentCategory=TripCategory::whereNull('parent_id')->get();
                 $subCategory=TripCategory::where('parent_id','!=',null)->get();
                 return view($this->folder_name.'category')
                 ->with('trips',$trip)
                 ->with('parentCategory',$parentCategory)
                 ->with('subCategory',$subCategory)->with('meta', $meta);
                 break;
            case 'blogs':
                $blogs = Post::orderByDesc('created_at')->where('status', 'active')->get();
                $design = GeneralPage::where('slug', 'our-blogs')->first();
                return view($this->folder_name.'bloglist')->with('blogs', $blogs)->with('design', $design);
                break;

            default:
                return view($this->folder_name.'notfound');
                break;
       }
    }

    public function generalPage($slug)
    {


        $data = Menu::where('title_slug', $slug)->first();
        return view('frontend.general-page',compact('data'))
        ->with('meta',$this->getMeta($data));
    }



    public function singleBlog($slug)
    {
        $blog = Post::where('slug', $slug)->firstOrFail();
        $data = [
            'blog'=>$blog,
        ];
        return view($this->folder_name.'blogsingle', $data);
    }

    public function searchTrip(Request $request)
    {

        if($request->category_name=='parent')
        {

            $category=TripCategory::findOrFail($request->category_id);
            $data =$category->getCategoryTrip;
        }
        else if($request->category_name=='subparent')
        {

            $category=TripCategory::findOrFail($request->category_id);

            $data =$category->category_trip;
        }
        else
        {
            $item=$request->category_name;
            if($item=='all')
            {
                $data =Trip::where('status','active')->get();
            }
            else if($item=='16')
            {
                $data=Trip::whereBetween('trip_duration',['10','16'])->get();
            }

            else if($item=='31')
            {
                $data=Trip::whereBetween('trip_duration',['16','31'])->get();
            }

            else if($item=='46')
            {
                $data=Trip::whereBetween('trip_duration',['31','46'])->get();
            }

            else
            {
                $data=Trip::where('trip_duration','>=','46')->get();
            }
        }

        return view('frontend.item')
        ->with('trips',$data);
    }

    public function sortTrip(Request $request)
    {
        if($request->selection_sort=='parent')
        {

            if($request->sort_order=='1')
            {
                $category=TripCategory::findOrFail($request->selection_cat);
                $data =$category->getSortCategoryTripByHigh;
            }
            else
            {
                $category=TripCategory::findOrFail($request->selection_cat);
                $data =$category->getSortCategoryTripByLow;
            }
        }
        else if($request->selection_sort=='subparent')
        {
            if($request->sort_order=='1')
            {

                $category=TripCategory::findOrFail($request->selection_cat);

                $data =$category->category_Hightrip;
            }
            else
            {
                $category=TripCategory::findOrFail($request->selection_cat);
                $data =$category->category_Lowtrip;
            }
        }
        else if($request->selection_sort=='All')
        {

            if($request->sort_order=='1')
            {

                $data =Trip::where('status','active')->orderBy('trip_cost','desc')->get();
            }
            else
            {

                $data =Trip::where('status','active')->orderBy('trip_cost','asc')->get();
            }
        }
        else
        {
            $item=$request->selection_sort;
            if($item=='all')
            {
                if($request->sort_order=='1')
                {
                    $data =Trip::where('status','active')->orderBy('trip_cost','desc')->get();
                }
                else
                {
                    $data =Trip::where('status','active')->orderBy('trip_cost','asc')->get();
                }

            }
            else if($item=='16')
            {

                if($request->sort_order=='1')
                {
                    $data=Trip::whereBetween('trip_duration',['10','16'])->orderBy('trip_cost','desc')->get();
                }
                else
                {
                    $data=Trip::whereBetween('trip_duration',['10','16'])->orderBy('trip_cost','asc')->get();
                }


            }

            else if($item=='31')
            {
                if($request->sort_order=='1')
                {
                    $data=Trip::whereBetween('trip_duration',['16','31'])->orderBy('trip_cost','desc')->get();
                }
                else
                {
                    $data=Trip::whereBetween('trip_duration',['16','31'])->orderBy('trip_cost','asc')->get();
                }


            }

            else if($item=='46')
            {
                if($request->sort_order=='1')
                {
                    $data=Trip::whereBetween('trip_duration',['31','46'])->orderBy('trip_cost','desc')->get();
                }
                else
                {
                    $data=Trip::whereBetween('trip_duration',['31','46'])->orderBy('trip_cost','asc')->get();
                }


            }

            else
            {
                if($request->sort_order=='1')
                {
                    $data=Trip::where('trip_duration','>=','46')->orderBy('trip_cost','desc')->get();
                }
                else
                {
                    $data=Trip::where('trip_duration','>=','46')->orderBy('trip_cost','asc')->get();
                }
            }
        }


        return view('frontend.item')
        ->with('trips',$data);
    }
}
