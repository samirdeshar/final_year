@include('frontend.layouts.header')
<style>
    #v-pills-tabContent {
    width: 100%;
}
.booking-dashboard table tr th {
    background: #efefef;
}
.booking-dashboard table tr th,
.booking-dashboard table tr td {
    font-size: 14px;
}
.booking-dashboard .table-card {
    padding: 20px;
}
.booking-dashboard .table-card .dashboard-card-info {
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0px 2px 10px rgba(0,0,0,0.08);
    margin: 0 0 25px 0;
    padding: 15px;
}
.booking-dashboard .table-card .dashboard-card-info span {
    font-size: 24px;
}

.booking-dashboard .table-card .dashboard-card-info i {
    height: 50px;
    width: 50px;
    line-height: 50px;
    text-align: center;
    border-radius: 4px;
    font-size: 35px;
}
.booking-dashboard .table-card .dashboard-card-info h5 {
    font-size: 14px;
}
.dashboard-sidebar #v-pills-tab {
    width: 20%;
    background-color: var(--white-color);
    margin-right: 25px;
    box-shadow: var(--box-shadow);
    height: 100%;
    border-radius: var(--border-radius);
    transition: var(--transition);
    position: relative;
}

.booking-dashboard {
    background: #f5f5f5;
    padding: 25px 0;
}

.dashboard-sidebar #v-pills-tab button {
    border-bottom: 1px solid #eee;
    border-radius: 0;
    position: relative;
    display: block;
    color: black;
    text-decoration: none;
    font-size: 14px;
    padding: 15px 0;
}

.dashboard-sidebar #v-pills-tab button.active {
    background: #ffe1da;
    border-left: 4px solid var(--primary-color);
}
.booking-dashboard .dashboard-avatarwrapper figure {
    height: 100px;
    width: 100px;
    overflow: hidden;
    border-radius: 900px;
    border: 1px solid #e1e1e1;
}

.booking-dashboard .dashboard-avatarwrapper figure img {
    height: 100px;
    object-fit: cover;
}

.booking-dashboard .dashboard-avatarwrapper {
    display: flex;
    margin: 0 0 40px 0;
}

.booking-dashboard .dashboard-avatarwrapper .profile-avatar {
    border-left: 1px solid #e9e9e9;
    padding-left: 25px;
    margin-left: 25px;
}

.booking-dashboard .dashboard-avatarwrapper .profile-avatar .btn {
    background: var(--primary-color);
    color: var(--white-color);
    font-size: 14px;
}
</style>
<div class="booking-dashboard">
    <div class="container">
<div class="d-flex align-items-start dashboard-sidebar">
    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>
      <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
      <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Forget Password</button>
        
    </div>
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <div class="card table-card">
            <div class="row">
                <div class="col-md-3">
                    <div class="dashboard-card-info">
                        <i class="las la-shopping-cart"></i>
                        <div class="other-info">
                            <h5>Total Trips</h5>
                            <span>{{count(@$customerTrip)}}</span>
                        </div>
                    </div>
                </div>


            </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Trip Type</th>
                                <th>Total Person</th>
                                <th>Arrival Date</th>
                                <th>Departure Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customerTrip as $trip)
                            <tr>
                                <td>{{getTripType(@$trip->trip_type)}}</td>
                                <td>{{@$trip->adults+@$trip->childs+@$trip->infants}}</td>
                                <td>{{@$trip->arrival}}</td>
                                <td>{{@$trip->departure}}</td>
                            </tr>
                            @endforeach
                    </tbody>
                    </table>
                </div>

        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
        <div class="card table-card">
            <div class="dashboard-avatarwrapper">
                <figure>
                    <img src="{{(auth()->guard('customer')->user()->image !=null) ? asset('uploads/customer/'.auth()->guard('customer')->user()->image) : asset('uploads/vector-illustration-avatar-dummy-logo-collection-image-icon-stock-isolated-object-set-symbol-web-137160339.jpg')}}" alt="dashboard-avatar">
                </figure>
                <div class="profile-avatar">
                <ul>
                    <li>
                        <span>Name:</span>
                        <span>{{ auth()->guard('customer')->user()->first_name ?? ''}} {{ auth()->guard('customer')->user()->middle_name ?? ''}} {{ auth()->guard('customer')->user()->last_name ?? ''}}</span>
                    </li>
                    <li>
                        <span>email:</span>
                        <span>{{ auth()->guard('customer')->user()->email ?? ''}}</span>
                    </li>
                    <li>
                        <span>Mobile Number:</span>
                        <span>{{ auth()->guard('customer')->user()->contact_num ?? ''}}</span>
                    </li>
                </ul>

                <a href="{{route('customer.updateProfile')}}" class="btn">Update Profile</a>
                </div>


            </div>

    </div>
      </div>
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
        @if(auth()->guard('customer')->user())
        <form action="{{route('customerupdatePassword',auth()->guard('customer')->user()->id)}}" method="post">
            @csrf
              <div class="mb-3">
                <input type="password" class="form-control" id="password" aria-describedby="emailHelp" name="password" placeholder="password" required>
                @error('password')
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
  
              <input type="email" value="{{ auth()->guard('customer')->user()->email }}" name="email" hidden>
  
              <div class="mb-3">
                <input type="password" class="form-control" id="password_confirmation" aria-describedby="emailHelp" name="password_confirmation" placeholder="password_confirmation" required>
                @error('password_confirmation')
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
  
              <button type="submit" class="btn btn-sm btn-danger">Update</button>
            </form>
        @endif
      </div>
    </div>
  </div>
</div>
</div>
@include('frontend.layouts.footer')
