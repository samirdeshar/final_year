
@include('frontend.layouts.header')
<div class="form-singlepage">
    <div class="login-form">
        <h1>Sign In</h1>
        <p>{{session()->get('bookData')['trekname'] ?? ''}}</p>
        <form action="{{route('customer.booklogin')}}" method="post">
          @csrf
            <div class="mb-3">
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Email" required>
              @error('email')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              @error('password')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <button type="submit" class="btn">Login</button>
          </form>
          <p><a href="{{route('customer.forgetPassword')}}">forgot password</a>| Are you a new user ?<a href="{{route('customer.signup')}}">Register</a>  </p>
    </div>
</div>

@include('frontend.layouts.footer')
