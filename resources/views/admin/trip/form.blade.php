@extends('layouts.backend_layout.template')

<?php
use App\Models\Admin\Trip\TripGallery;
?>
@section('title', 'Admin || Trip-Form')

@section('backend-css')
    <style>
        .tripGallery {
            position: relative;
        }

        .galleryBtn {
            position: absolute;
            top: -9px;
            left: 8px;
        }
    </style>
@endsection

@section('backend-js')
    <script>
        const base_url = $("meta[name='base_url']").attr('content');
        $(document).on('click', '.delete-image', function(e) {
            e.preventDefault();
            let image_id = $(this).data('imageid');
            console.log(base_url);
            const elem = $(this);
            $.ajax({
                url: base_url + "/delete-galleryimage",
                type: "get",
                data: {
                    image_id: image_id
                },
                success: function(response) {
                    $(elem).parent().remove();
                }
            });
        });
    </script>

    {{-- ---------------------------------Cat------------------------ --}}
    <script>
        $('#category_id').change(function(e) {
            e.preventDefault();
            const cat_id = $(this).val();

            const sub_cat_id = {{ @$data->getParentCategory->getSubmainCategory->id ?? 0 }};
            console.log('Sub-Cat-Id:', sub_cat_id);

            $.ajax({
                url: "{{ route('show-sub-cat') }}",
                type: "get",
                data: {
                    cat_id: cat_id
                },
                success: function(response) {

                    if (typeof(response) != 'object') {
                        response = JSON.parse(response);
                    }
                    var child_html =
                        "<option value=''>----------------Select Any One--------------------</option>";
                    if (response.error) {
                        alert(response.error);
                    } else {
                        if (response.data.child.length > 0) {
                            $.each(response.data.child, function(index, value) {
                                child_html += "<option value='" + value.id + "'";

                                if (sub_cat_id == value.id) {
                                    child_html += 'selected';
                                }

                                child_html += ">" + value.name + "</option>";
                            });
                        }
                    }

                    $('#sub_category_id').html(child_html);
                }
            });
        });

        @isset($data)
            $('#category_id').change();
        @endisset
    </script>
    {{-- --------------------------------/cat------------------------------- --}}
@endsection


@section('main-content')

    <div class="pagetitle">
        <h1>Trip-Form</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('trip.index') }}">Trip List</a></li>
                <li class="breadcrumb-item active">Trip Form</li>
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
                        Trip
                    </h5>

                </div>

                <div>
                    @isset($data)
                        {{ Form::open(['url' => route('trip.update', @$data->id), 'files' => true]) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('trip.store'), 'files' => true]) }}
                    @endisset
                    <div class="row ">
                        {{-- <div class="col-md-12"> --}}
                        <div class="col-12 mb-2">
                            {{ Form::label('title', 'Title:', ['class' => 'form-label']) }}
                            {{ Form::text('title', @$data->title, ['class' => 'form-control  ' . ($errors->has('title') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Title Here.....', 'required' => true]) }}
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            {{ Form::label('slogan', 'Slogan:', ['class' => 'form-label']) }}
                            {{ Form::textarea('slogan', @$data->slogan, ['class' => 'form-control  ' . ($errors->has('slogan') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip slogan Here.....', 'required' => false, 'resize:none;', 'rows' => 3]) }}
                            @error('slogan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-12 mb-2">
                            {{ Form::label('tag_id','Trip Type:',['class'=>'form-label'])}}
                            {{ Form::select('tag_id',@$tags->pluck('name','id'),@$data->tag_id,['class'=>'form-control  '.($errors->has('tag_id') ?'is-invalid':''),'placeholder'=>'-------------------Select Trip Type-------------------','required'=>false])}}
                            @error('tag_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        {{-- {{ dd($data->getParentCategory)}} --}}
                        <div class="col-12 mb-2">
                            {{ Form::label('category_id', 'Trip Category:', ['class' => 'form-label']) }}
                            {{ Form::select('category_id', @$cats->pluck('name', 'id'), @$data->getParentCategory->getCategoryMain->id, ['class' => 'form-control  ' . ($errors->has('category_id') ? 'is-invalid' : ''), 'placeholder' => '-------------------Select Trip Type-------------------', 'required' => true]) }}
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            {{ Form::label('sub_category_id', 'Trip Category Sub:', ['class' => 'form-label']) }}
                            {{ Form::select('sub_category_id', [], @$data->getParentCategory->getSubmainCategory->id, ['class' => 'form-control  ' . ($errors->has('sub_category_id') ? 'is-invalid' : ''), 'placeholder' => '-------------------Select Trip Type-------------------', 'required' => true]) }}
                            @error('sub_category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <h5 class="card-title">Trip Options</h5>
                        </div>
                        <div class="col-12 mb-2">
                            {{ Form::label('currency', 'Currency:', ['class' => 'form-label']) }}
                            {{ Form::select('currency', ['$' => 'USD', 'NPR' => 'NPR'], @$data->currency ?? 'NPR', ['class' => 'form-control  ' . ($errors->has('currency') ? 'is-invalid' : ''), 'placeholder' => '-----Select Any One-----', 'required' => true]) }}
                            @error('currency')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            {{ Form::label('trip_cost', 'Trip Cost:', ['class' => 'form-label']) }}
                            {{ Form::number('trip_cost', @$data->trip_cost, ['class' => 'form-control  ' . ($errors->has('trip_cost') ? 'is-invalid' : ''), 'required' => false, 'min' => 0]) }}
                            @error('trip_cost')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            {{ Form::label('trip_duration', 'Trip Duration:', ['class' => 'form-label']) }}
                            {{ Form::number('trip_duration', @$data->trip_duration, ['class' => 'form-control  ' . ($errors->has('trip_duration') ? 'is-invalid' : ''), 'required' => true]) }}
                            @error('trip_duration')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            {{ Form::label('duration_details', 'Trip Duration Detail:', ['class' => 'form-label']) }}
                            {{ Form::text('duration_details', @$data->duration_details, ['class' => 'form-control  ' . ($errors->has('duration_details') ? 'is-invalid' : ''), 'required' => true]) }}
                            @error('duration_details')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4 mt-4">


                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" name="mega_special_trip" value="1"
                                    {{ @$data->mega_special_trip == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="mega_special_trip">
                                    Special Trip:
                                </label>
                                @error('display')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" name="home_page_slider" value="1"
                                    {{ @$data->home_page_slider == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="home_page_slider">
                                    Home Page Slider:
                                </label>
                                @error('display')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" name="classic_layout" value="1"
                                    {{ @$data->classic_layout == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="classic_layout">
                                    Classic Layout:
                                </label>
                                @error('display')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!--<div class="form-check">-->
                            <!--    <input class="form-check-input " type="checkbox" name="show_on_home_page" value="1" {{ @$data->show_on_home_page == 1 ? 'checked' : '' }}>-->
                            <!--    <label class="form-check-label" for="show_on_home_page">-->
                            <!--        Show on Homepage:-->
                            <!--    </label>-->
                            <!--    @error('display')
        -->
                                <!--        <span class="text-danger">{{ $message }}</span>-->
                                <!--
    @enderror-->
                            <!--</div>-->
                        </div>
                        <div class="col-12 mb-2">
                            {{ Form::label('summary', 'Summary:', ['class' => 'form-label fs-6']) }}
                            {{ Form::textarea('summary', @$data->summary, ['class' => 'form-control ' . ($errors->has('summary') ? 'is-invalid' : ''), 'placeholder' => 'Enter Product summary Here.....', 'required' => false, 'rows' => 3, 'style' => 'resize:none;']) }}
                            @error('summary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            {{ Form::label('description', 'Description:', ['class' => 'form-label fs-6']) }}
                            {{ Form::textarea('description', @$data->description, ['class' => 'form-control ' . ($errors->has('Description') ? 'is-invalid' : ''), 'placeholder' => 'Enter Product Description Here.....', 'required' => false, 'rows' => 5, 'style' => 'resize:none;']) }}
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            {{ Form::label('status', 'Trip Status:', ['class' => 'form-label']) }}
                            {{ Form::select('status', ['active' => 'Active', 'inactive' => 'In-Active'], @$data->status, ['class' => 'form-control  ' . ($errors->has('status') ? 'is-invalid' : ''), 'placeholder' => '-----Select Any One-----', 'required' => true]) }}
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12  mb-2">
                            {{ Form::label('banner_image', 'Trip Image:', ['class' => 'form-label']) }}
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="banner_image"
                                    value="{{ old('banner_image', @$data->banner_image) }}">
                            </div>
                            <img id="holder" style="margin-top:15px;max-height:100px;">

                            @error('banner_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            @isset($data)
                                <div class="col-md-4">
                                    <img src="{{ asset(@$data->banner_image) }}" alt="Img"
                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                </div>
                            @endisset
                        </div>

                        <div class="col-12  mb-2">
                            <div class="form-group">
                                <label for="notes">Trip Notes</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="notes" data-input="thumbnail9" data-preview="holder"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail9" class="form-control" type="text" name="notes"
                                        value="{{ old('notes', @$data->notes) }}">
                                </div>
                                <img id="holder" style="margin-top:15px;max-height:100px;">

                                @error('notes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @isset($data)
                                    <div class="col-md-4">
                                        <a href="{{ asset($data->notes) }}">View</a>
                                    </div>
                                @endisset
                            </div>
                        </div>


                        <div class="row py-5 ms-4">
                            <h5 class="card-title">
                                Trip Details
                            </h5>
                            {{-- --------------------Tab Bar-------------------- --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                        data-bs-target="#overview-tab-pane" type="button" role="tab"
                                        aria-controls="overview-tab-pane" aria-selected="true">Overview</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="itineary-tab" data-bs-toggle="tab"
                                        data-bs-target="#itineary-tab-pane" type="button" role="tab"
                                        aria-controls="itineary-tab-pane" aria-selected="false">Itineary</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="date-tab" data-bs-toggle="tab"
                                        data-bs-target="#date-tab-pane" type="button" role="tab"
                                        aria-controls="date-tab-pane" aria-selected="false">Dates</button>
                                </li>
                                <li>
                                    <button class="nav-link" id="train-tab" data-bs-toggle="tab"
                                        data-bs-target="#train-tab-pane" type="button" role="tab"
                                        aria-controls="train-tab-pane" aria-selected="false">Train</button>
                                </li>
                                {{-- <li>
                                    <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery-tab-pane" type="button" role="tab" aria-controls="gallery-tab-pane" aria-selected="false">Gallery</button>
                                </li> --}}
                                <li>
                                    <button class="nav-link" id="faq-tab" data-bs-toggle="tab"
                                        data-bs-target="#faq-tab-pane" type="button" role="tab"
                                        aria-controls="faq-tab-pane" aria-selected="false">Faq</button>
                                </li>
                                <li>
                                    <button class="nav-link" id="gear-tab" data-bs-toggle="tab"
                                        data-bs-target="#gear-tab-pane" type="button" role="tab"
                                        aria-controls="gear-tab-pane" aria-selected="false">Gear</button>
                                </li>
                                <li>
                                    <button class="nav-link" id="gallery-tab" data-bs-toggle="tab"
                                        data-bs-target="#gallery-tab-pane" type="button" role="tab"
                                        aria-controls="gear-tab-pane" aria-selected="false">Gallery</button>
                                </li>
                                <li>
                                    <button class="nav-link" id="tripinfo-tab" data-bs-toggle="tab"
                                        data-bs-target="#tripinfo-tab-pane" type="button" role="tab"
                                        aria-controls="gear-tab-pane" aria-selected="false">Trip Informations</button>
                                </li>

                                <li>
                                    <button class="nav-link" id="tripinfoextra-tab" data-bs-toggle="tab"
                                        data-bs-target="#tripinfoextra-tab-pane" type="button" role="tab"
                                        aria-controls="gear-tab-pane" aria-selected="false">Trip Extra</button>
                                </li>
                            </ul>
                            <div class="tab-content py-5" id="myTabContent">
                                {{-- ---------------------------------OverView-------------------------------- --}}
                                <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel"
                                    aria-labelledby="overview-tab" tabindex="0">
                                    <div class="row">

                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_image', 'Overview Banner Image:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail1" class="form-control" type="text"
                                                    name="overview_image"
                                                    value="{{ old('overview_image', @$overview->overview_image) }}">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('overview_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @isset($data)
                                                <div class="col-md-4">
                                                    <img src="{{ asset(@$overview->overview_image) }}" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            @endisset
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_slogan', 'Slogan:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('overview_slogan', @$overview->overview_slogan, ['class' => 'form-control  ' . ($errors->has('overview_slogan') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Slogan Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 3]) }}
                                            @error('overview_slogan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!--<div class="col-12 mb-4">-->
                                        <!--    {{ Form::label('overview_show_on', 'Show On:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}-->
                                        <!--    <input type="checkbox" name="overview_show_on" value="1" >-->

                                        <!--</div>-->


                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_trip_type_summary', 'Trip Type Summary:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('overview_trip_type_summary', @$overview->overview_trip_type_summary, ['class' => 'form-control  ' . ($errors->has('overview_trip_type_summary') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                            @error('overview_trip_type_summary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_trip_summary', 'Trip Summary:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('overview_trip_summary', @$overview->overview_trip_summary, ['class' => 'form-control  ' . ($errors->has('overview_trip_summary') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Slogan Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                            @error('overview_trip_summary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_description', 'Description:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('overview_description', @$overview->overview_description, ['class' => 'form-control  ' . ($errors->has('overview_description') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Slogan Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                            @error('overview_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-4">
                                            <div class="row">
                                                <div class="col-3">
                                                    {{ Form::label('overview_trip_code', 'Trip Code:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('overview_trip_code', @$overview->overview_trip_code, ['class' => 'form-control  ' . ($errors->has('overview_trip_code') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('overview_trip_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('overview_duration', 'Duration:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::number('overview_duration', @$overview->overview_duration, ['class' => 'form-control  ' . ($errors->has('overview_duration') ? 'is-invalid' : ''), 'placeholder' => 'Plz Duration In Number.....', 'required' => false, 'min' => 0]) }}
                                                    @error('overview_duration')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('overview_group_size', 'Group Size:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::number('overview_group_size', @$overview->overview_group_size, ['class' => 'form-control  ' . ($errors->has('overview_group_size') ? 'is-invalid' : ''), 'placeholder' => 'Plz Enter In Number.....', 'required' => false, 'min' => 0]) }}
                                                    @error('overview_group_size')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('overview_best_season', 'Best Season:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('overview_best_season', @$overview->overview_best_season, ['class' => 'form-control  ' . ($errors->has('overview_best_season') ? 'is-invalid' : ''), 'placeholder' => 'Enter Best Season Month.....', 'required' => false]) }}
                                                    @error('overview_best_season')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-4">
                                            <div class="row">
                                                <div class="col-3">
                                                    {{ Form::label('overview_level_start', 'Level Start:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::select('overview_level_start', ['easy' => 'Easy', 'medium' => 'Medium', 'strenuous' => 'Strenuous', 'hard' => 'Hard'], @$overview->overview_level_start, ['class' => 'form-control  ' . ($errors->has('overview_level_start') ? 'is-invalid' : ''), 'required' => true]) }}
                                                    @error('overview_level_start')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('overview_level_end', 'Level End:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::select('overview_level_end', ['medium' => 'Medium', 'strenuous' => 'Strenuous', 'hard' => 'Hard'], @$overview->overview_level_end, ['class' => 'form-control  ' . ($errors->has('overview_level_end') ? 'is-invalid' : ''), 'required' => true]) }}
                                                    @error('overview_level_end')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('overview_trek_day', 'Trek Days:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::number('overview_trek_day', @$overview->overview_trek_day, ['class' => 'form-control  ' . ($errors->has('overview_trek_day') ? 'is-invalid' : ''), 'placeholder' => 'Plz Enter In Number.....', 'required' => false, 'min' => 0]) }}
                                                    @error('overview_trek_day')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('overview_activities', 'Primary Activities:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('overview_activities', @$overview->overview_activities, ['class' => 'form-control  ' . ($errors->has('overview_activities') ? 'is-invalid' : ''), 'placeholder' => 'Activities Separate By Commas, .....', 'required' => false]) }}
                                                    @error('overview_activities')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-4">
                                            <div class="row">
                                                <div class="col-3">
                                                    {{ Form::label('overview_arrival_city', 'Arrival City:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('overview_arrival_city', @$overview->overview_arrival_city, ['class' => 'form-control  ' . ($errors->has('overview_arrival_city') ? 'is-invalid' : ''), 'placeholder' => 'Enter Arrival City Here......', 'required' => false]) }}
                                                    @error('overview_arrival_city')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('overview_departure_city', 'Departure City:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('overview_departure_city', @$overview->overview_departure_city, ['class' => 'form-control  ' . ($errors->has('overview_departure_city') ? 'is-invalid' : ''), 'placeholder' => 'Enter Departure City Here......', 'required' => false]) }}
                                                    @error('overview_departure_city')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_transportation', 'Transportation:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::text('overview_transportation', @$overview->overview_transportation, ['class' => 'form-control  ' . ($errors->has('overview_transportation') ? 'is-invalid' : ''), 'placeholder' => 'Transportation details, e.g; Motors Vehicle, Aircraft, Heli Charter.....', 'required' => false]) }}
                                            @error('overview_transportation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_trip_route', 'Trip Route:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('overview_trip_route', @$overview->overview_trip_route, ['class' => 'form-control  ' . ($errors->has('overview_trip_route') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Route Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                            @error('overview_trip_route')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_cost_includes', 'Cost Includes:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('overview_cost_includes', @$overview->overview_cost_includes, ['class' => 'form-control  ' . ($errors->has('overview_cost_includes') ? 'is-invalid' : ''), 'placeholder' => 'Enter Cost Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                            @error('overview_cost_includes')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_cost_excludes', 'Cost Excludes:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('overview_cost_excludes', @$overview->overview_cost_excludes, ['class' => 'form-control  ' . ($errors->has('overview_cost_excludes') ? 'is-invalid' : ''), 'placeholder' => 'Enter Cost Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                            @error('overview_cost_excludes')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_price_schedule', 'Overview Price Schedule:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('overview_price_schedule', @$overview->overview_price_schedule, ['class' => 'form-control  ' . ($errors->has('overview_price_schedule') ? 'is-invalid' : ''), 'required' => false, 'style' => 'resize:none;', 'rows' => 1]) }}
                                            @error('overview_price_schedule')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                {{-- ---------------------------------/OverView-------------------------------- --}}

                                {{-- ---------------------------------Iteneary-------------------------------- --}}
                                <div class="tab-pane fade" id="itineary-tab-pane" role="tabpanel"
                                    aria-labelledby="itineary-tab" tabindex="0">
                                    <div class="row" id="itineary">
                                        <div class="col-12 mb-4">
                                            {{ Form::label('itineary_map_lattitude', 'Map Lattitude:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::text('itineary_map_lattitude', @$iteneary[0]->itineary_map_lattitude, ['class' => 'form-control  ' . ($errors->has('itineary_map_lattitude') ? 'is-invalid' : ''), 'required' => false]) }}
                                            @error('itineary_map_lattitude')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('itineary_map_logitude', 'Map Longitude:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::text('itineary_map_logitude', @$iteneary[0]->itineary_map_logitude, ['class' => 'form-control  ' . ($errors->has('itineary_map_logitude') ? 'is-invalid' : ''), 'required' => false]) }}
                                            @error('itineary_map_logitude')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!--<div class="col-12 mb-4">-->
                                        <!--    {{ Form::label('itineary_show_on', 'Show On:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}-->
                                        <!--    <input type="checkbox" name="itineary_show_on" value="1">-->

                                        <!--</div>-->

                                        <div class="col-12 mb-4">
                                            {{ Form::label('overview_slogan', 'Slogan:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('overview_slogan', @$overview->overview_slogan, ['class' => 'form-control  ' . ($errors->has('overview_slogan') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Slogan Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 3]) }}
                                            @error('overview_slogan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-4">
                                            <div class="form-group">
                                                <label for="itslogan"> Title </label>
                                                <input type="text" class="form-control" name="itslogan"
                                                    value="{{ old('itslogan', @$iteneary[0]->itslogan) }}">
                                                @error('itslogan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if (isset($iteneary))
                                            @foreach ($iteneary as $key => $it_data)
                                                <script>
                                                    var id = {{ $key }};
                                                </script>

                                                <div class="col-12 mb-4">
                                                    {{ Form::label('itineary_heading', 'Heading:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('itineary_heading[]', @$it_data->itineary_heading, ['class' => 'form-control  ' . ($errors->has('itineary_heading') ? 'is-invalid' : ''), 'placeholder' => 'Enter Itineary Day Here.....', 'required' => false]) }}
                                                    @error('itineary_heading')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-4">

                                                    <div class="form-group">
                                                        <label for="itineary_description">Description</label>
                                                        <textarea name="itineary_description[]" id="description{{ @$key }}" rows="5" class="form-control">{{ @$it_data->itineary_description }}</textarea>
                                                    </div>
                                                    @error('itineary_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('description' + id, {
                                                        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                        filebrowserUploadMethod: 'form'
                                                    });
                                                </script>
                                            @endforeach
                                        @else
                                            <div class="col-12 mb-4">
                                                {{ Form::label('itineary_heading', 'Heading:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                {{ Form::text('itineary_heading[]', @$iteneary->itineary_heading, ['class' => 'form-control  ' . ($errors->has('itineary_heading') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Slogan Here.....', 'required' => false]) }}
                                                @error('itineary_heading')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12 mb-4">
                                                {{ Form::label('itineary_description', 'Description:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                {{ Form::textarea('itineary_description[]', @$iteneary->itineary_description, ['class' => 'form-control  ' . ($errors->has('itineary_description') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Slogan Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                @error('itineary_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <a href="javascript:;" onclick="addIteneary()"
                                                class="btn btn-sm btn-primary">
                                                Add Row
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{-- ---------------------------------/Iteneary-------------------------------- --}}

                                {{-- ---------------------------------Dates-------------------------------- --}}
                                <div class="tab-pane fade" id="date-tab-pane" role="tabpanel" aria-labelledby="date-tab"
                                    tabindex="0">
                                    <div class="row">

                                        <div class="col-12 mb-4">
                                            {{ Form::label('date_banner_image', 'Dates Banner Image:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm2" data-input="thumbnail2" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail2" class="form-control" type="text"
                                                    name="date_banner_image"
                                                    value="{{ old('date_banner_image', @$date->date_banner_image) }}">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('date_banner_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @isset($data)
                                                <div class="col-md-4">
                                                    <img src="{{ asset(@$date->date_banner_image) }}" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            @endisset
                                        </div>
                                        <!-- <div class="col-12 mb-4">-->
                                        <!--    {{ Form::label('date_show_on', 'Show On:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}-->
                                        <!--    <input type="checkbox" name="date_show_on" value="1">-->

                                        <!--</div>-->

                                        <div class="col-12 mb-4">
                                            {{ Form::label('private_dates', 'PRIVATE DATES:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('private_dates', @$date->private_dates, ['class' => 'form-control  ' . ($errors->has('private_dates') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Slogan Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 3]) }}
                                            @error('private_dates')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('tailor_made', 'TAILOR MADE:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('tailor_made', @$date->tailor_made, ['class' => 'form-control  ' . ($errors->has('tailor_made') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Slogan Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 3]) }}
                                            @error('tailor_made')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="col-12 mb-4">
                                                {{ Form::label('date_description','Description:',['class'=>'form-label','style'=>'font-weight:bold'])}}
                                                {{ Form::textarea('date_description',@$date->date_description,['class'=>'form-control  '.($errors->has('date_description') ?'is-invalid':''),'placeholder'=>'Enter OverView Slogan Here.....','required'=>false,'style'=>'resize:none','rows'=>3])}}
                                                @error('date_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="col-12 mb-4">
                                                <h5 class="card-title">
                                                    Fixed Trip Dates
                                                </h5>
                                            </div>

                                            <div class="col-12">
                                                <table class="table text-center">
                                                    <thead>
                                                        <div class="col-2">
                                                            <th>#</th>
                                                        </div>
                                                        <div class="col-2">
                                                            <th>Trip Start</th>
                                                        </div>
                                                        <div class="col-2">
                                                            <th>Trip Status</th>
                                                        </div>
                                                        <div class="col-2">
                                                            <th>Cost</th>
                                                        </div>
                                                        <div class="col-2">
                                                            <th>Upon Request</th>
                                                        </div>
                                                    </thead>
                                                    <tbody id="datefield">

                                                            @isset($date_detail)
                                                                @foreach ($date_detail as $key => $date)

                                                                <tr>
                                                                    <div class="row">
                                                                        <div class="col-1">
                                                                            <td>1</td>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <td>
                                                                                {{ Form::date("date_start[]",@$date->date_start,["class"=>"form-control"])}}
                                                                            </td>
                                                                        </div><div class="col-2">
                                                                            <td>
                                                                                {{ Form::select("date_trip_status[]",["available"=>"Available","booked"=>"Booked","guaranteed"=>"Guaranteed"],@$date->date_trip_status,["class"=>"form-control"])}}
                                                                            </td>
                                                                        </div><div class="col-2">
                                                                            <td>
                                                                                {{ Form::number("date_cost[]",@$date->date_cost,["class"=>"form-control  ".($errors->has("date_cost") ?"is-invalid":""),"min"=>0])}}
                                                                                @error('date_cost')
                                                                                    <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </td>
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <td>
                                                                                <input type="checkbox" id="vehicle1" name="date_request{{$key}}" value="1" {{ (@$date->date_request==1)?'checked':''}}>
                                                                            </td>
                                                                        </div>
                                                                    </div>
                                                                </tr>
                                                                @endforeach
                                                            @else
                                                            <tr>
                                                                <div class="row">
                                                                    <div class="col-1">
                                                                        <td>1</td>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <td>
                                                                            {{ Form::date("date_start[]","",["class"=>"form-control"])}}
                                                                        </td>
                                                                    </div><div class="col-2">
                                                                        <td>
                                                                            {{ Form::select("date_trip_status[]",["available"=>"Available","booked"=>"Booked","guaranteed"=>"Guaranteed"],"",["class"=>"form-control"])}}
                                                                        </td>
                                                                    </div><div class="col-2">
                                                                        <td>
                                                                            {{ Form::number("date_cost[]","",["class"=>"form-control  ".($errors->has("date_cost") ?"is-invalid":""),"min"=>0])}}
                                                                            @error('date_cost')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </td>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <td>
                                                                            <input type="checkbox" id="vehicle1" name="date_request0" value="1">
                                                                        </td>
                                                                    </div>
                                                                </div>
                                                            </tr>
                                                            @endisset




                                                    </tbody>
                                                </table>

                                                <script>

                                                    let num2=1;
                                                    @if (isset($date_detail))
                                                    num2={{$key}} + 1;
                                                    @else
                                                    num2=1;
                                                    @endif

                                                    let sum=1;

                                                </script>
                                                <div class="col-12">
                                                    <a href="javascript:;" onclick="addMore()" class="btn btn-sm btn-primary" style="float:right">
                                                        <i class="bi bi-plus"></i> Add Row
                                                    </a>
                                                </div>
                                            </div> --}}
                                    </div>
                                </div>


                                {{-- ---------------------------------/Dates-------------------------------- --}}

                                {{-- ---------------------------------train-------------------------------- --}}
                                <div class="tab-pane fade" id="train-tab-pane" role="tabpanel"
                                    aria-labelledby="train-tab" tabindex="0">
                                    <div class="row">

                                        <div class="col-12 mb-4">
                                            {{ Form::label('train_banner_image', 'Train Yourself Banner Image:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm3" data-input="thumbnail3" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail3" class="form-control" type="text"
                                                    name="train_banner_image"
                                                    value="{{ old('train_banner_image', @$train->train_banner_image) }}">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('train_banner_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @isset($data)
                                                <div class="col-md-4">
                                                    <img src="{{ asset(@$train->train_banner_image) }}" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            @endisset
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('train_description', 'Description:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            {{ Form::textarea('train_description', @$train->train_description, ['class' => 'form-control  ' . ($errors->has('train_description') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Slogan Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 3]) }}
                                            @error('train_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- ---------------------------------/train-------------------------------- --}}

                                {{-- ---------------------------------Gallery-------------------------------- --}}
                                <div class="tab-pane fade" id="gallery-tab-pane" role="tabpanel"
                                    aria-labelledby="gallery-tab" tabindex="0">
                                    <div class="row">
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                            aria-labelledby="home-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    {{ Form::label('gallery_image', 'Select Gallery Image:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    <br>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a id="lfm6" data-input="thumbnail8"
                                                                data-preview="holder" class="btn btn-primary">
                                                                <i class="fa fa-picture-o"></i> Choose
                                                            </a>
                                                        </span>
                                                        <input id="thumbnail8" class="form-control" type="text"
                                                            name="gallery_image" value="{{ @$gallery_test }}">
                                                    </div>
                                                    <img id="holder" style="margin-top:15px;max-height:100px;">
                                                    @error('gallery_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if (@$image_value[0])

                                                <div class="row mb-5">
                                                    @foreach ($image_value as $key => $image)
                                                        <?php
                                                        $image_id = TripGallery::where('gallery_image', $image)->first();
                                                        ?>
                                                        <div class="col-md-3 mb-3">
                                                            <img src="{{ asset(@$image) }}" alt=""
                                                                class="img img-fluid img-thumbnail tripGallery">
                                                            <a href="javascript:;"
                                                                class="btn btn-sm btn-danger galleryBtn delete-image"
                                                                data-imageid="{{ @$image_id->id }}"
                                                                style="border-radius:50%">
                                                                <i class="bi bi-trash"></i>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- ---------------------------------/Gallery-------------------------------- --}}

                                {{-- ---------------------------------Trip Information-------------------------------- --}}
                                <div class="tab-pane fade" id="tripinfo-tab-pane" role="tabpanel"
                                    aria-labelledby="tripinfo-tab" tabindex="0">
                                    <div class="row">
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                            aria-labelledby="home-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-3">
                                                    {{ Form::label('trip_style', 'Trip Style:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('trip_style', @$data->trip_style, ['class' => 'form-control  ' . ($errors->has('trip_style') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('trip_style')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('trip_duration1', 'Trip Duration:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('trip_duration1', @$data->trip_duration1, ['class' => 'form-control  ' . ($errors->has('trip_duration1') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('trip_duration1')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('accomodation', 'Accomodation:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('accomodation', @$data->accomodation, ['class' => 'form-control  ' . ($errors->has('accomodation') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('accomodation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('trip_outline', 'Trip Outline:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('trip_outline', @$data->trip_outline, ['class' => 'form-control  ' . ($errors->has('trip_outline') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('trip_outline')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('package', 'Package:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('package', @$data->package, ['class' => 'form-control  ' . ($errors->has('package') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('package')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('note', 'Note:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('note', @$data->note, ['class' => 'form-control  ' . ($errors->has('note') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('note')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('destination', 'Destination:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('destination', @$data->destination, ['class' => 'form-control  ' . ($errors->has('destination') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('destination')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('hotel_category', 'Hotel Category:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('hotel_category', @$data->hotel_category, ['class' => 'form-control  ' . ($errors->has('hotel_category') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('hotel_category')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('max_altitude', 'Max Altitude:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('max_altitude', @$data->max_altitude, ['class' => 'form-control  ' . ($errors->has('max_altitude') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('max_altitude')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('min_pax', 'Min Pax:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('min_pax', @$data->min_pax, ['class' => 'form-control  ' . ($errors->has('min_pax') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('min_pax')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('travel_mode', 'Travel Mode:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('travel_mode', @$data->travel_mode, ['class' => 'form-control  ' . ($errors->has('travel_mode') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('travel_mode')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('trek_type', 'Trek Type:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('trek_type', @$data->trek_type, ['class' => 'form-control  ' . ($errors->has('trek_type') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('trek_type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('highest_altitude', 'Highest Altitude:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('highest_altitude', @$data->highest_altitude, ['class' => 'form-control  ' . ($errors->has('highest_altitude') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('highest_altitude')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('trip_type', 'Trip Type:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('trip_type', @$data->trip_type, ['class' => 'form-control  ' . ($errors->has('trip_type') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('trip_type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('grade', 'Grade:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('grade', @$data->grade, ['class' => 'form-control  ' . ($errors->has('grade') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('grade')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('meals', 'Meals:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('meals', @$data->meals, ['class' => 'form-control  ' . ($errors->has('meals') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('meals')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    {{ Form::label('total_trip', 'Total Trip:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('total_trip', @$data->total_trip, ['class' => 'form-control  ' . ($errors->has('total_trip') ? 'is-invalid' : ''), 'placeholder' => 'Enter Trip Code Here.....', 'required' => false]) }}
                                                    @error('total_trip')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- ---------------------------------/Trip Information-------------------------------- --}}

                                {{-- ---------------------------------Trip Extra Data-------------------------------- --}}
                                <div class="tab-pane fade" id="tripinfoextra-tab-pane" role="tabpanel"
                                    aria-labelledby="tripinfoextra-tab" tabindex="0">
                                    <div class="row">
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                            aria-labelledby="home-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    {{ Form::label('sightseeing_places', 'Sightseeing places:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::textarea('sightseeing_places', @$tripData->sightseeing_places, ['class' => 'form-control  ' . ($errors->has('sightseeing_places') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                    @error('sightseeing_places')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-4">
                                                    {{ Form::label('best_time', 'Best Time To Visit:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::textarea('best_time', @$tripData->best_time, ['class' => 'form-control  ' . ($errors->has('best_time') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                    @error('best_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-4">
                                                    {{ Form::label('trip_info', 'Trip Information:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::textarea('trip_info', @$tripData->trip_info, ['class' => 'form-control  ' . ($errors->has('trip_info') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                    @error('trip_info')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-4">
                                                    {{ Form::label('imp_note', 'Important Note:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::textarea('imp_note', @$tripData->imp_note, ['class' => 'form-control  ' . ($errors->has('imp_note') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                    @error('imp_note')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-4">
                                                    {{ Form::label('travel_date', 'Travel Date:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::textarea('travel_date', @$tripData->travel_date, ['class' => 'form-control  ' . ($errors->has('travel_date') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                    @error('travel_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-4">
                                                    {{ Form::label('min_travel', 'Minimum travelling 5pax together:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::textarea('min_travel', @$tripData->min_travel, ['class' => 'form-control  ' . ($errors->has('min_travel') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                    @error('min_travel')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-4">
                                                    {{ Form::label('trip_safety', 'Trip safety:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::textarea('trip_safety', @$tripData->trip_safety, ['class' => 'form-control  ' . ($errors->has('trip_safety') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                    @error('trip_safety')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-4">
                                                    {{ Form::label('useful_tip', 'Useful Tips:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::textarea('useful_tip', @$tripData->useful_tip, ['class' => 'form-control  ' . ($errors->has('useful_tip') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                    @error('useful_tip')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-4">
                                                    {{ Form::label('hike_trip', 'Hike trip:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::textarea('hike_trip', @$tripData->hike_trip, ['class' => 'form-control  ' . ($errors->has('hike_trip') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                    @error('hike_trip')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-4">
                                                    {{ Form::label('optional_tour', 'Optional tour:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::textarea('optional_tour', @$tripData->optional_tour, ['class' => 'form-control  ' . ($errors->has('optional_tour') ? 'is-invalid' : ''), 'placeholder' => 'Enter OverView Trip Here.....', 'required' => false, 'style' => 'resize:none', 'rows' => 5]) }}
                                                    @error('optional_tour')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- ---------------------------------/Trip Extra Data-------------------------------- --}


                                {{-- ---------------------------------Faq-------------------------------- --}}
                                <div class="tab-pane fade" id="faq-tab-pane" role="tabpanel" aria-labelledby="faq-tab"
                                    tabindex="0">
                                    <div class="row">
                                        <div id="faq">
                                            <div class="col-12 mb-4">
                                                {{ Form::label('faq_banner_image', 'Faq Banner Image:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <a id="lfm4" data-input="thumbnail4" data-preview="holder"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-picture-o"></i> Choose
                                                        </a>
                                                    </span>
                                                    <input id="thumbnail4" class="form-control" type="text"
                                                        name="faq_banner_image"
                                                        value="{{ old('faq_banner_image', @$faq_image->faq_banner_image) }}">
                                                </div>
                                                <img id="holder" style="margin-top:15px;max-height:100px;">

                                                @error('faq_banner_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                @isset($data)
                                                    <div class="col-md-4">
                                                        <img src="{{ asset(@$faq_image->faq_banner_image) }}" alt="Img"
                                                            class="img img-fluid img-thumbnail"
                                                            style="width:100px; height:auto;">
                                                    </div>
                                                @endisset
                                            </div>

                                            <!--<div class="col-12 mb-4">-->
                                            <!--{{ Form::label('faq_show_on', 'Show On:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}-->
                                            <!--<input type="checkbox" name="faq_show_on" value="1">-->

                                            <!--</div>-->

                                            @isset($faq)
                                                @foreach ($faq as $faq_key => $data)
                                                    <script>
                                                        var id = {{ $faq_key }};
                                                    </script>
                                                    <div class="col-12 mb-4">
                                                        {{ Form::label('faq_question', 'Question:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                        {{ Form::text('faq_question[]', @$data->faq_question, ['class' => 'form-control  ' . ($errors->has('faq_question') ? 'is-invalid' : ''), 'required' => false]) }}
                                                        @error('faq_question')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 mb-4">
                                                        {{ Form::label('faq_answer', 'Answer:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                        {{-- {{ Form::textarea("faq_answer[]",@$data->faq_answer,["class"=>"form-control  ".($errors->has("faq_answer") ?"is-invalid":""),"required"=>false,"style"=>"resize:none","rows"=>5])}} --}}
                                                        <textarea name="faq_answer[]" id="description{{ $faq_key }}" rows="5" class="form-control"> {{ @$data->faq_answer }}</textarea>
                                                        @error('faq_answer')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
                                                    <script type="text/javascript">
                                                        CKEDITOR.replace('description' + id, {
                                                            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                            filebrowserUploadMethod: 'form'
                                                        });
                                                    </script>
                                                @endforeach
                                            @else
                                                <div class="col-12 mb-4">
                                                    {{ Form::label('faq_question', 'Question:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{ Form::text('faq_question[]', '', ['class' => 'form-control  ' . ($errors->has('faq_question') ? 'is-invalid' : ''), 'required' => false]) }}
                                                    @error('faq_question')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-4">
                                                    {{ Form::label('faq_answer', 'Answer:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                                    {{-- {{ Form::textarea("faq_answer[]",'',["class"=>"form-control  ".($errors->has("faq_answer") ?"is-invalid":""),"required"=>false,"style"=>"resize:none","rows"=>5])}} --}}
                                                    <textarea name="faq_answer[]" id="description" rows="5" class="form-control"> </textarea>
                                                    @error('faq_answer')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endisset
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <a href="javascript:;" onclick="addFaq()" class="btn btn-sm btn-primary">
                                                Add Row
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{-- ---------------------------------/Faq-------------------------------- --}}

                                {{-- ---------------------------------Gear-------------------------------- --}}
                                <div class="tab-pane fade" id="gear-tab-pane" role="tabpanel" aria-labelledby="gear-tab"
                                    tabindex="0">
                                    <div class="row">

                                        <div class="col-12 mb-4">

                                            <div class="form-group">
                                                <label for="gear_title"> <strong> Title </strong></label>
                                                <input type="text" name="gear_title" id="gear_title"
                                                    class="form-control"
                                                    value="{{ old('gear_title', @$gear->gear_title) }}">
                                                @error('gear_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!--<div class="col-12 mb-4">-->
                                            <!--{{ Form::label('gear_show_on', 'Show On:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}-->
                                            <!--<input type="checkbox" name="gear_show_on" value="1">-->

                                            <!--</div>-->

                                            <div class="form-group">
                                                <label for="gear_subtitle"><strong>Sub Title</strong></label>
                                                <input name="gear_subtitle" type="text" class="form-control"
                                                    id="gear_subtitle"
                                                    value="{{ old('gear_subtitle', @$gear->gear_subtitle) }}">
                                                @error('gear_subtitle')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="gear_button_tex"><strong>Gear Button Text</strong></label>
                                                <input type="text" name="gear_button_text" id="gear_button_text"
                                                    class="form-control"
                                                    value="{{ old('gear_button_text', @$gear->gear_button_text) }}">
                                                @error('gear_button_text')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="gear_detail_text"><strong>List View Text</strong></label>
                                                <input type="text" name="gear_detail_text" id="gear_detail_text"
                                                    class="form-control"
                                                    value="{{ old('gear_detail_text', @$gear->gear_detail_text) }}">
                                                @error('gear_detail_text')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="gear_pdf_file"><strong> Download Pdf File:</strong></label>
                                                <br>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <a id="lfm13" data-input="thumbnail14" data-preview="holder"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-picture-o"></i> Choose
                                                        </a>
                                                    </span>
                                                    <input id="thumbnail14" class="form-control" type="text"
                                                        name="gear_pdf_file"
                                                        value="{{ old('gear_pdf_file', @$gear->gear_pdf_file) }}">
                                                </div>
                                                <img id="holder" style="margin-top:15px;max-height:100px;">

                                                @error('gear_pdf_file')
                                                    <span class="text-danger">{{ $message }} </span>
                                                @enderror

                                            </div>

                                            {{ Form::label('gear_banner_image', 'Gear Design Image:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm5" data-input="thumbnail5" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail5" class="form-control" type="text"
                                                    name="gear_banner_image"
                                                    value="{{ old('gear_banner_image', @$gear->gear_banner_image) }}">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('gear_banner_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @isset($data)
                                                <div class="col-md-4">
                                                    <img src="{{ asset(@$gear->gear_banner_image) }}" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            @endisset
                                        </div>

                                        <div class="form-group">
                                            <label for="new_banner_imaege"> <strong> Gear Banner Image </strong> </label>
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm55" data-input="thumbnail4234" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail4234" class="form-control" type="text"
                                                    name="new_banner_image"
                                                    value="{{ old('new_banner_image', @$gear->new_banner_image) }}"
                                                    requirde>
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('new_banner_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @isset($data)
                                                <div class="col-md-4">
                                                    <img src="{{ asset(@$gear->new_banner_image) }}" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            @endisset
                                        </div>

                                        <div class="col-12 mb-4">
                                            {{ Form::label('gear_description', 'Description:', ['class' => 'form-label', 'style' => 'font-weight:bold']) }}
                                            <textarea name="gear_description" rows="5" class="form-control" id="summernote123">{{ old('gear_description', @$gear->gear_description) }}</textarea>
                                            {{-- <textarea name="gear_description" id="summernote" rows="5" class="form-copntrol"> {{old('gear_desscription', @$gear->gear_description)}}</textarea> --}}
                                            {{-- {{ Form::textarea('gear_description',@$gear->gear_description,['class'=>'form-control  '.($errors->has('gear_description') ?'is-invalid':''),'placeholder'=>'Enter OverView Slogan Here.....','required'=>false,'style'=>'resize:none','rows'=>3])}} --}}
                                            @error('gear_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <textarea name="" id="" rows="5" class="form-control" id="summernote123"></textarea> --}}

                                    </div>
                                </div>
                                {{-- ---------------------------------/Gear-------------------------------- --}}
                            </div>
                            {{-- ------------------------/Tab Bar-------------------------- --}}
                        </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>


        <div class="card col-md-3" style="box-shadow: 0px 0px 5px grey;margin-left:50px;height:600px">
            <div class="card-body">
                <div>
                    <h5 class="card-title">
                        Meta
                    </h5>

                </div>

                <div>
                    <div class="col-12 mb-2">
                        {{ Form::label('meta_titles', 'Meta Titles:', ['class' => 'form-label']) }}
                        {{ Form::textarea('meta_titles', @$data->meta_titles, ['class' => 'form-control  ' . ($errors->has('meta_titles') ? 'is-invalid' : ''), 'placeholder' => 'Enter Meta Title Here.....', 'style' => 'resize:none', 'rows' => 3, 'required' => false]) }}
                        @error('meta_titles')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="col-12 mb-2">
                        {{ Form::label('meta_keywords', 'meta Keywords:', ['class' => 'form-label']) }}
                        {{ Form::textarea('meta_keywords', @$data->meta_keywords, ['class' => 'form-control  ' . ($errors->has('meta_keywords') ? 'is-invalid' : ''), 'placeholder' => 'Enter Meta Keywords Here.....', 'style' => 'resize:none', 'rows' => 3, 'required' => false]) }}
                        @error('meta_keywords')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="col-12 mb-2">
                        {{ Form::label('meta_descriptions', 'Meta Descriptions:', ['class' => 'form-label']) }}
                        {{ Form::textarea('meta_descriptions', @$data->meta_descriptions, ['class' => 'form-control  ' . ($errors->has('meta_descriptions') ? 'is-invalid' : ''), 'placeholder' => 'Enter Meta Descriptions Here.....', 'style' => 'resize:none', 'rows' => 5, 'required' => false]) }}
                        @error('meta_descriptions')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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


    @if (isset($iteneary))
        <script>
            var num = {{ @$key + 1 }};
        </script>
    @else
        <script>
            var num = 0;
        </script>
    @endif

    @if (isset($faq))
        <script>
            var faq = {{ @$faq_key + 1 }}
        </script>
    @else
        <script>
            var faq = 0;
        </script>
    @endif


    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}',
        };
    </script>


    <script>
        function addIteneary() {
            $('#itineary').append(
                '<div class="col-12 mb-2"><div class="form-group"><label for="question">Heading :</label><input type="text" name="itineary_heading[]" id="question" class="form-control"></div></div><div class="col-12 mb-2"><div class="form-group"><label for="answer">Description</label><textarea name="itineary_description[]" id="description' +
                num + '" rows="4" class="description form-control"> </textarea></div></div>');
            CKEDITOR.replace('description' + num, options);
            num++;
        }
        // <a href="javascript:;" onclick="removeIteneary()" class="btn btn-sm btn-dabger"> remove row </a>

        // function removeIteneary() {
        //     alert(num);
        //     $('.description').remove();
        // }

        function addMore() {
            sum++;
            $('#datefield').append('<tr><div class="row"><div class="col-1"><td>' + sum +
                '</td></div><div class="col-2"><td>{{ Form::date('date_start[]', '', ['class' => 'form-control']) }}</td></div><div class="col-2"><td>{{ Form::select('date_trip_status[]', ['available' => 'Available', 'booked' => 'Booked', 'guaranteed' => 'Guaranteed'], '', ['class' => 'form-control']) }}</td></div><div class="col-2"><td>{{ Form::number('date_cost[]', '', ['class' => 'form-control  ' . ($errors->has('date_cost') ? 'is-invalid' : ''), 'min' => 0]) }}@error('date_cost')<span class="text-danger">{{ $message }}</span>@enderror</td></div><div class="col-5"><td><input type="checkbox" id="vehicle1" name="date_request' +
                num2++ + '" value="1"></td></div></div></tr>');
        }

        function addFaq() {
            $('#faq').append(
                '<div class="col-12 mb-2"><div class="form-group"><label for="faq_question">Question:</label><input type="text" name="faq_question[]" id="question" class="form-control"></div></div><div class="col-12 mb-2"><div class="form-group"><label for="faq_answer">Answer :</label><textarea name="faq_answer[]" id="description' +
                faq + '" rows="4" class="description form-control"> </textarea></div></div>');
            CKEDITOR.replace('description' + faq, options);
            faq++;
        }
    </script>



    <script src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        CKEDITOR.replace('description', options);

        CKEDITOR.replace('overview_trip_type_summary', options);


        CKEDITOR.replace('overview_trip_summary', options);


        CKEDITOR.replace('overview_description', options);


        CKEDITOR.replace('overview_trip_route', options);

        CKEDITOR.replace('overview_cost_includes', options);


        CKEDITOR.replace('overview_cost_excludes', options);


        CKEDITOR.replace('date_description', options);


        CKEDITOR.replace('train_description', options);

        CKEDITOR.replace('summary', options);
        // CKEDITOR.replace('gear_description', options);

        CKEDITOR.replace('itineary_description[]', options);


        CKEDITOR.replace('faq_answer[]', options);
        CKEDITOR.replace('sightseeing_places', options);
        CKEDITOR.replace('best_time', options);
        CKEDITOR.replace('trip_info', options);
        CKEDITOR.replace('imp_note', options);
        CKEDITOR.replace('travel_date', options);
        CKEDITOR.replace('min_travel', options);
        CKEDITOR.replace('trip_safety', options);
        CKEDITOR.replace('useful_tip', options);
        CKEDITOR.replace('hike_trip', options);
        CKEDITOR.replace('optional_tour', options);
    </script>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#lfm').filemanager('image');
            $('#lfm1').filemanager('image');
            $('#lfm2').filemanager('image');
            $('#lfm3').filemanager('image');
            $('#lfm4').filemanager('image');
            $('#lfm5').filemanager('image');
            $('#lfm55').filemanager('image');

            $('#notes').filemanager('file');
            $('#lfm6').filemanager('image');
            $('#lfm13').filemanager('file');
        });
    </script>
@endpush
