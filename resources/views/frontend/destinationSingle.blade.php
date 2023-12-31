@include('frontend.layouts.header')
<section id="breadcrumb-singlepage">
    {{-- <img src="https://www.rupakot.nectar.com.np/templates/images/banner/2.jpg" alt="single-breadcrumb" class="singlebreadcrumb"> --}}
    <div class="container">
        {{-- <h1>{{@$destination->title}}</h1> --}}
    </div>
</section>
{{-- @dd($destination) --}}
<section class="singlepage-contents">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <img src="{{@$destination->image}}" alt="single-image">

                <p>
                    {!!@$destination->description!!}
                </p>
            </div>
            <div class="col-md-3">
                <div class="singleaside-links">
                    <ul>
                        @foreach($allDestination as $data)
                        <li><a href="{{route('popular-destination',@$data->slug)}}">{{@$data->title}}</a></li>
                        @endforeach


                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>


@include('frontend.layouts.footer')
