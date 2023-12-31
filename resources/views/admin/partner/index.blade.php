@extends('layouts.backend_layout.template')


@isset($data)
@section('title','Admin || Update Partner')
@else
@section('title','Admin ||  Partners')
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
        Update "{{ ucfirst($data->show_in) }}" Partner
        @else
        Add Partners
        @endisset
    </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Our Partners</li>
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
                        Update Partner
                        @else
                        Add New
                        @endisset
                    </h5>
                </div>

                <div class="row ml-2 mr-2">
                    @isset($data)
                    {{ Form::open(['url'=>route('partner.update',$data->id),'files'=>true])}}
                    @method('put')
                    @else
                    {{ Form::open(['url'=>route('partner.store'),'files'=>true])}}
                    @endisset


                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="show_in">Select Where To show</label>
                            <select name="show_in" id="show_in" class="form-control form-control-sm">
                                <option value="">-----------------------Select Any One---------------------------</option>
                                <option value="affiliate" {{(@$data->show_in == 'affiliate')?'selected' : ''}}>Our Affiliates</option>
                            </select>
                            @error('show_in')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="url">Your Url</label>
                        <input type="url" name="url" id="url" class="form-control form-control-sm" value="{{old('url', @$data->url)}}">
                        @error('url')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control form-control-sm">
                            <option value="">---------------Please Select Any One ------------------</option>
                            <option value="active"{{(@$data->status == 'active')? 'selected':''}}>Active</option>
                            <option value="inactive" {{(@$data->status == 'inactive')? 'selected':''}}>InActive</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="image">Image</label>

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
                <div class="text-center mb-2 mt-2">
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
                <h5 class="card-title" style="float">Partners List</h5>

                <p>All Partners Listed Here.....</p>

                <div>


                  {{-- -------------------Action Drop Down----------------- --}}
                  <!-- Example single danger button -->
                  <div class="btn-group " style="float:right;margin-right:10px;">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Action
                    </button>
                    <ul class="dropdown-menu bg-danger ">

                      <li>
                          <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-triptype" data-multiple_action="delete">
                            <i class="bi bi-trash"></i>
                              Delete
                          </a>
                      </li>
                    </ul>
                  </div>
                  {{-- -------------------Action Drop Down----------------- --}}
                </div>

                <!-- Table with stripped rows -->
                <form  action="{{route('to-partner-category')}}" method="post" id="full-form">
                  <input type="text" hidden name="multiple_action" id="multiple_action">
                  @csrf
                <table class="table ">

                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">URL</th>
                      <th scope="col">Status</th>
                      <th scope="col">image</th>
                      <th scope="col">Show In</th>
                      <th scope="col">Action</th>
                      <th>
                        <input type="checkbox" name="selectall" id="selectall">
                      </th>
                    </tr>
                  </thead>
                  <tbody id="tablecontents">

                    @isset($partners)
                        @foreach($partners as $cat)
                            <tr class="row1" data-id="{{ $cat->id}}">
                                <td>{{ $n++ }}</td>
                                <td>{{ ucfirst($cat->url) }}</td>
                                <td>
                                    <a href="{{ route('partner-update-status',$cat->id)}}">
                                        <span class="badge rounded-pill bg-{{ ($cat->status=='active')?'success':'danger'}}"><i class="bi {{ ($cat->status=='active')?'bi-check-circle me-1 ':'bi-exclamation-octagon me-1'}} "></i> {{ ucfirst($cat->status)}}</span>
                                    </a>
                                </td>
                                <td>
                                    <img src="{{asset(@$cat->image)}}" alt="Img" style="width:50px; height: auto;">
                                </td>
                                <td>
                                    {{$cat->show_in}}
                                </td>
                                <td>
                                    <a href="{{ route('partner.edit',$cat->id)}}" class="">
                                        <i class="bi bi-pen-fill"></i>
                                    </a>
                                    <a href="javascript:;" data-id="{{$cat->id }}" class="delete-cat">
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
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
                $('#selectall').click(function() {
                    $('input:checkbox').prop('checked', this.checked);
                });

                $('.to-perform-triptype').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });

                $(document).on('click', '.delete-cat', function(e) {
                   e.preventDefault();
                    var myAction = "{{route('partner.destroy', 'id')}}"
                    var productId = $(this).data('id');
                    myAction = myAction.replace('id', productId);
                    $('.delete-form').attr('action', myAction);
                    let clicked = confirm('Are You Sure Want To Delete Category !');

                if (clicked) {
                    $('.delete-form').submit();
                }
});
</script>

<script type="text/javascript">
CKEDITOR.replace('description', {
filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
filebrowserUploadMethod: 'form'
});
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $('#lfm').filemanager('image');
    });
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
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('tr.row1').each(function(index, element) {
              order.push({
                  id: $(this).attr('data-id'),
                  position: index + 1
              });

          });
          console.log('order', order)
          $.ajax({
              type: "post",
              dataType: "json",
              url: "{{ route('updatePartnerPosition') }}",
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
@endsection
