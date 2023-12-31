@extends('layouts.backend_layout.template')
@section('backend-css')
<style>
    #form1 {
        display:none;
    }

</style>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

        .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

        .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

        input:checked + .slider {
        background-color: #2196F3;
    }

        input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

        input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

        /* Rounded sliders */
        .slider.round {
        border-radius: 34px;
    }

        .slider.round:before {
        border-radius: 50%;
    }
    .hide{
        display: none;

    }
    .show{
        display: block;
    }
</style>
{{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet"> --}}
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Menu <a href="{{ route('menu.index') }}" class="btn btn-primary">View Menu List</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Menu Lists</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="col-sm-12">
                            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="col-sm-12">
                            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Menu Title : </label>
                                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Menu title" required>
                                                    <p class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!--<div class="col-md-6">-->
                                            <!--    <div class="form-group">-->
                                            <!--        <label for="name">Icon Tag : </label>-->
                                            <!--        <input type="text" class="form-control" name="icon" value="{{ old('icon') }}" placeholder="Icon Tag" required>-->
                                            <!--        <p class="text-danger">-->
                                            <!--            {{ $errors->first('icon') }}-->
                                            <!--        </p>-->
                                            <!--    </div>-->
                                            <!--</div>-->



                                            <div class="col-md-6">
                                                {{ Form::label('image','Icon Image:',['class'=>'form-label'])}}
                                                <div class="input-group">


                                                <span class="input-group-btn">
                                                  <a id="lfm1111" data-input="thumbnail11" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                  </a>
                                                </span>
                                                <input id="thumbnail11" class="form-control" type="text" name="image" value="{{old('image', @$data->image)}}">
                                            </div>
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('image')
                                              <span class="text-danger">{{$message}}</span>
                                            @enderror








                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="menu_category">Menu Category: </label>
                                                    <select name="menu_category" class="form-control menuCat" id="menuCategory">
                                                        <option value="">--Select a category--</option>
                                                        @foreach ($menu_categories as $category)
                                                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('menu_category') }}
                                                    </p>
                                                    <button  class="btn btn-warning"  type="button" id="formButton">Create Category</button>
                                                    <label id="form1">
                                                        <input type="text" id="name1" placeholder="category Title">
                                                        <button class="btn btn-success" type="button" id="butsave">Submit</button>
                                                    </label>
                                                </div>
                                            </div>



                                            <div class="col-md-6 content-slug" style="display: none">
                                                <div class="form-group">
                                                    <label for="">Select Menu Link : </label>
                                                    <select name="content_slug" class="form-control" id="menuLink">
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content_slug') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Main Child">Main or Child Menu:</label>
                                                    <select name="main_child" class="form-control main_child">
                                                        <option value="">--Choose as main or child--</option>
                                                        <option value="0">Main Menu</option>
                                                        <option value="1">Chlid Menu</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('main_child') }}
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="banner_imagee">Banner Image</label>
                                                     {{-- Unisharp added filemanager --}}


                                                     <div class="input-group">
                                                        <span class="input-group-btn">
                                                          <a id="banner_image" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                            <i class="fa fa-picture-o"></i> Choose
                                                          </a>
                                                        </span>
                                                        <input id="thumbnail" class="form-control" type="text" name="banner_image">
                                                      </div>
                                                      <img id="holder" style="margin-top:15px;max-height:100px;">


                                                    @error('banner_image')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6" id="parent" style="display: none;">
                                                <div class="form-group">
                                                    <label for="parent id">Under Main Menu:</label>
                                                    <select name="parent_id" class="form-control" id="parent_id">
                                                        <option value="">--Select a Parent Menu--</option>
                                                        @foreach ($parent_menus as $menu)
                                                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('parent_id') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6" id="header_footer" style="display: none;">
                                                <div class="form-group">
                                                    <label for="show in">Show In:</label>
                                                    <select name="show_in" class="form-control" id="show_in_id">
                                                        <option value="">--Select where to show--</option>
                                                        <option value="1">Header</option>
                                                        <option value="2">Footer</option>
                                                        <option value="3">Header and Footer</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('show_in') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="publish_status">Active: </label>
                                                    <label class="switch pt-0">
                                                        <input type="checkbox" name="publish_status" value="1">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Content">Menu Content:</label>
                                                    <textarea name="content" id="summernote" class="form-control"></textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content') }}
                                                    </p>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Meta Information</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_title">Meta Title(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="Meta Title for SEO" value="">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keywords(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keyword') }}" placeholder="Meta Keywords for SEO" value="">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_keywords') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta-description">Meta Description (optional):</label>
                                                    <textarea name="meta_description"  value="{{ old('meta_description') }}" cols="30" rows="5" class="form-control" placeholder="Meta description.."></textarea>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <label for="">Current Og:</label> <br>
                                                <img id="current_og" style="height: 100px;" src="{{ Storage::disk('uploads')->url('noimage.jpg') }}">
                                            </div> --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="external_link">External Link(Optional): </label>
                                                    <input type="text" class="form-control" name="external_link" value="{{ old('external_link') }}" placeholder="External link" value="">
                                                    <p class="text-danger">
                                                        {{ $errors->first('external_link') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-4">
                                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection

@section('backend-js')
<script>
    $(function() {
        $('.main_child').change(function() {
            var main_child = $(this).children("option:selected").val();
            if (main_child == 1)
            {
                document.getElementById("parent").style.display = "block";
                document.getElementById("header_footer").style.display = "none";
            }
            else if(main_child == 0)
            {
                document.getElementById("parent").style.display = "none";
                document.getElementById("header_footer").style.display = "block";
            }
        })


    });
</script>

    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.lfm').filemanager('image');

            $('.menuCat').change(function(){
                var a = $(this).val();
                if(a == 'course'){
                    $('.content-slug').show();
                    $.ajax({
                        url: "{{route('menuLinkCourse')}}",
                        type: "GET",
                        data: {
                            _token:"{{ csrf_token()}}"
                        },
                        cache: false,
                        success: function(response) {
                            // console.log(response);
                            var course = response;
                            document.getElementById("menuLink").innerHTML =
                            course.reduce((tmp, x) => `${tmp}<option value='${x.slug}'>${x.title}</option>`, '');
                        }
                    });
                }else{
                    $('.content-slug').hide();
                }
            });


        });



</script>
    <script type="text/javascript">


    </script>
    <script>
        $("#formButton").click(function(){
        $("#form1").toggle();
    });
    </script>
    <script>
        $(document).ready(function() {

            $('#banner_image').filemanager('image');

            $('#butsave').on('click', function() {
                $("#butsave").attr("disabled", "enabled");
                var name = $('#name1').val();
                console.log(name);
                if(name!=""){
                    $.ajax({
                        url: "{{route('saveMenuCategory')}}",
                        type: "POST",
                        data: {
                            _token:"{{ csrf_token()}}",
                            name: name,
                        },
                        cache: false,
                        success: function() {
                            $('#alertMessage').html('<p>success message</p>');
                            setTimeout(function(){
                            location.reload();
                            }, 800);
                        }
                    });
                }
                else{
                    alert('Please fill all the field !');
                }
            });
        });
        </script>

        <script>
            $(document).ready(function(){
    $('#lfm1111').filemanager('image');
});
        </script>


@endsection
