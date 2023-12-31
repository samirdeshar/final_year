@include('frontend.layouts.header')
<!-- Banner -->

<div class="testimonial-main">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
        <h1>Welcome to our Testimonials and Reviews!</h1>
        <div class="testmonial-nav">
            <ul>
                <li>
                    <a href="">Home</a>
                </li>
                <li>
                    /
                </li>
                <li>
                    <a href="" class="text-warning">Review Detail</a>
                </li>
            </ul>
        </div>
        </div>
        </div>
    </div>
</div>

{{-- <section class="banner">
    <img src="{{asset('uploads/about/thumbnail/109666_1659241973.jpg')}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>Testimonials</h1>
            <span></span>
        </div>
    </div>
</section> --}}


<!-- Banner End -->


<!-- Other Content -->
<section class="other-content mb" style="margin:0 auto">
    <div class="container" id="testimonial-display">
        <div class="general_page_content">
            <div class="row mt-4">
                <div class="col-md-9">
                    <div class="pagecontent-single">
                        <h3>Nepal tour a wonderful tour</h3>
                        @if(@$testimonial)
                        <img src="{{asset(@$testimonial->image)}}" alt="testiminial image">
                        {!!@$testimonial->description!!}
                        {{ $testimonial->title}}
                        @endif
                        @if(@$review)
                        {{ $review->full_name }}
                        <br>
                        {{ $review->company_name }}
                        <br>
                        @php
                        $rating = $review->rating;
                        @endphp
                        <ul class="d-flex" style="list-style-type:none;">
                            @for ( $i=1 ;  $i<=5 ; $i++)
                                @if($i <= $rating)
                                <li><i class="las la-star" style="color:orange;"></i></li>
                                @else
                                <li><i class="las la-star" style="color: #dfdad1;"></i></li>
                                @endif
                            @endfor
                            {{-- <li><i class="las la-star"></i></li>
                            <li><i class="las la-star"></i></li>
                            <li><i class="las la-star"></i></li> --}}
                        </ul>
                        <p>{!! $review->description !!}</p>

                        <br>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
        </div>
        {{-- <div class="community-btn">
            <a class="btn load-button" id="load-button" data-last_id="{{$testimonial->id}}" style="color: rgb(127, 140, 241)">Load More Testimonials</a>
        </div>
         --}}

    </div>

</section>
<!-- Other Content End -->

@include('frontend.layouts.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
{{-- <script>
    loadMore();
    function loadOnClick(){
        $('.load-button').on('click', function(){
            let id = $(this).data("last_id");
            $(this).remove();
            loadMore(id);
        });
    }
    function loadMore(id=null){
        let url = "";
        if(id==null){
            url = '/get/ajax-testimonials/';
        }else{
            url = '/get/ajax-testimonials/'+id;
        }
        $.ajax({
            type: 'get',
            url: url,
            success: function(response) {
                $('#testimonial-display').append(response);
                loadOnClick();
            },
            error : function(error){
                console.log(error);
            }
        });
    }
</script> --}}

