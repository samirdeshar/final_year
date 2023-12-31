@include('frontend.layouts.header')
<!-- Banner -->

<section id="breadcrumb-singlepage-actvities">
    <div class="container">
        <div class="titlenav-wrapper">
            <h1>{{@$page->title}}</h1>
            <ul>
                <li><a href="{{route('home')}}">Home</a>
                </li>
                <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fa fa-angle-right" aria-hidden="true"></i> Font Awesome fontawesome.com --> </li>
                <li><a href="#" class="bread-acti"> {{@$page->title}}</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- Banner End -->


<!-- Other Content -->
<section class="other-content mb mt">
    <div class="container">
       <div class="general_page_content">
            {{-- <div>{!!@$page->description !!}</div> --}}
            <div class="row">
                <div class="col-md-9">
                    @if($page->slug == 'message-from-executive-chairman')
                    <div class="img-frame">
                        <h2 style="position: absolute;
                        right: 3%;
                        top: 14%;
                        background: #f7bb06;
                        width: 49%;
                        height: 127px;
                        padding: 14px 0 14px 66px;">Rishi Ram Dhamala <span style="font-size: 20px;">rishi@rupakottravels.com</span></h2>
                    <div>{!!@$page->description !!}</div>
                    </div>
                    @else
                    <div>{!!@$page->description !!}</div>
                    @endif

                </div>
                <div class="col-md-3">
                    <div class="aside-menubar">
                        <h3>Popular Destinations</h3>
                        <ul>

                        </ul>
                    </div>
                </div>

            </div>
       </div>
    </div>
</section>
<!-- Other Content End -->


@if($page->slug == 'message-from-executive-chairman')
    <style>
        .img-frame{
            position: relative;
        }


/* border-width: 2px;
    float: left;
    height: 300px;
    margin: 4px;
    width: 420px;
    object-fit: cover;
    object-position: top; */

/*
    .img-frame:before {
    position: absolute;
    height: 31%;
    width: 49%;

    background: #2d5d73;
    content: "";
    z-index: -9;
    top: -1%;
    right: 50%;

    -webkit-clip-path: polygon(0% 0%, 82% 0%, 100% 116%, 0% 100%);
    clip-path: polygon(0% 0%, 82% 0%, 100% 116%, 0% 100%);
} */
/* .img-frame img {

    top: 20%;

    -webkit-clip-path: polygon(0% 0%, 70% 0%, 96% 100%, 0% 100%);
    clip-path: polygon(0% 0%, 76% 0%, 100% 100%, 0% 101%);
    margin-top: 130px; */



/* final-change */
.img-frame:before {
    position: absolute;
    height: 34%;
    width: 53%;
    background: #2d5d73;
    content: "";
    z-index: -9;
    top: -1%;
    right: 42%;

    -webkit-clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);

    clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);
}



    .img-frame img {
        border-width: 0 ! important;
    float: left ! important;
    height: 350px ! important;
    margin: 4px ! important;
    width: 469px ! important;
    object-fit: cover ! important;
    object-position: top ! important;

    top: 20%;
    margin-top: 130px;
    -webkit-clip-path: polygon(0 0, 100% 0, 80% 100%, 0% 100%);
    clip-path: polygon(0 0, 100% 0, 86% 100%, 0% 100%);
}
.img-frame p:nth-child(11){
    margin-top: 71px;
}
/* p-tag */
/* margin-top: 79px; */


    </style>
@endif


@include('frontend.layouts.footer')
