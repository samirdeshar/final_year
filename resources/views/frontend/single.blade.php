@include('frontend.layouts.header')
<style>
    .breadcrumb-info ul li span {
        color: var(--white-color);
    margin-right: 15px;
    font-size: 21px;
    background: var(--secondary-color);
    padding: 3px 40px;
    border-radius: 4px;
}
.breadcrumb-info ul li {
    display: flex;
}
</style>
<section id="breadcrumb-singlepage">
    {{-- @dd($itineary) --}}
    {{-- <img src="https://www.rupakot.nectar.com.np/templates/images/banner/2.jpg" alt="single-breadcrumb" class="singlebreadcrumb"> --}}
    <div class="container">
        {{-- <h1>{{ @$trip->title }}</h1> --}}
    </div>
</section>
<div class="breadcrumb-info">
    <div class="container">
        <ul>
            <li>
                <p>{{ @$trip->trip_cost ? ' Cost per person' . ' ' . @$trip->currency . ' ' . @$trip->trip_cost  : ''}}</p>
            </li>

            <li><span>{{@$trip->currency }} {{@$trip->trip_cost}}</span><a href="{{ route('book', $trip->id) }}" class="btn">Book Now</a></li>
        </ul>
    </div>
</div>

<div class="single-details-sl">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div id="popular-tours" class="owl-carousel owl-theme">
                    {{-- <div class="item">
                        <img src="{{ @$trip->banner_image }}" alt="images-banner" class="img-fluid">
                    </div> --}}
                    @foreach (@$galleries as $gImage)
                        <div class="item">
                            <img src="{{ $gImage->gallery_image }}" alt="images-banner" class="img-fluid">
                        </div>
                    @endforeach
                </div>

                <div class="single-description">
                    <h2>Description</h2>
                    <span>{{ @$trip->slogan }}</span>
                    <p>
                        {!! @$trip->description !!}
                    </p>
                </div>

                <div class="singledescription-tabs">

                    <div class="tabs-static-wrapper">

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Brief
                                    Itinerary</button>

                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="true">Detailed
                                    Itinerary</button>
                                @if ($trip->getTripData->sightseeing_places != null)
                                <button class="nav-link" id="nav-sightseeing_places-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-sightseeing_places" type="button" role="tab"
                                aria-controls="nav-sightseeing_places" aria-selected="true">Sightseeing places</button>
                                @endisset

                                @if ($trip->getTripData->best_time != null)
                                <button class="nav-link" id="nav-best_time-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-best_time" type="button" role="tab"
                                aria-controls="nav-best_time" aria-selected="true">Best Time</button>
                                @endisset

                                @if ($trip->getTripData->trip_info != null)
                                <button class="nav-link" id="nav-trip_info-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-trip_info" type="button" role="tab"
                                aria-controls="nav-trip_info" aria-selected="true">Trip Info</button>
                                @endisset

                                @if ($trip->getTripData->imp_note != null)
                                <button class="nav-link" id="nav-imp_note-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-imp_note" type="button" role="tab"
                                aria-controls="nav-imp_note" aria-selected="true">Important Note</button>
                                @endisset

                                @if ($trip->getTripData->travel_date != null)
                                <button class="nav-link" id="nav-travel_date-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-travel_date" type="button" role="tab"
                                aria-controls="nav-travel_date" aria-selected="true">Travel Date</button>
                                @endisset

                                @if ($trip->getTripData->min_travel != null)
                                <button class="nav-link" id="nav-min_travel-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-min_travel" type="button" role="tab"
                                aria-controls="nav-min_travel" aria-selected="true">Min Travel</button>
                                @endisset

                                @if ($trip->getTripData->trip_safety != null)
                                <button class="nav-link" id="nav-trip_safety-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-trip_safety" type="button" role="tab"
                                aria-controls="nav-trip_safety" aria-selected="true">Trip Safety</button>
                                @endisset

                                @if ($trip->getTripData->useful_tip != null)
                                <button class="nav-link" id="nav-useful_tip-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-useful_tip" type="button" role="tab"
                                aria-controls="nav-useful_tip" aria-selected="true">Useful Tip</button>
                                @endisset

                                @if ($trip->getTripData->hike_trip != null)
                                <button class="nav-link" id="nav-hike_trip-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-hike_trip" type="button" role="tab"
                                aria-controls="nav-hike_trip" aria-selected="true">Hike Trip</button>
                                @endisset

                                @if ($trip->getTripData->optional_tour != null)
                                <button class="nav-link" id="nav-optional_tour-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-optional_tour" type="button" role="tab"
                                aria-controls="nav-optional_tour" aria-selected="true">Optional Tour</button>
                                @endisset

                                @if($trip->getOverView->overview_cost_includes !=null || $trip->getOverView->overview_cost_excludes !=null)
                                <button class="nav-link" id="nav-Inclusion-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-Inclusion" type="button" role="tab"
                                aria-controls="nav-Inclusion" aria-selected="true">Cost Inclusion / Cost Exclusion</button>
                                @endif





                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <ul class="pt-3">
                                    @isset($itineary)
                                        @if (count($itineary) > 0)
                                            @foreach ($itineary as $it)
                                                <li>{{ @$it->itineary_heading }}</li>
                                            @endforeach
                                        @endif
                                    @endisset
                                </ul>
                            </div>

                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                @isset($itineary)
                                <p></p>
                                    @if (count($itineary) > 0)
                                        @foreach ($itineary as $it)
                                            <p>{!! @$it->itineary_description !!}</p>
                                        @endforeach
                                    @endif
                                @endisset
                            </div>
                            @if ($trip->getTripData->sightseeing_places != null)
                            <div class="tab-pane fade" id="nav-sightseeing_places" role="tabpanel"
                            aria-labelledby="nav-sightseeing_places-tab">
                            <p></p>
                            {!! @$trip->getTripData->sightseeing_places !!}
                            </div>
                            @endif

                            @if ($trip->getTripData->best_time != null)
                            <div class="tab-pane fade" id="nav-best_time" role="tabpanel"
                            aria-labelledby="nav-best_time-tab">
                            <p></p>
                            {!! @$trip->getTripData->best_time !!}
                            </div>
                            @endif

                            @if ($trip->getTripData->trip_info != null)
                            <div class="tab-pane fade" id="nav-trip_info" role="tabpanel"
                            aria-labelledby="nav-trip_info-tab">
                            <p></p>
                            {!! @$trip->getTripData->trip_info !!}
                            </div>
                            @endif

                            @if ($trip->getTripData->imp_note != null)
                            <div class="tab-pane fade" id="nav-imp_note" role="tabpanel"
                            aria-labelledby="nav-imp_note-tab">
                            <p></p>
                            {!! @$trip->getTripData->imp_note !!}
                            </div>
                            @endif

                            @if ($trip->getTripData->travel_date != null)
                            <div class="tab-pane fade" id="nav-travel_date" role="tabpanel"
                            aria-labelledby="nav-travel_date-tab">
                            <p></p>
                            {!! @$trip->getTripData->travel_date !!}
                            </div>
                            @endif

                            @if ($trip->getTripData->min_travel != null)
                            <div class="tab-pane fade" id="nav-min_travel" role="tabpanel"
                            aria-labelledby="nav-min_travel-tab">
                            <p></p>
                            {!! @$trip->getTripData->min_travel !!}
                            </div>
                            @endif

                            @if ($trip->getTripData->trip_safety != null)
                            <div class="tab-pane fade" id="nav-trip_safety" role="tabpanel"
                            aria-labelledby="nav-trip_safety-tab">
                            <p></p>
                            {!! @$trip->getTripData->trip_safety !!}
                            </div>
                            @endif

                            @if ($trip->getTripData->useful_tip != null)
                            <div class="tab-pane fade" id="nav-useful_tip" role="tabpanel"
                            aria-labelledby="nav-useful_tip-tab">
                            <p></p>
                            {!! @$trip->getTripData->useful_tip !!}
                            </div>
                            @endif

                            @if ($trip->getTripData->hike_trip != null)
                            <div class="tab-pane fade" id="nav-hike_trip" role="tabpanel"
                            aria-labelledby="nav-hike_trip-tab">
                            <p></p>
                            {!! @$trip->getTripData->hike_trip !!}
                            </div>
                            @endif

                            @if ($trip->getTripData->optional_tour != null)
                            <div class="tab-pane fade" id="nav-optional_tour" role="tabpanel"
                            aria-labelledby="nav-optional_tour-tab">
                            <p></p>
                            {!! @$trip->getTripData->optional_tour !!}
                            </div>
                            @endif

                            @if ($trip->getOverView->overview_cost_includes !=null || $trip->getOverView->overview_cost_excludes !=null)
                            <div class="tab-pane fade" id="nav-Inclusion" role="tabpanel"
                            aria-labelledby="nav-Inclusion-tab">
                            @if($trip->getOverView->overview_cost_includes)
                            <h5 class="inclusion m-0" style="font-size: 18px;">
                               <strong>Cost Inclusion</strong>
                            </h5>
                            @endif
                            {!! @$trip->getOverView->overview_cost_includes !!}
                            @if($trip->getOverView->overview_cost_excludes)
                            <h5 class="inclusion m-0" style="font-size: 18px;">
                                <strong>Cost Exclusion</strong>
                             </h5>
                            @endif
                            {!! @$trip->getOverView->overview_cost_excludes !!}
                            </div>
                            @endif


                        </div>


                    </div>



                </div>

            </div>
            <div class="col-md-3">
                <div class="singledescription-trip">
                    <h3>Trip Information</h3>
                    <p>
                        @if (@$trip->trip_style)
                          <p>  <strong>Trip Style</strong>:{{ @$trip->trip_style }}</p>
                        @endif
                        @if (@$trip->trip_duration != null)
                        <p> <strong>Trip Duration</strong>:{{ @$trip->trip_duration }} </p>
                        @endif
                        @if (@$trip->accomodation != null)
                        <p> <strong>accomodation</strong>:{{ @$trip->accomodation }} </p>
                        @endif
                        @if (@$trip->trip_outline != null)
                            <p><strong>Trip OutLine</strong>:{{ @$trip->trip_outline }} </p>
                        @endif
                        @if (@$trip->package != null)
                            <p><strong>Package</strong>:{{ @$trip->package }} </p>
                        @endif
                        @if (@$trip->note != null)
                            <p><strong>Note</strong>:{{ @$trip->note }} </p>
                        @endif
                        @if (@$trip->destination != null)
                            <p><strong>Destination</strong>:{{ @$trip->destination }} </p>
                        @endif
                        @if (@$trip->hotel_category != null)
                           <p> <strong>Hotel Category</strong>:{{ @$trip->hotel_category }} </p>
                        @endif
                        @if (@$trip->max_altitude != null)
                            <p><strong>Max Altitude</strong>:{{ @$trip->max_altitude }} </p>
                        @endif
                        @if (@$trip->min_pax != null)
                            <p><strong>Min Pax</strong>:{{ @$trip->min_pax }} </p>
                        @endif
                        @if (@$trip->travel_mode != null)
                            <p><strong>Travel Mode</strong>:{{ @$trip->travel_mode }} </p>
                        @endif
                        @if (@$trip->trek_type != null)
                            <p><strong>Trek Type</strong>:{{ @$trip->trek_type }} </p>
                        @endif
                        @if (@$trip->meals != null)
                            <p><strong>Meals</strong>:{{ @$trip->meals }} </p>
                        @endif
                        @if (@$trip->total_trip != null)
                            <p><strong>Total Trip</strong>:{{ @$trip->total_trip }} </p>
                        @endif
                        @if (@$trip->trip_type != null)
                            <p><strong>Trip Type</strong>:{{ @$trip->trip_type }} </p>
                        @endif
                        @if (@$trip->grade != null)
                            <p><strong>Grade</strong>:{{ @$trip->grade }} </p>
                        @endif
                        @if (@$trip->highest_altitude != null)
                            <p><strong>Highest Altitude</strong>:{{ @$trip->highest_altitude }} </p>
                        @endif

                        @if ($trip->getOverView->overview_trip_code != null)
                            <p><strong>Trip Code</strong>:{{ @$trip->getOverView->overview_trip_code }} </p>
                        @endif

                        @if ($trip->getOverView->overview_duration != null)
                           <p> <strong>Duration</strong>:{{ @$trip->getOverView->overview_duration }} </p>
                        @endif

                        @if ($trip->getOverView->overview_activities != null)
                            <p><strong>Primary Activities</strong>:{{ @$trip->getOverView->overview_activities }} </p>
                        @endif

                        @if ($trip->getOverView->overview_arrival_city != null)
                            <p><strong>Arrival City</strong>:{{ @$trip->getOverView->overview_arrival_city }} </p>
                        @endif

                        @if ($trip->getOverView->overview_arrival_city != null)
                            <p><strong>Departure City</strong>:{{ @$trip->getOverView->overview_departure_city }} </p>
                        @endif

                        @if ($trip->getOverView->overview_transportation != null)
                            <p><strong>Transportation</strong>:{{ @$trip->getOverView->overview_transportation }} </p>
                        @endif

                        @if ($trip->getOverView->overview_best_season != null)
                            <p><strong>Best Season</strong>:{{ @$trip->getOverView->overview_best_season }} </p>
                        @endif
                        {{-- <strong>Trip Duration</strong> : 6N/7D<br>
                        <strong>Tour Code:&nbsp;</strong>RH/PR/02<br>
                        <strong>Package:</strong> 6N/7D Adventurous&nbsp;Tour<br>
                        <strong>Accommodation:</strong>&nbsp;Standard<br>
                        <strong>Transportation:</strong>&nbsp;Seat in Coach (SIC) // Seat in Vehicle (SIV)<br>
                        <strong>Starts &amp; Ends in:</strong> Kathmandu<br>
                        <strong>Activities:</strong> Thrilling tour of Nepal --}}
                    </p>
                </div>
                <div class="singledescription-trip">
                    <h3>SHARE THIS PACKAGE</h3>
                    <div class="single-aside-social">
                        <ul>
                            <li><a href="{{ @$setting->fb_link }}" target="_blank"><i
                                        class="lab la-facebook-f"></i></a></li>
                            <li><a href="{{ @$setting->twitter_link }}" target="_blank"><i
                                        class="lab la-twitter"></i></a></li>
                            <li><a href="{{ @$setting->linkedin_link }}" target="_blank"><i
                                        class="lab la-linkedin-in"></i></a></li>
                            <li><a href="{{ @$setting->google_plus }}" target="_blank"><i class="las la-plus"></i></a>
                            </li>
                        </ul>
                        <div class="rating-box">
                            <i class="fa fa-users"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="{{ route('get.review', @$trip->slug) }}"
                            class="btn btn-write-review btn-success">Write your review</a>
                    </div>
                </div>
                <div class="singledescription-trip">
                    <h3>HELP & SUPPORT</h3>
                    <div class="tour_help_1">
                        <h4 class="tour_help_1_call">Call Us Now</h4>
                        <h4><i class="fa fa-phone" aria-hidden="true"></i> {{ @$setting->phone }},
                            {{ @$setting->contact }},{{ @$setting->contact_second }}</h4>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>

@include('frontend.layouts.footer')
