@include('frontend.layouts.header')

<!-- Banner -->
<section class="banner">
    <img src="{{asset(@$meta->banner_image)}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>{{ucfirst(strtolower(@$meta->page_title))}}</h1>
            <span>
                {{$meta->content}}
            </span>
        </div>
    </div>
</section>
<!-- Banner End -->
<section class="special-trip listing-page pt pb">
    <div class="container">
        <div class="row" id="cybercast-display">

    </div>
</section>
@include('frontend.layouts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
   <script>
    loadMore();
    function loadOnClick(){
        $('.load-button').on('click', function(){
            let id = $(this).data("last_id");
            $(this).remove();
            loadMore(id);
        });
    }
    function loadMore(id=null){
        let url = "";
        if(id==null){
            url = '{{ route('frontend.tripDispatch')}}';
        }else{
            url = '/get/trip-daily-dispatch/'+id;
        }
        $.ajax({
            type: 'get',
            url: url,
            success: function(response) {
                $('#cybercast-display').append(response);
                loadOnClick();
            },
            error : function(error){
                console.log(error);
            }
        });
    }
</script>
