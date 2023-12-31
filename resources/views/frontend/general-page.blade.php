@include('frontend.layouts.header')
<!-- Banner -->
<section class="banner">
    <img src="{{asset(@$data->banner_image)}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{strtoupper(@$data->name)}}</h1>
            <span>{{ucfirst(@$data->page_title)}}</span>
        </div>
    </div>
</section>
<!-- Banner End -->



<!-- Other Content -->
<section class="other-content mb mt">
    <div class="container">
       <div class="general_page_content about-content">
            <div>{!!@$data->content !!}</div>
            <div class="social-media">
                <ul>
                    <li>
                        <a href="{{@$setting->fb_link}}"><i class="lab la-facebook-f"></i></a>
                    </li>
                    <li>
                        <a href="{{@$setting->twitter_link}}"><i class="lab la-twitter"></i></a>
                    </li>
                    <li>
                        <a href="{{@$setting->linkedin_link}}"><i class="lab la-linkedin"></i></a>
                    </li>
                    <li>
                        <a href="{{@$setting->insta_link}}"><i class="lab la-instagram"></i></a>
                    </li>
                </ul>
            </div>
       </div>
    </div>
</section>
<!-- Other Content End -->
@include('frontend.layouts.footer')
