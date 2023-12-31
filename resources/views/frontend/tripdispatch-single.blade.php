@include('frontend.layouts.header')
<style>
    .cyber_cast_post {
        list-style: none;
        font-size: 30px;
    }
</style>

<!-- cybercast Page -->
<section class="cybercast-page pt pb">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-lg-9">
                    <div class="trip-dispatch-main">
                        <h1>{{ @$cybercast->title }}</h1>
                        <div class="trip-dispatcifeatured-img">
                            <img src="{{ asset(@$cybercast->image) }}" alt="banner">
                        </div>
                        <h2>{{ @$cybercast->background_text }}</h2>
                        <div class="general_page_content">
                            {!! @$cybercast->description !!}
                        </div>
                        <div class="general_page_content">
                            @if (isset($cybercast->cyberCastPost))
                                <p><b> Daily Dispatches </b></p>
                            @endif
                            <ul class="cyber_cast_post">
                                @foreach ($cybercast->cyberCastPost as $data)
                                    <li style="font-size:16px;weight:bolder">
                                        <a href="{{ route('frontend.cyberCastPost-single', $data->slug) }}">{{ strtoupper($data->title) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="blog-single-sidebar">
                        <h3>Related Categories</h3>
                        <ul>
                            @foreach($cyberCasts as $cybercast)
                                <li><a href="{{ route('frontend.tripDispatchSingle', @$cybercast->slug) }}">{{ $cybercast->title  }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- cybercast Page End -->


@include('frontend.layouts.footer')
