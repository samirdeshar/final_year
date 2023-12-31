@include('frontend.layouts.header')
<section id="breadcrumb-singlepagenew">
    {{-- @dd($itineary) --}}
    <img src="{{@$setting->adventure1_image}}" alt="single-breadcrumb" class="singlebreadcrumb">
    <div class="container">
        <div class="breadcrumb-title-wrapper">
            <div class="title-breadcrumb">
                <h1>{{ @$setting->adventure1_title }}</h1>
                <p>{{ @$setting->adventure1_background_text }}</p>
            </div>
            <div class="nav-breadcrumb">
                <ul>
                    <li><a href="https://www.rupakot.nectar.com.np/">Home</a>
                    </li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                    <li><a href="{{ route('adventure.list') }}" class="bread-acti">Adventure</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="holidaypackages-single">
    <div class="container">
        <div class="holidaypackages-container">
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-3 single_portfolio_text">
                        <div class="advanture-image">
                            <img src="{{@$blog->image}}" alt="advanture-activities-thumb">
                            <a class="fancybox" rel="ligthbox" href="">
                                <div class="zoom"></div>
                            </a>
                            <div class="advanture-image-contents">
                                <h6>{{@$blog->title}}</h6>
                                <a href="{{route('frontend.singleBlog',$blog->slug)}}" class="btn">View Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="section-header-utilities">
                    <div class="section-header-btn">
                        <a href="{{route('adventure.list')}}">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.layouts.footer')
