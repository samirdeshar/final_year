@extends('layouts.backend_layout.template')

@section('title','Admin || about-Form')


@section('main-content')

<div class="pagetitle">
    <h1>Faq Design-Form</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Faq Design Form</li>
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
                    Faq Design
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

                {{ Form::open(['url'=>route('faqDesign.update',$data->id),'files'=>true])}}
                @method('put')
                @else
                {{ Form::open(['url'=>route('faqDesign.store'),'files'=>true])}}
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

                <div class="col-12 mb-2 form-group">
                   <label for="status">Status</label>
                   <select name="status" id="#" class="form-control form-control-sm">
                    <option value="inactive"> ----- PLease Select Any One ------</option>
                    <option value="active" {{(@$data->status == 'active') ? 'selected' : ''}}>Active</option>
                    <option value="inactive" {{(@$data->status == 'inactive') ? 'selected' : ''}}>Inactive</option>
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
  </div>

<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replace('description', {
filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
filebrowserUploadMethod: 'form'
});
</script>

<script type="text/javascript">
    CKEDITOR.replace('team_description', {
    filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
    });
</script>


@endsection

@section('backend-js')
<script>
$(document).ready(function(){
    $('#lfm').filemanager('image');
});
</script>
@endsection
