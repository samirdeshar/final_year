@include('frontend.layouts.header')


<!-- Banner -->
<section class="banner">
    <img src="{{ asset(@$gears_details->new_banner_image) }}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>
                {{ @$gears_details->gear_title }}
            </h1>
            <span>{{ @$gears_details->gear_subtitle }}</span>
            <div class="banner-button">
                <a href="{{asset(@$gears_details->gear_pdf_file)}}">{{ @$gears_details->gear_button_text }}</a>
            </div>
        </div>
    </div>
</section>

<div class="container">
   <div class="row">
    {!! $gears_details->gear_description !!}
    <!--{!! Str::limit(strip_tags(ucfirst($gears_details->gear_description))) !!}-->
   </div>
</div>


<!--Gear List End -->
@include('frontend.layouts.footer')
