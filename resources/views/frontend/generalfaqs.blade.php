@include('frontend.layouts.header')
<!-- Banner -->
<section class="banner">
    <img src="{{asset(@$faqdesign->image)}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{strtoupper(@$faqdesign->title)}}</h1>
            <span>{{ucfirst(@$faqdesign->slogan)}}</span>
        </div>
    </div>
</section>
<!-- Banner End -->


{{-- Faqs Content --}}

<div class="why-section">
    <div class="container">
        <div class="accordion mb-5" id="accordionExample1">
            @foreach ($faqs as $faq)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq->id}}" aria-expanded="false" aria-controls="collapse1">
                         <span>{{$faq->title}}</span>
                    </button>
                </h2>
                <div id="collapse{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionExample1">
                    <div class="accordion-body">
                        <p>
                          {!! $faq->description!!}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>





@include('frontend.layouts.footer')
