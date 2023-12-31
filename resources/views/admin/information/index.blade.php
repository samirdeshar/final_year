@extends('layouts.backend_layout.template')


@section('title','Admin || Information')

@section('backend-css')
  <style>
  .drop-hover:hover{
    color: black !important;
  }
  </style>


@endsection

@section('main-content')

<div class="pagetitle">
    <h1>Informations</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Information List</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title" style="float">Informations List</h5>
            <a href="{{ route('information.create')}}" style="float:right;margin-right:20px;" class="btn btn-sm btn-success"><i class="bi bi-plus"></i>Add New Member</a>

            <p>All Information Listed Here.....</p>

            <div>
              {{-- -------------------Status Drop Down----------------- --}}
              <!-- Example single danger button -->
                <div class="btn-group" style="float:left">
                  <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Status
                  </button>
                  <ul class="dropdown-menu bg-success ">
                    <li><a class="dropdown-item text-white drop-hover" href="{{ route('get-information-status','active')}}"><i class="bi bi-check-circle me-1"></i> Active</a></li>
                    <li><a class="dropdown-item text-white drop-hover" href="{{ route('get-information-status','inactive')}}"><i class="bi bi-exclamation-octagon me-1"></i> In-Active</a></li>
                    <li><a class="dropdown-item text-white drop-hover" href="{{ route('get-information-status','all')}}"><i class="bi bi-collection-fill me-1"></i> All</a></li>
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
                    <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-Information" data-multiple_action="active">
                      <i class="bi bi-check-circle me-1"></i>
                        Active
                    </a>
                  </li>
                  <li>
                      <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-Information" data-multiple_action="inactive">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                          Inactive
                      </a>
                  </li>
                  <li>
                      <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-Information" data-multiple_action="delete">
                        <i class="bi bi-trash"></i>
                          Delete
                      </a>
                  </li>
                </ul>
              </div>
              {{-- -------------------Action Drop Down----------------- --}}
            </div>
            <!-- Table with stripped rows -->
            <form action="{{route('to-information')}}" method="post" id="full-form">
              <input type="text" hidden name="multiple_action" id="multiple_action">
              @csrf
            <table class="table ">

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Icon</th>
                  <th scope="col">Image</th>
                  <th scope="col">Status</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Action</th>
                  <th>
                    <input type="checkbox" name="selectall" id="selectall">
                  </th>
                </tr>
              </thead>
              <tbody>

                @isset($informations)
                    @foreach($informations as $information)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ ucfirst($information->title) }}</td>
                            <td>
                                @if($information->icon && $information->icon !=null)
                                    <a href="{{ asset(@$information->icon)}}" data-lightbox="icon-{{$information->id}}" data-title="{{ ucfirst($information->title)}}">
                                        View
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($information->image && $information->image !=null)
                                    <a href="{{ asset(@$information->image)}}" data-lightbox="image-{{$information->id}}" data-title="{{ ucfirst($information->title)}}">
                                        View
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('information-update-status',[$information->id, $information->status])}}">
                                    <span class="badge rounded-pill bg-{{ ($information->status=='active')?'success':'danger'}}"><i class="bi {{ ($information->status=='active')?'bi-check-circle me-1 ':'bi-exclamation-octagon me-1'}} "></i> {{ ucfirst($information->status)}}</span>
                                </a>
                            </td>
                            <td>{{ date('Y/m/d',strtotime($information->created_at)) }}</td>
                            <td>
                                <a href="{{ route('information.edit', $information)}}" class="btn btn-sm btn-primary btn-style">
                                    <i class="bi bi-pen-fill"></i>
                                </a>
                                <a href="javascript:;" data-id="{{ $information->id }}" class="btn btn-sm btn-danger btn-style delete-information">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                            <td>
                              <input type="checkbox" name="selects[]" class="select" value="{{$information->id}}">
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

                $('.to-perform-Information').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });

                $(document).on('click', '.delete-information', function(e) {
                   e.preventDefault();
                    var myAction = "{{route('information.destroy', 'id')}}"
                    var InformationId = $(this).data('id');
                    myAction = myAction.replace('id', InformationId);
                    $('.delete-form').attr('action', myAction);
                    let clicked = confirm('Are You Sure Want To Delete Information !');

                if (clicked) {
                    $('.delete-form').submit();
                }
});
</script>
@endsection
