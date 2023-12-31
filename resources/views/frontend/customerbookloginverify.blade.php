


@include('frontend.layouts.header')
<div class="form-singlepage">

    <div class="login-form">
        <h1>Ghale Gaun trek Booking</h1>
        <p>Choose Booking Options</p>
        <hr>
        <form action="{{route('customer.chcekvaliditi')}}" method="post">
          @csrf
          <div class="row form-group">
            <div class="col-md-6">
                <h5 class="radio-small">As Registered User</h5>
                <input type="radio" value="1" name="validbookin" required="required"> &nbsp;   &nbsp;
            </div>
            <div class="col-md-6">
                <h5 class="radio-small">As Guest User</h5>
                <input type="radio" value="0" name="validbookin" required="required">


            </div>
        </div> <hr>

            <button type="submit" class="btn">Continue Booking</button>
          </form>
    </div>
</div>

@include('frontend.layouts.footer')
