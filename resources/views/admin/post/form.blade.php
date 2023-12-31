@extends('layouts.backend_layout.template')


@section('title', 'Admin || Post-Form')


@section('main-content')

    <div class="pagetitle">
        <h1>Post-Form</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('post.index') }}">Post List</a></li>
                <li class="breadcrumb-item active">Post Form</li>
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
                        Post
                    </h5>

                </div>

                <div>
                    @isset($data)
                        {{ Form::open(['url' => route('post.update', @$data->id), 'files' => true]) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('post.store'), 'files' => true]) }}
                    @endisset
                    <div class="row " id="itineary">
                        <div class="col-12 mb-2">
                            {{ Form::label('title', 'Title:', ['class' => 'form-label']) }}
                            {{ Form::text('title', @$data->title, ['class' => 'form-control  ' . ($errors->has('title') ? 'is-invalid' : ''), 'placeholder' => 'Enter Post Title Here.....', 'required' => true]) }}
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            {{ Form::label('summary', 'Summary:', ['class' => 'form-label']) }}
                            {{ Form::textarea('summary', @$data->summary, ['class' => 'form-control  ' . ($errors->has('summary') ? 'is-invalid' : ''), 'placeholder' => 'Enter Product summary Here.....', 'required' => false, 'rows' => 5, 'style' => 'resize:none;']) }}
                            @error('summary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            {{ Form::label('description', 'Description:', ['class' => 'form-label']) }}
                            {{ Form::textarea('description', @$data->description, ['class' => 'form-control  ' . ($errors->has('Description') ? 'is-invalid' : ''), 'placeholder' => 'Enter Product Description Here.....', 'required' => false, 'rows' => 5, 'style' => 'resize:none;']) }}
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12  mb-2">
                            {{ Form::label('icon', 'Post Header Icon:', ['class' => 'form-label']) }}
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="new1" data-input="thumbnail1" data-preview="holder"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail1" class="form-control" type="text" name="icon"
                                        value="{{ old('icon', @$data->icon) }}">
                                </div>
                                <img id="holder" style="margin-top:15px;max-height:100px;">
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @isset($data)
                                <div class="col-md-4">
                                    <img src="{{ asset(@$data->icon) }}" alt="Img" class="img img-fluid img-thumbnail">
                                </div>
                            @endisset
                        </div>

                        <div class="col-12 mb-2">
                            {{ Form::label('status', 'Post Status:', ['class' => 'form-label']) }}
                            {{ Form::select('status', ['active' => 'Active', 'inactive' => 'In-Active'], @$data->status, ['class' => 'form-control  ' . ($errors->has('status') ? 'is-invalid' : ''), 'placeholder' => '-----Select Any One-----', 'required' => true]) }}
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12  mb-2">
                            {{ Form::label('image', 'Post Image:', ['class' => 'form-label']) }}
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="new" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="image"
                                        value="{{ old('image', @$data->image) }}">
                                </div>
                                <img id="holder" style="margin-top:15px;max-height:100px;">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @isset($data)
                                <div class="col-md-4">
                                    <img src="{{ asset(@$data->image) }}" alt="Img" class="img img-fluid img-thumbnail">
                                </div>
                            @endisset
                        </div>
                        {{-- @dd($data->getDetails) --}}
                        @isset($data)
                            @if(count($data->getDetails) >0)
                                @foreach($data->getDetails as $dataValue)
                                    <div class="col-12 mb-4">
                                        {{ Form::label("heading","Heading:",["class"=>"form-label","style"=>"font-weight:bold"])}}
                                        {{ Form::text("heading[]",@$dataValue->heading,["class"=>"form-control  ".($errors->has("heading") ?"is-invalid":""),"placeholder"=>"Enter OverView Slogan Here.....","required"=>false])}}
                                        @error("heading")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                        {{ Form::label("description1","Description:",["class"=>"form-label","style"=>"font-weight:bold"])}}
                                        {{ Form::textarea("description1[]",@$dataValue->description,["class"=>"form-control  ".($errors->has("description1") ?"is-invalid":""),"placeholder"=>"Enter OverView Slogan Here.....","required"=>false,"style"=>"resize:none","rows"=>5])}}
                                        @error("description1")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach

                            @else
                            <div class="col-12 mb-4">
                                {{ Form::label("heading","Heading:",["class"=>"form-label","style"=>"font-weight:bold"])}}
                                {{ Form::text("heading[]",@$iteneary->heading,["class"=>"form-control  ".($errors->has("heading") ?"is-invalid":""),"placeholder"=>"Enter OverView Slogan Here.....","required"=>false])}}
                                @error("heading")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 mb-4">
                                {{ Form::label("description1","Description:",["class"=>"form-label","style"=>"font-weight:bold"])}}
                                {{ Form::textarea("description1[]",@$iteneary->description1,["class"=>"form-control  ".($errors->has("description1") ?"is-invalid":""),"placeholder"=>"Enter OverView Slogan Here.....","required"=>false,"style"=>"resize:none","rows"=>5])}}
                                @error("description1")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif
                        @else
                        <div class="col-12 mb-4">
                            {{ Form::label("heading","Heading:",["class"=>"form-label","style"=>"font-weight:bold"])}}
                            {{ Form::text("heading[]",@$iteneary->heading,["class"=>"form-control  ".($errors->has("heading") ?"is-invalid":""),"placeholder"=>"Enter OverView Slogan Here.....","required"=>false])}}
                            @error("heading")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-4">
                            {{ Form::label("description1","Description:",["class"=>"form-label","style"=>"font-weight:bold"])}}
                            {{ Form::textarea("description1[]",@$iteneary->description1,["class"=>"form-control  ".($errors->has("description1") ?"is-invalid":""),"placeholder"=>"Enter OverView Slogan Here.....","required"=>false,"style"=>"resize:none","rows"=>5])}}
                            @error("description1")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @endisset

                        
                    </div>
                    <div class="row">
                        <div class="col-12 mb-4">
                            <a href="javascript:;" onclick="addIteneary()" class="btn btn-sm btn-primary">
                                Add Row
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card col-md-3" style="box-shadow: 0px 0px 5px grey;margin-left:50px;height:600px">
            <div class="card-body">
                <div>
                    <h5 class="card-title">

                        Categories
                    </h5>

                </div>

                <div>
                    <div class="row ">
                        <div class="col-12 mb-2">
                            {{ Form::select('cat_id', @$post_cat->pluck('name', 'id'), @$data->cat_id, ['class' => 'form-control  ' . ($errors->has('cat_id') ? 'is-invalid' : ''), 'placeholder' => '-----------Select Category----------', 'required' => false]) }}
                            @error('cat_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="card-title">

                        Meta
                    </h5>

                </div>

                <div>
                    <div class="row ">
                        <div class="col-12 mb-2">
                            {{ Form::label('meta_titles', 'Meta Titles:', ['class' => 'form-label']) }}
                            {{ Form::text('meta_titles', @$data->meta_titles, ['class' => 'form-control  ' . ($errors->has('meta_titles') ? 'is-invalid' : ''), 'placeholder' => 'Enter Meta Title Here.....', 'required' => false]) }}
                            @error('meta_titles')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <div class="row ">
                        <div class="col-12 mb-2">
                            {{ Form::label('meta_keywords', 'meta Keywords:', ['class' => 'form-label']) }}
                            {{ Form::textarea('meta_keywords', @$data->meta_keywords, ['class' => 'form-control  ' . ($errors->has('meta_keywords') ? 'is-invalid' : ''), 'placeholder' => 'Enter Meta Keywords Here.....', 'required' => false, 'resize:none', 'rows' => 3]) }}
                            @error('meta_keywords')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <div class="row ">
                        <div class="col-12 mb-2">
                            {{ Form::label('meta_descriptions', 'Meta Descriptions:', ['class' => 'form-label']) }}
                            {{ Form::textarea('meta_descriptions', @$data->meta_descriptions, ['class' => 'form-control  ' . ($errors->has('meta_descriptions') ? 'is-invalid' : ''), 'placeholder' => 'Enter Meta Descriptions Here.....', 'required' => false, 'resize:none', 'rows' => 3]) }}
                            @error('meta_descriptions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-center mb-2 mt-4">
                    {{ Form::button('<i class="bi bi-x"></i> Reset', ['class' => 'btn btn-sm btn-danger', 'type' => 'reset']) }}
                    @isset($data)
                        {{ Form::button('<i class="bi bi-send"></i> Update', ['class' => 'btn btn-sm btn-success', 'type' => 'submit']) }}
                    @else
                        {{ Form::button('<i class="bi bi-send"></i> Add', ['class' => 'btn btn-sm btn-success', 'type' => 'submit']) }}
                    @endisset
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection

@section('backend-js')

<script>
    function addIteneary() {
        $('#itineary').append(
            '<div class="col-12 mb-2"><div class="form-group"><label for="question">Heading :</label><input type="text" name="heading[]" id="question" class="form-control"></div></div><div class="col-12 mb-2"><div class="form-group"><label for="answer">Description</label><textarea name="description1[]" id="description" rows="4" class="description form-control"> </textarea></div></div>'
            );
    }
</script>
    <script type="text/javascript">
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}',
        };

        CKEDITOR.replace('description', options);
        CKEDITOR.replace('description1', options);
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            // alert("Hello\nHow are you?");
            $('#new').filemanager('image');
            $('#new1').filemanager('image');

            
        });
    </script>
@endsection
