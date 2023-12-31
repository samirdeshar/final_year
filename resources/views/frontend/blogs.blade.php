@include('frontend.layouts.header')


<!-- Banner -->
<section class="banner">
    <img src="{{asset('frontend/images/banner.jpg')}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{$blogcategory->name}}</h1>
        </div>
    </div>
</section>
<!-- Banner End -->
<!-- Listing Page -->
<section class="special-trip listing-page pt pb">
    <div class="container">
        <div class="section_header">
        </div>
        <div class="row">
            @foreach($posts as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="special-trip-wrap">
                        <div class="special-trip-media">
                            <a href="{{route('frontend.singleBlog', $blog->slug)}}">
                                <img src="{{asset('uploads/post/thumbnail/'.@$blog->image)}}" alt="images">
                            </a>
                        </div>
                        <div class="special-trip-info">
                            <h3>
                                <span><a href="{{route('frontend.singleBlog', $blog->slug)}}">{{ strtoupper(@$blog->title)}}</a></span>
                            </h3>
                            <p>
                                {!! Str::limit($blog->description, 300, $end='.......') !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Listing Page End -->


@include('frontend.layouts.footer')
