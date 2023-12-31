@include('frontend.layouts.header')
@section('frontend-js')
    <script>

        let category_id = '';
        let category_name = '';
       function reloadAjax(){
        $('.page-link').on('click', function(e){
                e.preventDefault();
                let url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: "get",
                    data: {
                        category_id: category_id,
                        category_name: category_name
                    },
                    success: function(response) {
                        $('#item-show').html(response);
                        reloadAjax();
                    }
                });
        });
       }


        var selection_sort = "All";
        var selection_cat = null;
        $(document).on('click', '.search-trip', function(e) {
            e.preventDefault();
            category_id = $(this).data('categoryid');
            selection_cat = category_id;

            category_name = $(this).data('categoryname');
            selection_sort = category_name;
            $.ajax({
                url: "{{ route('trip.search') }}",
                type: "get",
                data: {
                    category_id: category_id,
                    category_name: category_name
                },
                success: function(response) {

                    $('#item-show').html(response);
                    reloadAjax();
                    // document.getElementById('test').innerHTML=;
                }
            });

        });

        $(document).ready(function() {
            $('#sort-trip').on('change', function(e) {
                e.preventDefault();
                let sort_order = $(this).val();
                getSortedTrip(sort_order);
            });
        });





        function getSortedTrip(sort_order) {
            $.ajax({
                url: "{{ route('trip.sort') }}",
                type: "get",
                data: {
                    selection_sort: selection_sort,
                    sort_order: sort_order,
                    selection_cat: selection_cat
                },
                success: function(response) {
                    $('#item-show').html(response);
                }
            });
        }
    </script>


@endsection

<!-- Banner -->
<section class="banner">
    <img src="{{ asset(@$meta->banner_image) }}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{ $meta->name }}</h1>
        </div>
    </div>
</section>
<!-- Banner End -->

<!-- Category -->

<section class="category mt mb">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 desktop-only-filter">
                <div class="category-sidebar">
                    <h2><i class="las la-sliders-h"></i> Filter</h2>
                    <div class="filter">
                        <h3>Destination</h3>
                        <ul>
                            @isset($parentCategory)
                                @foreach ($parentCategory as $parent)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label">
                                                <a href="javascript:void();" class="search-trip" data-categoryname="parent"
                                                    data-categoryid="{{ $parent->id }}">
                                                    {{ $parent->name }} ({{ $parent->getCategoryTrip->count() }})
                                                </a>
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>
                    <div class="filter">
                        <h3>Activity</h3>
                        <ul>
                            @isset($subCategory)
                                @foreach ($subCategory as $sub)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label">
                                                <a href="javascript:;" class="search-trip" data-categoryname="subparent"
                                                    data-categoryid="{{ $sub->id }}">
                                                    {{ $sub->name }} ({{ $sub->category_trip->count() }})
                                                </a>
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>
                    <div class="filter">
                        <h3>Days</h3>
                        <ul>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label">
                                        <a href="javascript:;" class="search-trip" data-categoryname="all"
                                            data-categoryid="1">
                                            All Items
                                        </a>

                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label">
                                        <a href="javascript:;" class="search-trip" data-categoryname="16"
                                            data-categoryid="1">
                                            10 Days - 16 Days
                                        </a>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label">
                                        <a href="javascript:;" class="search-trip" data-categoryname="31"
                                            data-categoryid="1">
                                            16 Days - 31Days
                                        </a>

                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label">
                                        <a href="javascript:;" class="search-trip" data-categoryname="46"
                                            data-categoryid="1">
                                            31 Days - 46 Days
                                        </a>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label">
                                        <a href="javascript:;" class="search-trip" data-categoryname="62"
                                            data-categoryid="1">
                                            46 Days - 62 Days
                                        </a>

                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="filter">
                        <h3>Price</h3>
                        <div class="price-filter">
                            <input type="text" class="price-filters" name="my_range" value="" />
                        </div>
                    </div>
                    <div class="filter">
                        <h3>Date</h3>
                        <ul>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label">
                                        <a href="javascript:void();">
                                            October 2020
                                        </a>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label">
                                        <a href="javascript:void();">
                                            November 2021
                                        </a>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label">
                                        <a href="javascript:void();">
                                            December 2022
                                        </a>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label">
                                        <a href="javascript:void();">
                                            January 2022
                                        </a>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="category-main">
                    <div class="category-head">
                        <div class="filter-head">
                            <div class="mobile-filter-icon">
                                <div class="filters-icons">
                                    <i class="las la-sliders-h"></i>Filter
                                </div>
                                <div class="category-sidebar mobile-only-filter">
                                    <div class="filter">
                                        <h3>Destination</h3>
                                        <ul>
                                            @isset($parentCategory)
                                                @foreach ($parentCategory as $parent)
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                            <label class="form-check-label">
                                                                <a href="javascript:void();" class="search-trip" data-categoryname="parent"
                                                                    data-categoryid="{{ $parent->id }}">
                                                                    {{ $parent->name }} ({{ $parent->getCategoryTrip->count() }})
                                                                </a>
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endisset
                                        </ul>
                                    </div>
                                    <div class="filter">
                                        <h3>Activity</h3>
                                        <ul>
                                            @isset($subCategory)
                                                @foreach ($subCategory as $sub)
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                            <label class="form-check-label">
                                                                <a href="javascript:;" class="search-trip" data-categoryname="subparent"
                                                                    data-categoryid="{{ $sub->id }}">
                                                                    {{ $sub->name }} ({{ $sub->category_trip->count() }})
                                                                </a>
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endisset
                                        </ul>
                                    </div>
                                    <div class="filter">
                                        <h3>Days</h3>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        <a href="javascript:;" class="search-trip" data-categoryname="all"
                                                            data-categoryid="1">
                                                            All Items
                                                        </a>

                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        <a href="javascript:;" class="search-trip" data-categoryname="16"
                                                            data-categoryid="1">
                                                            10 Days - 16 Days
                                                        </a>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        <a href="javascript:;" class="search-trip" data-categoryname="31"
                                                            data-categoryid="1">
                                                            16 Days - 31Days
                                                        </a>

                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        <a href="javascript:;" class="search-trip" data-categoryname="46"
                                                            data-categoryid="1">
                                                            31 Days - 46 Days
                                                        </a>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        <a href="javascript:;" class="search-trip" data-categoryname="62"
                                                            data-categoryid="1">
                                                            46 Days - 62 Days
                                                        </a>

                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="filter">
                                        <h3>Price</h3>
                                        <div class="price-filter">
                                            <input type="text" class="price-filters" name="my_range" value="" />
                                        </div>
                                    </div>
                                    <div class="filter">
                                        <h3>Date</h3>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        <a href="javascript:void();">
                                                            October 2020
                                                        </a>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        <a href="javascript:void();">
                                                            November 2021
                                                        </a>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        <a href="javascript:void();">
                                                            December 2022
                                                        </a>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        <a href="javascript:void();">
                                                            January 2022
                                                        </a>
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <h2 id="test">{{ @$trips->count() }} Results Found</h2>
                        </div>
                        <div class="sort">
                            <select class="form-select form-control" aria-label="Default select example"
                                id="sort-trip">
                                <option selected>Sort By</option>
                                <option value="1">Price High to Low</option>
                                <option value="2">Price Low to High</option>
                            </select>
                        </div>
                    </div>
                    <div class="category-list" id="item-show">
                        @isset($trips)
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
                                                    <a href="{{ route('trip-details', @$data->slug) }}">Book Now <i class="las la-bookmark"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {!! $trips->links() !!}
                        @else
                            <h2>Sorry !! No Trip At This Moment !!</h2>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Category End -->
@include('frontend.layouts.footer')


