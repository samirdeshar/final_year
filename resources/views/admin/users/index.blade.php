@extends('layouts.backend_layout.template')
@push('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
<style>
    .table-bordered, th, td {
        border: 1px solid green !important;
    }
</style>
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                <h1>View Users <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Create User</a></h1>
                <table class="table-bordered data-table"">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {

          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('user.index') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'email', name: 'email'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });

        });
      </script>
@endpush
