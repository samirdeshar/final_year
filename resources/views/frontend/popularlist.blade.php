@include('frontend.layouts.header')

<section id="breadcrumb-singlepagenew">
    {{-- @dd($itineary) --}}
    <img src="{{@$setting->information_banner_image}}" alt="single-breadcrumb" class="singlebreadcrumb">
    {{-- @dd($setting->information_title) --}}
    <div class="container">
        <div class="breadcrumb-title-wrapper">
            <div class="title-breadcrumb">
                <h1>{{ @$setting->information_title }}</h1>
                <p>{{ @$setting->information_background_text }}</p>
            </div>
            <div class="nav-breadcrumb">
                <ul>
                    <li><a href="https://www.rupakot.nectar.com.np/">Home</a>
                    </li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                    <li><a href="{{ route('special.list') }}" class="bread-acti">Special Package</a>
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
                @foreach ($mega_special as $mega)
                {{-- @dump($mega) --}}
                    <div class="col-md-4">
                        <div class="popular-tours-wrap">
                            <div class="popular-tours-img">
                                <a href="{{ route('trip-details', @$mega->slug) }}"
                                    title="{{ ucfirst(@$mega->title) }}">
                                    <img src="{{ asset(@$mega->banner_image) }}" alt="images">
                                </a>
                                <small>{{ @$mega->trip_duration }} Days</small>
                            </div>
                            <div class="popular-tours-content">
                                <h3>
                                    <a href="{{ route('trip-details', @$mega->slug) }}">
                                        <h3>{{ ucfirst(@$mega->title) }}</h3>
                                        <small>{{ @$mega->trip_duration }} Days</small>
                                    </a>
                                </h3>
                                <div class="package-ratings">
                                    <ul>
                                        <li>Rating: <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></li>

                                    </ul>
                                    @if(@$mega->trip_cost !=null)
                                    <b>US ${{ @$mega->trip_cost }}</b>
                                    @endif
                                    <b>{{@$mega->duration_details}}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('frontend.layouts.footer')
