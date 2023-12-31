
@if ($trip_comments->count() > 0)
<div class="general_page_content only-single-page">
    @foreach ($trip_comments as $trip_comment)
        <div class="row mt-4">
            <div class="col-md-3 text-center">
                <img src="{{ asset('uploads/comment/' . @$trip_comment->image) }}" alt=""
                    style="border-radius: 100%; width: 120px !important; height: 120px !important;object-fit:cover;">
            </div>
            <div class="col-md-9">
                <p>{{ @$trip_comment->title }}!</p>

                <p>{{ @$trip_comment->comment }}</p>

                <p>-{{ ucfirst(@$trip_comment->user_name) }},{{ strtoupper(@$trip_comment->country) }}
                </p>
                -{{ @$trip_comment->email }}
            </div>
    @endforeach
</div>


<div class="community-btn">
    <a class="btn btn-success load-button" id="load-button" data-id="{{$trip_comment->id}}" style="margin: 10px; padding: 10px;">Load More Testimonials</a>
</div>
@else
    <h1 class="text-center">Sorry No More Testimonial In This Trip !!</h1>
@endif
