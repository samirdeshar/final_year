@extends('layouts.backend_layout.template')


@isset($data)
@section('title','Admin || Update Categories')
@else
@section('title','Admin || Trip Categories')
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
        Update "{{ ucfirst($data->name) }}" Categories
        @else
        Trip Categories
        @endisset
    </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Trip Categories List</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
        <div class="col-lg-{{ (@$data==true) ?'12':'5'}}">
            <div class="card" style="box-shadow:0px 0px 5px grey">
                <div class="card-body">
                    <h5 class="card-title text-center" style="float">
                        @isset($data)
                        Update Category
                        @else
                        Add New Trip Category
                        @endisset
                    </h5>
                </div>

                <div class="row ml-2 mr-2">
                    @isset($data)
                    {{ Form::open(['url'=>route('tripcategory.update',$data->id),'files'=>true])}}
                    @method('put')
                    @else
                    {{ Form::open(['url'=>route('tripcategory.store'),'files'=>true])}}
                    @endisset
                    <div class="col-12 mb-2">
                        {{ Form::label('name','Name:',['class'=>'form-label'])}}
                        {{ Form::text('name',@$data->name,['class'=>'form-control  '.($errors->has('name') ?'is-invalid':''),'placeholder'=>'Category Name.....','required'=>true])}}
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <!--<div class="col-12 mb-2">-->
                    <!--    {{ Form::label('icon','Icon Tag:',['class'=>'form-label'])}}-->
                    <!--    {{ Form::text('icon',@$data->icon,['class'=>'form-control  '.($errors->has('icon') ?'is-invalid':''),'placeholder'=>'Icon Tag.....','required'=>true])}}-->
                    <!--    @error('icon')-->
                    <!--        <span class="text-danger">{{ $message }}</span>-->
                    <!--    @enderror-->
                    <!--</div>--> --}}
                     
                    <div class="col-12 mb-2">
                        {{ Form::label('icon','Icon Image:',['class'=>'form-label'])}}
                        <div class="input-group">
                       
                        
                        <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                          </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="icon" value="{{old('icon', @$data->icon)}}">
                    </div>
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
                    
                    
                    
                    

                    <div class="col-12 mb-2">
                        {{ Form::label('parent_id','Parent Category:',['class'=>'form-label'])}}

{{--
                        <select name="parent_id" id="" class="form-control">
                            <option value="" >-----------------Select If Any------------------</option>

                            @if(isset($parent_cat))
                            @foreach($parent_cat as $parent)
                                <option value="{{ $parent->id }}" >{{ $parent->name}}</option>
                                   @if($parent->getSub && $parent->getSub->count() >0)
                                        @foreach($parent->getSub as $sub)

                                            <option value="{{ $sub->id}}" >&nbsp;&nbsp;&nbsp;&nbsp;{{ $sub->name}}</option>

                                        @endforeach
                                   @endif
                            @endforeach
                            @endif

                        </select> --}}
                        {{ Form::select('parent_id',@$parent_cat->pluck('name','id'),@$data->parent_id,['class'=>'form-control  '.($errors->has('parent_id') ?'is-invalid':''),'placeholder'=>'-----------Select Category----------','required'=>false])}}


                        @error('parent_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-12 mb-2">
                        {{ Form::label('summary','Summary:',['class'=>'form-label'])}}
                        {{ Form::textArea('summary',@$data->summary,['class'=>'form-control  '.($errors->has('summary') ?'is-invalid':''),'placeholder'=>'Category Summary.....','required'=>false,'rows'=>'5','style'=>'resize:none;'])}}
                        @error('summary')
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

                    <div class="col-12 mb-2">
                      {{ Form::label('status','Status:',['class'=>'form-label'])}}
                      <select name="status" id="" class="form-control ">
                        <option value="active" {{(@$data->status=='active') ? 'selected':''}}>Active</option>
                        <option value="inactive" {{(@$data->status=='inactive') ? 'selected':''}}>In-Active</option>
                      </select>
                      @error('description')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>

                    <div class="col-12 mb-4 mt-4">
                        <div class="form-check">

                            <input class="form-check-input " type="checkbox" name="display" value="1" {{ (@$data->display==1)? 'checked':''}}>
                            <label class="form-check-label" for="display">
                             Show On Home Page
                            </label>
                          </div>
                        @error('display')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-4 mt-4">
                      <div class="form-check">

                          <input class="form-check-input " type="radio" name="bond_status" value="1" {{ (@$data->bond_status==1)? 'checked':''}}>
                          <label class="form-check-label" for="display">
                           Inbound
                          </label>
                        </div>
                      @error('display')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>

                  <div class="col-12 mb-4 mt-4">
                    <div class="form-check">

                        <input class="form-check-input " type="radio" name="bond_status" value="2" {{ (@$data->bond_status==2)? 'checked':''}}>
                        <label class="form-check-label" for="display">
                         Outbound
                        </label>
                      </div>
                    @error('display')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                    <div class="col-12 mb-4">
                        {{ Form::label('image','Banner Image:',['class'=>'form-label'])}}

                        <div class="input-group">
                            <span class="input-group-btn">
                              <a id="lfm1" data-input="thumbnail1" data-preview="holder" class="btn btn-primary">
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
        <div class="col-lg-7">

            <div class="card" style="box-shadow:0px 0px 5px grey">
              <div class="card-body">
                <h5 class="card-title" style="float">Trip Categories List</h5>

                <p>All Trip Categories Listed Here.....</p>

                <div>

                  <!-- Example single danger button -->
                  <div class="btn-group " style="float:right;margin-right:10px;">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Action
                    </button>
                    <ul class="dropdown-menu bg-danger ">

                      <li>
                          <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-tripcategory" data-multiple_action="delete">
                            <i class="bi bi-trash"></i>
                              Delete
                          </a>
                      </li>
                    </ul>
                  </div>
                  {{-- -------------------Action Drop Down----------------- --}}
                </div>
                <!-- Table with stripped rows -->
                <form  action="{{route('to-trip-cat')}}" method="post" id="full-form">
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
                  <tbody id="tablecontents">

                    @isset($tripcats)
                        @foreach($tripcats as $cat)
                            <tr class="row1" data-id="{{ $cat->id}}">
                                <td>{{ $n++ }}</td>
                                <td>{{ ucfirst($cat->name) }} 
                                  <a href="{{route('tripcateproduct',@$cat->slug)}}" class="btn btn-sm btn-info">Product View</a>
                                </td>
                                <td>{{ ucfirst(@$cat->getCat->name) }}</td>
                                <td>{{ ($cat->slug) }}</td>


                                <td>{{ date('Y/m/d',strtotime($cat->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('tripcategory.edit',$cat->id)}}" class="">
                                        <i class="bi bi-pen-fill"></i>
                                    </a>
                                    <a href="javascript:;" data-id="{{ $cat->id }}" class=" delete-cat">
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

                $('.to-perform-tripcategory').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });

                $(document).on('click', '.delete-cat', function(e) {
                   e.preventDefault();
                    var myAction = "{{route('tripcategory.destroy', 'tripCatValue')}}"
                    var productId = $(this).data('id');
                    myAction = myAction.replace('tripCatValue', productId);
                    $('.delete-form').attr('action', myAction);
                    let clicked = confirm('Are You Sure Want To Delete Category !');

                if (clicked) {
                    $('.delete-form').submit();
                }
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

$(document).ready(function(){
    $('#lfm').filemanager('image');
});


$(document).ready(function(){
    $('#lfm1').filemanager('image');
});
</script>


@endsection

{{-- @push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

<script type="text/javascript">
  $(function() {
      $("#tablecontents").sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
      });

      function sendOrderToServer() {
          var order = [];
          // var token = $('meta[name="csrf-token"]').attr('content');
         
          $('tr.row1').each(function(index, element) {
              order.push({
                  id: $(this).attr('data-id'),
                  position: index + 1
              });

          });
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type: "post",
              dataType: "json",
              url: "{{ route('updateTripcategoryPosition') }}",
              // url: "{{ url('updateMenuOrder') }}",
              data: {
                  order: order,
              },
              success: function(response) {
                  if (response.status == "success") {
                      console.log(response);
                  } else {
                      console.log(response)
                  }
              }
          });
      }
  });
</script>
@endpush --}}
