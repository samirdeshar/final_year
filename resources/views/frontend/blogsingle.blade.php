@include('frontend.layouts.header')
<section id="breadcrumb-singlepage-actvities">
    <div class="container">
        <div class="titlenav-wrapper">
            <h1>{{ @$blog->title }}</h1>
            <ul>
                <li><a href="{{url('')}}">Home</a>
                </li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                <li><a href="#" class="bread-acti"> {{ @$blog->title }}</a>
                </li>
            </ul>
        </div>
    </div>
</section>
{{-- @dd($blog) --}}
<section class="activities-single">
    <div class="container">
        <img src="{{@$blog->image}}" alt="single-image">
        <div class="row">
            <div class="col-md-8">
                <h3>{{ @$blog->title }}</h3>
                <h4><strong>{{ @$blog->summary }}</strong></h4>
                <p>
                    {!! @$blog->description !!}
                </p>
            </div>
        </div>
    </div>
</section>

<div class="activities-tabs">
    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach($blog->getDetails as $heading)
                <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{@$heading->heading}}</button>
                @endforeach
                {{-- <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> --}}
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach($blog->getDetails as $description)
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">{{@$description->description}}</div>
            @endforeach
            {{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">This is a
                About</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">This is a
                Contact</div> --}}
        </div>
    </div>
</div>

@include('frontend.layouts.footer')
