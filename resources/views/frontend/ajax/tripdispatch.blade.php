@if (@$cybercasts->count() > 0)

    @foreach ($cybercasts as $cybercast)

        <div class="col-md-4">
            <div class="special-trip-wrap">
                <div class="special-trip-media">
                    <a href="{{ route('frontend.tripDispatchSingle',$cybercast->slug) }}">
                        <img src="{{ asset(@$cybercast->image) }}" alt="images">
                    </a>
                </div>
                <div class="special-trip-info">
                    <h3>
                        <span>{{ $cybercast->cyberCategory()->pluck('name')->implode(',') }}</span>

                    </h3>
                    <a href="{{ route('frontend.tripDispatchSingle', $cybercast->slug) }}" style="color:black">
                        <h3>{{ $cybercast->title }}</h3>
                    </a>
                    <p>
                        {!! Str::limit(strip_tags(ucfirst($cybercast->description)), 120, '...') !!}
                    </p>

                </div>
            </div>
        </div>
    @endforeach
    <div class="dispatch-btn">
        <a class="btn load-button" id="load-button" data-last_id="{{ $cybercast->id }}">Load More</a>
    </div>
    </div>
@else
    <h1 class="text-center">Sorry No More Trips Dispatch At This Moment !!</h1>
@endif
