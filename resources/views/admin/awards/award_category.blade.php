@extends('layouts.backend_layout.template')


@isset($data)
@section('title','Admin || Update Categories')
@else
@section('title','Admin || Team Categories')
@endisset
@section('backend-css')
  <style>
  .drop-hover:hover{
    color: black !important;
  }
  </style>


@endsection

@section('main-content')


<div class="pagetitle">
    <h1>
        @isset($data)
{{-- @dd($data) --}}
        Update "{{ ucfirst($data->name) }}" Categories
        @else
        Awards Categories
        @endisset
    </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Awards Categories List</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
        <div class="col-lg-{{ (@$data==true) ?'12':'5'}}" >
            <div class="card" style="box-shadow:0px 0px 5px grey">
                <div class="card-body">
                    <h5 class="card-title text-center" style="float">
                        @isset($data)
                        Update Category
                        @else
                        Add New Category
                        @endisset
                    </h5>
                </div>

                <div class="row ml-2 mr-2">
                    @isset($data)
                    {{ Form::open(['url'=>route('awardscategory.update',$data->id)])}}
                    @method('put')
                    @else
                    {{ Form::open(['url'=>route('awardscategory.store')])}}
                    @endisset
                    <div class="col-12 mb-2">
                        {{ Form::label('name','Name:',['class'=>'form-label'])}}
                        {{ Form::text('name',@$data->name,['class'=>'form-control  '.($errors->has('name') ?'is-invalid':''),'placeholder'=>'Category Name.....','required'=>true])}}
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-2">
                        {{ Form::label('parent_id','Parent Category:',['class'=>'form-label'])}}


                        <select name="parent_id" id="" class="form-control">
                            <option value="" >-----------------Select If Any------------------</option>

                            @foreach($parent_cat as $parent)
                                <option value="{{ $parent->id }}" >{{ $parent->name}}</option>
                                   @if($parent->getSub && $parent->getSub->count() >0)
                                        @foreach($parent->getSub as $sub)

                                            <option value="{{ $sub->id}}" >&nbsp;&nbsp;&nbsp;&nbsp;{{ $sub->name}}</option>

                                        @endforeach
                                   @endif
                            @endforeach

                        </select>
                        {{-- {{ Form::select('parent_id',@$parent_cat->pluck('name','id'),@$data->parent_id,['class'=>'form-control  '.($errors->has('parent_id') ?'is-invalid':''),'placeholder'=>'-----------Select Category----------','required'=>false])}} --}}


                        @error('parent_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-2">
                        {{ Form::label('description','Description:',['class'=>'form-label'])}}
                        {{ Form::textArea('description',@$data->description,['class'=>'form-control  '.($errors->has('description') ?'is-invalid':''),'placeholder'=>'Description.....','required'=>false,'rows'=>'5','style'=>'resize:none;'])}}
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="text-center mb-2">
                    {{ Form::button('<i class="bi bi-x"></i> Reset',['class'=>'btn btn-sm btn-danger','type'=>'reset'])}}
                    @isset($data)
                    {{ Form::button('<i class="bi bi-send"></i> Update',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
                    @else
                    {{ Form::button('<i class="bi bi-send"></i> Add',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
                    @endisset
                </div>
                {{ Form::close()}}
            </div>
        </div>
        @isset($data)
        @else
        <div class="col-lg-7" >

            <div class="card" style="box-shadow:0px 0px 5px grey">
              <div class="card-body">
                <h5 class="card-title" style="float">Awards Categories List</h5>

                <p>All Awrds Categories Listed Here.....</p>

                <div>
                  {{-- -------------------Status Drop Down----------------- --}}
                  <!-- Example single danger button -->
                    {{-- <div class="btn-group" style="float:left">
                      <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Status
                      </button>
                      <ul class="dropdown-menu bg-success ">
                        <li><a class="dropdown-item text-white drop-hover" href=""><i class="bi bi-check-circle me-1"></i> Active</a></li>
                        <li><a class="dropdown-item text-white drop-hover" href=""><i class="bi bi-exclamation-octagon me-1"></i> In-Active</a></li>
                        <li><a class="dropdown-item text-white drop-hover" href=""><i class="bi bi-collection-fill me-1"></i> All</a></li>
                      </ul>
                    </div> --}}
                  {{-- -------------------Status Drop Down----------------- --}}

                  {{-- -------------------Action Drop Down----------------- --}}
                  <!-- Example single danger button -->
                  <div class="btn-group " style="float:right;margin-right:10px;">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Action
                    </button>
                    <ul class="dropdown-menu bg-danger ">

                      {{-- <li>
                        <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-product" data-multiple_action="active">
                          <i class="bi bi-check-circle me-1"></i>
                            Active
                        </a>
                      </li>
                      <li>
                          <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-product" data-multiple_action="inactive">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                              Inactive
                          </a>
                      </li> --}}
                      <li>
                          <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-awards-category" data-multiple_action="delete">
                            <i class="bi bi-trash"></i>
                              Delete
                          </a>
                      </li>
                    </ul>
                  </div>
                  {{-- -------------------Action Drop Down----------------- --}}
                </div>
                <!-- Table with stripped rows -->
                <form  action="{{route('to-awardscat-cat')}}" method="post" id="full-form">
                  <input type="text" hidden name="multiple_action" id="multiple_action">
                  @csrf
                <table class="table ">

                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Category Of</th>
                      <th scope="col">Slug</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Action</th>
                      <th>
                        <input type="checkbox" name="selectall" id="selectall">
                      </th>
                    </tr>
                  </thead>
                  <tbody>

                    @isset($team_cats)
                        @foreach($team_cats as $cat)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ ucfirst($cat->name) }}</td>
                                <td>{{ ucfirst(@$cat->getCat->name) }}</td>
                                <td>{{ ($cat->slug) }}</td>


                                <td>{{ date('Y/m/d',strtotime($cat->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('awardscategory.edit',$cat->id)}}" class="">
                                        <i class="bi bi-pen-fill"></i>
                                    </a>
                                    <a href="javascript:;" data-id="{{ $cat->id }}" class=" delete-awards-cat">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                                <td>
                                  <input type="checkbox" name="selects[]" class="select" value="{{$cat->id}}">
                                </td>

                            </tr>
                        @endforeach
                    @endisset

                  </tbody>
                </table>
                </form>
                <!-- End Table with stripped rows -->

              </div>
            </div>

          </div>
        @endisset

    </div>


    {{ Form::open(['url'=>'','class'=>'delete-form'])}}
      @method('delete')
    {{ Form::close()}}


  </section>

@endsection

@section('backend-js')

<script>

                $('#selectall').click(function() {
                    $('input:checkbox').prop('checked', this.checked);
                });

                $('.to-awards-category').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });

                $(document).on('click', '.delete-awards-cat', function(e) {
                   e.preventDefault();
                    var myAction = "{{route('awardscategory.destroy', 'id')}}"
                    var productId = $(this).data('id');
                    myAction = myAction.replace('id', productId);
                    $('.delete-form').attr('action', myAction);
                    let clicked = confirm('Are You Sure Want To Delete Category !');

                if (clicked) {
                    $('.delete-form').submit();
                }
});
</script>

<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replace('description', {
filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
filebrowserUploadMethod: 'form'
});
</script>
@endsection
