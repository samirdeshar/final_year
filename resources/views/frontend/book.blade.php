@include('frontend.layouts.header')
<style>
    .terms-radio {
    display: flex;
    align-items: center;
    gap: 5px;
}

.terms-radio label {
    margin: 0;
}
</style>
<!-- Banner -->
{{-- <section class="banner">
    <img src="{{asset('uploads/8063997620_e476cbec93_o-e1491468742178-1920x320.jpg')}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>Trip Booking</h1>
        </div>
    </div>
</section> --}}
<!-- Banner End -->

<section id="breadcrumb-singlepage-actvities" style="background-image:{{asset('uploads/8063997620_e476cbec93_o-e1491468742178-1920x320.jpg')}}">
    <div class="container">
        <div class="titlenav-wrapper">
            <h1>Trip Booking</h1>
            <ul>
                <li>{{$trip_title->title}}
                </li>
                <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fa fa-angle-right" aria-hidden="true"></i> Font Awesome fontawesome.com --> </li>
                {{-- <li><a href="#" class="bread-acti"> Contact Us</a>
                </li> --}}
            </ul>
        </div>
    </div>
</section>




<!--Form Page -->
<section class="form-page mt mb">
    @include('frontend.message')
    <div class="container">
        <div class="booking-page-head">
            <h3> {{$trip_title->title}} </h3>
            <p>
                This is a pre-booking form for the lead traveler. We would send you the actual booking form after the confirmation.
            </p>
        </div>
        {{ Form::open(['url'=>route('sav-trip-bokking'),'files'=>true])}}
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="form_page_col">
                        @method('put')
                            <div class="form-group_list">
                                <h4>Personal Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Package Name:</label>
                                            <input type="text" name="package_name" value="{{$title}}" class="form-control" required disabled>
                                            <input type="text" name="trip_id" value="{{$trip_title->id}}" class="form-control" required hidden>
                                            @error('trip_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Trip Type*</label>
                                            <select name="trip_type" id="" class="form-control" >
                                                @foreach(getTripType() as $key=>$type)
                                                <option value="{{$key}}">{{ucfirst($type)}}</option>
                                                @endforeach
                                            </select>

                                            @error('trip_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Arrival*</label>
                                            {{ Form::date('arrival','',['class'=>'form-control  '.($errors->has('arrival') ?'is-invalid':''),'required'=>true])}}
                                            @error('arrival')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departure*</label>
                                            {{ Form::date('departure','',['class'=>'form-control  '.($errors->has('departure') ?'is-invalid':''),'required'=>true])}}
                                            @error('departure')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Of PAX*</label>
                                            {{ Form::number('num_of_pax','',['class'=>'form-control  '.($errors->has('num_of_pax') ?'is-invalid':''),'required'=>true])}}
                                            @error('num_of_pax')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Adults(12+)*</label>
                                            <select name="adults" id="" class="form-control">
                                                @foreach (\App\Utility\HelperClass::adults(1) as $adults)
                                                    <option value="{{$adults}}">{{@$adults}}</option>
                                                @endforeach
                                            </select>

                                            @error('adults')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Childs(2-12)</label>
                                            <select name="childs" id="" class="form-control">
                                                @foreach (\App\Utility\HelperClass::adults(0) as $childs)
                                                    <option value="{{$childs}}">{{@$childs}}</option>
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
                                            <select name="infants" id="" class="form-control">
                                                @foreach (\App\Utility\HelperClass::adults(0) as $infants)
                                                    <option value="{{$infants}}">{{@$infants}}</option>
                                                @endforeach
                                            </select>
                                            @error('infants')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title*</label>
                                            <select name="title" id="" class="form-control">
                                                @foreach (getCustomerTitle() as $key=>$title)
                                                    <option value="{{$key}}">{{ucfirst(@$title)}}</option>
                                                @endforeach
                                            </select>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Firts Name *</label>
                                            {{ Form::text('first_name','',['class'=>'form-control  '.($errors->has('first_name') ?'is-invalid':''),'required'=>true])}}
                                            @error('first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Middle Name </label>
                                            {{ Form::text('middle_name','',['class'=>'form-control  '.($errors->has('middle_name') ?'is-invalid':''),'required'=>false])}}
                                            @error('middle_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name *</label>
                                            {{ Form::text('last_name','',['class'=>'form-control  '.($errors->has('last_name') ?'is-invalid':''),'required'=>true])}}
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact Num *</label>
                                            {{ Form::text('contact_num','',['class'=>'form-control  '.($errors->has('contact_num') ?'is-invalid':''),'required'=>true])}}
                                            @error('contact_num')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email *</label>
                                            {{ Form::email('email','',['class'=>'form-control  '.($errors->has('email') ?'is-invalid':''),'required'=>true])}}
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country *</label>
                                            {{ Form::text('country','',['class'=>'form-control  '.($errors->has('country') ?'is-invalid':''),'required'=>true])}}
                                            @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City *</label>
                                            {{ Form::text('city','',['class'=>'form-control  '.($errors->has('city') ?'is-invalid':''),'required'=>true])}}
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport No </label>
                                            {{ Form::text('passport','',['class'=>'form-control  '.($errors->has('passport') ?'is-invalid':'')])}}
                                            @error('passport')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Additional Info</label>
                                            {{ Form::textarea('additional_info','',['class'=>'form-control  '.($errors->has('additional_info') ?'is-invalid':'')])}}
                                            @error('additional_info')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Extra Facility</label>
                                            {{ Form::textarea('extra_faciulity','',['class'=>'form-control  '.($errors->has('extra_faciulity') ?'is-invalid':'')])}}
                                            @error('extra_faciulity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>How Do You Know About Us</label>
                                            <select name="know_from" id="" class="form-control">
                                                @foreach (getKnownFrom() as $key=>$title)
                                                    <option value="{{$key}}">{{ucfirst(@$title)}}</option>
                                                @endforeach
                                            </select>
                                            @error('know_from')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group terms-radio">
                                            <input type="checkbox" name="aggree" value="1" required>
                                            <label>I Aggree Terms And Conditions</label>
                                            @error('aggree')
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
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="booking-sidebar">
                        <div class="books-btns">
                            <button type="submit">Confirm Booking</button>
                        </div>
                        <div class="booking-date">
                            <span> <i class="las la-calendar-check"></i> Booking Date: <b>{{currentDate()}}</b></span>
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
