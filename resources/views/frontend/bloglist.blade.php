@include('frontend.layouts.header')


<!-- Banner -->
<section class="banner">
    <img src="{{asset(@$menu->banner_image)}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{$menu->name}}</h1>
        </div>
    </div>
</section>
<!-- Banner End -->

<!-- Listing Page -->
<section class="blog-page mt mb">
    <div class="container">
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-wrap">
                        <div class="blog-media">
                            <a href="{{route('frontend.singleBlog', $blog->slug)}}">
                                <img src="{{asset(@$blog->image)}}" alt="images">
                            </a>
                        </div>
                        <div class="blog-info">
                            <span><a href="{{ route('frontend.blogCategory', @$blog->getCat->slug) }}">{{ @$blog->getCat->name }}</a></span>
                            <h3><a href="{{route('frontend.singleBlog', $blog->slug)}}">{{ @$blog->title }}</a></h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Listing Page End -->

@include('frontend.layouts.footer')
