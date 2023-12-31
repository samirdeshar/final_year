


<footer class="footer">
    {{-- <div class="travel-bg">
        <img src="{{ asset('frontend/images/bg3.png') }}" alt="images">
    </div> --}}
    <div class="footer-col">
        <div class="container">
            <div class="newsletter d-none">
                <div class="newsletter-left">
                    <h3>Subscribe to our Newsletter</h3>
                </div>
                <div class="newsletter-form">
                    {{ Form::open(['url' => route('frontend.subscribe')]) }}
                    @method('post')
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <input type="text" name="name" id="name" placeholder="Enter your Name here"
                                    class="form-control" required>
                                @error('name')
                                    <span class="text-warning">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Enter your email here"
                                    class="form-control">
                                @error('email')
                                    <span class="text-warning">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-btn">
                            <button type="submit">Subscribe Now</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <a href="{{ url('/') }}" class="footer-small-logo">
                                <img src="{{ asset(@$setting->logo) }}" alt="Logo" class="footer-logo p-2" style="border-radius: 8px;">
                            </a>
                            <ul class="footer-social">
                                <li><a href="{{ @$setting->fb_link }}" target="_blank"><i class="lab la-facebook-f"></i></a>
                                </li>
                                <li><a href="{{ @$setting->twitter_link }}" target="_blank"><i class="lab la-twitter"></i></a>
                                </li>
                                <li><a href="{{ @$setting->instagram_link }}" target="_blank"><i
                                            class="lab la-instagram"></i></a> </li>
                                <li><a href="{{ @$setting->youtube_link }}" target="_blank"><i class="lab la-youtube"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 class="text-light">Locate Us</h3>
                    <ul class="text-light">
                        <li class="d-flex">
                            <i class="las la-map-marker me-1 mt-1"></i>
                            <a href="javascript:void(0)" onclick="openGoogleMap(); return false;">
                            {{ @$setting->address }}
                            </a>
                        </li>
                        <li class="d-flex">
                            <i class="las la-phone me-1 mt-1"></i>
                            {{ @$setting->phone }}, {{ @$setting->contact }},<br>
                            {{ @$setting->contact_second }}, {{ @$setting->contact4 }} {{ @$setting->contact5 }} {{ @$setting->contact6 }}
                            <br>
                        </li>
                        <li class="d-flex">
                            <i class="las la-envelope me-1 mt-1"></i>
                            <div>
                                <a href="mailto:{{ @$setting->email }}">{{ @$setting->email }}</a>
                                <a href="mailto:{{ @$setting->email2 }}">{{ @$setting->email2 }}</a>
                            </div>

                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 p-0">
                    <div class="footer-wrap space">
                        <h3>Useful Links</h3>
                        <ul class="footer-menu">
                            @foreach ($footerpages as $footerpage)
                                <li><a href="{{ route('detail.page', $footerpage->slug) }}">{{ $footerpage->title }}</a>
                                </li>
                            @endforeach
                            {{-- @if (isset($faqs))
                                        <li><a href="{{ rout    e('frontend.generalfaqs') }}">FAQs</a></li>
                                    @endif --}}


                        </ul>

                    </div>

                    <form action="{{ route('frontend.subscribe') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <div class="input-wrapper">
                                <input type="hidden" class="form-control" name="name" value="subscriber">
                                <input class="btn btn-sm" name="email" id="email" type="email"
                                    placeholder="Enter Your Email Address" required="">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>

                                </div>

                            </div>
                        @enderror
                        <div class="captcha-form">
                            <div class="form-group">
                                <style>
                                    .rc-anchor-normal-footer{
                                        position: absolute !important;
                                        right: 60px !important;
                                    }
                                </style>
                                <div class="g-recaptcha" data-sitekey="6Lfs9jomAAAAAAaejaP35DT_aRWtOcaTIIRD3hYb"></div>
                                @error('g-recaptcha-response')
                                    <span class="text-danger"> The reCAPTCHA was invalid. Go back and try it again.
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button class="btn  btn-sm" type="submit">SUBSCRIBE</button>

                </div>
                </form>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ url('/') }}" class="footer-small-logo" style="border-radius: 8px;">
                    <img src="{{ asset(@$setting->logo3) }}" alt="Logo" class="footer-logo p-2">
                </a>
                <ul class="footer-social">
                    <li><a href="{{ @$setting->fb_link2 }}" target="_blank"><i class="lab la-facebook-f"></i></a>
                    </li>
                    <li><a href="{{ @$setting->twitter_link2 }}" target="_blank"><i class="lab la-twitter"></i></a>
                    </li>
                    <li><a href="{{ @$setting->instagram_link2 }}" target="_blank"><i
                                class="lab la-instagram"></i></a> </li>
                    <li><a href="{{ @$setting->youtube_link2 }}" target="_blank"><i class="lab la-youtube"></i></a>
                    </li>
                </ul>
        </div>
        {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-wrap">
                            <h3>{{@$setting->site_name}}</h3>
                            <p><strong>{{@$setting->quatation}}<</strong><br>
                               {{@$setting->address}}<br>
                                Tel: {{@$setting->phone}},{{@$setting->contact}},{{@$setting->contact_second}}<br>
                                Email : <a href="mailto:{{@$setting->email}}">{{@$setting->email}}</a></p>

                        </div>
                    </div> --}}

        {{-- <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="footer-wrap">
                            <h3>{{@$setting->site_name}}</h3>
                            <p><strong>{{@$setting->quatation}}<</strong><br>
                               {{@$setting->address}}<br>
                                Tel: {{@$setting->phone}},{{@$setting->contact}},{{@$setting->contact_second}}<br>
                                Email : <a href="mailto:{{@$setting->email}}">{{@$setting->email}}</a></p>

                        </div>

                        <div class="footer-wrap">
                            <div class="cards">
                                <img src="{{ asset(@$setting->payment_image) }}" alt="images">
                            </div>
                        </div>
                    </div> --}}
    </div>


    </div>


    {{-- <div class="container capthch-info">
                <div class="row">
                <div class="col-md-5 container">
                    <div class="footer-contacts">
                        <div class="top-contacts-foot">
                            <span>Call us, we're open 24/7</span>
                            <h4>+977- {{@$setting->phone}}</h4>
                        </div>
                        <div class="top-contacts-foot">
                            <span>Follow us on our social medias</span>

                        </div>
                    </div>
                </div>
                <div class="col-md-7">


                </div>
                </div>
            </div> --}}


    </div>


    </div>

</footer>

<div class="footer-affilate">
    <div class="container">
        <h5 class="text-center">WE ARE AFFILIATED WITH</h5>
        <ul class="partner-list">
            @foreach ($affiliates as $affiliate)
                <li><a target="_blank" href="{{ $affiliate->url }}"><img src="{{ asset(@$affiliate->image) }}"
                            alt="images"></a></li>
            @endforeach
        </ul>
    </div>
</div>

<div class="footer-end">
    <div class="container">
        <div class="copyright-foot">
            <p>
                © {{ date('Y') }} {{ @$setting->site_name }} All rights reserved.
            </p>
            <p>Powered by: <a href="https://nectardigit.com/">Nectar Digit</a></p>
        </div>
    </div>
</div>

<div class="footer-bottom d-none">
    <div class="container">


        <div class="fb-middle text-center">

            <p>
                © {{ date('Y') }} {{ @$setting->site_name }} All rights reserved.
            </p>
        </div>


    </div>
</div>

<!-- Scroll Top -->

{{-- <div class="go-top">
    <div class="pulse">
        <i class="las la-angle-up"></i>
    </div>
</div> --}}

<!-- Scroll Top End -->

<div class="get-callback" style="    writing-mode: vertical-rl;
padding: 10px;
transform: translate(0, -50%);">
    <a href="{{ route('call.back') }}"><i class="las la-phone-volume"></i> Get a callback</a>
    {{-- <a href="{{ route('call.back') }}"><img src="https://www.rupakot.nectar.com.np/templates/img/callback.png"
            alt="callback"></a> --}}
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/lightgallery-all.min.js') }}"></script>
<script src="{{ asset('frontend/js/ion.rangeSlider.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXLMlEq4wefW7-VhHrtCWHVAHD_NKgz88"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>


<script src="{{ asset('frontend/js/script.js') }}"></script>
@yield('frontend-js')
@stack('script')
{{-- Tostr --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::render() !!}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>

<script>
    $(document).on('click', '#searchButton', function() {
        $('#searchForm').submit();
    });

    setTimeout(function() {
        $('#alert').removeAttr('hidden');
    }, 4000);

    $(document).on('click', '#alertHide', function() {
        $('#alert').attr('hidden', true);
        @php
            request()
                ->session()
                ->put('alertCancel', 'sumit');
        @endphp
    });

    $(document).on('click', '#saveAlert', function() {
        var route = "{{ route('saveAlert') }}";
        $('#alert').attr('hidden', true);
        window.location.href = route;
    });
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5b138e768859f57bdc7bca16/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->
<script>
    $(document).ready(function() {
        $('#summernote123').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    });
</script>
<script>

    function openGoogleMap(){
        let embedded_link = "{{ @$setting->location_url }}";
        window.open(embedded_link, 'blank');
    }
</script>

</body>

</html>
