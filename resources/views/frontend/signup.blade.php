
@include('frontend.layouts.header')
<div class="form-singlepage">

    <div class="login-form">
        <h1>Create an Account</h1>
        <p>Be A part of Rupakot Tours and Travels Pvt. Ltd.</p>
        <form action="{{route('customer.signup')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="row">
            <div class="col-md-6 mb-3">
                <select class="form-select" aria-label="Default select example" name="title">
                    <option selected>Title*</option>
                    <option value="mr">Mr</option>
                    <option value="mrs">Mrs</option>
                    <option value="ms">Ms</option>
                  </select>
                  @error('title')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name*" value="{{old('first_name')}}" required>
              @error('first_name')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{old('middle_name')}}" placeholder="Middle Name*">
                @error('middle_name')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name')}}" placeholder="Last Name*" required>
                @error('last_name')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email Address*" required>
                @error('email')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="country" name="country" value="{{old('country')}}" placeholder="Your Country*" required>
                @error('country')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" placeholder="City*" required>
                @error('city')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="contact_num" name="contact_num" value="{{old('contact_num')}}" placeholder="Contact Number*" required>
                @error('contact_num')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="file" class="form-control" id="image" name="image"  placeholder="Contact Number*" >
                @error('image')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" placeholder="Password" required>
                @error('password')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Password" required>
                @error('password_confirmation')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>


            <button type="submit" class="btn">Register Now</button>
        </div>
          </form>
          <p>Are you a already member ?<a href="{{route('customer.login')}}">Click to Login</a>  </p>
    </div>
</div>

@include('frontend.layouts.footer')
