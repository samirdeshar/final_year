
    @if ($testimonials->count() > 0)
        @foreach ($testimonials as $testimonial)

        <div class="general_page_content">
            <div class="row mt-4">
                <div class="col-md-9">
                    <div class="pagecontent-single">
                        <h3>Nepal tour a wonderful tour</h3>
                        <img src="{{asset(@$testimonial->image)}}" alt="testiminial image">
                        {!!@$testimonial->description!!}
                        {{ $testimonial->title}}
                    </div>
                </div>
                {{-- <div class="col-md-8">

                </div> --}}
            </div>
            <hr>
        </div>
    @endforeach
    <div class="community-btn">
        <a class="btn load-button" id="load-button" data-last_id="{{$testimonial->id}}" style="color: rgb(127, 140, 241)">Load More Testimonials</a>
    </div>
    @else
        <h1 class="text-center">Sorry No More Testimonials !!</h1>
    @endif
