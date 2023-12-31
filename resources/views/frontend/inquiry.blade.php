@include('frontend.layouts.header')

<!-- Banner -->
<section class="banner">
    <img src="{{ asset('uploads/inner-banner-1366x320.png') }}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>Inquiry</h1>
        </div>
    </div>
</section>
<!-- Banner End -->


<!--Form Page -->
<section class="inquiry-form mt mb">
    @include('frontend.message')
    <div class="container">
        <div class="inquiry-form_page_col">
            {{ Form::open(['url' => route('save-inquiry', $trip->slug), 'files' => true]) }}
            @method('post')
            <div class="inquiry-group_list">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="inquiry-media">
                            <img src="{{ asset('frontend/images/inquiry.png') }}" alt="images">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="inquiry-right">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name*</label>
                                        {{ Form::text('full_name', '', ['class' => 'form-control  ' . ($errors->has('full_name') ? 'is-invalid' : ''), 'placeholder' => 'Full Name .....', 'required' => true]) }}
                                        @error('full_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address*</label>
                                        {{ Form::email('email', '', ['class' => 'form-control  ' . ($errors->has('email') ? 'is-invalid' : ''), 'placeholder' => 'Email .....', 'required' => false]) }}
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone*</label>
                                        {{ Form::text('phone', '', ['class' => 'form-control  ' . ($errors->has('phone') ? 'is-invalid' : ''), 'placeholder' => 'Phone Number .....', 'required' => true]) }}
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country*</label>
                                        <select class="form-select form-control" name="country" required>
                                            @foreach ($country as $country)
                                                <option value="{{ $country }}">{{ $country }}</option>
                                            @endforeach
                                            @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How did you find Mega?</label>
                                        <select class="form-select form-control" name="find_mega">
                                            <option selected value="null">How did you find Mega?</option>
                                            <option value="Google">Google</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="Twitter">Twitter</option>
                                        </select>
                                        @error('find_mega')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Message*</label>
                                        {{ Form::textarea('message', '', ['class' => 'form-control  ' . ($errors->has('message') ? 'is-invalid' : ''), 'placeholder' => 'Message .....', 'required' => true, 'rows' => 05, 'style' => 'resize:none;']) }}
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="captcha"> CAPTCHA </label>
                                        <div class="g-recaptcha"
                                            data-sitekey="6LcclpAlAAAAAJ4VydTyTDG4vSS9tNaj0mWm13uZ">
                                        </div>
                                        @error('g-recaptcha-response')
                                            <span class="text-danger"> The reCAPTCHA was invalid. Go back and try it again.
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="inquiries-btn">
                                        <button type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</section>
<!--Form Page End -->

<script>
    setTimeout(function() {
        $('.alert').slideUp();
    }, 3000);
</script>







@include('frontend.layouts.footer')
