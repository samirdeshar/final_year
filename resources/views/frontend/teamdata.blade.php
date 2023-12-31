@include('frontend.layouts.header')

@section('front-css')
<style>
    .team-pd{
    margin: 30px 0;
}

</style>

@endsection
<!-- Banner -->
<section class="banner">
    <img src="{{ asset(@$meta->banner_image) }}" alt="banner">
    <div class="container">
        <div class="banner-info" >
            <h1>{{ @$meta->name }}</h1>
        </div>
    </div>
</section>
<!-- Banner End -->

<!-- Contact Us Page -->

<section class="team-pd" style="  margin: 50px 0;" >
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="text-center">Chief Executive Director</h3>
            </div>
        </div>
        <div class="row">
            @foreach($teams as $team)
            {{-- @dd($team) --}}
                <div class="card col-md-3 team-card" style="width: 18rem;border:none; margin: 10px;">
                    <img src="{{@$team->image}}" class="card-img-top rounded-circle team-img" alt="{{ @$team->title }}" height="250px" style="object-fit: cover;">
                    <div class="card-body team-content">
                          <div class="team-detail">
                            <h4 class="text-center team-name">{{@$team->name}}</h4>
                            <h5 class="text-center team-content">{{@$team->designation}}</h5>
                            <small class="text-center">{{ @$team->email }}</small>
                            <p class="card-text">{!! Str::limit(@$team->description,'150') !!}</p>
                          </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
<style>
    .team-card{
        position: relative;
        width: 50%;
        cursor: pointer !important;
    }
    .team-img{
        opacity: 1;
        display: block;
        width: 100%;
        transition: .5s ease;
        backface-visibility: hidden;
        transition: 0.1s all ease-in;
    }

    .team-card:hover .team-img {
        opacity: 0.9;
        transform: scale(1.05);
    }
</style>
</section>



@include('frontend.layouts.footer')
