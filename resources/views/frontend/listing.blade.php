@include('frontend.layouts.header')
@isset($category)

<!-- Banner -->
<section class="banner">
    <img src="{{ asset(@$category->image) }}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{ $category->name }}</h1>
        </div>
    </div>
</section>
<!-- Banner End -->

@endisset
<!-- Listing Page -->
<section class="listing-page mt mb">
    <div class="container">
        @if (@$trips->count() > 0)
            <div class="row">
                @foreach ($trips as $trip)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="listing-trip-wrap">
                            <div class="listing-trip-media">
                                <a href="{{ route('trip-details', $trip->slug) }}">
                                    <img src="{{ asset(@$trip->banner_image) }}" alt="images">
                                </a>
                            </div>
                            <div class="listing-trip-info">
                                <h3>
                                    <a href="{{ route('trip-details', $trip->slug) }}">
                                        {{ Str::limit(ucfirst($trip->title), 27) }}
                                    </a>
                                </h3>
                                <div class="listing-trip-details">
                                    <span>From <b>US$ {{ $trip->trip_cost }}</b></span>
                                    <span><i class="las la-clock"></i> {{ $trip->trip_duration }} Days</span>
                                </div>
                                <div class="listing-trip-btns">
                                    <a href="{{ route('trip-details', $trip->slug) }}">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$trips->onEachSide(1)->links()}}
            </div>
            {{-- {!! $informations->appends(Request::all())->links() !!} --}}
        @else
            <h1 class="text-center">Sorry No Trips At This Moment !!</h1>
        @endif
    </div>
</section>
<!-- Listing Page End -->

<section class="travel-information mb">
    <div class="container">
        <div class="section_header">
            <h3>{{ @$setting->information_title }}</h3>
        </div>
        <div class="row">
            @isset($informations)
                @foreach ($informations as $information)
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="travel-information-wrap">
                            <img src="{{ asset(@$information->icon) }}" alt="images">
                            <h3><a href="{{ route('information-detail', $information->slug) }}">{{ ucfirst(@$information->title) }}</a></h3>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</section>


@include('frontend.layouts.footer')
