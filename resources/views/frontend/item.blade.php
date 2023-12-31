@if (@$trips->count() > 0)
    <div class="category-wise">
        {{-- <h2>{{ @$trips->count() }} Results Found</h2> --}}
        <div class="category-list">
            @foreach (@$trips as $data)
                <div class="category-list-col">
                    <div class="category-wrap">
                        <div class="category-media">
                            <a href="{{ route('trip-details', @$data->slug) }}" title="{{ ucfirst(@$data->title) }}">
                                <img src="{{ asset(@$data->banner_image) }}" alt="images">
                            </a>
                        </div>
                        <div class="category-info">
                            <div class="category-info-content">
                                <h3>
                                    <a href="{{ route('trip-details', @$data->slug) }}">
                                        {{ ucfirst(@$data->title) }}
                                    </a>
                                </h3>
                                <p>
                                    {{ Str::limit(@$data->summary, 220) }}
                                </p>
                            </div>
                            <div class="category-info-util">
                                <small>{{ @$data->trip_duration }}
                                    <span>Days</span>
                                </small>
                                <b><i class="las la-tags"></i> US$ {{ @$data->trip_cost }}</b>
                                <div class="cat-btns">
                                    <a href="{{ route('trip-details', @$data->slug) }}">Book Now <i
                                            class="las la-bookmark"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {!! $trips->links() !!}
    </div>
@else
    <h2 class="blank-message">Sorry !! No Trip At This Moment !!</h2>
@endif
