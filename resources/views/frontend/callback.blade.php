@include('frontend.layouts.header')

<!-- Banner -->
<section class="banner">
    <img src="{{asset('uploads/8063997620_e476cbec93_o-e1491468742178-1920x320.jpg')}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>Plan Your Holiday Trip</h1>
        </div>
    </div>
</section>
<!-- Banner End -->




<!--Form Page -->
<section class="form-page mt mb">
    @include('frontend.message')
    <div class="container">
        <div class="booking-page-head">
            
            <p>
                Note: Fields marked with * are mandatory
            </p>
        </div>
        {{ Form::open(['url'=>route('callback.store'),'files'=>true,'method="post'])}}
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="form_page_col">
                        @method('put')
                            <div class="form-group_list">
                                <h4>Personal Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country*</label>
                                            <select class="form-select form-control" name="country" required>
                                            
                                            @foreach(\App\Utility\HelperClass::country() as $country)
                                                <option value="{{$country}}">{{$country}}</option>
                                            @endforeach
                                            </select>
                                            @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Destination*</label>
                                            @foreach(\App\Utility\HelperClass::destination() as $destination)
                                                <input type="checkbox" name="destination[]" value="{{$destination}}">{{$destination}}
                                            @endforeach
                                            
                                            @error('destination')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Trip Type*</label>
                                            <select class="form-select form-control" name="trip_type" required>
                                            <option value="0">Private</option>
                                            <option value="1">Group</option>
                                            </select>
                                            @error('trip_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Trip Start*</label>
                                            <input type="date" class="form-select form-control" name="trip_start" required>
                                            </select>
                                            @error('trip_start')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Trip End*</label>
                                            <input type="date" class="form-select form-control" name="trip_end" required>
                                            </select>
                                            @error('trip_end')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price Range*</label>
                                            <input type="text" class="form-select form-control" name="price_range" required>
                                            </select>
                                            @error('price_range')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Adults(12+)*</label>
                                            <select class="form-select form-control" name="adults" required>
                                            
                                            @foreach(\App\Utility\HelperClass::adults(1) as $adult)
                                                <option value="{{$adult}}">{{$adult}}</option>
                                            @endforeach
                                            </select>
                                            @error('adults')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Child(2-12)</label>
                                            <select class="form-select form-control" name="childs" >
                                            
                                            @foreach(\App\Utility\HelperClass::adults(2) as $child)
                                                <option value="{{$child}}">{{$child}}</option>
                                            @endforeach
                                            </select>
                                            @error('childs')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Infants(0-2)</label>
                                            <select class="form-select form-control" name="infants">
                                            @foreach(\App\Utility\HelperClass::adults(2) as $infant)
                                                <option value="{{$infant}}">{{$infant}}</option>
                                            @endforeach
                                            </select>
                                            @error('infants')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                   



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name*</label>
                                            {{ Form::text('full_name','',['class'=>'form-control  '.($errors->has('full_name') ?'is-invalid':''),'required'=>true])}}
                                            @error('full_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact No*</label>
                                            {{ Form::text('contact_num','',['class'=>'form-control  '.($errors->has('contact_num') ?'is-invalid':''),'required'=>true])}}
                                            @error('contact_num')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email*</label>
                                            {{ Form::email('email','',['class'=>'form-control  '.($errors->has('email') ?'is-invalid':''),'required'=>true])}}
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                    <label for="captcha"> CAPTCHA </label>
                                    <div class="g-recaptcha" data-sitekey="6Lfs9jomAAAAAAaejaP35DT_aRWtOcaTIIRD3hYb"></div>
                                    @error('g-recaptcha-response')
                                        <span class="text-danger"> The reCAPTCHA was invalid. Go back and try it again.
                                        </span>
                                    @enderror
                                        </div>
                                    </div>

                                    <button class="btn btn-sm btn-info" type="submit">Submit</button>
                                </div>
                            </div>
                            
                    </div>
                </div>
                
            </div>
        {{Form::close()}}
    </div>
</section>
<!--Form Page End -->


 <script>
    setTimeout(function(){
    $('.alert').slideUp();
    }, 3000);
</script>

@include('frontend.layouts.footer')
