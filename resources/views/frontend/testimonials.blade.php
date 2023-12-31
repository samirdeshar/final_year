@include('frontend.layouts.header')

    <section id="breadcrumb-singlepage-actvities">
        <div class="container">
            <div class="titlenav-wrapper">
                <h1>Testimonial</h1>
                <ul>
                    <li><a href="https://rupakotholidays.nectar.com.np">Home</a>
                    </li>
                    <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fa fa-angle-right" aria-hidden="true"></i> Font Awesome fontawesome.com --> </li>
                    <li><a href="#" class="bread-acti"> Testimonial</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <div class="all-testimonials">
        <div class="container">
            @foreach ($testimonials as $testimonial)
            {{-- @dd($testimonial) --}}
                <div class="row blog-post">
                    <div class="col-md-9">
                    <h3>
                        <a href="{{route('testimonial.details',@$testimonial->slug)}}">{{@$testimonial->title}}</a>
                    </h3>

                    <div class="blog_info">
                        <span class="blog_posttype blog_slider text-center"> <i class="las la-image"></i></span>

                        <div class="blog_info_block">
                            <span class="author_name">Review by {{@$testimonial->name}}</span>

                            <span class="date"><i class="fa fa-calendar  "></i> {{date('M d',strtotime(@$testimonial->created_at))}}, {{date('Y',strtotime(@$testimonial->created_at))}}, {{date('H:I:
                             a',strtotime(@$testimonial->created_at))}}</span>
                        </div>
                    </div>
                    <a href="{{route('testimonial.details',@$testimonial->id)}}" class="read-more hovereffect ">Read More <span class="fa fa-angle-right"></span></a>

                </div>

                </div>
            @endforeach

            {{$testimonials->links()}}




        </div>
    </div>
@include('frontend.layouts.footer')
