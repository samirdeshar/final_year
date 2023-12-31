

@extends('layouts.backend_layout.template')


@section('title','Admin || Trip')

@section('backend-css')
  <style>
  .drop-hover:hover{
    color: black !important;
  }
  </style>


@endsection

@section('main-content')

<div class="pagetitle">
    <h1>Products</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Trip List</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title" style="float">Trip List</h5>

            <p>All Trip Listed Here.....</p>

            <div>
              {{-- -------------------Status Drop Down----------------- --}}
              <!-- Example single danger button -->
                
              {{-- -------------------Status Drop Down----------------- --}}

              {{-- -------------------Action Drop Down----------------- --}}
              <!-- Example single danger button -->
              
            <!-- Table with stripped rows -->
            <form action="{{ route('to-trip')}}" method="post" id="full-form">
              <input type="text" hidden name="multiple_action" id="multiple_action">
              @csrf
            <table class="table ">

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Image</th>
                  <th scope="col">Status</th>
                  <th scope="col">Created Date</th>
                </tr>
              </thead>
              <tbody id="tablecontents">

                @isset($trips)
                    @foreach($trips as $post)
                        <tr class="row1" data-id="{{ $post->id}}">
                            <td>{{ $n++ }}</td>
                            <td>{{ ucfirst($post->title) }}</td>
                            <td>
                                @if($post->banner_image && $post->banner_image !=null)
                                    <a href="{{ asset(@$post->banner_image)}}" data-lightbox="image-{{$post->id}}" data-title="{{ ucfirst($post->title)}}">
                                        View
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('trip-update-status',[$post->id,$post->status])}}">
                                    <span class="badge rounded-pill bg-{{ ($post->status=='active')?'success':'danger'}}"><i class="bi {{ ($post->status=='active')?'bi-check-circle me-1 ':'bi-exclamation-octagon me-1'}} "></i> {{ ucfirst($post->status)}}</span>
                                </a>
                            </td>
                            <td>{{ date('Y/m/d',strtotime($post->created_at)) }}</td>
                            

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
                url: "{{ route('updateTripcategoryTripPosition') }}",
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
