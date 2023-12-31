
@include('frontend.layouts.header')

<!-- Banner -->
<section class="banner">
    <img src="{{ asset(@$about->image) }}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{ @$about->title }}</h1>
        </div>
    </div>
</section>
<!-- Banner End -->

<!-- About Page -->
<section class="about-page pt">
    <div class="container">
        <div class="about-content">
            <h2>{{ @$about->background_text }}</h2>
            {!! @$about->description !!}
        </div>
    </div>
</section>
<!-- About Page End -->

<!-- About Information -->
{{-- <section class="about-information mb">
    <div class="container">
        <div class="about-inforamtion-col">
            <div class="row m-0">
                <?php
                $num = 0;
                ?>

                @foreach ($teams as $key => $team)
                    <div class="col-lg-6 p-0">
                        <div class="about-information-wrap">

                            @if ($num <= 1)
                                <div class="about-inforamtion-media">
                                    <img src="{{ asset(@$team->image) }}" alt="images">
                                    <div class="social-media">
                                        <ul>
                                            @if (isset($team->fb_link))
                                                <li>
                                                    <a target="_blank" href="{{ $team->fb_link }}"><i
                                                            class="lab la-facebook-f"></i></a>
                                                </li>
                                            @endif
                                            @if (isset($team->twitter_link))
                                                <li>
                                                    <a target="_blank" href="{{ $team->twitter_link }}"><i
                                                            class="lab la-twitter"></i></a>
                                                </li>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="about-information-info">
                                    <h3>{{ $team->name }}</h3>
                                    <p>
                                        {!! $team->description !!}
                                    </p>
                                </div>

                                @php
                                    $num++;
                                @endphp
                            @elseif ($num <= 3)
                                <div class="about-information-info">
                                    <h3>{{ $team->name }}</h3>
                                    <p>
                                        {!! $team->description !!}
                                    </p>
                                </div>
                                <div class="about-inforamtion-media">
                                    <img src="{{ asset(@$team->image) }}" alt="images">
                                    <div class="social-media">
                                        <ul>
                                            @if (isset($team->fb_link))
                                                <li>
                                                    <a target="_blank" href="{{ $team->fb_link }}"><i
                                                            class="lab la-facebook-f"></i></a>
                                                </li>
                                            @endif
                                            @if (isset($team->twitter_link))
                                                <li>
                                                    <a target="_blank" href="{{ $team->twitter_link }}"><i
                                                            class="lab la-twitter"></i></a>
                                                </li>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                                <?php
                                $num++;

                                if ($num == 4) {
                                    $num = 0;
                                }
                                ?>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section> --}}
<!-- About Information End -->

@include('frontend.layouts.footer')
