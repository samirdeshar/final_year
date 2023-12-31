@include('frontend.layouts.header')

<style>
    .categorysingle .tripcat-description {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.categorysingle .similar-packages .row .col-md-6 .package-duration-info {
    width: fit-content;
}
.categorysingle .tripcat-description h1 {
    font-size: 24px;
}
.categorysingle .tripcat-description .tripcat-price {
    display: flex;
    justify-content: space-between;
}

.categorysingle .tripcat-description .tripcat-price .price-cat {
    font-size: 34px !important;
    color: var(--primary-color) !important;
    display: flex;
    gap: 15px;
}
.categorysingle .tripcat-description .tripcat-price .price-cat del {
    color: #666;
    font-size: 16px;
    margin: 10px 0 0 0;
}
</style>

    <div class="tripcat-breadcrumb">
        <img src="{{@$category->icon}}" alt="tripcat-image">
        {{-- <h1 class="breadcrumb-title">{{@$category->name}}</h1> --}}
    </div>
    <div class="categorysingle">
        <div class="container">
            <div class="single-cat-info">
                <h1>{{@$category->name}}</h1>
                <p>{!!@$category->summary!!}</p>
                <p>{!!@$category->description!!}</p>
            </div>
            <div class="similar-packages">
                {{-- <h3>Holiday Packages In Nepal</h3> --}}
                <div class="row">
                    @isset($trips)
                        @foreach ($trips as $trip)
                        {{-- @dd($trip) --}}
                            <div class="col-md-6">
                                <a href="{{route('trip-details',@$trip->slug)}}">
                                    <img src="{{@$trip->banner_image}}" alt="tripcat-image" class="img-fluid">
                                </a>

                            </div>
                            <div class="col-md-6">
                                <div class="tripcat-description">
                                <h4>{{$trip->title}}</h4>
                                <span>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <a href="{{route('trip-details',@$trip->slug)}}"><h4 class="tripslogan">{{$trip->slogan}}</h4></a>
                                <p>{!!@$trip->summary!!}</p>
                                <div class="tripcat-price">
                                    <div class="tripcat-packageview">
                                        <p class="package-duration-info">Package Duration: {{@$trip->duration_details}}</p>
                                        <div class="package-cat-buttons">
                                            <ul>
                                                <li><a href="{{route('book',$trip->id)}}" class="book-btn">Book Now</a> </li>
                                                <li><a href="{{route('trip-details',@$trip->slug)}}" class="vpackage-btn">View Package</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @if(@$trip->trip_cost)
                                    <h4 class="price-cat"><del></del> {{ @$trip->currency }} {{ @$trip->trip_cost }}</h4>
                                    @endif
                                </div>

                            </div>

                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
@include('frontend.layouts.footer')
