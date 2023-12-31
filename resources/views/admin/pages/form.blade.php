@extends('layouts.backend_layout.template')


@section('title','Admin || Post-Form')


@section('main-content')

<div class="pagetitle">
    <h1>General Page - Form</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('generalPage.index')}}">General Pages List</a></li>
        <li class="breadcrumb-item active">General Page Form</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="row">
    <div class="card col-md-8" style="box-shadow: 0px 0px 5px grey; margin-left:20px">
        <div class="card-body">
            <div>
                <h5 class="card-title">
                    @isset($data)
                    Update
                    @else
                    Add
                    @endisset
                    General Page
                </h5>

            </div>

            <div>
                @isset($data)
                {{ Form::open(['url'=>route('generalPage.update', @$data->id),'files'=>true])}}
                @method('put')
                @else
                {{ Form::open(['url'=>route('generalPage.store'),'files'=>true])}}
                @endisset
                <div class="row ">
                    <div class="col-12 mb-2">
                        {{ Form::label('title','Title:',['class'=>'form-label'])}}
                        {{ Form::text('title',@$data->title,['class'=>'form-control  '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Enter Post Title Here.....','required'=>true])}}
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="col-12 mb-2">
                        {{ Form::label('icon','Icon Tag:',['class'=>'form-label'])}}
                        {{ Form::text('icon',@$data->icon,['class'=>'form-control  '.($errors->has('icon') ?'is-invalid':''),'placeholder'=>'Icon Tag Here.....','required'=>true])}}
                        @error('icon')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    
                    
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="show_in">Choose Where to Show</label>
                            <select name="show_in" id="show_in" class="form-control form-control-sm">
                                <option value="">--------------------Choose Or Not-----------------</option>
                                <option value="header" {{ (@$data->show_in=='header') ? 'selected':'' }}>Header</option>
                                <option value="footer" {{ (@$data->show_in=='footer')? 'selected':''}}>Footer</option>
                                <option value="both" {{ (@$data->show_in=='both')? 'selected':''}}>Both</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        {{ Form::label('summary','Summary:',['class'=>'form-label'])}}
                        {{ Form::textarea('summary',@$data->summary,['class'=>'form-control  '.($errors->has('summary') ?'is-invalid':''),'placeholder'=>'Enter Product summary Here.....','required'=>false,'rows'=>5,'style'=>'resize:none;'])}}
                        @error('summary')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-2">
                        {{ Form::label('description','Description:',['class'=>'form-label'])}}
                        {{ Form::textarea('description',@$data->description,['class'=>'form-control  '.($errors->has('Description') ?'is-invalid':''),'placeholder'=>'Enter Product Description Here.....','required'=>false,'rows'=>5,'style'=>'resize:none;'])}}
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-2">
                        {{ Form::label('status','Post Status:',['class'=>'form-label'])}}
                        {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$data->status,['class'=>'form-control  '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'-----Select Any One-----','required'=>true])}}
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12  mb-2">
                        {{ Form::label('image','Banner Image:',['class'=>'form-label'])}}
                        <div class="input-group">
                            <span class="input-group-btn">
                              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                              </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image', @$data->image)}}">
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
      </div>


      <div class="card col-md-3" style="box-shadow: 0px 0px 5px grey;margin-left:50px;height:600px">
        <div class="card-body">
            <div>
                <h5 class="card-title">
                    Meta Tags
                </h5>

            </div>

            <div>
                <div class="row ">
                    <div class="col-12 mb-2">
                        {{ Form::label('meta_title','Meta Title:',['class'=>'form-label'])}}
                        {{ Form::text('meta_title',@$data->meta_title,['class'=>'form-control  '.($errors->has('meta_title') ?'is-invalid':''),'placeholder'=>'Enter Meta Title Here.....','required'=>false])}}
                        @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <div class="row ">
                    <div class="col-12 mb-2">
                        {{ Form::label('meta_keywords','meta Keywords:',['class'=>'form-label'])}}
                        {{ Form::textarea('meta_keywords',@$data->meta_keywords,['class'=>'form-control  '.($errors->has('meta_keywords') ?'is-invalid':''),'placeholder'=>'Enter Meta Keywords Here.....','required'=>false, 'resize:none','rows'=>3])}}
                        @error('meta_keywords')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <div class="row ">
                    <div class="col-12 mb-2">
                        {{ Form::label('meta_description','Meta Description:',['class'=>'form-label'])}}
                        {{ Form::textarea('meta_description',@$data->meta_description,['class'=>'form-control  '.($errors->has('meta_description') ?'is-invalid':''),'placeholder'=>'Enter Meta Description Here.....','required'=>false, 'resize:none','rows'=>3])}}
                        @error('meta_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center mb-2 mt-4">
                {{ Form::button('<i class="bi bi-x"></i> Reset',['class'=>'btn btn-sm btn-danger','type'=>'reset'])}}
                @isset($data)
                {{ Form::button('<i class="bi bi-send"></i> Update',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
                @else
                {{ Form::button('<i class="bi bi-send"></i> Add',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
                @endisset
            </div>
        </div>
      </div>
      {{ Form::close()}}
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

</script>

<script>
    $(document).ready(function(){

        // alert("Hello\nHow are you?");
        $('#lfm').filemanager('image');
    });
    
    $(document).ready(function(){
    $('#lfm100010').filemanager('image');
});
</script>
@endsection

