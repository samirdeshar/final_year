@include('frontend.layouts.header')
<section id="breadcrumb-singlepagenew">
    {{-- @dd($itineary) --}}
    <img src="{{@$setting->trip_banner_image}}" alt="single-breadcrumb" class="singlebreadcrumb">
    <div class="container">
        <div class="breadcrumb-title-wrapper">
            <div class="title-breadcrumb">
                <h1>{{ @$setting->trip_title }}</h1>
                <p>{{ @$setting->trip_background_text }}</p>
            </div>
            <div class="nav-breadcrumb">
                <ul>
                    <li><a href="https://www.rupakot.nectar.com.np/">Home</a>
                    </li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                    <li><a href="{{ route('home.categories') }}" class="bread-acti">Travel categories</a>
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
                @foreach ($category as $cat)
                        <div class="col-md-4">
                            <div class="popular-tours-wrap">
                                <div class="popular-tours-img">
                                    <a href="{{ route('tripcategorydetail',$cat->slug) }}"
                                        title="{{ ucfirst(@$cat->name) }}">
                                        <img src="{{ @$cat->icon}}" alt="images">
                                    </a>
                                    <small>{{ @$cat->name }} Days</small>
                                </div>
                                <div class="popular-tours-content">
                                    <h3>
                                        <a href="{{ route('tripcategorydetail',$cat->slug) }}">
                                            <h3>{{ strtoupper(@$cat->name) }}</h3>
                                        </a>
                                    </h3>
                                    <ul class="package-info-icons">
                                        <li>
                                            <a href="{{ route('tripcategorydetail', $cat->slug) }}"><img
                                                    src="{{ asset('templates/images/clock.png') }}"
                                                    alt="Date" title="Tour Timing"> </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('tripcategorydetail', $cat->slug) }}"><img
                                                    src="{{ asset('templates/images/info.png') }}"
                                                    alt="Details" title="View more details"> </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('tripcategorydetail', $cat->slug) }}"><img
                                                    src="{{ asset('templates/images/price.png') }}"
                                                    alt="Price" title="Price"> </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('tripcategorydetail', $cat->slug) }}"><img
                                                    src="{{ asset('templates/images/map.png') }}"
                                                    alt="Location" title="Location"> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@include('frontend.layouts.footer')
