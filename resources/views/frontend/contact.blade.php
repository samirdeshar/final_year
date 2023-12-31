@include('frontend.layouts.header')


<!-- Banner -->
{{-- <section class="banner">
    <img src="{{asset(@$meta->banner_image)}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{@$meta->name}}</h1>
        </div>
    </div>
</section> --}}

<section id="breadcrumb-singlepage-actvities">
    <div class="container">
        <div class="titlenav-wrapper">
            <h1>{{@$meta->name}}</h1>
            <ul>
                <li><a href="https://rupakotholidays.nectar.com.np">Home</a>
                </li>
                <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fa fa-angle-right" aria-hidden="true"></i> Font Awesome fontawesome.com --> </li>
                <li><a href="#" class="bread-acti"> {{@$meta->name}}</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- Banner End -->

<!-- Contact Us Page -->
<section class="contact-us mt mb">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <div class="contact-utilities">
                    <h3>{{ @$setting->contact_inquiry_heading1 ? @$setting->contact_inquiry_heading1 : 'Holidays Queries' }}</h3>
                    <p><strong>{{ @$setting->site_name ? @$setting->site_name : 'Rupakot Holidays Pvt. Ltd.' }}</strong><br>
                        @php
                            $address = @$setting->address;
                            $address = explode(',',$address);
                        @endphp
                        {{ @$address[0] }},&nbsp;{{ @$address[1] . ' ' . @$address[2] }}&nbsp;<br>
                        {{ @$address[3] }}&nbsp;<br>

                        Tel: {{ @$setting->phone }} {{ @$setting->contact ? ','. @$setting->contact : '' }} {{ @$setting->contact_second ? ',' . @$setting->contact_second : '' }}<br>
                        <div class="email d-flex">Email:
                                <div class="ms-2">
                                    <a href="mailto:{{ @$setting->email}}">{{ @$setting->email }}</a>
                                    @if(@$setting->email2)
                                    <a href="mailto:{{ @$setting->email2}}">{{ @$setting->email2 }}</a>
                                    @endif
                                </div>
                            </div>

                    </p>
                    {{-- <ul>
                        <li>
                            <div class="contact-icon">
                                <i class="las la-building"></i>
                            </div>
                            <div class="contact-info">
                                <b>Company Name</b>
                                <span>{{@$setting->site_name}}</span>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon">
                                <i class="las la-map-signs"></i>
                            </div>
                            <div class="contact-info">
                                <b>Address</b>
                                <span>{{@$setting->address}}</span>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon">
                                <i class="las la-blender-phone"></i>
                            </div>
                            <div class="contact-info">
                                <b>Phone</b>
                                <span>{{@$setting->phone}}</span>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <div class="contact-info">
                                <b>Cell</b>
                                <span>
                                    {{@$setting->contact}}
                                    @if (@$setting->contact_second)
                                    , {{@$setting->contact_second}}
                                    @endif
                                </span>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon">
                                <i class="las la-envelope-open-text"></i>
                            </div>
                            <div class="contact-info">
                                <b>Email</b>
                                <span>{{@$setting->email}}</span>
                            </div>
                        </li>
                    </ul> --}}
                </div>
                <div class="contact-utilities">
                    <h3>{{ @$setting->contact_inquiry_heading2 ? @$setting->contact_inquiry_heading2 : 'Ticketing Queries' }}</h3>
                    <p><strong>{{ @$setting->sitename2 ? @$setting->sitename2 : 'Rupakot International Travels Pvt. Ltd.' }}</strong><br>
                        @php
                            $address = @$setting->address_intl;
                            $address = explode(',',$address);
                        @endphp

                        @if($address)
                        {{ @$address[0] }},&nbsp;{{ @$address[1] . ' ' . @$address[2] }}&nbsp;<br>
                        {{ @$address[3] }}&nbsp;<br>
                        @endif

                        @if(@$setting->phone_intl || @$setting->contact_intl)
                        Tel: {{ @$setting->phone_intl }} {{ @$setting->contact_intl ? ','. @$setting->contact_intl : '' }}<br>
                        <div class="email d-flex">Email:
                                <div class="ms-2">
                                    <a href="mailto:{{ @$setting->email_intl}}">{{ @$setting->email_intl }}</a>
                                </div>
                            </div>
                        @endif
                    </p>
                </div>
                <div class="social-media-contact">
                    <h3><u>{{ @$setting->contact_inquiry_heading3 ? @$setting->contact_inquiry->heading3 : 'Emergency Contact' }}</u></h3>
                    <strong>{{ @$setting->emergency_name_1 ? @$setting->emergency_name_1 : 'Rajendra Dhamala' }}:</strong>{{ @$setting->emergency_contact_1 ? @$setting->emergency_contact_1 : '+977 9801059802 , 9851187802' }} <span><i class="fab fa-viber" style="color:#59267c"></i>/<i class="fab fa-whatsapp" style="color:#128C7E"></i></span> <br>
                    <strong>{{ @$setting->emergency_name_2 ? @$setting->emergency_name_2 : 'Rishi Ram Dhamala' }}:</strong>{{ @$setting->emergency_contact_2 ? @$setting->emergency_contact_2 : '+977-9801059801 , 9851082483' }} <span><i class="fab fa-viber" style="color: #59267c"></i>/<i class="fab fa-whatsapp" style="color:#128C7E"></i></span>
                {{-- <ul>
                        <li>
                            <a href="{{@$setting->fb_link}}"><i class="lab la-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="{{@$setting->twitter_link}}"><i class="lab la-twitter"></i></a>
                        </li>
                        <li>
                            <a href="{{@$setting->linkedin_link}}"><i class="lab la-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="{{@$setting->insta_link}}"><i class="lab la-instagram"></i></a>
                        </li>
                        <li>
                            <a href="{{@$setting->youtube_link}}"><i class="lab la-youtube"></i></a>
                        </li>
                        <li>
                            <a href="{{@$setting->pinterest_link}}"><i class="lab la-pinterest"></i></a>
                        </li>
                    </ul> --}}
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="contact-form">
                    <form action="{{route('frontend.contactStore')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="first_name">Enquiry Type*</label>
                                    <select name="enquiry_type" id="" class="form-control">
                                        @foreach (getEnquiryType() as $key=>$eType)
                                        <option value="{{$key}}">{{ucfirst($eType)}}</option>
                                        @endforeach

                                    </select>
                                    @error('first_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name*</label>
                                    <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">
                                    @error('first_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name*</label>
                                    <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}">
                                    @error('last_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">Address*</label>
                                    <input type="text" name="address" class="form-control" value="{{old('address')}}">
                                    @error('address')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control" name="email" value="{{old('email')}}">
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contact">Contact Number</label>
                                    <input type="string" class="form-control" name="contact" value="{{old('contact')}}">
                                    @error('contact')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" cols="30" rows="7" class="form-control">{{old('message')}}</textarea>
                                    @error('message')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="captcha"> CAPTCHA </label>
                                    <div class="g-recaptcha" data-sitekey="6Lfs9jomAAAAAAaejaP35DT_aRWtOcaTIIRD3hYb"></div>
                                    @error('g-recaptcha-response')
                                        <span class="text-danger"> The reCAPTCHA was invalid. Go back and try it again.
                                        </span>
                                    @enderror
                                        </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="books-btns">
                                    <button type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- <div class="contact-information">
            <div class="maps">
                <iframe src="{{@$setting->location_url}}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div> --}}

    </div>
</section>
<!-- Contact Us Page End-->


@include('frontend.layouts.footer')
