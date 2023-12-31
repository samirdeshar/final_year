<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset(@$setting->icon) }}">
    <title>{{ $setting->site_name }} | {{ @$meta['meta_title'] ?? $setting->meta_title }}</title>
    <link rel="shortcut icon" href="{{$setting->logo ?? ''}}" type="image/x-icon">
    @include('frontend.meta')

    @include('frontend.layouts.style')



</head>


<body id="top">
    @include('frontend.layouts.header')

    <div  class="preload" data-preaload>
        <div class="circle"></div>
        <p class="text">Order Munch</p>
    </div>

    @yield('main_content')



    @include('frontend.layouts.footer')
    <a href="#top" class="back-top-btn active" aria-label="back to top" data-back-top-btn>
        <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
      </a>



</body>
@include('frontend.layouts.script')

