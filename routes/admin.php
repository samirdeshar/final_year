<?php

use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\ShortUrl\ShortUrlController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

//  -----------------------------------------------Backend Admin Routes Starts Here-------------------------------------
Route::group(['prefix'=>'admin','namespace'=>'App\Http\Controllers','middleware'=>'auth'],function()
    {
        Route::get('/test','Admin\trip\tripController@test')->name('test');
        Route::put('/user/update-profile/{id}', 'UserController@updateProfile')->name('user.update-profile');
        Route::put('/user/update-password/{slug}', 'UserController@updatePassword')->name('user.update-password');
        Route::get('/tripcateproduct/{slug}','Admin\Trip\TripCategoryController@tripCategoryTrip')->name('tripcateproduct');
        Route::post('/updateTripcategoryTripPosition','Admin\Trip\TripCategoryController@updateTripcategoryTripPosition')->name('updateTripcategoryTripPosition');

        // --------------------------Post Routes Starts Here---------------------------------------------

            // Route::resource('post','Admin\Post\PostController');

            Route::resource('/post','Admin\Post\PostController');
            Route::get('/post/update_status/{id}/{status}','Admin\Post\PostController@updateStatus')->name('post-update-status');
            Route::post('/post-action','Admin\Post\PostController@toPost')->name('to-post');
            Route::get('/post/status/{status}','Admin\Post\PostController@getPostStatus')->name('get-post-status');

            Route::resource('postcategory','Admin\Post\PostCategoryController');
            Route::post('/cat-action','Admin\Post\PostCategoryController@toPostCat')->name('to-post-cat');

            Route::resource('/posttag','Admin\Post\PostTagController');
            Route::post('/tag-action','Admin\Post\PostTagController@toPostTag')->name('to-post-tag');

        // --------------------------Post Routes Ends Here---------------------------------------------


        Route::post('/updatePostPosition','Admin\Post\PostController@updatePostPosition')->name('updatePostPosition');
        // -----------------------------------Team Routes Starts Here-----------------------------------
            Route::resource('/teamcategory','Admin\Team\TeamCategoryController');
            Route::post('/teamcat-action','Admin\Team\TeamController@toTeam')->name('to-team-cat');
            Route::resource('/team','Admin\Team\TeamController');
            Route::post('updateTeam','Admin\Team\TeamController@updateTeamOrder')->name('updateTeamOrder');

            Route::get('/team/update-status/{id}/{status}','Admin\Team\TeamController@updateStatus')->name('team-update-status');
            Route::get('/team/status/{status}','Admin\Team\TeamController@getTeamStatus')->name('get-team-status');
            Route::post('/team-action','Admin\Team\TeamController@toTeam')->name('to-team');
        // -----------------------------------Team Routes Ends Here-----------------------------------


 // -----------------------------------Awards Routes Ends Here-----------------------------------
        Route::resource('awards', 'Admin\Awards\AwardController');
        Route::get('/awards/update-status/{id}/{status}','Admin\Awards\AwardController@updateStatus')->name('awards-update-status');
        Route::get('/awards/status/{status}','Admin\Awards\AwardController@getawardsStatus')->name('get-awards-status');
        Route::post('/awards-action','Admin\Awards\AwardController@toAwards')->name('to-awards');



        Route::resource('/awardscategory','Admin\Awards\AwardCategoryController');
        Route::post('/awardscat-action','Admin\Awards\AwardController@toAwardsCat')->name('to-awards-cat');
        Route::post('/awardscat-action','Admin\Awards\AwardCategoryController@toAwardsCat')->name('to-awardscat-cat');
        Route::post('update','Admin\Awards\AwardController@updateAwardsOrder')->name('updateAwardsOrder');



        Route::post('ckeditor', 'CkeditorFileUploadController@store')->name('ckeditor.upload');
// about route started

    Route::resource('setting', 'Admin\Setting\SettingController');
    Route::resource('about', 'Admin\About\AboutController');


// ----------------------------------------Testimonial---------------------------
// Testimonial
    Route::resource('testimonial', 'Admin\Testimonial\TestimonialController');
    Route::post('testimonial/position', 'Admin\Testimonial\TestimonialController@updatePosition')->name('updateTestimonialPosition');
    Route::post('partner/position', 'Admin\Testimonial\TestimonialController@updatePartnerPosition')->name('updatePartnerPosition');
    Route::get('testimonial/updat_status{id}/{status}', 'Admin\Testimonial\TestimonialController@updateStatus')->name('update-testimonial-status');
// ------------------------------------------testimonial-----------------------------

// ----------------------------------------Information---------------------------
// Information
Route::resource('information', 'Admin\Information\InformationController');
Route::get('information/updat_status{id}/{status}', 'Admin\Information\InformationController@updateStatus')->name('information-update-status');
Route::get('/information/status/{status}','Admin\Information\InformationController@getInformationStatus')->name('get-information-status');
Route::post('/information-action','Admin\Information\InformationController@toInformation')->name('to-information');


// ---------------------------------------Faq---Information-----------------------------



        // General Faq
        Route::resource('generalFaq', 'Admin\Faqs\GeneralFaqController');
        Route::get('generalFaq/update/status/{id}', 'Admin\Faqs\GeneralFaqController@updateStatus')->name('update-generalFaq-status');
        // Bul Action
        Route::post('generalFaq/select/delet', 'Admin\Faqs\GeneralFaqController@destroyBulk')->name('to-perform-generalFaq');
        // Search Status
        Route::get('generalFaq/search/status/{status}', 'Admin\Faqs\GeneralFaqController@searchStatus')->name('get-generalFaq-status');


        // ----------------------------general page ---------------------------------------------
        // General Page
        Route::resource('generalPage', 'Admin\Pages\GeneralPageController');
        // Bulk Action
        Route::post('to-generalPage', 'Admin\Pages\GeneralPageController@deleteBulk')->name('to-generalPage');
        // Status Update
        Route::get('generalPage-update-status/{id}/', 'Admin\Pages\GeneralPageController@updateStatus')->name('generalPage-update-status');
        // Search with Status
        Route::get('get-generalPage-status/{status}', 'Admin\Pages\GeneralPageController@searchStatus')->name('get-generalPage-status');


        // Partner Or Afiliates & sister concerns
        Route::resource('partner', 'Admin\Partner\PartnerController');
        Route::post('partner/deleteBulk', 'Admin\Partner\PartnerController@deleteBulk')->name('to-partner-category');
        Route::get('Partner/update-status/{id}', 'Admin\Partner\PartnerController@updateStatus')->name('partner-update-status');


        // -----------------Menu---------------------
        Route::resource('/menu','MenuController');
        Route::post('updateMenu', [MenuController::class, 'updateMenuOrder'])->name('updateMenuOrder');
        Route::get('menu/link/course', [MenuController::class, 'menuLinkCourse'])->name('menuLinkCourse');
        Route::post('saveMenuCategory', [MenuController::class, 'create_menuCategory'])->name('saveMenuCategory');
        // -----------------/Menu---------------------

        Route::get('allbokking','Admin\BookingList\BookingListController@list')->name('allbokking');




        //---------------------------------Photo-------------------------------//

        Route::resource('photo', 'Admin\Gallery\PhotoController');
        Route::get('/photo/status/{status}','Admin\Gallery\PhotoController@getphotoStatus')->name('get-photo-status');
        Route::post('/photo-action','Admin\Gallery\PhotoController@toPhoto')->name('to-photo');
        Route::get('/photo/update_status/{id}/{status}','Admin\Gallery\photoController@updateStatus')->name('photo-update-status');
        //---------------------------------video-------------------------------//
        Route::resource('video', 'Admin\Gallery\VideoController');
        Route::get('/video/status/{status}','Admin\Gallery\VideoController@getVideoStatus')->name('get-video-status');
        Route::post('/video-action','Admin\Gallery\VideoController@toVideo')->name('to-video');
        Route::get('/video/update_status/{id}/{status}','Admin\Gallery\VideoController@updateStatus')->name('video-update-status');


    });

        Route::group(['namespace'=>'App\Http\Controllers','middleware'=>'auth'],function(){
        Route::post('/delete-image','Admin\Trip\TripController@get');

    });

    Route::resource('admin/all-messages', ContactController::class)->middleware('auth');



// -----------------------------------------------Backend short Url       --------------------------------
    Route::get('short_url',[ShortUrlController::class, 'index']);
    Route::post('/shorten', [ShortUrlController::class, 'shorten'])->name('shorten');
    Route::get('shorten/{shortCode}', [ShortUrlController::class, 'redirect'])->name('shorten.redirect');
//  -----------------------------------------------Backend Admin Routes Ends Here-------------------------------------
