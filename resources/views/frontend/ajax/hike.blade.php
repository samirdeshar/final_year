@if (@$hikes->count() > 0)
@isset($hikes)
@foreach ($hikes as $hike)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="community-wrap" id="alldata">
            <div class="community-media">
                <a target="_blank" href="{{ @$hike->url_link }}">
                    <img src="{{ asset(@$hike->image) }}" alt="images">
                </a>
            </div>
            <div class="community-info">
                <a target="_blank" href="{{ @$hike->url_link }}">
                    <span>{{ date('d-M-Y', strtotime(@$hike->created_at)) }}</span>
                    <h3>{{ $hike->title }}</h3>
                </a>
            </div>
        </div>
    </div>
@endforeach
@endisset
<div class="community-btn">
    <a class="btn load-button" id="load-button" data-last_id="{{$hike->id}}">Load More Hike for Nepal</a>
</div>
@else
    <h1 class="text-center">Sorry No More Hikes At This Moment !!</h1>
@endif
