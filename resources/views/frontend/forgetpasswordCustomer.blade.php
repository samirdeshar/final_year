
@include('frontend.layouts.header')
<div class="form-singlepage">

    <div class="login-form">
        <h1>Send Reset Password Link</h1>
        <p>It's free and always will be.</p>
        <form action="{{route('customer.forgetPassword')}}" method="post">
          @csrf
            <div class="mb-3">
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Email" required>
              @error('email')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <button type="submit" class="btn">Send</button>
          </form>
          <p><a href="{{route('customer.login')}}">Login</a>| Are you a new user ?<a href="{{route('customer.signup')}}">Register</a>  </p>
    </div>
</div>

@include('frontend.layouts.footer')
