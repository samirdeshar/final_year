@if (isset($setting))
<form action="{{ route('setting.update', $setting) }}" method="post" enctype="multipart/form-data">
    @method('PATCH')
@else
    <form action="{{ route('setting.store') }}" method="post" enctype="multipart/form-data">
@endif
@csrf

    <div class="row ms-3 mr-3">
        <h5 class="card-title ms-3 mr-3">
        Awards Page
        </h5>
        <div class="col-6 mb-4">
            {{ Form::label("trip_title","Title: *",["class"=>"form-label","style"=>"font-weight:bold"])}}
            {{ Form::text("trip_title",@$setting->trip_title,["class"=>"form-control  ".($errors->has("trip_title") ?"is-invalid":""),"placeholder"=>"Enter Trip Page Title Here.....","required"=>true])}}
            @error("trip_title")
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-6 mb-4">
            {{ Form::label("trip_sub_title","Sub Title:",["class"=>"form-label","style"=>"font-weight:bold"])}}
            {{ Form::text("trip_sub_title",@$setting->trip_sub_title,["class"=>"form-control  ".($errors->has("trip_sub_title") ?"is-invalid":""),"placeholder"=>"Enter Trip Page Sub Title Here.....","required"=>true])}}
            @error("trip_sub_title")
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-6 mb-4">
            {{ Form::label("trip_background_text","Background Text:",["class"=>"form-label","style"=>"font-weight:bold"])}}
            {{ Form::text("trip_background_text",@$setting->trip_background_text,["class"=>"form-control  ".($errors->has("trip_background_text") ?"is-invalid":""),"placeholder"=>"Enter Trip Page Background.....","required"=>true])}}
            @error("trip_background_text")
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-6 mb-4">
            {{ Form::label("trip_banner_image","Banner Image:",["class"=>"form-label","style"=>"font-weight:bold"])}}

            <div class="input-group">
                <span class="input-group-btn">
                  <a id="trip_banner_image" data-input="thumbnail3" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail3" class="form-control" type="text" name="trip_banner_image" value="{{old('trip_banner_image', @$setting->trip_banner_image)}}">
              </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">

            @error('trip_banner_image')
              <span class="text-danger">{{$message}}</span>
            @enderror

            @isset($setting)
               <div class="col-md-4">
                    <img src="{{asset(@$setting->trip_banner_image)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
               </div>
            @endisset
        </div>

    </div>
    <hr>
    <div class="row ms-3 mr-3">
        <h5 class="card-title ms-3 mr-3">
            Certificate
        </h5>



        <div class="col-6 mb-4 mt-4">
            {{ Form::label("certificate_image","Certificate Image:",["class"=>"form-label","style"=>"font-weight:bold"])}}
            <div class="input-group">
                <span class="input-group-btn">
                  <a id="certificate_image" data-input="thumbnail7" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail7" class="form-control" type="text" name="certificate_image" value="{{old('certificate_image', @$setting->certificate_image)}}">
              </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">

            @error('certificate_image')
              <span class="text-danger">{{$message}}</span>
            @enderror

            @isset($setting)
               <div class="col-md-4">
                    <img src="{{asset(@$setting->certificate_image)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
               </div>
            @endisset
        </div>

    </div>

    <div class="row ms-3 mr-3">
        <h5 class="card-title ms-3 mr-3">
            Payment
        </h5>



        <div class="col-6 mb-4 mt-4">
            {{ Form::label("payment_image","Payment Image:",["class"=>"form-label","style"=>"font-weight:bold"])}}
            <div class="input-group">
                <span class="input-group-btn">
                  <a id="payment_image" data-input="thumbnail8" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail8" class="form-control" type="text" name="payment_image" value="{{old('payment_image', @$setting->payment_image)}}">
              </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">

            @error('payment_image')
              <span class="text-danger">{{$message}}</span>
            @enderror

            @isset($setting)
               <div class="col-md-4">
                    <img src="{{asset(@$setting->payment_image)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
               </div>
            @endisset
        </div>

    </div>


<div class="text-center mt-2">
    {{ Form::button('<i class="bi bi-x"></i> Reset',['class'=>'btn btn-sm btn-danger','type'=>'reset'])}}
    @isset($setting)
    {{ Form::button('<i class="bi bi-send"></i> Submit',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
    @else
    {{ Form::button('<i class="bi bi-send"></i> Add',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
    @endisset
</div>

</form>

