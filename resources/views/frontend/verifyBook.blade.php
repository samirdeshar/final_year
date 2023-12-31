
@include('frontend.layouts.header')
<div class="form-singlepage">

    <div class="login-form">
        <h1>Ghale Gaun trek Booking</h1>
        <p>Choose Booking Options</p>
        <hr>
        <form action="{{route('customer.login')}}" method="post">
          @csrf
          <div class="row form-group">
            <div class="col-md-6">
                <h5 class="radio-small">As Registered User</h5>
                <input type="radio" value="register" name="booking_type" required="required"> &nbsp;   &nbsp;
            </div>
            <div class="col-md-6">
                <h5 class="radio-small">As Guest User</h5>
                <input type="radio" value="guest" name="booking_type" required="required">


            </div>
        </div> <hr>

            <button type="submit" class="btn">Continue Booking</button>
          </form>
    </div>
</div>

@include('frontend.layouts.footer')
