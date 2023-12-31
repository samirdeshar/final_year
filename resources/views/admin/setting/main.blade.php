@if (isset($setting))
<form action="{{ route('setting.update', $setting) }}" method="post" enctype="multipart/form-data">
    @method('PATCH')
@else
    <form action="{{ route('setting.store') }}" method="post" enctype="multipart/form-data">
@endif
@csrf
    <div class="row  ms-3 mr-3">
        {{-- <div class="col row"> --}}
            <div class="col-md-6 form-group mt-2">
                <label for="site_name">Site Name</label>
                <input type="text" name="site_name" id="site_name" class="form-control "
                    value="{{ old('site_name', @$setting->site_name) }}">
                @error('site_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 form-group mt-2">
                <label for="sitename2">Intl Site Name</label>
                <input type="text" name="sitename2" id="sitename2" class="form-control "
                    value="{{ old('sitename2', @$setting->sitename2) }}">
                @error('sitename2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 form-group mt-2">
                <label for="icon">Icon</label>

                    <div class="input-group">

                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>

                <input id="thumbnail" class="form-control" type="text" name="icon" value="{{old('icon', @$setting->icon)}}">
            </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
            @error('icon')
                <span class="text-danger">{{$message}}</span>
            @enderror
                @isset($setting)
                   <div class="col-md-4">
                        <img src="{{asset(@$setting->icon)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                   </div>
                @endisset
            </div>

            <div class="col-md-6 form-group mt-2">
                <label for="logo">Logo</label>
                <div class="input-group">
                    <span class="input-group-btn">
                      <a id="logo" data-input="thumbnail1" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                      </a>
                    </span>
                    <input id="thumbnail1" class="form-control" type="text" name="logo" value="{{old('logo', @$setting->logo)}}">
                  </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">

                @error('logo')
                <span class="text-danger">{{$message}}</span>
                @enderror

                @isset($setting)
                   <div class="col-md-4">
                        <img src="{{asset(@$setting->logo)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                   </div>
                @endisset
            </div>

            <div class="col-md-6 form-group mt-2">
                <label for="logo3">logo2</label>
                <div class="input-group">
                    <span class="input-group-btn">
                      <a id="logo3" data-input="thumbnail122" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                      </a>
                    </span>
                    <input id="thumbnail122" class="form-control" type="text" name="logo3" value="{{old('logo3', @$setting->logo3)}}">
                  </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">

                @error('logo3')
                <span class="text-danger">{{$message}}</span>
                @enderror

                @isset($setting)
                   <div class="col-md-4">
                        <img src="{{asset(@$setting->logo3)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                   </div>
                @endisset
            </div>


            {{-- footer logo --}}

            <div class="col-md-6 form-group mt-2">
                <label for="logo2">Footer Logo</label>
                <div class="input-group">
                    <span class="input-group-btn">
                      <a id="logo2" data-input="thumbnail2" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                      </a>
                    </span>
                    <input id="thumbnail2" class="form-control" type="text" name="logo2" value="{{old('logo2', @$setting->logo2)}}">
                  </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">

                @error('logo2')
                    <span class="text-danger">{{$message}}</span>
                @enderror

                @isset($setting)
                   <div class="col-md-4">
                        <img src="{{asset(@$setting->logo2)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                   </div>
                @endisset
            </div>


            {{-- <div class="col-md-6 form-group "> --}}
                <div class="col-md-6 form-group mt-2">
                <label for="quatation">Footer Quatation</label>
                <textarea name="quatation" id="quatation" rows="4" class="form-control ">{{ old('quatation', @$setting->quatation) }}</textarea>
                @error('quatation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>



            <div class="col-md-6 form-group mt-2">
                <label for="fb_link">Facebook Page</label>
                <input type="text" name="fb_link" id="fb_link" class="form-control "
                    value="{{ old('fb_link', @$setting->fb_link) }}">
                @error('fb_link')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="twitter_link">Twitter Link</label>
                <input type="text" name="twitter_link" id="twitter_link" class="form-control "
                    value="{{ old('twitter_link', @$setting->twitter_link) }}">
                @error('twitter_link')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="linkedin_link">LinkedIn Link</label>
                <input type="text" name="linkedin_link" id="linkedin_link" class="form-control "
                    value="{{ old('linkedin_link', @$setting->linkedin_link) }}">
                @error('linkedin_link')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="insta_link">Instagram Link</label>
                <input type="text" name="insta_link" id="insta_link" class="form-control " value="{{old('insta_link', @$setting->insta_link)}}">
                @error('insta_link')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="youtube_link">Youtube Link</label>
                <input type="text" name="youtube_link" id="youtube_link" class="form-control " value="{{old('youtube_link', @$setting->youtube_link)}}">
                @error('youtube_link')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="pinterest_link">Pinterest Link</label>
                <input type="text" name="pinterest_link" id="pinterest_link" class="form-control " value="{{old('pinterest_link', @$setting->pinterest_link)}}">
                @error('pinterest_link')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="google_plus">Google+ Link</label>
                <input type="text" name="google_plus" id="google_plus" class="form-control " value="{{old('google_plus', @$setting->google_plus)}}">
                @error('google_plus')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="address">Address 1</label>
                <input type="text" name="address" id="adress" class="form-control "
                    value="{{ old('address', @$setting->address) }}">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 form-group mt-2">
                <label for="address2">Address 2</label>
                <input type="text" name="address2" id="adress" class="form-control "
                    value="{{ old('address2', @$setting->address2) }}">
                @error('address2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 form-group mt-2">
                <label for="location_url">Location URL</label>
                <input type="text" name="location_url" id="adress" class="form-control "
                    value="{{ old('location_url', @$setting->location_url) }}">
                @error('location_url')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 form-group mt-2">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control "
                    value="{{ old('email', @$setting->email) }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 form-group mt-2">
                <label for="email2">Email 2</label>
                <input type="text" name="email2" id="email2" class="form-control "
                    value="{{ old('email2', @$setting->email2) }}">
                @error('email2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        {{-- </div> --}}
        {{-- <div class="col row"> --}}
            <div class="col-md-6 form-group mt-2">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control " value="{{old('phone', @$setting->phone)}}">
                @error('phone')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="contact">Contact</label>
                <input type="text" name="contact" id="contact" class="form-control "
                    value="{{ old('contact', @$setting->contact) }}">
                @error('contact')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="contact_second">Contact 2</label>
                <input type="text" name="contact_second" id="contact_second" class="form-control "
                    value="{{ old('contact_second', @$setting->contact_second) }}">
                @error('contact_second')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <div class="col-md-6 form-group mt-2">
                <label for="meta_title">Meta Title(Optional)</label>
                <input type="text" name="meta_title" id="meta_title" class="form-control "
                    value="{{ old('meta_title', @$setting->meta_title) }}">
                @error('meta_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="meta_keywords">Meta Keywords(Optional)</label>
                <textarea name="meta_keywords" id="meta_keywords" rows="5" class="form-control ">{{ old('meta_keywords', @$setting->meta_keywords) }}</textarea>
                @error('meta_keywords')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2">
                <label for="meta_description">Meta Description(Optional)</label>
                <textarea name="meta_description" id="meta_description" rows="5" class="form-control ">{{ old('meta_description', @$setting->meta_description) }}</textarea>
                @error('meta_description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="text-center"> --}}

            <div class="col-md-6 form-group mt-2">
                <label for="copyright">CopyRight Section</label>
                <input type="text" name="copyright" id="copyright" class="form-control "
                    value="{{ old('copyright', @$setting->copyright) }}">
                @error('copyright')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        {{-- </div> --}}
        {{-- </div> --}}
    </div>

<div class="text-center mt-2">
    {{ Form::button('<i class="bi bi-x"></i> Reset',['class'=>'btn btn-sm btn-danger','type'=>'reset'])}}
    @isset($setting)
    {{ Form::button('<i class="bi bi-send"></i> Update',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
    @else
    {{ Form::button('<i class="bi bi-send"></i> Add',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
    @endisset
</div>

</form>
