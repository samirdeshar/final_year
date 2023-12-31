<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset(@$setting->icon) }}">
    <title>{{ $setting->site_name }} | {{ @$meta['meta_title'] ?? $setting->meta_title }}</title>
    @include('frontend.meta')

    <link href="{{ asset('frontend/plugins/lineawesome1.3.0/css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/lightgallery.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/ion.rangeSlider.min.css') }}"/>
    <link href="{{ asset('frontend/css/font.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{$setting->logo ?? ''}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('front-css')


</head>

<body>
    <!-- Top Header  -->
    <div class="top-header">
        <div class="container">
            <div class="th-wrap">
                <div class="social_link">
                    <p><i class="fa fa-comment"></i> Support: {{@$setting->email}}</p>
                    <p>Phone: {{@$setting->phone}},{{@$setting->contact}},{{@$setting->contact_second}}</p>
                    <ul>
                        <li>
                            <a href="{{ $setting->fb_link }}" target="_blank">
                                <i class="lab la-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $setting->twitter_link }}" target="_blank">
                                <i class="lab la-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $setting->insta_link }}" target="_blank">
                                <i class="lab la-instagram"></i>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ $setting->youtube_link }}" target="_blank">
                                <i class="lab la-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $setting->linkedin_link }}" target="_blank">
                                <i class="lab la-linkedin-in"></i>
                            </a>
                        </li> --}}
                    </ul>
                </div>
                <div class="header-contact">
                    <ul>
                        <li>
                            @if(auth()->guard('customer')->user())
                            <a href="{{route('customer.logout')}}" class="btn btn-signin">
                                {{-- <i class="las la-phone-square"></i>
                                {{ @$setting->contact }} --}}
                                Logout
                            </a>
                            @else
                            <a href="{{route('customer.login')}}" class="btn btn-signin">
                                {{-- <i class="las la-phone-square"></i>
                                {{ @$setting->contact }} --}}
                                Sign In
                            </a>
                            @endif

                        </li>
                        <li>

                            @if(auth()->guard('customer')->user())
                            <a href="{{route('customer.dashboard')}}" class="btn btn-signup">
                                {{-- <i class="las la-phone-square"></i>
                                {{ @$setting->contact }} --}}
                                Dashboard
                            </a>
                            @else
                            <a href="{{route('customer.signup')}}" class="btn btn-signup">
                                {{-- <i class="las la-tty"></i>
                                {{ @$setting->contact_second }} --}}
                                Sign Up
                            </a>
                            @endif


                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- Top Header End  -->

    <!-- Header  -->
    <div class="middle-header">
        <div class="container">
            <div class="mh-wrap">
                <div class="header-left">
                    <div class="site_logo">
                        <a href="{{ url('/') }}" class="">
                            <img src="{{ asset(@$setting->logo) }}" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="header-utilities">
                    {{-- <div class="header-phone">
                        <span>Call us, we’re at your service</span>
                        <a href="tel:{{ @$setting->phone }}">
                            <i class="las la-tty"></i>
                            {{ @$setting->phone }}
                        </a>
                    </div>
                    <div class="header-btn">
                        <a href="#">Sign In/Register</a>
                        <a href="">Inquiry <i class="lab la-telegram-plane"></i></a>
                    </div> --}}
                    <div class="header-menu">
                        <div class="hamburger_menu hamburger_menu-mobile">
                            <i class="las la-bars"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="{{url('/')}}" class="nav-link">Home</a>
                            </li>

                            {{-- {{ dd($headerpages) }} --}}
                            @isset($headerpages)
                            @foreach ($headerpages as $key=>$headerpage)

                            @if($headerpage->slug !== 'about')


                            @if($key==1)
                            <li class="dropdown">
                                <a href="{{url('/')}}" class="nav-link">PACKAGES</a>
                                <div class="dropdown-wrapper">
                                    <div class="dropdown-menuwrapper">
                                    </div>
                                    <div class="dropdown-menuwrapper">
                                        <h4>Inbound</h4>
                                        <ul class="dropdown-links" role="menu">
                                            @foreach($inbond as $inB)
                                            <li><a href="{{ route('tripcategorydetail',$inB->slug) }}">{{$inB->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="dropdown-menuwrapper">
                                        <h4>Outbound</h4>
                                        <ul class="dropdown-links" role="menu">
                                            @foreach($outbond as $outB)
                                            <li><a href="{{ route('tripcategorydetail',$outB->slug) }}">{{$outB->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="dropdown-menuwrapper">
                                    </div>

                                </div>
                                <i class="las la-angle-down"></i>
                            </li>
                            @endif
                                <li>
                                    @if($headerpage->slug=='reviews')
                                    <a href="{{ route('frontend.testimonials') }}" class="nav-link">{{ $headerpage->title }}</a>
                                    @else
                                    <a href="{{ route('detail.page', $headerpage->slug) }}" class="nav-link">{{ $headerpage->title }}</a>
                                    @endif

                                </li>
                            @endif
                            @if($headerpage->slug == 'about')
                            <li class="dropdown">
                                <a href="{{ url('page/about') }}" class="nav-link">ABOUT <i class="las la-angle-down"></i></a>
                                <div class="dropdown-wrapper" style="z-index: 9999;">
                                    <div class="dropdown-menuwrapper"></div>
                                    <div class="dropdown-menu-wrapper">
                                        <ul class="dropdown-links" role="menu">
                                            <li class="nav-item drop-item-second"><a href="{{ url('/page/message-from-executive-chairman') }}">Message from Chairman</a></li>
                                            <li class="nav-item drop-item-second"><a href="{{ url('our-team') }}">Our Team</a></li>
                                            <li class="nav-item drop-item-second"><a href="{{ url('/page/about-nepal') }}">About Nepal</a></li>
                                            <li class="nav-item drop-item-second"><a href="{{ url('/page/responsible-tourism') }}">Responsible Tourism</a></li>
                                            <li class="nav-item drop-item-second"><a href="{{ url('/page/nepal-travel-tips') }}">Nepal Travel Tips</a></li>
                                            <li class="nav-item drop-item-second"><a href="{{ url('/page/general-information') }}">General Information</a></li>
                                            <li class="nav-item drop-item-second"><a href="{{ url('/page/faqs') }}">FAQs</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @endforeach
                            @endisset
                            @foreach ($menus as $menu)
                                <li class="nav-item drop-item">
                                    @if($menu->category_slug==='trip-category')
                                    <a class="nav-link"  href="{{ route('getMenuTrip',$menu->slug) }}" >
                                        {{ $menu->name }}
                                        @if ($menu->children->count() > 0) <i class="las la-angle-down"></i> @endif
                                    </a>
                                    @else
                                    <a class="nav-link"  href="{{ $menu->external_link ?? route('generalPage', $menu->title_slug) }}" >
                                        {{ $menu->name }}
                                        @if ($menu->children->count() > 0) <i class="las la-angle-down"></i> @endif
                                    </a>
                                    @endif
                                    @if ($menu->children->count() > 0)

                                        <ul class="dropdown-menus">
                                            @foreach ($menu->children as $child)
                                                <li>
                                                    <a
                                                        @if ($child->category_slug == 'page') href="{{ $child->external_link ?? route('generalPages', $child->title_slug) }}"  @else href="{{ $child->external_link ?? route('category', $child->category_slug) }}" @endif>{{ $child->name }}
                                                    </a>
                                                    @if ($child->children->count() > 0) <i class="las la-angle-down"></i> @endif
                                                        @if ($child->children->count() > 0)
                                                        <ul class="second-dropdown-menus">
                                                            @foreach ($child->children as $child1)
                                                            <li class="nav-item drop-item-second">
                                                                <a
                                                                    @if ($child1->category_slug == 'page') href="{{ $child1->external_link ?? route('generalPages', $child1->title_slug) }}"  @else href="{{ $child1->external_link ?? route('category', $child1->category_slug) }}" @endif>{{ $child1->name }}
                                                                </a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="aside-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{@$setting->logo3}}" alt="aside-logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Header  -->


    {{-- <header class="header">
        <div class="container">
            <div class="header-wrap">


            </div>
        </div>
    </header> --}}


    <!-- Header End  -->

    <!-- Mobile Menu -->
    <div id="mySidenav" class="sidenav">
        <div class="mobile-logo">
            <a href="{{ url('/') }}"><img src="{{ asset(@$setting->logo) }}" alt="logo"></a>
            <a href="javascript:void(0)" id="close-btn" class="closebtn">&times;</a>
        </div>
        <div class="no-bdr1">
            <ul id="menu1">
                <li>
                    <a href="{{url('/')}}" class="nav-link">Home</a>
                </li>

                @isset($headerpages)
                @foreach ($headerpages as $key=>$headerpage)
                @if($key==2)
                <li class="dropdown">
                    <a href="{{url('/')}}" class="nav-link">PACKAGES</a>
                    <div class="dropdown-wrapper">
                        <div class="dropdown-menuwrapper">
                        </div>
                        <div class="dropdown-menuwrapper">
                            <h4>Inbound</h4>
                            <ul class="dropdown-links" role="menu">
                                @foreach($inbond as $inB)
                                <li><a href="{{ route('tripcategorydetail',$inB->slug) }}">{{$inB->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="dropdown-menuwrapper">
                            <h4>Outbound</h4>
                            <ul class="dropdown-links" role="menu">
                                @foreach($outbond as $outB)
                                <li><a href="{{ route('tripcategorydetail',$outB->slug) }}">{{$outB->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="dropdown-menuwrapper">
                        </div>

                    </div>
                </li>
                @endif
                    <li>
                        @if($headerpage->slug=='reviews')
                        <a href="{{ route('frontend.testimonials') }}" class="nav-link">{{ $headerpage->title }}</a>
                        @else
                        <a href="{{ route('detail.page', $headerpage->slug) }}" class="nav-link">{{ $headerpage->title }}</a>
                        @endif

                    </li>
                @endforeach
                @endisset
                @foreach ($menus as $menu)
                    <li class="nav-item drop-item">
                        @if($menu->category_slug==='trip-category')
                        <a class="nav-link"  href="{{ route('getMenuTrip',$menu->slug) }}" >
                            {{ $menu->name }}
                            @if ($menu->children->count() > 0) <i class="las la-angle-down"></i> @endif
                        </a>
                        @else
                        <a class="nav-link"  href="{{ $menu->external_link ?? route('generalPage', $menu->title_slug) }}" >
                            {{ $menu->name }}
                            @if ($menu->children->count() > 0) <i class="las la-angle-down"></i> @endif
                        </a>
                        @endif

                        @if ($menu->children->count() > 0)
                            <ul class="dropdown-menus">
                                @foreach ($menu->children as $child)
                                    <li>
                                        <a
                                            @if ($child->category_slug == 'page') href="{{ $child->external_link ?? route('generalPages', $child->title_slug) }}"  @else href="{{ $child->external_link ?? route('category', $child->category_slug) }}" @endif>{{ $child->name }}
                                        </a>
                                        @if ($child->children->count() > 0) <i class="las la-angle-down"></i> @endif
                                            @if ($child->children->count() > 0)
                                            <ul class="second-dropdown-menus">
                                                @foreach ($child->children as $child1)
                                                <li class="nav-item drop-item-second">
                                                    <a
                                                        @if ($child1->category_slug == 'page') href="{{ $child1->external_link ?? route('generalPages', $child1->title_slug) }}"  @else href="{{ $child1->external_link ?? route('category', $child1->category_slug) }}" @endif>{{ $child1->name }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif

                                            <i class="las la-plus-circle"></i>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
            <ul class="mobile-social-media">
                <li><a href="{{ $setting->fb_link }}" target="_blank"><i class="lab la-facebook-f"></i></a>
                </li>
                <li><a href="{{ $setting->twitter_link }}" target="_blank"><i
                            class="lab la-twitter"></i></a>
                </li>
                <li><a href="{{ $setting->insta_link }}" target="_blank"><i
                            class="lab la-instagram"></i></a>
                </li>
                <li><a href="{{ $setting->youtube_link }}" target="_blank"><i
                            class="lab la-youtube"></i></a>
                </li>
                <li><a href="{{ $setting->linkedin_link }}" target="_blank"><i
                            class="lab la-linkedin-in"></i></a></li>
                <li><a href="{{ $setting->google_plus }}" target="_blank"><i
                            class="lab la-google-plus-g"></i></a></li>
            </ul>
            <div class="aside-logo">
                <a href="{{ url('/') }}">
                    <img src="{{@$setting->logo3}}" alt="aside-logo">
                </a>
            </div>
        </div>
    </div>

    @if(session()->get('alertCancel')=='sumit')
    @else
    <div class="site-alert" id="alert" hidden>
        <div class="alert-top">
            <img src="{{@$setting->logo}}" alt="alert-image">
            <div class="alert-information">
                <h4>Rupakot wants to be friend with you</h4>
                <p>Become friends with Rupakotholidays to be the first one to know about exclusive deals and discounts.</p>
            </div>
        </div>
        <div class="alert-buttons">
            <a href="javascript:;" class="btn btn-notintrested" id="alertHide">Not Intrested</a>
            <a href="javascript:;" class="btn btn-befirnds" id="saveAlert">Be Friends</a>
        </div>
    </div>
    @endif
	<!-- Mobile Menu End -->

