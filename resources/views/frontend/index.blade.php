@include('frontend.layouts.header')

@section('content')
    <style>

.reviews-main .clientsl-wrapper:before {
    display: none;
}

#searchButton i {
    color: var(--white-color);
    display: none;
}
@media(max-width:767px) {
    #searchButton i {
    display: block;
}
#searchButton span {
    display: none;
}
.header-search .search_button_icon a {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 45px;
    border-radius: 50%;
    top: 9px;
}
}

    </style>
    <!-- Site Banner -->
    <section id="site_banner">
        <div id="web_banner" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset(@$banner->image) }}" alt="images">
                        <div class="banner-caption">
                            <h2>{{ $banner->title }}</h2>
                            <p>{{ $banner->sub_title }}</p>

                        </div>
                        <div class="header-search">
                            <div class="search_button_icon">
                                <form action="{{ route('search-nect-trip') }}" method="get" id="searchForm">
                                    <input type="text" name="search" placeholder="Search your travels & tours"
                                        class="form-control" required>
                                    <a href="javascript:;" id="searchButton"><i class="las la-search"></i><span>Search</span></a>

                                </form>

                            </div>
                            <div class="banner-icons">
                                <ul>
                                    @foreach ($bannerIcon as $icon)
                                        <li>
                                            <a href="{{ @$icon->link }}"
                                                class="waves-effect waves-light btn-large tourz-pop-ser-btn wow fadeInUp animated"
                                                data-wow-duration="0.5s"
                                                style="visibility: visible;-webkit-animation-duration: 0.5s; -moz-animation-duration: 0.5s; animation-duration: 0.5s;"><img
                                                    src="{{ @$icon->image }}" alt="Icon Image"> {{ @$icon->title }}</a>
                                        </li>
                                    @endforeach
                                    {{-- <li>
                                    <a href="#activities_wrapper" class="waves-effect waves-light btn-large tourz-pop-ser-btn wow fadeInUp animated" data-wow-duration="0.5s" style="visibility: visible;-webkit-animation-duration: 0.5s; -moz-animation-duration: 0.5s; animation-duration: 0.5s;"><img src="https://www.rupakot.nectar.com.np/templates/images/icon/2.png" alt=""> Tour</a>
                                </li>
                            <li>
                                    <a href="" class="waves-effect waves-light btn-large tourz-pop-ser-btn wow fadeInUp animated" data-wow-duration="1.5s" style="visibility: visible;-webkit-animation-duration: 1.5s; -moz-animation-duration: 1.5s; animation-duration: 1.5s;"><img src="https://www.rupakot.nectar.com.np/templates/images/icon/30.png" alt=""> Trekking</a>
                                </li>

                                <li>
                                    <a href="#advanture" class="waves-effect waves-light btn-large tourz-pop-ser-btn wow fadeInUp animated" data-wow-duration="2s" style="visibility: visible;-webkit-animation-duration: 2s; -moz-animation-duration: 2s; animation-duration: 2s;"><img src="https://www.rupakot.nectar.com.np/templates/images/icon/1.png" alt=""> Activities</a>
                                </li>
                                <li>
                                    <a href="" class="waves-effect waves-light btn-large tourz-pop-ser-btn wow fadeInUp animated" data-wow-duration="1s" style="visibility: visible;-webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;"><img src="https://www.rupakot.nectar.com.np/templates/images/icon/31.png" alt=""> Flight</a>
                                </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#web_banner" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#web_banner" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- Site Banner End -->

    <!-- Activity Section -->
    <section id="activities_wrapper" class="pt pb">
        <div class="container">
            <div class="activities-col">
                <div class="section_header">
                    <h3>{{ @$setting->trip_title }}</h3>
                </div>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"></div>
                    <div class="tl-3"></div>
                </div>
                @isset($category)
                    <div class="row">
                        @foreach ($category as $cat)
                            <div class="col-md-4">
                                <div class="popular-tours-wrap">
                                    <div class="popular-tours-img">
                                        <a href="{{ route('tripcategorydetail', $cat->slug) }}"
                                            title="{{ ucfirst(@$cat->name) }}">
                                            <img src="{{ @$cat->icon }}" alt="images">
                                        </a>
                                        <small>{{ @$cat->name }} Days</small>
                                    </div>
                                    <div class="popular-tours-content">
                                        <h3>
                                            <a href="{{ route('tripcategorydetail', $cat->slug) }}">
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
                @endisset
                <div class="section-header-utilities">
                    <div class="section-header-btn">
                        <a href="{{ route('home.categories') }}">View All >></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Activity Section End -->



    <!-- Special Trip -->
    <section class="special-trip pt pb">
        <div class="container">
            <div class="section_header">
                <h3>{{ @$setting->mega_title }}</h3>

            </div>
            <div class="title-line">
                <div class="tl-1"></div>
                <div class="tl-2"></div>
                <div class="tl-3"></div>
            </div>
            <div class="row">

            </div>
            {{-- <div class="section-header-utilities">
            <div class="section-header-btn">
                <a href="#">View All</a>
            </div>
        </div> --}}
        </div>
    </section>
    <!-- Special Trip End -->

    <!-- Activity Section -->
    <section id="activities_wrapper2" class="pt pb">
        <div class="container">
            <div class="activities-col">
                <div class="section_header">
                    <h3>{{ @$setting->information_title }}</h3>
                </div>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"></div>
                    <div class="tl-3"></div>
                </div>
                {{-- @dd($mega_special->toArray()) --}}
                @isset($mega_special)
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
                                                <li>Rating: <i class="fa fa-star" aria-hidden="true"></i><i
                                                        class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"
                                                        aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                                </li>

                                            </ul>
                                            @if (@$mega->trip_cost != null)
                                                <b>US ${{ @$mega->trip_cost }}</b>
                                            @endif
                                            <b>{{ @$mega->duration_details }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endisset
                <div class="section-header-utilities">
                    <div class="section-header-btn">
                        <a href="{{ route('special.list') }}">View All >></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Activity Section End -->

    <section id="advanture" class="advanture-activities">

        <div class="section_header">
            <h3>{{ @$setting->adventure1_title }}</h3>
        </div>
        <div class="title-line">
            <div class="tl-1"></div>
            <div class="tl-2"></div>
            <div class="tl-3"></div>
        </div>
        <div class="row">
            @isset($blogs)
                @foreach ($blogs as $blog)
                    <div class="col-md-3 single_portfolio_text">
                        <div class="advanture-image">
                            <img src="{{ @$blog->image }}" alt="advanture-activities-thumb">
                            <a class="fancybox" rel="ligthbox" href="">
                                <div class="zoom"></div>
                            </a>
                            <div class="advanture-image-contents">
                                <h6>{{ @$blog->title }}</h6>
                                <a href="{{ route('frontend.singleBlog', $blog->slug) }}" class="btn">View Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="section-header-utilities">
                    <div class="section-header-btn">
                        <a href="{{ route('adventure.list') }}">View All >></a>
                    </div>
                </div>
            @endisset


        </div>

    </section>




    <!-- Activity Section -->
    <section id="activities_wrapper" class="pt pb">
        <div class="container">
            <div class="activities-col">
                <div class="section_header">
                    <h3>{{ @$setting->outbound_title }}</h3>
                </div>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"></div>
                    <div class="tl-3"></div>
                </div>
                @isset($outBonds)
                    <div class="row">
                        @foreach ($outBonds as $cat)
                            <div class="col-md-4">
                                <div class="popular-tours-wrap">
                                    <div class="popular-tours-img">
                                        <a href="{{ route('tripcategorydetail', $cat->slug) }}"
                                            title="{{ ucfirst(@$cat->name) }}">
                                            <img src="{{ @$cat->icon }}" alt="images">
                                        </a>
                                        <small>{{ @$cat->name }} Days</small>
                                    </div>
                                    <div class="popular-tours-content">
                                        <h3>
                                            <a href="{{ route('tripcategorydetail', $cat->slug) }}">
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
                @endisset
                <div class="section-header-utilities">
                    <div class="section-header-btn">
                        <a href="{{ route('outbound.list') }}">View All >></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Activity Section End -->

    {{-- Testimonial-Section-Design --}}

    <section id="reviews" class="reviews-main pt pb">
        <div class="container">
            {{-- <div class="section_header">
                <h3>Testimonials And Reviews</h3>
            </div>
            <div class="title-line">
                <div class="tl-1"></div>
                <div class="tl-2"></div>
                <div class="tl-3"></div>
            </div> --}}

            <div class="row">
                <div class="col-md-6">
                    <h3>Testimonials</h3>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <div class="testimonial-sl owl-carousel owl-theme" id="testimonial-wrapper">
                        {{-- @forelse ($testimonial as $testimonial)
                        <div class="item">
                            <div class="clientsl-wrapper">
                                <div class="left-image">
                                    <img src="{{ $testimonial->image }}"
                                    alt="{{ $testimonial->title }}">
                                    <h3>{{ $testimonial->name }}</h3>
                                    <span>{{ $testimonial->country }}</span>
                                </div>
                                <div>
                                    <h3><a href="{{ route('testimonial.details',$testimonial->slug) }}">{{$testimonial->title}}</a></h3>
                                    <p class="review-date"><i class="las la-calendar"></i>{{date('M d',strtotime(@$testimonial->created_at))}}, {{date('Y',strtotime(@$testimonial->created_at))}}, {{date('H:i
                                        a',strtotime(@$testimonial->created_at))}}</p>
                                    <p>{!! Str::limit($testimonial->summary ?? $testimonial->description,300) !!}</p>
                                    <a href="{{ route('testimonial.details',$testimonial->slug) }}">Read More</a>
                                </div>

                            </div>

                        </div>
                        @empty --}}

                        <div class="item">
                            <div class="clientsl-wrapper">
                                <div class="left-image">
                                <img src="https://images.pexels.com/photos/91227/pexels-photo-91227.jpeg?auto=compress&cs=tinysrgb&w=600"
                                    alt="Client">
                                <h3>Great Adventure</h3>
                                <span>Actor</span>
                                </div>
                                <div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus iure possimus harum
                                        quisquam praesentium ipsum accusantium.</p>
                                </div>
                            </div>
                        </div>
                        {{-- @endforelse --}}


                    </div>
                </div>
                {{-- @dd($reviewsData) --}}
                <div class="col-md-6">
                    <h3 class="reviews-title">Reviews</h3>
                    <div class="title-line review-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <div class="review-box owl-carousel owl-theme" id="popular-tours">
                        {{-- @if($reviewsData)
                        @foreach ($reviewsData as $reviewValue)
                        <div class="item">
                            <h3><a href="{{route('review.details',@$reviewValue->id)}}">{{$reviewValue->review_title}}</a></h3>
                            <p class="review-date"><i class="las la-calendar"></i>{{date('M d',strtotime(@$reviewValue->created_at))}}, {{date('Y',strtotime(@$reviewValue->created_at))}}, {{date('H:i
                                a',strtotime(@$reviewValue->created_at))}}</p>

                            <p>
                                {!! $reviewValue->description !!}
                            </p>
                            <a href="{{route('review.details',@$reviewValue->id)}}" class="read-more hovereffect ">Read More <span class="fa fa-angle-right"></span></a>
                        </div>
                        @endforeach
                        @endif
                        @if($reviews)
                        @foreach ($reviews as $reviewValue)
                        <div class="item">
                            <h3><a href="{{route('testimonial.details',@$reviewValue->slug)}}">{{$reviewValue->title}}</a></h3>
                            <p class="review-date"><i class="las la-calendar"></i>{{date('M d',strtotime(@$reviewValue->created_at))}}, {{date('Y',strtotime(@$reviewValue->created_at))}}, {{date('H:i
                                a',strtotime(@$reviewValue->created_at))}}</p>

                            <p>
                                {!! Str::limit($reviewValue->summary ?? $reviewValue->description,300) !!}
                            </p>
                            <a href="{{route('testimonial.details',@$reviewValue->slug)}}" class="read-more hovereffect ">Read More <span class="fa fa-angle-right"></span></a>
                        </div>
                        @endforeach
                        @endif --}}
{{--
                        @empty
                        <div class="item">
                            <h3>Review</h3>
                            <p class="review-date"><i class="las la-calendar">May 01,2023 , 06:00AM</i></p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto quos tenetur sit accusantium adipisci quaerat, itaque dignissimos praesentium nostrum quam doloribus similique quis excepturi veritatis commodi, molestias eligendi, dolor mollitia. Doloribus sint nam, explicabo laboriosam sed corporis aspernatur nulla commodi similique ratione dolorem excepturi hic temporibus nostrum, soluta delectus suscipit.</p>
                        </div>
                        @endforelse --}}

                    </div>
                </div>
            </div>

        </div>
    </section>

    @include('frontend.layouts.footer')




    <script>
        loadMore();

        function loadOnClick() {
            $('.load-button').on('click', function() {
                let id = $(this).data("last_id");
                $(this).remove();
                loadMore(id);
            });
        }

        function loadMore(id = null) {
            let url = "";
            if (id == null) {
                url = '/get/ajax-hikes/';
            } else {
                url = '/get/ajax-hikes/' + id;
            }
            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    $('#hike-display').append(response);
                    loadOnClick();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
