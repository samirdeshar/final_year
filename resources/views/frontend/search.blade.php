
@include('frontend.layouts.header')
<div class="searchsingle">
    <div class="container">
        <div class="search-form">
            <form action="{{route('search-nect-trip')}}" method="get" id="searchForm">
                <div class="input-field">
                    
                    <input type="text" name="search" id="select-search" class="autocomplete">
                    <label for="select-search" class="search-hotel-type">Search over a million tour and travels, sight
                        seeings and more</label>
                    <ul class="autocomplete-content dropdown-content"></ul>
                </div>
                <div class="input-field">
                    <i class="waves-effect waves-light tourz-sear-btn waves-input-wrapper" style="">
                        <a type="submit" value="search" class="waves-button-input" id="searchButton">Search</a>
                    </i>
                </form>
                </div>
        </div>
    </div>
    <section class="search-items">
        <div class="container">
            <h1>Search Result For "{{ @$name }}"</h1>
            <div class="searchpackages-wrapper">
                <div class="row">
                    @if(count($trips) >0)
                    @foreach ($trips as $trip)
                        <div class="col-md-6">
                            <div class="card-wrapper">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('trip-details', @$trip->slug) }}">
                                            <img src="{{ @$trip->banner_image }}" alt="thumbnails-image">
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>{{ @$trip->title }}</h4>
                                        <ul>
                                            <li><i class="las la-map-marker-alt"></i></li>
                                            <li><i class="las la-star"></i><i class="las la-star"></i><i
                                                    class="las la-star"></i><i class="las la-star"></i></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <span>{{ @$trip->duration_details }}</span>
                                        <a href="{{ route('book', @$trip->id) }}" class="btn">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                    <div class="col-md-6">
                        <div class="card-wrapper">
                            <div class="row">
                                <h3>Sorry !! No Results Found</h3>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('frontend.layouts.footer')