@extends('layouts.backend_layout.template')


@section('title','Admin || Information-Form')


@section('main-content')

<div class="pagetitle">
    <h1>Information-Form</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active"><a href="">Informations List</a></li>
        <li class="breadcrumb-item active">Information Form</li>
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
                Information
            </h5>

        </div>

        <div>
            @isset($data)

            {{ Form::open(['url'=>route('information.update',$data->id),'files'=>true])}}
            @method('put')
            @else
            {{ Form::open(['url'=>route('information.store'),'files'=>true])}}
            @endisset
            <div class="col-12 mb-2">
                {{ Form::label('title','Title:',['class'=>'form-label'])}}
                {{ Form::text('title',@$data->title,['class'=>'form-control  '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Enter Title .....','required'=>true])}}
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row col-12 mb-2">
                {{ Form::label('icon','Display Icon:',['class'=>'form-label'])}}
                <div class="input-group">
                    <span class="input-group-btn">
                      <a id="icon" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                      </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="icon" value="{{old('icon', @$data->icon)}}">
                  </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">

                @error('icon')
                  <span class="text-danger">{{$message}}</span>
                @enderror

                @isset($data)
                   <div class="col-md-4">
                        <img src="{{asset(@$data->icon)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                   </div>
                @endisset
            </div>


            <div class="col-12 mb-2">
                {{ Form::label('summary','Summary:',['class'=>'form-label'])}}
                {{ Form::textarea('summary',@$data->summary,['class'=>'form-control  '.($errors->has('summary') ?'is-invalid':''),'placeholder'=>'Enter Summary Here.....','required'=>false,'rows'=>5,'style'=>'resize:none;'])}}
                @error('summary')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('things','Things To Do:',['class'=>'form-label'])}}
                {{ Form::textarea('things',@$data->things,['class'=>'form-control  '.($errors->has('things') ?'is-invalid':''),'placeholder'=>'Enter things Here.....','required'=>false,'rows'=>5,'style'=>'resize:none;'])}}
                @error('things')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('description','Description:',['class'=>'form-label'])}}
                {{ Form::textarea('description',@$data->description,['class'=>'form-control  '.($errors->has('Description') ?'is-invalid':''),'placeholder'=>'Enter Description Here.....','required'=>false,'rows'=>5,'style'=>'resize:none;'])}}
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('status','Sub-Category Of:',['class'=>'form-label'])}}
                {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$data->status,['class'=>'form-control  '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'------------Select If Any---------------','required'=>true])}}
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row col-12 mb-2">
                {{ Form::label('image','Banner Image:',['class'=>'form-label'])}}
                <div class="input-group">
                    <span class="input-group-btn">
                      <a id="ne_image" data-input="thumbnail1" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                      </a>
                    </span>
                    <input id="thumbnail1" class="form-control" type="text" name="image" value="{{old('image', @$data->image)}}">
                  </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">

                @error('image')
                  <span class="text-danger">{{$message}}</span>
                @enderror

                @isset($data)
                   <div class="col-md-4">
                        <img src="{{asset(@$data->image)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                   </div>
                @endisset
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
@endsection

@section('backend-js')

<script type="text/javascript">
        $(document).ready(function(){
            $('#icon').filemanager('image');

            $('#ne_image').filemanager('image');
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
