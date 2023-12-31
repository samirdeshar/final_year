@extends('layouts.backend_layout.template')


@section('title','Admin || generalFaq')

@section('backend-css')
  <style>
  .drop-hover:hover{
    color: black !important;
  }
  </style>

@endsection

@section('main-content')

<div class="pagetitle">
    <h1>General FAQs</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">General FAQs List</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title" style="float">General FAQs List</h5>
            <a href="{{ route('generalFaq.create')}}" style="float:right;margin-right:20px;" class="btn btn-sm btn-success"><i class="bi bi-plus"></i>Create</a>

            <p>All generalFaq Listed Here.....</p>

            <div>
              {{-- -------------------Status Drop Down----------------- --}}
              <!-- Example single danger button -->
                <div class="btn-group" style="float:left">
                  <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Status
                  </button>
                  <ul class="dropdown-menu bg-success ">
                    <li><a class="dropdown-item text-white drop-hover" href="{{route('get-generalFaq-status', 'active')}}"><i class="bi bi-check-circle me-1"></i> Active</a></li>
                    <li><a class="dropdown-item text-white drop-hover" href="{{route('get-generalFaq-status', 'inactive')}}"><i class="bi bi-exclamation-octagon me-1"></i> In-Active</a></li>
                    <li><a class="dropdown-item text-white drop-hover" href="{{route('get-generalFaq-status', 'all')}}"><i class="bi bi-collection-fill me-1"></i> All</a></li>
                  </ul>
                </div>
              {{-- -------------------Status Drop Down----------------- --}}


              {{-- -------------------Action Drop Down----------------- --}}
              <!-- Example single danger button -->
              <div class="btn-group" style="float:right;margin-right:10px;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Action
                </button>
                <ul class="dropdown-menu bg-danger ">

                  <li>
                    <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-generalFaq" data-multiple_action="active">
                      <i class="bi bi-check-circle me-1"></i>
                        Active
                    </a>
                  </li>
                  <li>
                      <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-generalFaq" data-multiple_action="inactive">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                          Inactive
                      </a>
                  </li>
                  <li>
                      <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-generalFaq" data-multiple_action="delete">
                        <i class="bi bi-trash"></i>
                          Delete
                      </a>
                  </li>
                </ul>
              </div>
              {{-- -------------------Action Drop Down----------------- --}}
            </div>
            <!-- Table with stripped rows -->
            <form action="{{route('to-perform-generalFaq')}}" method="post" id="full-form">
              <input type="text" hidden name="multiple_action" id="multiple_action">
              @csrf
            <table class="table ">

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Slug</th>
                  <th scope="col">Status</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Action</th>
                  <th>
                    <input type="checkbox" name="selectall" id="selectall">
                  </th>
                </tr>
              </thead>
              <tbody>

                @isset($generalFaqs)
                    @foreach($generalFaqs as $generalFaq)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ ucfirst($generalFaq->title) }}</td>
                            <td>
                                {{$generalFaq->slug}}
                            </td>
                            <td>
                                <a href="{{ route('update-generalFaq-status',[$generalFaq->id, $generalFaq->status])}}">
                                    <span class="badge rounded-pill bg-{{ ($generalFaq->status=='active')?'success':'danger'}}"><i class="bi {{ ($generalFaq->status=='active')?'bi-check-circle me-1 ':'bi-exclamation-octagon me-1'}} "></i> {{ ucfirst($generalFaq->status)}}</span>
                                </a>
                            </td>
                            <td>{{ date('Y/m/d',strtotime($generalFaq->created_at)) }}</td>
                            <td>
                                <a href="{{ route('generalFaq.edit', $generalFaq)}}" class="btn btn-sm btn-primary btn-style">
                                    <i class="bi bi-pen-fill"></i>
                                </a>
                                <a href="javascript:;" data-id="{{ $generalFaq->id }}" class="btn btn-sm btn-danger btn-style delete-generalFaq">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                            <td>
                              <input type="checkbox" name="selects[]" class="select" value="{{$generalFaq->id}}">
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

<script>

                $('#selectall').click(function() {
                    $('input:checkbox').prop('checked', this.checked);
                });

                $('.to-perform-generalFaq').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });

                $(document).on('click', '.delete-generalFaq', function(e) {
                   e.preventDefault();
                    var myAction = "{{route('generalFaq.destroy', 'id')}}"
                    var generalFaqId = $(this).data('id');
                    myAction = myAction.replace('id', generalFaqId);
                    $('.delete-form').attr('action', myAction);
                    let clicked = confirm('Are You Sure Want To Delete generalFaq !');

                if (clicked) {
                    $('.delete-form').submit();
                }
});
</script>
@endsection
