@extends('layouts.backend_layout.template')


@section('title','Admin || testimonial-Form')


@section('main-content')

<div class="pagetitle">
    <h1>Testimonial-Form</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active"><a href="">Testimonial List</a></li>
        <li class="breadcrumb-item active">Testimonial Form</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card">
    <div class="card-body">
        <div>
            <h5 class="card-title">
                @isset($data)
                Update
                @else
                Add
                @endisset
                Testimonial
            </h5>

        </div>

        <div>
            @isset($data)

            {{ Form::open(['url'=>route('testimonial.update',$data->id),'files'=>true])}}
            @method('put')
            @else
            {{ Form::open(['url'=>route('testimonial.store'),'files'=>true])}}
            @endisset
            <div class="col-12 mb-2">
                {{ Form::label('title','Title:',['class'=>'form-label'])}}
                {{ Form::text('title',@$data->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Enter Title Here.....','required'=>true])}}
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="col-12 mb-2">
                {{ Form::label('review','Review:',['class'=>'form-label'])}}
                {!! Form::textarea('description',@$data->description,['class'=>'form-control form-control-sm '.($errors->has('description') ?'is-invalid':''),'placeholder'=>'Place  your feedback here.....']) !!}
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}

            <div class="col-12 mb-2">
                {{ Form::label('review','Summary:',['class'=>'form-label'])}}
                {!! Form::textarea('summary',@$data->summary,['class'=>'form-control form-control-sm '.($errors->has('summary') ?'is-invalid':''),'placeholder'=>'Place  your feedback here.....']) !!}
                @error('summary')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('description','Description:',['class'=>'form-label'])}}
                {{ Form::textarea('description',@$data->description,['class'=>'form-control form-control-sm '.($errors->has('Description') ?'is-invalid':''),'placeholder'=>'Enter testimonial Description Here.....','required'=>true,'rows'=>5,'style'=>'resize:none;'])}}
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2 form-group">
                <label for="type">Type</label>
                <select name="type" id="#" class="form-control">
                 <option value="testimonial" {{(@$data->type == 'testimonial') ? 'selected' : ''}}>Testimonial</option>
                 <option value="review" {{(@$data->type == 'review') ? 'selected' : ''}}>Review</option>
                </select>
                 @error('status')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>

            <div class="col-12 mb-2 form-group">
               <label for="status">Status</label>
               <select name="status" id="#" class="form-control">
                <option value="inactive"> ----- PLease Select Any One ------</option>
                <option value="active" {{(@$data->status == 'active') ? 'selected' : ''}}>Active</option>
                <option value="inactive" {{(@$data->status == 'inactive') ? 'selected' : ''}}>Inactive</option>
               </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row mb-2">
                {{ Form::label('image','Profile Image:',['class'=>'form-label'])}}
               <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-btn">
                      <a id="img" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                      </a>
                    </span>
                <input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image', @$data->image)}}">
                  </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">
                <br>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
               </div>
               @isset($data)
               <div class="col-md-4">
                    <img src="{{asset(@$data->image)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
               </div>
                @endisset
            </div>
        </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
        <div>
            <h5 class="card-title">
                Featured Testimonial
            </h5>
        </div>

        <div class="form-group mt-2">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm" value="{{old('name', @$data->name)}}">
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control form-control-sm" value="{{old('email', @$data->email)}}">
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control form-control-sm" value="{{old('phone', @$data->phone)}}">
            @error('phone')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control form-control-sm" value="{{old('address', @$data->address)}}">
            @error('address')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="trip">Trip</label>
            <input type="text" name="trip" id="trip" class="form-control form-control-sm" value="{{old('trip', @$data->trip)}}">
            @error('trip')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="country">Country</label>
            <input type="text" name="country" id="country" class="form-control form-control-sm" value="{{old('country', @$data->country)}}">
            @error('country')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="website">Website</label>
            <input type="text" name="website" id="website" class="form-control form-control-sm" value="{{old('website', @$data->website)}}">
            @error('website')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="text-center mt-2">
        {{ Form::button('<i class="bi bi-x"></i> Reset',['class'=>'btn btn-sm btn-danger','type'=>'reset'])}}
        @isset($data)
        {{ Form::button('<i class="bi bi-send"></i> Update',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
        @else
        {{ Form::button('<i class="bi bi-send"></i> Add',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
        @endisset
    </div>
  </div>




@endsection

@push('scripts')
<script type="text/javascript">
    var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
    };

// CKEDITOR.replace('description', options);

</script>

<script>
    $(document).ready(function(){
        $('#img').filemanager('image');
    });
</script>
@endpush
