<?php

namespace App\Providers;

use App\Models\Admin\Faqs\GeneralFaq;
use App\Models\Admin\Partner\Partner;
use App\Models\Admin\Setting;
// use Facade\FlareClient\View;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Schema;
use App\Models\Admin\Trip\TripCategory;
use App\Models\Admin\Pages\GeneralPage;
use App\Models\Frontend\Contact;
use UniSharp\LaravelFilemanager\LaravelFilemanagerServiceProvider;
use Intervention\Image\ImageServiceProvider;

use App\Models\Menu;
// use App\Models\Service\Service;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        // -------------------------Project Section-----------------------------------
        View::composer(['frontend.layouts*'],function($view){
            $view->with('cat_menu',TripCategory::where('parent_id','!=',null)->where('display',1)->get());
        });

        View::composer(['frontend.layouts*'],function($view){
            $view->with('pages',GeneralPage::where('status','active')->get());
        });

        View::composer(['frontend*'],function($view){
            $view->with('setting',Setting::first());
        });


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    // Setting Sharing
        $setting = Setting::find(1);
        view()->share('setting', $setting);
    // Mailing for site
        define('SITE_MAIL', $setting->email);

    // Notifiaction on nav bar
        $messages = Contact::where('is_read', 'no')->take(2)->get();

        View::share('messages', $messages);

    // Header Pages
    $headerpages = GeneralPage::where('show_in', 'header')->where('status', 'active')->get();
    View::share('headerpages', $headerpages);
    // Footer Pages
    $footerpages = GeneralPage::where('show_in', 'footer')->where('status', 'active')->get();
    View::share('footerpages', $footerpages);

    // Partners or sister concerns & Affiliates
        $sisters = Partner::where('status', 'active')->where('show_in', 'sister')->orderByDesc('created_at')->take(4)->get();
        view()->share('sisters', $sisters);

        $affiliates = Partner::where('status', 'active')->where('show_in', 'affiliate')->orderByDesc('created_at')->take(4)->get();
        view()->share('affiliates', $affiliates);

        View::share('footerMenu' , Menu::where(['parent_id'=> null,'publish_status'=>1])->whereNotIn('header_footer',['1'])
        ->select('id', 'name', 'slug', 'position', 'parent_id','external_link','category_slug','title_slug')
        ->orderBy('position', 'ASC')
        ->take(5)
        ->get());

        View::share('menus', Menu::where(['parent_id'=> null, 'publish_status'=>1])->whereNotIn('header_footer',['2'])
            ->select('id', 'name', 'slug', 'position', 'parent_id', 'header_footer', 'external_link','category_slug','page_title','title_slug')
            ->with('children:id,name,slug,position,parent_id,header_footer,external_link,category_slug,page_title,title_slug')
            ->orderBy('position', 'ASC')
            ->get());



            // not nescessarry but needed on footer of frontend only there
            $faqs =GeneralFaq::where('status', 'active')->get();
            view()->share('faqs', $faqs);
    }
}
