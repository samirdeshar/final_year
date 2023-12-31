@extends('layouts.backend_layout.template')

@section('title','Admin || about-Form')


@section('main-content')

<div class="pagetitle">
    <h1>About-Form</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active"><a href="">About List</a></li>
        <li class="breadcrumb-item active">About Form</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card">
   <div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="card-body">
            <div>
                <h5 class="card-title">
                    @isset($data)
                    Update
                    @else
                    Add
                    @endisset
                    About
                </h5>
            </div>

        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif --}}


            <div>
                @isset($data)

                {{ Form::open(['url'=>route('about.update',$data->id),'files'=>true])}}
                @method('put')
                @else
                {{ Form::open(['url'=>route('about.store'),'files'=>true])}}
                @endisset
                <div class="col-12 mb-2">
                    {{ Form::label('title','Title:',['class'=>'form-label'])}}
                    {{ Form::text('title',@$data->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Enter about Title Here.....','required'=>true])}}
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slogan">Sub Title</label>
                    <input type="text" name="slogan" id="slogan" class="form-control form-control-sm" value="{{old('slogan', @$data->slogan)}}" placeholder="Enter about Sub Title...">
                    @error('slogan')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="background_text">Background Text</label>
                    <input type="text" name="background_text" id="background_text" class="form-control form-control-sm" value="{{old('background_text', @$data->background_text)}}">
                    @error('background_text')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-12 mb-2">
                    {{ Form::label('description','Description:',['class'=>'form-label'])}}
                    {{ Form::textarea('description',@$data->description,['class'=>'form-control form-control-sm '.($errors->has('Description') ?'is-invalid':''),'placeholder'=>'Enter about Description Here.....','required'=>true,'rows'=>5,'style'=>'resize:none;'])}}
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 mb-2 form-group">
                   <label for="status">Status</label>
                   <select name="status" id="#" class="form-control form-control-sm">
                    <option value="inactive"> ----- PLease Select Any One ------</option>
                    <option value="active" {{(@$data->status == 'active') ? 'selected' : ''}}>Active</option>
                    <option value="inactive" {{(@$data->status == 'active') ? 'selected' : ''}}>Inactive</option>
                   </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row mb-2">
                    {{ Form::label('image','Banner Image',['class'=>'form-label'])}}
                    <div class="input-group">
                        <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                          </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image', @$data->image)}}">
                      </div>
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                    @isset($data)
                       <div class="col-md-4">
                            <img src="{{asset(@$data->image)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                       </div>
                    @endisset
                </div>
            </div>
        </div>

        <div class="card-body">
            <div>
                <h5 class="card-title">
                    @isset($data)
                    Update
                    @else
                    Add
                    @endisset
                    Team Page
                </h5>
            </div>
            <div>
                <div class="form-group">
                    <label for="team_title" class="form-label">Team Title</label>
                    <input type="text" name="team_title" id="team_title" class="form-control form-control-sm" value="{{old('team_title', @$data->team_title)}}">
                    @error('team_title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="team_backgroundtext">Background Text</label>
                    <input type="text" name="team_backgroundtext" id="team_backgroundtext" class="form-control form-control-sm" value="{{old('team_backgroundtext', @$data->team_backgroundtext)}}">
                    @error('team_backgroundtext')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="team_description">Team Description</label>
                    <textarea name="team_description" id="team_description" rows="5" class="form-control">{{old('team_description', @$data->team_description)}}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="team_features">Team Features</label>
                    <textarea name="team_features" id="team_features" rows="5" class="form-control">{{old('team_features', @$data->team_features)}}</textarea>
                </div>
            </div>
        </div>
       </div>
       <div class="col-md-4 col-sm-12 mt-5">

             <div class="form-group">
                 <label for="meta_title">Meta Title</label>
                 <input type="text" name="meta_title" id="meta_title" class="form-control form-control-sm" value="{{old('meta_title', @$data->meta_title)}}">
                 @error('meta_title')
                     <span class="text-danger">{{$message}}</span>
                 @enderror
             </div>
             <div class="form-group">
                 <label for="meta_keywords">Meta Keywords</label>
                 <textarea name="meta_keywords" id="meta_keywords" rows="5" class="form-control form-control-sm">{{old('meta_keywords', @$data->meta_keywords)}}</textarea>
                 @error('meta_keywords')
                     <span class="text-danger">{{$message}}</span>
                 @enderror
             </div>
             <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea name="meta_description" id="meta_description" rows="5" class="form-control form-control-sm">{{old('meta_description', @$data->meta_description)}}</textarea>
                @error('meta_description')
                    <span class="text-danger">{{$message}}</span>
                @enderror
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
   </div>
  </div>
@endsection

@section('backend-js')


<script type="text/javascript">


    var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
    };

        CKEDITOR.replace('description', options);

        CKEDITOR.replace('team_description', options);
        CKEDITOR.replace('team_features', options);
    </script>

    <script>
        $(document).ready(function(){
            $('#lfm').filemanager('image');
        });
    </script>
@endsection

