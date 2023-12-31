@include('frontend.layouts.header')

<!-- Single Page -->
<section class="single-page mt mb">
    <div class="container">
        <div class="single-page-head">
            <div class="single-pahe-head-left">
                <h1>{{ucfirst( @$trip->title)}}</h1>
                <span><i class="las la-street-view"></i> Baneshwor, Kathmandu, Nepal <a href="#">Show on Map</a></span>
            </div>
            <div class="single-page-head-right">
                <div class="share">
                    <span>Share: </span>
                    <div class="social-media">
                        <ul>
                            <li class="facebook">
                                <a href="{{ @$setting->fb_link}}" target="_blank"><i class="lab la-facebook-f"></i></a>
                            </li>
                            <li class="twitter">
                                <a href="{{ @$setting->twitter_link}}" target="_blank"><i class="lab la-twitter"></i></a>
                            </li>
                            <li class="linkedin">
                                <a href="{{ @$setting->linkedin_link}}" target="_blank"><i class="lab la-linkedin"></i></a>
                            </li>
                            <li class="instagram">
                                <a href="{{ @$setting->instagram_link}}" target="_blank"><i class="lab la-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="single-page-main">
                    <div class="single-page-slider">
                        <div id="carouselExampleFade1" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                    <img src="{{@$trip->banner_image}}"  alt="Slider">
                              </div>
                              @if(count($trip->getGallery) >0)
                                @foreach ($trip->getGallery as $gImage)
                                <div class="carousel-item">
                                    <img src="{{@$gImage->gallery_image}}"  alt="Slider">
                                </div>
                                @endforeach
                              @endif
                              
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade1" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade1" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">{{ @$overview->overview_slogan}}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            @isset($itineary[0]->itslogan)
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">{{$itineary[0]->itslogan}}</button>
                            @endif
                        </li>
                        <li class="nav-item" role="presentation">
                            @if($trip_faq->count() >0)
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">FAQ</button>
                                @endif
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="map-tab" data-bs-toggle="tab" data-bs-target="#map-tab-pane" type="button" role="tab" aria-controls="map-tab-pane" aria-selected="false">Map</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="include-tab" data-bs-toggle="tab" data-bs-target="#include-tab-pane" type="button" role="tab" aria-controls="include-tab-pane" aria-selected="false">Include/Exclude</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            @if ($galleries->count() > 0)
                                <button class="nav-link dynamic">Gallery</button>
                            @endif
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            @isset($overview)
                                <div class="overview">
                                    <div class="overview-details">
                                        <h3 class="tabs-title">{{ @$overview->overview_slogan}}</h3>
                                        <div class="overview-col">
                                            {!! @$overview->overview_description!!}
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            @isset($itineary[0]->itslogan)
                                <div class="itinery" id="{{$itineary[0]->itslogan}}">
                                            <h3 class="tabs-title">{{$itineary[0]->itslogan}}</h3>
                                        <div class="accordion" id="accordionExample">
                                            @foreach($itineary as $item)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{$item->id}}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapseOne">
                                                        <span>{{ $item->itineary_heading}}</span>
                                                    </button>
                                                </h2>
                                                <div id="collapse{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$item->id}}"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        {!! $item->itineary_description!!}
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                </div>
                            @endisset
                        </div>
                        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            @isset($trip_faq)
                            <div class="itinery">
                                <h3 class="tabs-title">Frequently Asked Questions</h3>
                                <div class="accordion" id="accordionExample">
                                    @foreach($trip_faq as $item)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{$item->id}}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapseOne">
                                                <span>{{ $item->faq_question}}</span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$item->id}}"data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>
                                                {!! $item->faq_answer!!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endisset
                        </div>
                        <div class="tab-pane fade" id="map-tab-pane" role="tabpanel" aria-labelledby="map-tab" tabindex="0">
                            <div class="map-section">
                                <h3 class="tabs-title">Map</h3>
                                <div class="map-container">
                                    <div id="map" class="map"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="include-tab-pane" role="tabpanel" aria-labelledby="include-tab" tabindex="0">
                            <div class="include">
                                <div class="includes">
                                    @if($overview->overview_cost_includes !=null)
                                        <div class="trip-infos includes-list">
                                            <h3 class="tabs-title">Includes</h3>
                                            {!! @$overview->overview_cost_includes !!}
                                        </div>
                                    @endif
                                    @if($overview->overview_cost_excludes !=null)
                                        <div class="trip-infos excludes-list">
                                            <h3 class="tabs-title">Excludes</h3>
                                            {!! @$overview->overview_cost_excludes !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-page-sidebar">
                    <div class="single-page-content-head">
                        <div class="price">
                            <span> price </span>
                            <b> ${{ $trip->trip_cost}}</b>
                        </div>
                        <div class="duration">
                            <span>Duration</span>
                            <b>{{ @$trip->trip_duration}} Days</b>
                        </div>
                    </div>
                    <div class="additional-list">
                        <ul>
                            <li>
                                <i class="las la-skiing"></i>
                                <div class="additional-right">
                                    <span> Difficulty</span>
                                    <p>{{ ucfirst(@$overview->overview_level_start)}} - {{ucfirst(@$overview->overview_level_end)}}</p>
                                </div>
                            </li>
                            @if($overview->overview_trip_route !=null)
                            <li>
                                <i class="las la-map-signs"></i>
                                <div class="additional-right">
                                    <span> Trip Route</span>
                                   {!! @$overview->overview_trip_route !!}
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                    {{-- <label for="captcha" style="color: white"> CAPTCHA </label>
                        <div name="captcha" class="g-recaptcha" data-sitekey="6LcclpAlAAAAAJ4VydTyTDG4vSS9tNaj0mWm13uZ" required></div>
                        @error('g-recaptcha-response')
                            <span class="text-warning"> The reCAPTCHA was invalid. Go back and try it again.
                            </span>
                        @enderror --}}
                    <div class="booking">
                        <a href="{{route('book',$trip->id)}}" class="btns">Book Now <i class="lab la-telegram-plane"></i></a>
                        <span>Or</span>
                        <a href="{{ route('inquiry',$trip->id)}}" class="inquery">Inquiry Now <i class="las la-voicemail"></i></a>
                    </div>
                    <div class="experience">
                        <div class="experience-icon">
                            <i class="lar la-heart"></i>
                        </div>
                        <div class="experience-info">
                            94% of travelers recommend this experience
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SIngle Page End -->

<!-- Single Page Details End -->
<section class="single-page-details mb" id="{{@$overview->overview_slogan}}">

</section>




    <!--Faq End -->


<!-- Single Page Details End -->



<!-- Special Trip -->

{{-- <section class="special-trip pt pb">
    <div class="container">
        <div class="section_header">

            @php
            $category = getCat($trip->getTripCat);
            @endphp
                <span class="main-title">Related Trips</span>
                <div class="bg-head">similar</div>
        </div>
        <div class="owl-carousel owl-theme" id="special-trip">
            @foreach($category->category_trip->where('id','!=',$trip->id) as $related_trip)

                <div class="item">
                    <div class="special-trip-wrap">
                        <div class="special-trip-media">
                            <a href="{{ route('trip-details',@$related_trip->slug)}}">
                                <img src="{{ asset(@$related_trip->banner_image)}}" alt="images">
                            </a>
                        </div>
                        <div class="special-trip-info">
                            <h3>
                                <span><a href="{{ route('trip-details',@$related_trip->slug)}}">{{ ucfirst($related_trip->title)}}</a></span>
                                <small>/ {{ $related_trip->trip_duration}} Days</small>
                            </h3>
                            <b>From US $ {{$related_trip->trip_cost}} per person</b>
                            <p>
                                {{ Str::limit(@$related_trip->summary, 100)}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section> --}}
<!-- Special Trip End -->
@push('script')
<script src="https://maps.googleapis.com/maps/api/js?key=6LcclpAlAAAAAJ4VydTyTDG4vSS9tNaj0mWm13uZ"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
       {{-- Ajax Call --}}
    <script>
        loadMore();
        function loadOnClick() {
            $('.load-button').on('click', function() {
                let id = $(this).data("id");
                $(this).remove();
                loadMore(id);
            });
        }

        function loadMore(id = null) {
            let url = "";
            var trip_id = {{$trip->id}};
            if (id == null) {
                url = '/get/comments-trip/'+trip_id;
            } else {
                url = '/get/comments-trip/'+trip_id+'/'+id;
            }
            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    $('#display-comments').append(response);
                    loadOnClick();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>


      <script>
       // Gallery-->
        $(document).ready(function() {
            $('#lightgallery').lightGallery();
        });

        $(document).ready(function() {
            $('.dynamic').on('click', function(e) {
                $(document).lightGallery({
                    dynamic: true,

                    dynamicEl: [
                        @foreach ($galleries as $img)
                            {
                                src: '{{ asset("$img->gallery_image") }}',
                                thumb: '{{ asset("$img->gallery_image") }}'
                            },
                        @endforeach
                    ]
                });
            });
        });
        // Gallery End-->
    </script>




    <script>
    let latt = {{@$itineary[0]->itineary_map_lattitude}};
    let lang = {{@$itineary[0]->itineary_map_logitude}};
    var mapWithAccessibleControls = (function () {
    var map;
    var mapListener;
    var mapCanvas = document.getElementById("map");

    // set increments for panning
    var panY = Math.floor(mapCanvas.offsetHeight / 3);
    var panX = Math.floor(mapCanvas.offsetWidth / 3);

    // enable keyboard controls on selected elements
    function enableKeyboardAccessibility() {
      var controls = findControls();

      for (var i = 0; i < controls.length; i++) {
        makeKeyboardAccessible(controls[i]);
      }

      google.maps.event.removeListener(mapListener);
    }

    // filter through all divs to find the controls
    function findControls() {
      // list of target control titles
      var controlTitles = [
        "zoom in",
        "zoom out",
        "show street map",
        "show satellite imagery",
      ];

      // get all child divs of the generated map
      var mapElements = mapCanvas.querySelectorAll("div");

      // loop through divs and build array of elements matching our list
      var controls = [];
      for (var i = 0; i < mapElements.length; i++) {
        var element = mapElements[i];
        var title = element.title.toLowerCase().trim();
        if (controlTitles.indexOf(title) !== -1) {
          controls.push(element);
        }
      }

      return controls;
    }

    // modify element
    function makeKeyboardAccessible(element) {
      element.setAttribute("tabindex", "0");
      element.setAttribute("role", "button");
      element.setAttribute("aria-label", element.title);

      element.addEventListener("keydown", function (ev) {
        var key = ev.keyCode || ev.which;
        if (key == 13 || key == 32) {
          var event = document.createEvent("HTMLEvents");
          event.initEvent("click", true, false);
          this.dispatchEvent(event);
        } else if (key == 40) {
          //down
          map.panBy(0, panY);
        } else if (key == 38) {
          //up
          map.panBy(0, -panY);
        } else if (key == 37) {
          //left
          map.panBy(-panX, 0);
        } else if (key == 39) {
          //right
          map.panBy(panX, 0);
        } else {
          return;
        }
        ev.preventDefault();
      });

      (function (element) {
        var mouseover = false;
        var bo = element.style.border;
        var ma = element.style.margin;
        var bc = element.style.backgroundColor;
        var op = element.style.opacity;

        element.addEventListener("mouseover", function () {
          mouseover = true;
        });
        element.addEventListener("mouseout", function () {
          mouseover = false;
        });

        element.addEventListener("focus", function () {
          if (mouseover) return;
          element.style.border = "1px solid blue";
          element.style.margin = "-1px";
          element.style.backgroundColor = "transparent";
          element.style.opacity = "1";
        });
        element.addEventListener("blur", function () {
          element.style.border = bo;
          element.style.margin = ma;
          element.style.backgroundColor = bc;
          element.style.opacity = op;
        });
      })(element);
    }

    // make init() available outside
    return {
      init: function () {
        map = new google.maps.Map(mapCanvas, {
          center: { lat: latt, lng: lang },
          zoom: 4,
        });

        mapListener = google.maps.event.addListener(
          map,
          "tilesloaded",
          enableKeyboardAccessibility
        );
      },
    };
  })();

  mapWithAccessibleControls.init();
    </script>
@endpush

@include('frontend.layouts.footer')
