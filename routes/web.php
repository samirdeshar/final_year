<?php

use App\Models\Role;
use App\Models\Destination;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerIconController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\Trip\TripController;
use App\Http\Controllers\Frontend\FrontendController;


// use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });




    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
    Route::group(['middleware' => ['auth']], function() {
        Route::resource('user', UserController::class);
        Route::resource('permission', PermissionController::class);
        Route::resource('roles', RoleController::class);
    });
    Route::get('/be-friend',[FrontendController::class,'saveAlert'])->name('saveAlert');
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
//  -----------------------------------------------Backend Admin Routes Starts Here-------------------------------------


Route::get('/delete-galleryimage', [TripController::class, 'deletegalleryImage']);

Route::put('call-back/store','App\Http\Controllers\CallBackController@store')->name('callback.store');
// ------------------------------------------------Frontend Routes Started From Here-----------------------------------------
Route::group(['namespace'=>'App\Http\Controllers\Frontend'],function()
{
    Route::get('testimonial-details/{slug}',[FrontendController::class,'testimonialDetail'])->name('testimonial.details');
    // Frontend Index
    Route::get('/test',[FrontendController::class, 'test']);
    Route::get('/trip-categories/{slug}',[FrontendController::class, 'tripCategoryDetail'])->name('tripcategorydetail');
    Route::get('/tripSingleTest',[FrontendController::class, 'tripSingleTest']);
    Route::get('/destinationTest',[FrontendController::class, 'destinationTestTest']);
    Route::get('/dummyTest',[FrontendController::class,'dummyTest']);
    Route::get('','FrontendController@index')->name('index');
    Route::get('/share-comment','FrontendController@shareComment');


    Route::get('popular-destination/{slug}','FrontendController@popularDestination')->name('popular-destination');

    Route::get('search-next-trip','FrontendController@searchNextTrip')->name('search-nect-trip');
    Route::get('/comment/{id}','FrontendController@comment')->name('comment');
    Route::post('/save-comment','FrontendController@saveComment')->name('save-comment');

    Route::get('/gear-list{id}','FrontendController@gearlist')->name('gear.list');

    Route::get('/inquiry/{id}','FrontendController@inquiry')->name('inquiry');
    Route::post('/inquiry/{slug}','FrontendController@saveInquiry')->name('save-inquiry');

    Route::get('call-back','FrontendController@callBack')->name('call.back');

    Route::get('/book/{id}','FrontendController@book')->name('book');
    Route::put('/save-bokking','FrontendController@saveBooking')->name('sav-bokking');
    Route::get('/confirmation/{slug}','FrontendController@confirmation')->name('confirmation');

    Route::get('','FrontendController@index')->name('home');
    Route::get('{slug}', [FrontendController::class, 'getPage'])->name('category');

    Route::get('/home/categories/rp','FrontendController@inboundCategory')->name('home.categories');
    Route::get('/packages/special','FrontendController@specialList')->name('special.list');
    Route::get('/home/categories/ob','FrontendController@outboundList')->name('outbound.list');
    Route::get('adventure/index','FrontendController@adventureList')->name('adventure.list');

    Route::put('/sav-trip-bokking',[FrontendController::class,'saveTripBooking'])->name('sav-trip-bokking');
    Route::get('{content}', [FrontendController::class, 'generalPage'])->name('generalPage');
    Route::get('content-view/{content}', [FrontendController::class, 'generalPage'])->name('generalPages');
    // Route::get('/','FrontendController@index')->name('home');
    // Route::get('/','FrontendController@index')->name('home');
    // Route::get('','FrontendController@index')->name('home');

    // tripcategory/{subcategory}
    Route::get('/ies/{slug}', 'FrontendController@tripcategory')->name('ies');
    Route::get('/trip/{slug}','FrontendController@tripDetails')->name('trip-details');
    // trip/{trip}
    Route::get('trip/everest-base-camp-trek/', 'FrontendController@tripSingle')->name('frontend.trip');

    Route::get('trip-daily/{slug}', 'FrontendController@tripDispatchSingle')->name('frontend.tripDispatchSingle');
    // MegaSpecial
    Route::get('/mega-specials', 'FrontendController@megaSpecial')->name('frontend.megaSpecial');
    // About
    Route::get('/about', 'FrontendController@About')->name('frontend.page');
    // Contact US    Saving/ Messagingg
    Route::post('save-contact-post', 'FrontendController@contactStore')->name('frontend.contactStore');


    Route::get('/page/{slug}','FrontendController@detailPage')->name('detail.page');

    Route::get('/information/{slug}','FrontendController@informationDetail')->name('information-detail');

    // Testimonial list
    Route::get('/testimonials','FrontendController@TestimonialList')->name('frontend.testimonials');
    // Blog List
    Route::get('/blogs','FrontendController@Blogs')->name('frontend.blogs');
    // Category of blog
    Route::get('/blogCategory/{slug}', 'FrontendController@blogCategory')->name('frontend.blogCategory');
    // Single blog
    Route::get('/blogs/{slug}', 'FrontendController@singleBlog')->name('frontend.singleBlog');
    // Subscription
    Route::post('/subscribe', 'FrontendController@subscribe')->name('frontend.subscribe');
    // Find Yout Trip
    Route::get('/ies', 'FrontendController@findYourTrip')->name('frontend.tripcategory');


    // Generral faqs of footer on frontend

    Route::get('/general/faqs', 'FrontendController@generalfaqs')->name('frontend.generalfaqs');
    Route::get('/category/trip-search','FrontendController@searchTrip')->name('trip.search');
    Route::get('/category/trip-sort','FrontendController@sortTrip')->name('trip.sort');

    // Get Hike With Ajax
    Route::get('/get/ajax-hikes/{id?}', [FrontendController::class, 'getHikes'])->name('ajax-get-hikes');

    Route::get('/get/trip-daily-dispatch/{id?}','FrontendController@tripDispatch')->name('frontend.tripDispatch');


    // Trip Comment
    Route::get('/get/comments-trip/{trip_id}/{id?}', [FrontendController::class, 'getTripComment'])->name('get.tripComment');
    Route::get('/get/ajax-testimonials/{id?}', [FrontendController::class, 'backendTestimonials']);

    // Information Essential Previou & Next
    Route::get('/information/previous/{id}', [FrontendController::class, 'infoPrevious'])->name('information.detailFirst');
    Route::get('/information/next/{id}', [FrontendController::class, 'infoNext'])->name('information.detaillast');
    Route::get('/cybercast-post/previous/{id}', [FrontendController::class, 'cyberPrevious'])->name('cyberpost.previous');
    Route::get('/cybercast-post/next/{id}', [FrontendController::class, 'cyberNext'])->name('cyberpost.next');


    Route::get('/cybercaastotst/previous/{id}', [FrontendController::class, 'cyberPrevious'])->name('cybercastpost.previous');
    Route::get('/cybercaastotst/next/{id}', [FrontendController::class, 'cyberNext'])->name('cybercastpost.next');

    Route::get('gallery/{slug}', [FrontendController::class, 'galleryDetail'])->name('gallery.details');

    Route::get('/menu-category/trip/{slug}',[FrontendController::class,'getMenuTrip'])->name('getMenuTrip');


    Route::get('/review/index/{slug}',[FrontendController::class,'getReview'])->name('get.review');
    Route::put('/review/index/{slug}',[FrontendController::class,'addReview'])->name('store.review');
    Route::get('/review/{id}/detail',[FrontendController::class,'reviewDetail'])->name('review.details');
});


include __DIR__.'/admin.php';

