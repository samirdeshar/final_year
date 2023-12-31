@extends('layouts.backend_layout.template')
@php
use App\Models\Admin\Trip\Trip;
@endphp

@section('title', 'Admin || tripComment')

@section('backend-css')
    <style>
        .drop-hover:hover {
            color: black !important;
        }

        .table1 th {
            border: 1px solid green;
        }

        .table1 td {
            border: 1px solid green;
        }
    </style>


@endsection

@section('main-content')

    <div class="pagetitle">
        <h1>tripComments</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">tripComment List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="float">tripComments List</h5>
                        {{-- <a href="{{ route('tripComment.create')}}" style="float:right;margin-right:20px;" class="btn btn-sm btn-success"><i class="bi bi-plus"></i>Create</a> --}}

                        <p>All tripComment Listed Here.....</p>

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
                            {{-- <div class="btn-group " style="float:right;margin-right:10px;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Action
                </button>
                <ul class="dropdown-menu bg-danger ">

                  <li>
                    <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-tripComment" data-multiple_action="active">
                      <i class="bi bi-check-circle me-1"></i>
                        Active
                    </a>
                  </li>
                  <li>
                      <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-tripComment" data-multiple_action="inactive">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                          Inactive
                      </a>
                  </li>
                  <li>
                      <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-tripComment" data-multiple_action="delete">
                        <i class="bi bi-trash"></i>
                          Delete
                      </a>
                  </li>
                </ul>
              </div> --}}
                            {{-- -------------------Action Drop Down----------------- --}}
                        </div>
                        <!-- Table with stripped rows -->
                        <form action="" method="post" id="full-form">
                            <input type="text" hidden name="multiple_action" id="multiple_action">
                            @csrf
                            <table class="table ">

                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Comment Title</th>
                                        <th>Commented By</th>
                                        <th scope="col">Commented Date</th>
                                        <th scope="col">Action</th>
                                        {{-- <th>
                    <input type="checkbox" name="selectall" id="selectall">
                  </th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    @isset($tripComments)
                                        @foreach ($tripComments as $tripComment)
                                            <tr>
                                                <td>{{ $n++ }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#exampleModalCenter{{ $tripComment->id }}">
                                                        {{ ucfirst($tripComment->title) }}
                                                    </button>

                                                </td>
                                                <td>
                                                    {{ $tripComment->user_name }}
                                                </td>
                                                <td>{{ date('Y/m/d', strtotime($tripComment->created_at)) }}</td>
                                                <td>
                                                    {{-- <a href="{{ route('tripComment.edit', $tripComment)}}" class="btn btn-sm btn-primary btn-style">
                                    <i class="bi bi-pen-fill"></i>
                                </a> --}}
                                                    <a href="javascript:;" data-id="{{ $tripComment->id }}"
                                                        class="btn btn-sm btn-danger btn-style delete-tripComment">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </a>
                                                </td>
                                                {{-- <td>
                              <input type="checkbox" name="selects[]" class="select" value="{{$tripComment->id}}">
                            </td> --}}

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


        {{ Form::open(['url' => '', 'class' => 'delete-form']) }}
        @method('delete')
        {{ Form::close() }}


    </section>





    {{-- Modal For Comments --}}

    @isset($tripComments)
        @foreach ($tripComments as $tripComment)
            @php
                $trip_name = Trip::where('id', $tripComment->trip_id)->first();
            @endphp
            <div class="modal fade" id="exampleModalCenter{{ $tripComment->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"> {{ $tripComment->title }} </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h3>Profile Image:</h3>
                            <img src="{{ asset('uploads/comment/' . @$tripComment->image) }}" alt="Img">
                            <table class="table1">
                                <tr>
                                    <th>Commented By :</th>
                                    <td>{{ $tripComment->user_name }}</td>
                                </tr>
                                <tr>
                                    <th>Comment Email :</th>
                                    <td>{{ $tripComment->email }}</td>
                                </tr>
                                <tr>
                                    <th>Comment Phone :</th>
                                    <td>{{ $tripComment->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Comment Address :</th>
                                    <td>{{ $tripComment->address }}</td>
                                </tr>
                                <tr>
                                    <th>Comment Country :</th>
                                    <td>{{ $tripComment->country }}</td>
                                </tr>
                                <tr>
                                    <th>Comment Website :</th>
                                    <td>{{ $tripComment->website }}</td>
                                </tr>
                                <tr>
                                    <th>Commented In (trip) :</th>
                                    <td>{{ @$trip_name->title }}</td>
                                </tr>
                                <tr>
                                    <th>Comment: </th>
                                    <td>
                                        {{ $tripComment->comment }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endisset
@endsection
@section('backend-js')

    <script>
        $('#selectall').click(function() {
            $('input:checkbox').prop('checked', this.checked);
        });

        $('.to-perform-tripComment').on('click', function(e) {
            var performAction = $(this).data('multiple_action');
            $('#multiple_action').val(performAction);
            if (confirm('Are You sure want to ' + performAction + '......?')) {
                $('#full-form').submit();
            }
        });

        $(document).on('click', '.delete-tripComment', function(e) {
            e.preventDefault();
            var myAction = "{{ route('trip-comment.delete', 'id') }}"
            var tripCommentId = $(this).data('id');
            myAction = myAction.replace('id', tripCommentId);
            $('.delete-form').attr('action', myAction);
            let clicked = confirm('Are You Sure Want To Delete tripComment !');

            if (clicked) {
                $('.delete-form').submit();
            }
        });
    </script>
@endsection
