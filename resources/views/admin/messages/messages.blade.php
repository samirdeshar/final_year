@extends('layouts.backend_layout.template')


@section('title','Admin || message')

@section('backend-css')

  <style>
  .drop-hover:hover{
    color: black !important;
  }
  </style>


@endsection

@section('main-content')

<div class="pagetitle">
    <h1>messages</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">message List</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title" style="float">messages List</h5>

            <p>All message Listed Here.....</p>

            <div>

              {{-- -------------------Action Drop Down----------------- --}}
              <!-- Example single danger button -->
              <div class="btn-group " style="float:right;margin-right:10px;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Action
                </button>
                <ul class="dropdown-menu bg-danger ">
                  <li>
                      <a href="javascript:void(0);" class="dropdown-item text-white drop-hover to-perform-message" data-multiple_action="delete">
                        <i class="bi bi-trash"></i>
                          Delete
                      </a>
                  </li>
                </ul>
              </div>
              {{-- -------------------Action Drop Down----------------- --}}
            </div>
            <!-- Table with stripped rows -->
            {{-- <form action="{{route('message.deleteBulk')}}" method="post" id="full-form"> --}}
              <input type="text" hidden name="multiple_action" id="multiple_action">
              @csrf
            <table class="table ">

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Message</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Action</th>
                  <th>
                    <input type="checkbox" name="selectall" id="selectall">
                  </th>
                </tr>
              </thead>
              <tbody>

                @isset($messages)
                    @foreach($messages as $message)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ ucfirst($message->first_name).' '.ucfirst($message->last_name) }}</td>
                            <td> {{Str::limit($message->message, 40, $end='......')}} </td>
                            <td>{{ date('Y/m/d',strtotime($message->created_at)) }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary fa fa-eye" data-toggle="modal" data-target="#exampleModalCenter{{$message->id}}"></a>




                                <div class="modal fade" id="exampleModalCenter{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">{{$message->full_name}}</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          Contact: {{$message->contact}}
                                          <hr>
                                          {{$message->message}}
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>


                                <a href="javascript:;" data-id="{{ $message->id }}" class="btn btn-sm btn-danger btn-style delete-message">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                            <td>
                              <input type="checkbox" name="selects[]" class="select" value="{{$message->id}}">
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

  {{-- -------------------------------Message------------------- --}}
  <!-- Modal -->
  {{-- --------------------------Message------------------- --}}

@endsection

@section('backend-js')



<script>

                $('#selectall').click(function() {
                    $('input:checkbox').prop('checked', this.checked);
                });

                $('.to-perform-message').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });

                $(document).on('click', '.delete-message', function(e) {
                   e.preventDefault();
                    var myAction = "{{route('all-messages.destroy', 'contcatValue')}}"
                    var messageId = $(this).data('id');
                    myAction = myAction.replace('contcatValue', messageId);
                    $('.delete-form').attr('action', myAction);
                    let clicked = confirm('Are You Sure Want To Delete message !');

                if (clicked) {
                    $('.delete-form').submit();
                }
});
</script>
@endsection
