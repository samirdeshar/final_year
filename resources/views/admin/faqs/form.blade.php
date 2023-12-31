@extends('layouts.backend_layout.template')


@section('title','Admin || geaneralFaqs-Form')


@section('main-content')

<div class="pagetitle">
    <h1>General FAQ-Form</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active"><a href="">General FAQs List</a></li>
        <li class="breadcrumb-item active">General FAQ Form</li>
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
                General FAQ
            </h5>

        </div>

        <div>
            @isset($data)

            {{ Form::open(['url'=>route('generalFaq.update',$data->id),'files'=>true])}}
            @method('put')
            @else
            {{ Form::open(['url'=>route('generalFaq.store'),'files'=>true])}}
            @endisset
            <div class="col-12 mb-2">
                {{ Form::label('title','Title:',['class'=>'form-label'])}}
                {{ Form::text('title',@$data->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Enter Title Here.....','required'=>true])}}
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2">
                {{ Form::label('description','Description:',['class'=>'form-label'])}}
                {{ Form::textarea('description',@$data->description,['class'=>'form-control form-control-sm '.($errors->has('Description') ?'is-invalid':''),'placeholder'=>'Enter generalFaq Description Here.....','required'=>true,'rows'=>5,'style'=>'resize:none;'])}}
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mb-2 form-group">
               <label for="status">Publish Status</label>
               <select name="status" id="#" class="form-control">
                <option value="inactive"> ----- PLease Select Any One ------</option>
                <option value="active" {{(@$data->status == 'active') ? 'selected' : ''}}>Active</option>
                <option value="inactive" {{(@$data->status == 'active') ? 'selected' : ''}}>Inactive</option>
               </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="text-center mt-2 mb-4">
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
