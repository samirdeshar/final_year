@extends('layouts.backend_layout.template')


@section('title','Admin || Setting-Form')


@section('main-content')

<div class="pagetitle">
    <h1>Setting Of Your Web</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Setting</li></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->


<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Setting</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Home Page Info</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo-tab-pane" type="button" role="tab" aria-controls="seo-tab-pane" aria-selected="false">SEO Settings</button>
      </li>
</ul>
<div class="tab-content" id="myTabContent">

    {{-- -----------------------Setting------------------------- --}}
    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
        @include('admin.setting.main');
    </div>

    {{-- ---------------------------/Setting----------------------- --}}

    {{-- --------------------------Page Info-------------------------- --}}
    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        @include('admin.setting.pageinfo');
    </div>
    {{-- -------------------------------/Page Info----------------------------- --}}
    {{-- --------------------------SEO Settings-------------------------- --}}
    <div class="tab-pane fade" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">
        @include('admin.setting.seo');
    </div>
    {{-- -------------------------------/SEO Settings----------------------------- --}}


</div>
@endsection

@section('backend-js')

    <script>
      $(document).ready(function(){
        $('#lfm').filemanager('image');
        $('#logo').filemanager('image');
        $('#logo2').filemanager('image');
        $('#logo3').filemanager('image');
        $('#trip_banner_image').filemanager('image');
        $('#mega_banner_image').filemanager('image');
        $('#information_banner_image').filemanager('image');
        $('#adventure_banner_image').filemanager('image');
        $('#certificate_image').filemanager('image');
        $('#payment_image').filemanager('image');
        $('#adventure1_image').filemanager('image');
        $('#outbound_image').filemanager('image');
      });
    </script>
@endsection
