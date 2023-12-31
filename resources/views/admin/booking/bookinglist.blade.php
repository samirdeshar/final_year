

@extends('layouts.backend_layout.template')


@section('title','Admin || Booking')

@section('backend-css')
  <style>
  .drop-hover:hover{
    color: black !important;
  }
  </style>


@endsection

@section('main-content')

<div class="pagetitle">
    <h1>All Booking</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Booking List</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title" style="float">Booking List</h5>
            <!--<a href="{{ route('trip.create')}}" style="float:right;margin-right:20px;" class="btn btn-sm btn-success"><i class="bi bi-plus"></i>Create New Trip</a>-->

            <p>All Booking Listed Here.....</p>

            <div>
              {{-- -------------------Status Drop Down----------------- --}}
              <!-- Example single danger button -->
                <!--<div class="btn-group" style="float:left">-->
                <!--  <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">-->
                <!--    Status-->
                <!--  </button>-->
                <!--  <ul class="dropdown-menu bg-success ">-->
                <!--    <li><a class="dropdown-item text-white drop-hover" href="{{ route('get-trip-status','active')}}"><i class="bi bi-check-circle me-1"></i> Active</a></li>-->
                <!--    <li><a class="dropdown-item text-white drop-hover" href="{{ route('get-trip-status','inactive')}}"><i class="bi bi-exclamation-octagon me-1"></i> In-Active</a></li>-->
                <!--    <li><a class="dropdown-item text-white drop-hover" href="{{ route('get-trip-status','all')}}"><i class="bi bi-collection-fill me-1"></i> All</a></li>-->
                <!--  </ul>-->
                <!--</div>-->
              {{-- -------------------Status Drop Down----------------- --}}

              {{-- -------------------Action Drop Down----------------- --}}
              <!-- Example single danger button -->
              <!--<div class="btn-group " style="float:right;margin-right:10px;">-->
              <!--  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">-->
              <!--    Action-->
              <!--  </button>-->
              <!--  <ul class="dropdown-menu bg-danger ">-->

              <!--    <li>-->
              <!--      <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-trip" data-multiple_action="active">-->
              <!--        <i class="bi bi-check-circle me-1"></i>-->
              <!--          Active-->
              <!--      </a>-->
              <!--    </li>-->
              <!--    <li>-->
              <!--        <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-trip" data-multiple_action="inactive">-->
              <!--          <i class="bi bi-exclamation-octagon me-1"></i>-->
              <!--            Inactive-->
              <!--        </a>-->
              <!--    </li>-->
              <!--    <li>-->
              <!--        <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-trip" data-multiple_action="delete">-->
              <!--          <i class="bi bi-trash"></i>-->
              <!--            Delete-->
              <!--        </a>-->
              <!--    </li>-->
              <!--  </ul>-->
              <!--</div>-->
              {{-- -------------------Action Drop Down----------------- --}}
            </div>
            <!-- Table with stripped rows -->
            <form action="{{ route('to-trip')}}" method="post" id="full-form">
              <input type="text" hidden name="multiple_action" id="multiple_action">
              @csrf
            <table class="table ">

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Trip Name</th>
                  <th scope="col">Booked On</th>
                  <th scope="col">No Of Person</th>
                  <th scope="col">Adult</th>
                  <th scope="col">Child</th>
                  <th scope="col">Infants</th>
                  <!--<th>-->
                  <!--  <input type="checkbox" name="selectall" id="selectall">-->
                  <!--</th>-->
                </tr>
              </thead>
              <tbody>
                  <?php
                  use Carbon\Carbon;
                  ?>

                @isset($bookings)
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ ucfirst(@$booking->first_name) .' '. ucfirst(@$booking->middle_name).' '. ucfirst(@$booking->last_name) }}</td>

                            <td>{{ ucfirst(@$booking->trip->title) }}</td>
                            <td>{{ (@$booking->created_at->diffForHumans())}}</td>
                            <td>{{ @$booking->adults+$booking->childs+$booking->infants }}</td>
                            <td>{{ @$booking->adults }}</td>
                            <td>{{ @$booking->childs }}</td>
                            <td>{{ @$booking->infants }}</td>
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

                $('.to-trip').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });

                $(document).on('click', '.delete-trip', function(e) {
                   e.preventDefault();
                    var myAction = "{{route('trip.destroy', 'id')}}"
                    var productId = $(this).data('id');
                    myAction = myAction.replace('id', productId);
                    $('.delete-form').attr('action', myAction);
                    let clicked = confirm('Are You Sure Want To Delete Trip !');

                if (clicked) {
                    $('.delete-form').submit();
                }
});
</script>
@endsection
