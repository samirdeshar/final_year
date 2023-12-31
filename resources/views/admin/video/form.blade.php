@extends('layouts.backend_layout.template')


@section('title','Admin || Video-Form')


@section('main-content')

<div class="pagetitle">
    <h1>Team-Form</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active"><a href="">Teams List</a></li>
        <li class="breadcrumb-item active">Team Form</li>
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
                Member
            </h5>

        </div>

        <div>
            @isset($data)

            {{ Form::open(['url'=>route('video.update',$data->id),'files'=>true])}}
            @method('put')
            @else
            {{ Form::open(['url'=>route('video.store'),'files'=>true])}}
            @endisset
            <div class="row">
                <div class="col-md-6 mb-2">
                    {{ Form::label('title','Title:',['class'=>'form-label'])}}
                    {{ Form::text('title',@$data->title,['class'=>'form-control  '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Enter Name .....','required'=>true])}}
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    {{ Form::label('description','Description:',['class'=>'form-label'])}}
                    {{ Form::textarea('description',@$data->description,['class'=>'form-control  '.($errors->has('Description') ?'is-invalid':''),'placeholder'=>'Enter testimonial Description Here.....','required'=>true,'rows'=>5,'style'=>'resize:none;'])}}
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    {{ Form::label('video_url','Profile Image:',['class'=>'form-label'])}}
                   <div class="col-md-12">
                        <label for="video_url">Choose Video:</label>
                        <input type="file" name="video_url" accept="video/*" required>
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                    @error('record')
                        <span class="text-danger"> {{$message}} </span>
                    @enderror

                    @isset($data)
                    <video controls width="200" height="150">
                        <source src="{{ @$data->video_url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @endisset
                </div>
                <div class="col-6 mb-2">
                    {{ Form::label('status','Status:',['class'=>'form-label'])}}
                    {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$data->status,['class'=>'form-control  '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'------------Select If Any---------------','required'=>true])}}
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
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
@section('backend-js')
    <script>
        $(document).ready(function(){
            $('#lfm').filemanager('image');
        });
    </script>


<script type="text/javascript">
    var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
    };

CKEDITOR.replace('description', options);

</script>

@endsection
