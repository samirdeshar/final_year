@include('frontend.layouts.header')
<section id="breadcrumb-singlepage-actvities">
    {{-- <img src="https://www.rupakot.nectar.com.np/templates/images/banner/2.jpg" alt="single-breadcrumb" class="singlebreadcrumb"> --}}
    <div class="container">
        <div class="titlenav-wrapper">
            <h1>Ultra Flights</h1>
            <ul>
                <li><a href="">Home</a>
                </li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                <li><a href="#" class="bread-acti"> Ultra Flights</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="activities-single">
    <div class="container">
        <img src="https://www.rupakot.nectar.com.np/templates/images/banner/2.jpg" alt="single-image">
        <div class="row">
            <div class="col-md-8">
                <h3>Ultra Flights</h3>
               <h4><strong>Ultra light Flights:</strong>&nbsp;<strong>Ultra charms in the sky with the eagles…</strong></h4>
                <p>
                Ultra light aircraft was introduced in Nepal in 1996 and has been offering zipping sky tours in and around Pokhara valley from Pokhara airport. Due to the wonderful proximity of the mountains and the scenic Fewa lake, Pokhara is the appropriate place for this activity as these white pea shaped aircraft share airspace with Himalayan griffin vultures, eagles, kites and float over villages like lazy well fed vultures; the aircraft also fly over monasteries, temples, lakes and jungles with a fantastic view of the regal Himalayas.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="activities-tabs">
    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
              <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
              <button class="nav-link" id="nav-other-tab" data-bs-toggle="tab" data-bs-target="#nav-other" type="button" role="tab" aria-controls="nav-other" aria-selected="false">Disabled</button>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">This is home</div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">This is profile</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">This is contact</div>
            <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-other-tab" tabindex="0">This is others</div>
          </div>
    </div>
</div>

@include('frontend.layouts.footer')
