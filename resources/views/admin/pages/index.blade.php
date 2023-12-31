travelinfo
@extends('layouts.backend_layout.template')


@section('title','Admin || generalPage')

@section('backend-css')
  <style>
  .drop-hover:hover{
    color: black !important;
  }
  </style>


@endsection

@section('main-content')

<div class="pagetitle">
    <h1>General Pages</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">General Page List</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title" style="float">General Page Lists</h5>
            <a href="{{ route('generalPage.create')}}" style="float:right;margin-right:20px;" class="btn btn-sm btn-success"><i class="bi bi-plus"></i>Create New generalPage</a>

            <p>All General Pages Listed Here.....</p>

            <div>
              {{-- -------------------Status Drop Down----------------- --}}
              <!-- Example single danger button -->
                <div class="btn-group" style="float:left">
                  <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Status
                  </button>
                  <ul class="dropdown-menu bg-success ">
                    <li><a class="dropdown-item text-white drop-hover" href="{{ route('get-generalPage-status','active')}}"><i class="bi bi-check-circle me-1"></i> Active</a></li>
                    <li><a class="dropdown-item text-white drop-hover" href="{{ route('get-generalPage-status','inactive')}}"><i class="bi bi-exclamation-octagon me-1"></i> In-Active</a></li>
                    <li><a class="dropdown-item text-white drop-hover" href="{{ route('get-generalPage-status','all')}}"><i class="bi bi-collection-fill me-1"></i> All</a></li>
                  </ul>
                </div>
              {{-- -------------------Status Drop Down----------------- --}}

              {{-- -------------------Action Drop Down----------------- --}}
              <!-- Example single danger button -->
              <div class="btn-group " style="float:right;margin-right:10px;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Action
                </button>
                <ul class="dropdown-menu bg-danger ">

                  <li>
                    <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-generalPage" data-multiple_action="active">
                      <i class="bi bi-check-circle me-1"></i>
                        Active
                    </a>
                  </li>
                  <li>
                      <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-generalPage" data-multiple_action="inactive">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                          Inactive
                      </a>
                  </li>
                  <li>
                      <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-generalPage" data-multiple_action="delete">
                        <i class="bi bi-trash"></i>
                          Delete
                      </a>
                  </li>
                </ul>
              </div>
              {{-- -------------------Action Drop Down----------------- --}}
            </div>
            <!-- Table with stripped rows -->
            <form action="{{ route('to-generalPage')}}" method="post" id="full-form">
              <input type="text" hidden name="multiple_action" id="multiple_action">
              @csrf
            <table class="table ">

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Show In</th>
                  <th scope="col">Image</th>
                  <th scope="col">Status</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Action</th>
                  <th>
                    <input type="checkbox" name="selectall" id="selectall">
                  </th>
                </tr>
              </thead>
              <tbody id="tablecontents">

                @isset($generalPages)
                    @foreach($generalPages as $generalPage)
                        <tr class="row1" data-id="{{ $generalPage->id}}">
                            <td>{{ $n++ }}</td>
                            <td>{{ ucfirst($generalPage->title) }}</td>
                            <td>{{$generalPage->show_in}}</td>
                            <td>
                                @if($generalPage->image && $generalPage->image !=null)
                                    <a href="{{ asset(@$generalPage->image)}}" data-lightbox="image-{{$generalPage->id}}" data-title="{{ ucfirst($generalPage->title)}}">
                                        View
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('generalPage-update-status',[$generalPage->id,$generalPage->status])}}">
                                    <span class="badge rounded-pill bg-{{ ($generalPage->status=='active')?'success':'danger'}}"><i class="bi {{ ($generalPage->status=='active')?'bi-check-circle me-1 ':'bi-exclamation-octagon me-1'}} "></i> {{ ucfirst($generalPage->status)}}</span>
                                </a>
                            </td>
                            <td>{{ date('Y/m/d',strtotime($generalPage->created_at)) }}</td>
                            <td>
                                <a href="{{ route('generalPage.edit',$generalPage)}}" class="btn btn-sm btn-primary btn-style">
                                    <i class="bi bi-pen-fill"></i>
                                </a>
                                <a href="javascript:;" data-id="{{ $generalPage->id }}" class="btn btn-sm btn-danger btn-style delete-generalPage">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                            <td>
                              <input type="checkbox" name="selects[]" class="select" value="{{$generalPage->id}}">
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
<script>

                $('#selectall').click(function() {
                    $('input:checkbox').prop('checked', this.checked);
                });

                $('.to-generalPage').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });

                $(document).on('click', '.delete-generalPage', function(e) {
                   e.preventDefault();
                    var myAction = "{{route('generalPage.destroy', 'pageValue')}}";
                    var productId = $(this).data('id');
                    myAction = myAction.replace('pageValue', productId);
                    $('.delete-form').attr('action', myAction);
                    let clicked = confirm('Are You Sure Want To Delete generalPage !');

                if (clicked) {
                    $('.delete-form').submit();
                }
});
</script>

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
              url: "{{ route('updatePagePosition') }}",
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
