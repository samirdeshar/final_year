@extends('layouts.backend_layout.template')


@section('title', 'Admin || Team')

@section('backend-css')
    <style>
        .drop-hover:hover {
            color: black !important;
        }

        ol {
            list-style-type: none;
        }

        .menu-handle {
            display: block;
            margin-bottom: 5px;
            padding: 6px 4px 6px 12px;
            color: #333;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            cursor: move;
        }

        .menu-handle:hover {
            background: #fff;
        }

        .placeholder {
            margin-bottom: 10px;
            background: #D7F8FD
        }
    </style>


@endsection

@section('main-content')

    <div class="pagetitle">
        <h1 class="m-0">Team <a href="{{ route('team.create') }}" class="btn btn-primary">Add New team</a></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Team List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

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
                        <div class="card-body card-format">
                            @if ($teams->count() > 0)
                                <ol class="sortable">
                                    @foreach ($teams as $team)
                                            <li id="menuItem_{{ $team->id }}" class="item-list" data-id="{{ @$team->id }}">
                                                <div class="menu-handle d-flex justify-content-between">
                                                    <span>
                                                        {{ $team->name }}
                                                    </span>

                                                    <div class="menu-options btn-group">
                                                        <a href="{{ route('team.edit', $team->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $team->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                        <!-- Modal -->
                                                            <div class="modal fade text-left" id="deletionservice{{ $team->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <form action="{{ route('team.destroy', $team->id) }}" method="POST" style="display:inline-block;">
                                                                                @csrf
                                                                                @method("POST")
                                                                                <label for="reason">Are you sure you want to delete??</label><br>
                                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                                <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            ";
                                                            </div>
                                                    </div>
                                                </div>
                                                {{-- {{ get_nested_menu($item->id) }} --}}
                                                {{-- @include('admin.menu.nested',['data'=>$item->child_menu]) --}}
                                            </li>
                                    @endforeach
                                    <div class="form-group mt-4">
                                        <button type="button" class="btn btn-success btn-sm btn-flat" id="serialize"><i
                                                class="fa fa-save"></i>
                                            Update Order
                                        </button>
                                    </div>
                                </ol>
                            @else
                                <p class="text-center">Team Member Not Found.</p>
                            @endif
                        </div>
                    </div>



                    {{-- <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Profile Image</th>
                                        <th>Name</th>
                                        <th>post</th>
                                        <th>Email</th>
                                        <th>Contact no.</th>
                                        <th>team Of</th>
                                        <th>Under Committee</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($teams) == 0)
                                        <tr>
                                            <td colspan="8">
                                                <p class="text-center">
                                                    No any records.
                                                </p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($teams as $team)
                                            <tr>
                                                <td>
                                                    <img src="{{ Storage::disk('uploads')->url($team->profile_photo) }}" alt="{{ $team->name }}" style="height: 100px; width: 100px;">
                                                </td>
                                                <td>
                                                    {{ $team->name }} <br>
                                                    ({{ $team->name['np'] }})
                                                </td>
                                                <td>
                                                    {{ $team->post }} <br>
                                                    ({{ $team->post['np'] }})
                                                </td>
                                                <td>
                                                    @if ($team->email == null)
                                                        Not Provided
                                                    @else
                                                    {{ $team->email }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $team->contact_no }} <br>
                                                    ({{ $team->contact_no['np'] }})
                                                </td>
                                                <td>
                                                    @if ($team->team_id == null)
                                                        -
                                                    @else
                                                        {{ $team->teamCategory->category_name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($team->commitee_id == null)
                                                        -
                                                    @else
                                                        {{ $team->commiteeCategory->category_name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('team.edit', $team->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletionservice{{ $team->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                    <!-- Modal -->
                                                        <div class="modal fade text-left" id="deletionservice{{ $team->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <form action="{{ route('team.destroy', $team->id) }}" method="POST" style="display:inline-block;">
                                                                            @csrf
                                                                            @method("POST")
                                                                            <label for="reason">Are you sure you want to delete??</label><br>
                                                                            <input type="hidden" name="_method" value="DELETE" />
                                                                            <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        ";
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="text-sm">
                                            Showing <strong>{{ $teams->firstItem() }}</strong> to
                                            <strong>{{ $teams->lastItem() }} </strong> of <strong>
                                                {{ $teams->total() }}</strong>
                                            entries
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="pagination-sm m-0 float-right">{{ $teams->links() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="content">
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
                        <div class="card-body card-format">
                            @if ($teams->count() > 0)
                                <ol class="sortable">
                                    @foreach ($teams as $team)
                                            <li id="menuItem_{{ $team->id }}">
                                                <div class="menu-handle d-flex justify-content-between">
                                                    <span>
                                                        {{ $team->name }}
                                                    </span>

                                                    <div class="menu-options btn-group">
                                                        <a href="{{ route('team.edit', $team->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $team->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                        <!-- Modal -->
                                                            <div class="modal fade text-left" id="deletionservice{{ $team->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <form action="{{ route('team.destroy', $team->id) }}" method="POST" style="display:inline-block;">
                                                                                @csrf
                                                                                @method("POST")
                                                                                <label for="reason">Are you sure you want to delete??</label><br>
                                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                                <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            ";
                                                            </div>
                                                    </div>
                                                </div>
                                            </li>
                                    @endforeach
                                    <div class="form-group mt-4">
                                        <button type="button" class="btn btn-success btn-sm btn-flat" id="serialize"><i
                                                class="fa fa-save"></i>
                                            Update Order
                                        </button>
                                    </div>
                                </ol>
                            @else
                                <p class="text-center">Team Member Not Found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

@endsection

@section('backend-js')
<script src="{{ asset('backend/plugins/toastrjs/toastr.min.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script type="text/javascript">
      $(function () {

        $( ".sortable" ).sortable({
          items: "li",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('li.item-list').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('updateTeamOrder') }}",
                data: {
              order: order,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                    toastr.options.closeButton = true
                    toastr.success('team Order Successfully', "Success !");
                } else {
                  console.log(response);
                }
            }
          });
        }
      });
    </script>

    <script>
        $('#selectall').click(function() {
            $('input:checkbox').prop('checked', this.checked);
        });

        $('.to-perform-team').on('click', function(e) {
            var performAction = $(this).data('multiple_action');
            $('#multiple_action').val(performAction);
            if (confirm('Are You sure want to ' + performAction + '......?')) {
                $('#full-form').submit();
            }
        });

        $(document).on('click', '.delete-team', function(e) {
            e.preventDefault();
            var myAction = "{{ route('team.destroy', 'id') }}"
            var teamId = $(this).data('id');
            myAction = myAction.replace('id', teamId);
            $('.delete-form').attr('action', myAction);
            let clicked = confirm('Are You Sure Want To Delete team !');

            if (clicked) {
                $('.delete-form').submit();
            }
        });
    </script>
@endsection
