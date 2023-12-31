
@include('frontend.layouts.header')
<div class="form-singlepage">
    <div class="login-form">
        <h1>Update Profile</h1>
        <form action="{{route('customer.updateProfile')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="row">
            <div class="col-md-6 mb-3">
                <select class="form-select" aria-label="Default select example" name="title">
                    <option selected>Title*</option>
                    <option value="mr" {{(@$customer->title=='mr') ? 'selected':''}}>Mr</option>
                    <option value="mrs" {{(@$customer->title=='mrs') ? 'selected':''}}>Mrs</option>
                    <option value="ms" {{(@$customer->title=='ms') ? 'selected':''}}>Ms</option>
                  </select>
                  @error('title')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name*" value="{{old('first_name',@$customer->first_name)}}" required>
              @error('first_name')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{old('middle_name',@$customer->middle_name)}}" placeholder="Middle Name*">
                @error('middle_name')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name',@$customer->last_name)}}" placeholder="Last Name*" required>
                @error('last_name')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
             
              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="country" name="country" value="{{old('country',@$customer->country)}}" placeholder="Your Country*" required>
                @error('country')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="city" name="city" value="{{old('city',@$customer->city)}}" placeholder="City*" required>
                @error('city')
                <span class="text-danger">{{$message}}</span>
              @enderror
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="contact_num" name="contact_num" value="{{old('contact_num',@$customer->contact_num)}}" placeholder="Contact Number*" required>
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
              @if(@$customer->image !=null)
              <figure>
                <img src="{{asset('uploads/customer/'.@$customer->image)}}" alt="" >
              </figure>
              @endif
            


            <button type="submit" class="btn">Update Now</button>
        </div>
          </form>
    </div>
</div>

@include('frontend.layouts.footer')
