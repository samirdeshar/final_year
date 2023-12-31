@extends('layouts.backend_layout.template')


@section('title','Admin || Awards-Form')


@section('main-content')

<div class="pagetitle">
    <h1>awards-Form</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active"><a href="">Awards List</a></li>
        <li class="breadcrumb-item active">Award Form</li>
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
                Awards
            </h5>

        </div>

        <div>
            @isset($data)
{{-- @dd($data->id) --}}
            {{ Form::open(['url'=>route('awards.update',$data->id),'files'=>true])}}
            @method('put')
            @else
            {{ Form::open(['url'=>route('awards.store'),'files'=>true])}}
            @endisset
            <div class="col-12 mb-2">
                {{ Form::label('name','Name:',['class'=>'form-label'])}}
                {{ Form::text('name',@$data->name,['class'=>'form-control  '.($errors->has('name') ?'is-invalid':''),'placeholder'=>'Enter Name .....','required'=>true])}}
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('cat_id','Category Of:',['class'=>'form-label'])}}
                {{ Form::select('cat_id',@$parentCat->pluck('name','id'),@$data->cat_id,['class'=>'form-control  '.($errors->has('cat_id') ?'is-invalid':''),'placeholder'=>'------------Select Any One---------------','required'=>false])}}
                @error('cat_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('sub_cat_id','Sub-Category Of:',['class'=>'form-label'])}}
                {{ Form::select('sub_cat_id',@$parentCat->pluck('name','id'),@$data->sub_cat_id,['class'=>'form-control  '.($errors->has('sub_cat_id') ?'is-invalid':''),'placeholder'=>'------------Select If Any---------------','required'=>false])}}
                @error('sub_cat_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('email','Email:',['class'=>'form-label'])}}
                {{ Form::text('email',@$data->email,['class'=>'form-control  '.($errors->has('email') ?'is-invalid':''),'placeholder'=>'Enter Email .....','required'=>false])}}
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('contact_no','Contact No:',['class'=>'form-label'])}}
                {{ Form::text('contact_no',@$data->contact_no,['class'=>'form-control  '.($errors->has('contact_no') ?'is-invalid':''),'placeholder'=>'Enter Contact No. .....','required'=>false])}}
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('description','Description:',['class'=>'form-label'])}}
                {{ Form::textarea('description',@$data->description,['class'=>'form-control  '.($errors->has('Description') ?'is-invalid':''),'placeholder'=>'Enter testimonial Description Here.....','required'=>true,'rows'=>5,'style'=>'resize:none;'])}}
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('status','Status:',['class'=>'form-label'])}}
                {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$data->status,['class'=>'form-control  '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'------------Select If Any---------------','required'=>true])}}
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row col-12 mb-2">
                {{ Form::label('image','Profile Image:',['class'=>'form-label'])}}
               <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                      </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image', @$data->image)}}">
                  </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">
                @error('record')
                    <span class="text-danger"> {{$message}} </span>
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

  <div class="card">
    <div class="card-body">
        <div>
            <h5 class="card-title">
                awards General
            </h5>
        </div>

        <div class="col-12 mb-2">
            {{ Form::label('designation','Designation:',['class'=>'form-label'])}}
            {{ Form::text('designation',@$data->designation,['class'=>'form-control  '.($errors->has('designation') ?'is-invalid':''),'placeholder'=>'Enter Designation .....','required'=>false])}}
            @error('designation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>





    </div>
    <div class="card-body">
        <div>
            <h5 class="card-title">
                Social Media Links
            </h5>
        </div>

        <div class="col-12 mb-2">
            {{ Form::label('fb_link','Facebook:',['class'=>'form-label'])}}
            {{ Form::url('fb_link',@$data->fb_link,['class'=>'form-control  '.($errors->has('fb_link') ?'is-invalid':''),'placeholder'=>'Enter Facebook Link Here .....','required'=>false])}}
            @error('fb_link')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12 mb-2">
            {{ Form::label('twitter_link','Twitter:',['class'=>'form-label'])}}
            {{ Form::url('twitter_link',@$data->twitter_link,['class'=>'form-control  '.($errors->has('twitter_link') ?'is-invalid':''),'placeholder'=>'Enter Twitter Link Here .....','required'=>false])}}
            @error('twitter_link')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12 mb-2">
            {{ Form::label('instagram_link','Instagram:',['class'=>'form-label'])}}
            {{ Form::url('instagram_link',@$data->instagram_link,['class'=>'form-control  '.($errors->has('instagram_link') ?'is-invalid':''),'placeholder'=>'Enter Instagram Link Here .....','required'=>false])}}
            @error('instagram_link')
                <span class="text-danger">{{ $message }}</span>
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
