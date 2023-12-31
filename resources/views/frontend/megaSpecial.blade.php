@include('frontend.layouts.header')


<!-- Banner -->
<section class="banner">
    <img src="{{ asset(@$meta->banner_image) }}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{ @$meta->name }}</h1>
        </div>
    </div>
</section>
<!-- Banner End -->

<!-- Listing Page -->
<section class="listing-page mt mb">
    <div class="container">
        <div class="section_header">
        </div>
        @if ($trips->count() > 0)
            <div class="row">
                @foreach ($trips as $trip)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="listing-trip-wrap">
                            <div class="listing-trip-media">
                                <a href="{{ route('trip-details', @$trip->slug) }}">
                                    <img src="{{ asset(@$trip->banner_image) }}" alt="images">
                                </a>
                            </div>
                            <div class="listing-trip-info">
                                <h3>
                                    <a href="{{ route('trip-details', @$trip->slug) }}">
                                        {{ Str::limit(@$trip->title, 27) }}
                                    </a>
                                </h3>
                                <div class="listing-trip-details">
                                    <span>From <b>US$ {{ @$trip->trip_cost }}</b></span>
                                    <span><i class="las la-clock"></i> {{ @$trip->trip_duration }} Days</span>
                                </div>
                                <div class="listing-trip-btns">
                                    <a href="{{ route('trip-details', @$trip->slug) }}">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h2 class="text-center pb-5">Sorry !! No Trip At This Category..... {{ @$meta->banner_image }}</h2>
        @endif
    </div>
</section>
<!-- Listing Page End -->



@include('frontend.layouts.footer')
