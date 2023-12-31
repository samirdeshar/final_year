@include('frontend.layouts.header')

<!-- Banner -->
<section class="banner">
    <img src="{{ asset(@$information->image) }}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{ @$information->title }}</h1>
        </div>
    </div>
</section>
<!-- Banner End -->


<!-- Other Content -->
<section class="general-page mb mt">
    <div class="container">
        {!! @$information->description !!}
    </div>
</section>
<!-- Other Content End -->


@include('frontend.layouts.footer')
