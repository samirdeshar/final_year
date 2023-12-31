@include('frontend.layouts.header')


<!-- Banner -->
<section class="banner">
    <img src="{{asset('public/uploads/8063997620_e476cbec93_o-e1491468742178-1920x320.jpg')}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>Testimonial</h1>
        </div>
    </div>
</section>
<!-- Banner End -->




<!--Form Page -->
<section class="form-page mt mb">
    @include('frontend.message')
    <div class="container">
        <div class="form_page_col">
            <h3>{{$trip_id->title}}</h3>
            {{ Form::open(['url'=>route('save-comment'),'files'=>true])}}
            @method('post')
            
                <div class="form-group_list">
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Testimonial Title*</label>
                                {{ Form::text('title','',['class'=>'form-control  '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Title .....','required'=>true])}}
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Your Name*</label>
                                {{ Form::text('user_name','',['class'=>'form-control  '.($errors->has('user_name') ?'is-invalid':''),'placeholder'=>'Full Name .....','required'=>true])}}
                                @error('user_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address*</label>
                                 {{ Form::email('email','',['class'=>'form-control  '.($errors->has('email') ?'is-invalid':''),'placeholder'=>'Email .....','required'=>false])}}
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number/Fax</label>
                                 {{ Form::text('phone','',['class'=>'form-control  '.($errors->has('phone') ?'is-invalid':''),'placeholder'=>'Phone Number .....','required'=>false])}}
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Your Address</label>
                                 {{ Form::text('address','',['class'=>'form-control  '.($errors->has('address') ?'is-invalid':''),'placeholder'=>'Street Address .....','required'=>false,'rows'=>04,'style'=>'resize:none;'])}}
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Trip</label>
                                {{ Form::select('trip_id',@$trips->pluck('title','id'),@$trip_id->id,['class'=>'form-control  '.($errors->has('trip_id') ?'is-invalid':''),'required'=>true])}}
                                @error('trip_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                               
                            </div>
                        </div>
                       <div class="col-md-6">
                            <div class="form-group">
                                <label>Country*</label>
                                <select class="form-select form-control" name="country" required>
                                  @foreach($country as $country)
                                  <option value="{{$country}}">{{$country}}</option>
                                  @endforeach
                                  @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Your Website</label>
                                {{ Form::text('website','',['class'=>'form-control  '.($errors->has('website') ?'is-invalid':''),'placeholder'=>'Website .....','required'=>false])}}
                                @error('website')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Your Picture</label>
                                 {{ Form::file('image',['class'=>''.($errors->has('image') ?'is-invalid':''),'required'=>false,'accept'=>'image/*'])}}
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                               
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Testimonial</label>
                                {{ Form::textarea('comment','',['class'=>'form-control  '.($errors->has('comment') ?'is-invalid':''),'placeholder'=>'Comments .....','required'=>true,'rows'=>05,'style'=>'resize:none;'])}}
                                @error('comment')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                               
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit">Submit</button>
                        </div>
                    </div>
                </div>
                
            {{ Form::close()}}
        </div>
    </div>
</section>
<!--Form Page End -->

 <script>
         setTimeout(function(){
            $('.alert').slideUp();
         }, 3000);
     </script>







@include('frontend.layouts.footer')