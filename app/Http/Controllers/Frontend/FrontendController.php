<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Response;
use App\Models\Menu;
use App\Mail\Enquiry;
use App\Models\Review;
use App\Mail\BookingMail;
use App\Mail\AdminEnquiry;
use App\Models\BannerIcon;
use App\Models\Admin\About;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\Mail\AdminBookingMail;
use App\Models\Admin\Hike\Hike;
use App\Models\Admin\Post\Post;
use App\Models\Admin\Team\Team;
use App\Models\Admin\Trip\Trip;
use App\Models\Service\Service;
use App\Models\Frontend\Contact;
use PhpParser\Builder\Function_;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Actions\Trip\TripBookStore;
use App\Events\TripBookEvent;
use App\Models\Admin\Banner\Banner;
use App\Models\Admin\Trip\TripGear;
use App\Http\Controllers\Controller;
use App\Models\Admin\Faqs\FaqDesign;
use App\Models\Frontend\TripComment;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\InquiryRequest;
use App\Models\Admin\Booking\Booking;
use App\Models\Admin\Inquiry\Inquiry;
use App\Models\Admin\WhyMega\WhyMega;
use App\Models\Admin\Trip\TripGallery;
use App\Models\Admin\Pages\GeneralPage;
use App\Models\Admin\Post\PostCategory;
use App\Models\Admin\Trip\TripCategory;
use App\Http\Requests\SubscriberRequest;
use App\Http\Requests\TripCommentRequest;
use App\Models\Admin\CyberCast\CyberCast;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TripBookSaveRequest;
use App\Mail\ReviewMail;
use App\Models\Admin\Booking\BookerDetail;
use App\Models\Admin\Subscriber\Subscriber;
use App\Models\Admin\Trip\TripCategoryList;
use App\Models\Admin\CyberCast\CyberCastPost;
use App\Models\Admin\CyberCast\CyberCategory;
use App\Models\Admin\Information\Information;
use App\Models\Admin\Testimonial\Testimonial;

class FrontendController extends Controller
{

    protected $folder_name = "frontend.";
    protected $tripcategory=null;
    protected $tripcategorylist=null;
    protected $trip=null;
    protected $information=null;protected $post=null;
    protected $testimonial=null;
    protected $about=null;
    protected $generalpage=null;
    protected $why_mega=null;
    protected $trip_comment=null;
    protected $booking=null;
    protected $booker_detail=null;
    protected $inquiry=null;

    public function __construct(TripCategory $tripcategory,TripCategoryList $tripcategorylist,Trip $trip,Information $information,Post $post,Testimonial $testimonial,About $about,GeneralPage $generalpage,WhyMega $why_mega,TripComment $trip_comment,Booking $booking,BookerDetail $booker_detail,Inquiry $inquiry)
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
        $this->trip_comment=$trip_comment;
        $this->booking=$booking;
        $this->booker_detail=$booker_detail;
        $this->inquiry=$inquiry;
    }

    public function index(){
        $banners = Banner::where('status', 'active')->orderByDesc('created_at')->get();
        $tripcategory=$this->tripcategory->where('parent_id','!=',null)->where('bond_status','1')->where('status','active')->orderBy('position','ASC')->limit(6)->get();
        $trip=$this->trip->where('status','active')->orderBY('id','DESC')->get();
        $mega_special=$this->trip->where('mega_special_trip','1')->orderBy('trip_special_position','ASC')->limit(6)->get();
        $information=$this->information->where('status','active')->get();
        $blog=$this->post->where('status','active')->orderBy('position','ASC')->limit(8)->get();
        // $testimonial=$this->testimonial->where('status','active')->where('type','testimonial')->latest()->get();
        // $reviewsData=Review::where('status','approved')->orderBy('created_at','ASC')->get();

        $team_detail=$this->about->first();
        $team = Team::orderByDesc('created_at')->first();
        $hikes  = Hike::where('status', 'active')->orderByDesc('created_at')->get();
		$outBond=$this->tripcategory->where('parent_id','!=',null)->where('bond_status','2')->where('status','active')->orderBy('position','ASC')->limit(6)->get();
        $data = [
            'banners'=>$banners,
            'hikes'=>$hikes,
            'team'=> $team,
        ];
        return view($this->folder_name.'index', $data)
        ->with('category',$tripcategory)
        ->with('trips',$trip)
        ->with('mega_special',$mega_special)
        ->with('informations',$information)
        ->with('blogs',$blog)
        ->with('team_detail',$team_detail)
		->with('bannerIcon',BannerIcon::where('status','1')->get())
		->with('outBonds',$outBond);
    }

    public function testimonialDetail(Request $request,$id)
    {
        $testimonial=Testimonial::findOrFail($id);

        return view('frontend.testimonialtest')
        ->with('testimonial',$testimonial);
    }
    public function test(){
        return view('frontend.test');
    }
    public function comment(Request $request,$id)
    {


        $country=[

            "Afghanistan",
        	"Albania",
        	"Algeria",
        	"American Samoa",
        	"Andorra",
        	"Angola",
        	"Anguilla",
        	"Antarctica",
        	"Antigua and Barbuda",
        	"Argentina",
        	"Armenia",
        	"Aruba",
        	"Australia",
        	"Austria",
        	"Azerbaijan",
        	"Bahamas (the)",
        	"Bahrain",
        	"Bangladesh",
        	"Barbados",
        	"Belarus",
        	"Belgium",
        	"Belize",
        	"Benin",
        	"Bermuda",
        	"Bhutan",
        	"Bolivia (Plurinational State of)",
        	"Bonaire, Sint Eustatius and Saba",
        	"Bosnia and Herzegovina",
        	"Botswana",
        	"Bouvet Island",
        	"Brazil",
        	"British Indian Ocean Territory (the)",
        	"Brunei Darussalam",
        	"Bulgaria",
        	"Burkina Faso",
        	"Burundi",
        	"Cabo Verde",
        	"Cambodia",
        	"Cameroon",
        	"Canada",
        	"Cayman Islands (the)",
        	"Central African Republic (the)",
        	"Chad",
        	"Chile",
        	"China",
        	"Christmas Island",
        	"Cocos (Keeling) Islands (the)",
        	"Colombia",
        	"Comoros (the)",
        	"Congo (the Democratic Republic of the)",
        	"Congo (the)",
        	"Cook Islands (the)",
        	"Costa Rica",
        	"Croatia",
        	"Cuba",
        	"Curaçao",
        	"Cyprus",
        	"Czechia",
        	"Côte d'Ivoire",
        	"Denmark",
        	"Djibouti",
        	"Dominica",
        	"Dominican Republic (the)",
        	"Ecuador",
        	"Egypt",
        	"El Salvador",
        	"Equatorial Guinea",
        	"Eritrea",
        	"Estonia",
        	"Eswatini",
        	"Ethiopia",
        	"Falkland Islands (the) [Malvinas]",
        	"Faroe Islands (the)",
        	"Fiji",
        	"Finland",
        	"France",
        	"French Guiana",
        	"French Polynesia",
        	"French Southern Territories (the)",
        	"Gabon",
        	"Gambia (the)",
        	"Georgia",
        	"Germany",
        	"Ghana",
        	"Gibraltar",
        	"Greece",
        	"Greenland",
        	"Grenada",
        	"Guadeloupe",
        	"Guam",
        	"Guatemala",
        	"Guernsey",
        	"Guinea",
        	"Guinea-Bissau",
        	"Guyana",
        	"Haiti",
        	"Heard Island and McDonald Islands",
        	"Holy See (the)",
        	"Honduras",
        	"Hong Kong",
        	"Hungary",
        	"Iceland",
        	"India",
        	"Indonesia",
        	"Iran (Islamic Republic of)",
        	"Iraq",
        	"Ireland",
        	"Isle of Man",
        	"Israel",
        	"Italy",
        	"Jamaica",
        	"Japan",
        	"Jersey",
        	"Jordan",
        	"Kazakhstan",
        	"Kenya",
        	"Kiribati",
        	"Korea (the Democratic People's Republic of)",
        	"Korea (the Republic of)",
        	"Kuwait",
        	"Kyrgyzstan",
        	"Lao People's Democratic Republic (the)",
        	"Latvia",
        	"Lebanon",
        	"Lesotho",
        	"Liberia",
        	"Libya",
        	"Liechtenstein",
        	"Lithuania",
        	"Luxembourg",
        	"Macao",
        	"Madagascar",
        	"Malawi",
        	"Malaysia",
        	"Maldives",
        	"Mali",
        	"Malta",
        	"Marshall Islands (the)",
        	"Martinique",
        	"Mauritania",
        	"Mauritius",
        	"Mayotte",
        	"Mexico",
        	"Micronesia (Federated States of)",
        	"Moldova (the Republic of)",
        	"Monaco",
        	"Mongolia",
        	"Montenegro",
        	"Montserrat",
        	"Morocco",
        	"Mozambique",
        	"Myanmar",
        	"Namibia",
        	"Nauru",
        	"Nepal",
        	"Netherlands (the)",
        	"New Caledonia",
        	"New Zealand",
        	"Nicaragua",
        	"Niger (the)",
        	"Nigeria",
        	"Niue",
        	"Norfolk Island",
        	"Northern Mariana Islands (the)",
        	"Norway",
        	"Oman",
        	"Pakistan",
        	"Palau",
        	"Palestine, State of",
        	"Panama",
        	"Papua New Guinea",
        	"Paraguay",
        	"Peru",
        	"Philippines (the)",
        	"Pitcairn",
        	"Poland",
        	"Portugal",
        	"Puerto Rico",
        	"Qatar",
        	"Republic of North Macedonia",
        	"Romania",
        	"Russian Federation (the)",
        	"Rwanda",
        	"Réunion",
        	"Saint Barthélemy",
        	"Saint Helena, Ascension and Tristan da Cunha",
        	"Saint Kitts and Nevis",
        	"Saint Lucia",
        	"Saint Martin (French part)",
        	"Saint Pierre and Miquelon",
        	"Saint Vincent and the Grenadines",
        	"Samoa",
        	"San Marino",
        	"Sao Tome and Principe",
        	"Saudi Arabia",
        	"Senegal",
        	"Serbia",
        	"Seychelles",
        	"Sierra Leone",
        	"Singapore",
        	"Sint Maarten (Dutch part)",
        	"Slovakia",
        	"Slovenia",
        	"Solomon Islands",
        	"Somalia",
        	"South Africa",
        	"South Georgia and the South Sandwich Islands",
        	"South Sudan",
        	"Spain",
        	"Sri Lanka",
        	"Sudan (the)",
        	"Suriname",
        	"Svalbard and Jan Mayen",
        	"Sweden",
        	"Switzerland",
        	"Syrian Arab Republic",
        	"Taiwan",
        	"Tajikistan",
        	"Tanzania, United Republic of",
        	"Thailand",
        	"Timor-Leste",
        	"Togo",
        	"Tokelau",
        	"Tonga",
        	"Trinidad and Tobago",
        	"Tunisia",
        	"Turkey",
        	"Turkmenistan",
        	"Turks and Caicos Islands (the)",
        	"Tuvalu",
        	"Uganda",
        	"Ukraine",
        	"United Arab Emirates (the)",
        	"United Kingdom of Great Britain and Northern Ireland (the)",
        	"United States Minor Outlying Islands (the)",
        	"United States of America (the)",
        	"Uruguay",
        	"Uzbekistan",
        	"Vanuatu",
        	"Venezuela (Bolivarian Republic of)",
        	"Viet Nam",
        	"Virgin Islands (British)",
        	"Virgin Islands (U.S.)",
        	"Wallis and Futuna",
        	"Western Sahara",
        	"Yemen",
        	"Zambia",
        	"Zimbabwe",
        	"Åland Islands"
            ];

            $trip=Trip::where('status','active')->get();
            $trip_id=Trip::where('id',$id)->first();



        return view($this->folder_name.'comment')
        ->with('country',$country)
        ->with('trips',$trip)
        ->with('trip_id',$trip_id);
    }

    public function shareComment()
    {
        return view($this->folder_name.'comment');
    }

    public function book(Request $request,$id)
    {
       	$trip_title = Trip::where('id',$id)->firstOrfail();
		return view('frontend.book')
        ->with('trip_id',$id)
        ->with('trip_title', $trip_title)
        ->with('title', $trip_title->title);
    }

    public function saveBooking(BookingRequest $request)
    {

        DB::beginTransaction();
      try{
           $data=$request->all();
        //   dd($data);
           $this->booking->fill($data);
           $status=$this->booking->save();
           $trip=Trip::where('id',$request->trip_id)->first();
           if($request->member_name[0])
           {
               $count=count($request->member_name);

               for($i=0;$i<$count;$i++)
               {
                   $this->booker_detail->create([
                       'bookings_id'=>$this->booking->id,
                       'member_name'=>$request->member_name[$i],
                       'member_email'=>$request->member_email[$i]
                       ]);
               }
           }


              Mail::to($request->email)->send(new BookingMail($this->booking));
             Mail::to('himalayanglimpse1@gmail.com')->send(new AdminBookingMail($this->booking));
           $request->session()->flash('success','Your Trip Has Been Booked Successfully');
            DB::commit();
           return redirect()->route('confirmation',$trip->slug);
          } catch (\Throwable $th) {
            DB::rollBack();
              $request->session()->flash('error','Sorry !! There Was A Problem While Booking Your Trip');
                return redirect()->back();
         }
    }



    public function confirmation(Request $request,$slug)
    {
        $trip=Trip::where('slug',$slug)->first();
        return view('frontend.confirmation')
        ->with('trip',$trip);
    }

    public function saveComment(TripCommentRequest $request)
    {
        // dd($request->all());
        $data=$request->except('image');
        if($request->image)
        {
            $image=uploadImage($request->image,'comment','400x400');
            if($image)
            {
                $data['image']=$image;
            }
        }

        // $data['trip_id']=$request->trip_id;



        $this->trip_comment->fill($data);
        $status=$this->trip_comment->save();
        if($status)
        {
            session()->flash('success','Your Comment Has Been Added Successfully !!');
        }
        else

        {
            session()->flash('error','Sorry !! There Was A Problem While Adding Your Comment');
        }

        return redirect()->back();
    }

    // TripCategory/{subCategory}
    public function tripcategory(Request $request, $slug)
    {

        $category =$this->tripcategory->where('slug',$slug)->first();
        $trips=$category->category_trips()->paginate(9);
        $information=$this->information->where('status','active')->get();

        return view($this->folder_name.'listing')
        ->with('category',$category)
        ->with('trips',$trips)
        ->with('informations',$information);
    }

    public function inquiry(Request $request,$id)
    {

        $trip=Trip::findOrFail($id);

         $country=[

            "Afghanistan",
        	"Albania",
        	"Algeria",
        	"American Samoa",
        	"Andorra",
        	"Angola",
        	"Anguilla",
        	"Antarctica",
        	"Antigua and Barbuda",
        	"Argentina",
        	"Armenia",
        	"Aruba",
        	"Australia",
        	"Austria",
        	"Azerbaijan",
        	"Bahamas (the)",
        	"Bahrain",
        	"Bangladesh",
        	"Barbados",
        	"Belarus",
        	"Belgium",
        	"Belize",
        	"Benin",
        	"Bermuda",
        	"Bhutan",
        	"Bolivia (Plurinational State of)",
        	"Bonaire, Sint Eustatius and Saba",
        	"Bosnia and Herzegovina",
        	"Botswana",
        	"Bouvet Island",
        	"Brazil",
        	"British Indian Ocean Territory (the)",
        	"Brunei Darussalam",
        	"Bulgaria",
        	"Burkina Faso",
        	"Burundi",
        	"Cabo Verde",
        	"Cambodia",
        	"Cameroon",
        	"Canada",
        	"Cayman Islands (the)",
        	"Central African Republic (the)",
        	"Chad",
        	"Chile",
        	"China",
        	"Christmas Island",
        	"Cocos (Keeling) Islands (the)",
        	"Colombia",
        	"Comoros (the)",
        	"Congo (the Democratic Republic of the)",
        	"Congo (the)",
        	"Cook Islands (the)",
        	"Costa Rica",
        	"Croatia",
        	"Cuba",
        	"Curaçao",
        	"Cyprus",
        	"Czechia",
        	"Côte d'Ivoire",
        	"Denmark",
        	"Djibouti",
        	"Dominica",
        	"Dominican Republic (the)",
        	"Ecuador",
        	"Egypt",
        	"El Salvador",
        	"Equatorial Guinea",
        	"Eritrea",
        	"Estonia",
        	"Eswatini",
        	"Ethiopia",
        	"Falkland Islands (the) [Malvinas]",
        	"Faroe Islands (the)",
        	"Fiji",
        	"Finland",
        	"France",
        	"French Guiana",
        	"French Polynesia",
        	"French Southern Territories (the)",
        	"Gabon",
        	"Gambia (the)",
        	"Georgia",
        	"Germany",
        	"Ghana",
        	"Gibraltar",
        	"Greece",
        	"Greenland",
        	"Grenada",
        	"Guadeloupe",
        	"Guam",
        	"Guatemala",
        	"Guernsey",
        	"Guinea",
        	"Guinea-Bissau",
        	"Guyana",
        	"Haiti",
        	"Heard Island and McDonald Islands",
        	"Holy See (the)",
        	"Honduras",
        	"Hong Kong",
        	"Hungary",
        	"Iceland",
        	"India",
        	"Indonesia",
        	"Iran (Islamic Republic of)",
        	"Iraq",
        	"Ireland",
        	"Isle of Man",
        	"Israel",
        	"Italy",
        	"Jamaica",
        	"Japan",
        	"Jersey",
        	"Jordan",
        	"Kazakhstan",
        	"Kenya",
        	"Kiribati",
        	"Korea (the Democratic People's Republic of)",
        	"Korea (the Republic of)",
        	"Kuwait",
        	"Kyrgyzstan",
        	"Lao People's Democratic Republic (the)",
        	"Latvia",
        	"Lebanon",
        	"Lesotho",
        	"Liberia",
        	"Libya",
        	"Liechtenstein",
        	"Lithuania",
        	"Luxembourg",
        	"Macao",
        	"Madagascar",
        	"Malawi",
        	"Malaysia",
        	"Maldives",
        	"Mali",
        	"Malta",
        	"Marshall Islands (the)",
        	"Martinique",
        	"Mauritania",
        	"Mauritius",
        	"Mayotte",
        	"Mexico",
        	"Micronesia (Federated States of)",
        	"Moldova (the Republic of)",
        	"Monaco",
        	"Mongolia",
        	"Montenegro",
        	"Montserrat",
        	"Morocco",
        	"Mozambique",
        	"Myanmar",
        	"Namibia",
        	"Nauru",
        	"Nepal",
        	"Netherlands (the)",
        	"New Caledonia",
        	"New Zealand",
        	"Nicaragua",
        	"Niger (the)",
        	"Nigeria",
        	"Niue",
        	"Norfolk Island",
        	"Northern Mariana Islands (the)",
        	"Norway",
        	"Oman",
        	"Pakistan",
        	"Palau",
        	"Palestine, State of",
        	"Panama",
        	"Papua New Guinea",
        	"Paraguay",
        	"Peru",
        	"Philippines (the)",
        	"Pitcairn",
        	"Poland",
        	"Portugal",
        	"Puerto Rico",
        	"Qatar",
        	"Republic of North Macedonia",
        	"Romania",
        	"Russian Federation (the)",
        	"Rwanda",
        	"Réunion",
        	"Saint Barthélemy",
        	"Saint Helena, Ascension and Tristan da Cunha",
        	"Saint Kitts and Nevis",
        	"Saint Lucia",
        	"Saint Martin (French part)",
        	"Saint Pierre and Miquelon",
        	"Saint Vincent and the Grenadines",
        	"Samoa",
        	"San Marino",
        	"Sao Tome and Principe",
        	"Saudi Arabia",
        	"Senegal",
        	"Serbia",
        	"Seychelles",
        	"Sierra Leone",
        	"Singapore",
        	"Sint Maarten (Dutch part)",
        	"Slovakia",
        	"Slovenia",
        	"Solomon Islands",
        	"Somalia",
        	"South Africa",
        	"South Georgia and the South Sandwich Islands",
        	"South Sudan",
        	"Spain",
        	"Sri Lanka",
        	"Sudan (the)",
        	"Suriname",
        	"Svalbard and Jan Mayen",
        	"Sweden",
        	"Switzerland",
        	"Syrian Arab Republic",
        	"Taiwan",
        	"Tajikistan",
        	"Tanzania, United Republic of",
        	"Thailand",
        	"Timor-Leste",
        	"Togo",
        	"Tokelau",
        	"Tonga",
        	"Trinidad and Tobago",
        	"Tunisia",
        	"Turkey",
        	"Turkmenistan",
        	"Turks and Caicos Islands (the)",
        	"Tuvalu",
        	"Uganda",
        	"Ukraine",
        	"United Arab Emirates (the)",
        	"United Kingdom of Great Britain and Northern Ireland (the)",
        	"United States Minor Outlying Islands (the)",
        	"United States of America (the)",
        	"Uruguay",
        	"Uzbekistan",
        	"Vanuatu",
        	"Venezuela (Bolivarian Republic of)",
        	"Viet Nam",
        	"Virgin Islands (British)",
        	"Virgin Islands (U.S.)",
        	"Wallis and Futuna",
        	"Western Sahara",
        	"Yemen",
        	"Zambia",
        	"Zimbabwe",
        	"Åland Islands"
            ];
        return view('frontend.inquiry')
        ->with('country',$country)
        ->with('trip',$trip);
    }

    public function saveInquiry(InquiryRequest $request,$slug)
    {

        $trip=Trip::where('slug',$slug)->first();
        // dd($req1uest->all());

        $data=$request->all();
        $this->inquiry->fill($data);
        $status=$this->inquiry->save();
        if($status)
        {
            $request->session()->flash('success','Your Message Has Been Sent Successfully !');

            Mail::to('himalayanglimpse1@gmail.com')->send(new AdminEnquiry($this->inquiry));
            Mail::to($request->email)->send(new Enquiry($this->inquiry));
            $trip=Trip::where('slug',$slug)->first();
            return view('frontend.confirmation')
            ->with('trip',$trip);
        }
        else
        {
            $request->session()->flash('error','Sorry !! There Was A Problem While Sending Your Message');
            return redirect()->back();
        }


    }

    public function searchNextTrip(Request $request)
    {
        $trip=Trip::where('title','LIKE','%'.$request->search.'%')->where('status', 'active')->orderBy('trip_cat_position')->get();

        return view('frontend.search')
        ->with('trips',$trip)
        ->with('name',$request->search);

    }




    //Trip Dispatch or cybercast single
    public function tripDispatchSingle(Request $request,$slug)
    {
        // dd($slug);
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
        $train=$this->trip->getTrain;
        $trip_gear = TripGear::where('trip_id', $this->trip->id)->first();

        $information=$this->information->where('status','active')->get();
        $why_mega = $this->why_mega->where('status', 'active')->first();

        $trip_comment=TripComment::where('trip_id',$this->trip->id)->get();
        $trip_date=$this->trip->getDate;
        $trip_faq=$this->trip->getFaq;
        $galleries = TripGallery::where('trip_id', $this->trip->id)->get();

    // dd($this->trip->tripFaq);

        $faq = $this->trip->tripFaq;

        // return view('frontend.single')
        return view('frontend.single')
        ->with('trip',$this->trip)
        ->with('overview',$overview)
        ->with('informations',$information)
        ->with('itineary',$itineary)
        ->with('why_mega', $why_mega)
        ->with('faq', $faq)
        ->with('train',$train)
        ->with('trip_comments',$trip_comment)
        ->with('trip_date',$trip_date)
        ->with('trip_faq',$trip_faq)
        ->with('galleries', $galleries)
        ->with('trip_gear', $trip_gear);
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
        dd('ok');
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
        // dd($request->all());
        DB::beginTransaction();
        try {

            $subscribed = Subscriber::where('email',$request->email)->get();
            if($subscribed->count() > 1)
            {
                Toastr::warning('This email has already been subscribed');
                return back();
            }
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
                $testimonials = Testimonial::orderBy('position')->where('status', 'active')->paginate(4);
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
                $trip=$this->trip->where('mega_special_trip','1')->orderBy('title')->get();
                return view($this->folder_name.'megaSpecial')
                ->with('trips',$trip)->with('meta', $meta);
                break;
            case 'contact-us':
                return view($this->folder_name.'contact')->with('meta', $meta);
                break;
            case 'trip-dispatch':
                $cybercasts = CyberCast::orderBy("title")->get();
                $data = [
                    'cybercasts'=>$cybercasts
                ];
                return view($this->folder_name.'tripDispatch', $data)->with('meta', $meta);
                break;
             case 'find-your-trip':
                 $trip=$this->trip->where('status','active')->paginate(10);

                 $parentCategory=TripCategory::whereNull('parent_id')->get();
                 $subCategory=TripCategory::where('parent_id','!=',null)->get();
                 return view($this->folder_name.'category')
                 ->with('trips',$trip)
                 ->with('parentCategory',$parentCategory)
                 ->with('subCategory',$subCategory)->with('meta', $meta);
                 break;
            case 'blog':
                $blogs = Post::orderByDesc('created_at')->where('status', 'active')->get();
                $menu = Menu::where('category_slug', 'blog')->first();

                return view($this->folder_name.'bloglist')->with('blogs', $blogs)
				->with('menu', $menu);
                break;

			case 'gallery-list':
				return view($this->folder_name.'gallery-list');
				break;
			case 'our-team':
				$team=Team::orderBy('in_order','ASC')->get();
				return view($this->folder_name.'teamdata')->with('meta',$meta)
				->with('teams',$team);
				break;

            default:
                abort(404, 'Not Found');
                break;
       }
    }




   public function generalPage($slug)
    {
        $data = Menu::where('title_slug', $slug)->first();
        return view('frontend.general-page', compact('data'));

    }

	public function galleryDetail($slug)
	{
		// $galleries = Gallery::where('id', $slug)->first();
		return view($this->folder_name.'gallery-details');
	}


    public function singleBlog($slug)
    {
		// dd('test');
		$postCategories = PostCategory::get();
        $blog = Post::where('slug', $slug)->firstOrFail();
        $next_blog=Post::where('id','>',$blog->id)->first();
        $data = [
			'postCategories'=>$postCategories,
            'blog'=>$blog,
        ];
        return view($this->folder_name.'blogsingle', $data)
        ->with('next_blog',$next_blog);
    }

    public function searchTrip(Request $request)
    {

        if($request->category_name=='parent')
        {
            $category=TripCategory::findOrFail($request->category_id);
            // $data =$category->getCategoryTrip;
            $data = Trip::select('trips.summary',
            'trips.banner_image',
            'trips.title',
            'trips.summary',
            'trips.trip_duration',
            'trips.trip_cost',
            'trips.slug',
            'trips.id'
            )->join('trip_category_lists', 'trip_category_lists.trip_id', '=', 'trips.id')
            ->join('trip_categories', 'trip_category_lists.category_id', '=', 'trip_categories.id')
            ->where('trip_category_lists.category_id', $category->id)
            ->where('trips.status','active')->paginate(10);
        }
        else if($request->category_name=='subparent')
        {

            $category=TripCategory::findOrFail($request->category_id);

            // $data =$category->category_trip;
            $data = Trip::select('trips.summary',
            'trips.banner_image',
            'trips.title',
            'trips.summary',
            'trips.trip_duration',
            'trips.trip_cost',
            'trips.slug',
            'trips.id'
            )->join('trip_category_lists', 'trip_category_lists.trip_id', '=', 'trips.id')
            ->join('trip_categories', 'trip_category_lists.category_id', '=', 'trip_categories.id')
            ->where('trip_category_lists.category_id', $category->id)
            ->where('trips.status','active')->paginate(10);

        }
        else
        {
            $item=$request->category_name;
            if($item=='all')
            {
                $data =Trip::where('status','active')->paginate(10);
            }
            else if($item=='16')
            {
                $data=Trip::whereBetween('trip_duration',['10','16'])->where('trips.status','active')->paginate(10);
            }

            else if($item=='31')
            {
                $data=Trip::whereBetween('trip_duration',['16','31'])->where('trips.status','active')->paginate(10);
            }

            else if($item=='46')
            {
                $data=Trip::whereBetween('trip_duration',['31','46'])->where('trips.status','active')->paginate(10);
            }

            else
            {
                $data=Trip::where('trip_duration','>=','46')->where('trips.status','active')->paginate(10);
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



    // Ajax Call Started from here
    // hikes Ajax
     public function getHikes($id=null)
    {
        // return "hello";
        if($id == null){
            $id = Hike::orderByDesc('created_at')->where('status', 'active')->first()->id;
        }
        $hikes  = Hike::where('status', 'active')->orderByDesc('created_at')->where('id', '<', $id)->take(4)->get();
        $data['hikes']=$hikes;

        if(request()->ajax()){
            return view('frontend.ajax.hike', $data);
            return response();
        }else{
            return back();
        }
    }

    // trip dispatch ajax
     public function tripDispatch($id=null)
    {

       if ($id == null) {
            $id = CyberCast::orderByDesc("created_at")->where('status', 'active')->first()->id;
            $id++;
        }

        $cybercasts = CyberCast::where('status', 'active')->orderByDesc("created_at")->where('id', '<', $id)->take(3)->get();
        $data = [
            'cybercasts'=>$cybercasts
        ];
        if (request()->ajax()) {
            return view('frontend.ajax.tripdispatch', $data);
            return response();
        }
    }

    // Single Page trip comments Ajax call
     public function getTripComment($trip_id, $id=null)
        {
            if ($id == null) {
                $id = TripComment::orderByDesc("created_at")->where('trip_id', $trip_id)->first()->id;
                $id++;
            }

            $trip_comments = TripComment::orderByDesc('created_at')->where('id', '<', $id)->where('trip_id', $trip_id)->take(1)->get();

            $data = [
                'trip_comments'=>$trip_comments,
            ];

            if (request()->ajax()) {
                return view('frontend.ajax.tripcomments', $data);
                return response();
            }
        }


    // Ajax Call of Testimonial
    public function backendTestimonials($id=null)
    {

        if ($id == null) {
            $id = 0;
            $testimonials = Testimonial::where('status', 'active')->orderBy('position')->where('position', '>', $id)->take(3)->get();
        }
        else
        {
            $id=Testimonial::findOrFail($id)->position;
            $testimonials = Testimonial::where('status', 'active')->orderBy('position')->where('position', '>', $id)->take(3)->get();

            // $id = Testimonial::where('status', 'active')->orderBy('position')->first()->id;
        }


        $data = [
            'testimonials'=>$testimonials,
        ];

        if (request()->ajax()) {
            return view('frontend.ajax.backendtestimonial', $data);
            return response();
        }

    }





    public function gearlist(Request $request, $id)
    {
        $gears_details = TripGear::where('trip_id', $id)->first();

        // return $gears_details->gear_description;
        return view('frontend.gear-list')->with('gears_details',$gears_details);
    }

     public function infoPrevious($id)
    {

        $information = Information::orderBy('id', 'DESC')->where('id', '<', $id)->first();
        $data = [
            'information' => $information,
        ];
        return view($this->folder_name.'information-detail', $data);
    }

    public function infoNext($id)
    {
        $information = Information::orderBy('id', 'ASC')->where('id', '>', $id)->first();
        $allinfo=Information::get();

        $value=count($allinfo);
        $lastinfo=$allinfo[$value-1];
        $hide=false;

        if($information->id == $lastinfo->id)
        {
            $hide=true;
        }

        $data = [
            'information' => $information,
            'hide'=>$hide
        ];
        return view($this->folder_name.'information-detail', $data);
    }

      public function cyberPrevious ($id)
    {
        $cybercastpost = CyberCastPost::orderBy('id', 'DESC')->where('id', '<', $id)->first();
        $data = [
            'cybercastpost'=> $cybercastpost
        ];
        return view($this->folder_name.'cybercastpost-single', $data);
    }

    public function cyberNext($id)
    {
        $cybercastpost = CyberCastPost::orderBy('id', 'ASC')->where('id', '>', $id)->first();
        $allcyber = CyberCastPost::where('status', 'active')->get();

        $value = count($allcyber);

        $lastinfo=$allcyber[$value-1];
        $hide=false;

        if ($cybercastpost->id == $lastinfo->id)
        {
            $hide = true;
        }

        $data = [
            'cybercastpost'=>$cybercastpost,
            'hide'=>$hide
        ];

        return view($this->folder_name.'cybercastpost-single', $data);

    }

	public function getMenuTrip(Request $request,$slug)
	{
		$menu=Menu::where('slug',$slug)->firstOrFail();

		$category =TripCategory::findOrFail($menu->trip_selection);

		$trips=$category->category_trips()->paginate(9);

		// dd($trips);
		return view('frontend.listing')
		->with('category',$category)
        ->with('trips',$trips);
	}


    // public function tripCategoryTest()
    // {
    //     return view('frontend.tripCategoryTest');
    // }

    public function tripSingleTest()
    {
        return view('frontend.tripSingleTest');
    }

    public function destinationTestTest()
    {
        return view('frontend.destinationTestTest');
    }

    public function dummyTest()
    {
        return view('frontend.dummyTest');
    }

	public function tripCategoryDetail(Request $request,$slug)
	{
		$tripCategory=$this->tripcategory->where('slug',$slug)->firstOrFail();
		$trips=$tripCategory->category_trips;
		$trips=collect($trips)->unique('id')->sortBy('trip_cat_position');
        $meta=[
            'meta_title'=>$slug,
            'meta_description'=>$tripCategory->summary,
            'meta_keyword'=>$tripCategory->description

        ];
		return view('frontend.tripCategoryTest')
		->with('category',$tripCategory)
		->with('trips',$trips)
        ->with('meta',$meta);
	}

	public function popularDestination(Request $request,$slug)
	{
		$destination=Destination::where('slug',$slug)->firstOrFail();
		$allDestination=Destination::where('id','!=',$destination->id)->get();
		return view('frontend.destinationSingle')
		->with('allDestination',$allDestination)
		->with('destination',$destination);
	}

	public function callBack()
	{
		return view('frontend.callback');
	}

    public function saveTripBooking(TripBookSaveRequest $request)
    {

    session()->forget('bookData');
       DB::beginTransaction();
       try{
            $customer=auth()->guard('customer')->user();
            if($customer)
            {
                $request['customer_id']=auth()->guard('customer')->user()->id;
                $data=(new TripBookStore($request))->store();
                event(new TripBookEvent($data));
                DB::commit();
                Toastr::success('Success', 'Thank You');
                return back();
            }
            else
            {
                $trip=Trip::findOrFail($request->trip_id)->value('title');
                $request['trekname']=$trip;
                $data=$request->all();
                session()->put('bookData',$request->all());
                return view('frontend.customerbookloginverify');
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning('Something Went Wrong', 'OOPs !!!');
        }

    }

    public function getReview(Request $request,$slug)
    {
        $trip=Trip::whereSlug($slug)->firstOrFail();

        return view('frontend.review')
        ->with('trip',$trip);
    }

    public function addReview(Request $request)
    {
        $validate=$request->validate([
            'title'=>'required|string',
            'full_name'=>'required|string',
            'review_title'=>'required|string',
            'description'=>'required|string',
            'rating'=>'required|integer|between:1,5',
            'g-recaptcha-response'=>'required|string'
        ],$request->all());
        DB::beginTransaction();
       try{
            $review=Review::create($request->all());
            $setting=Setting::first();
            Mail::to(@$setting->email ?? 'rupakotholidays1@gmail.com')->send(new ReviewMail($review));
            DB::commit();
            Toastr::success('Success', 'Thank You');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::warning('Something Went Wrong', 'OOPs !!!');
        }
        return back();
    }

    public function reviewDetail($id)
    {
        $review = Review::find($id);
        return view('frontend.testimonialtest')
        ->with('review',$review);
    }

    public function inboundCategory()
    {
        $tripcategory=$this->tripcategory->where('parent_id','!=',null)->where('bond_status','1')->orderBy('position','ASC')->get();
        return view('frontend.categoryinboundlis')
        ->with('category',$tripcategory);
    }

    public function specialList()
    {
        $mega_special=$this->trip->where('mega_special_trip','1')->orderBy('trip_special_position','ASC')->get();
        return view('frontend.popularlist')
        ->with('mega_special',$mega_special);
    }

    public function outboundList()
    {
        $outBond=$this->tripcategory->where('parent_id','!=',null)->where('bond_status','2')->orderBy('position','ASC')->get();
        return view('frontend.outboundlist')
        ->with('outBonds',$outBond);
    }

    public function adventureList()
    {
        $blog=$this->post->where('status','active')->orderBy('position','ASC')->get();
        return view('frontend.adventurelist')
        ->with('blogs',$blog);
    }


    public function saveAlert(Request $request)
    {
        $request->session()->put('alertCancel','sumit');
        $response = new Response('Hello World');
        $response->cookie('alertCookie', 'Friends', 60 * 24 * 10);
        return redirect()->back();
    }
}
