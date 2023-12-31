@include('frontend.layouts.header')

<style>
    .link{
    color: rgb(71, 174, 255);
    font-size: 16px;
    text-align: center;
    font-family: "Lorimer No2 Condensed Semi";
    text-transform: uppercase;
    display: inline-block;
    background: 0px 0px;
    }
</style>
<!-- Banner -->
<section class="banner">
    <img src="{{asset('public/uploads/8063997620_e476cbec93_o-e1491468742178-1920x320.jpg')}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>Confirmation</h1>
        </div>
    </div>
</section>
<!-- Banner End -->




<!--Form Page -->
<section class="form-page mt mb">
    @include('frontend.message')
    <div class="container">
        <div class="form_page_col">
           <p>Hi,
                Thank you for getting in touch with Mega Adventures and filling up our form online.
                
                We will contact you soon via e-mail or phone. If you do not receive a response within 24 hours, check your SPAM folder. Your internet service provider or email program is probably SPAM-blocking our messages to you. You should also add https://www.megaadventuresintl.com (info@megaadventuresintl.com) to your list of approved senders.
                
                We look forward to assisting you with your booking & also seeing you travel with Mega Adventures soon!
                
                Kind regards
                Sales and Operations Team
                Mega Adventures International
            </p>

<a href="{{ route('trip-details',@$trip->slug)}}" class="link">BACK TO {{@$trip->title}}</a>

{{session()->forget('success')}}
            
        </div>
    </div>
</section>
<!--Form Page End -->

 <script>
         setTimeout(function(){
            $('.alert').slideUp();
         }, 3000);
     </script>







@include('frontend.layouts.footer')