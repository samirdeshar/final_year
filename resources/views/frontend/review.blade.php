@include('frontend.layouts.header')
<style>
    .rating {
    direction: rtl;
    unicode-bidi: bidi-override;
    text-align: center;
  }

  .rating input {
    display: none;
  }

  .rating label {
    display: inline-block;
    color: gray;
    cursor: pointer;
    font-size: 24px;
  }

  .rating label:hover,
  .rating label:hover ~ label,
  .rating input:checked ~ label {
    color: orange;
  }

</style>
<!-- Banner -->
<section class="banner">
    <img src="{{asset('uploads/8063997620_e476cbec93_o-e1491468742178-1920x320.jpg')}}" alt="banner">
    <div class="container">
        <div class="banner-info">
            <h1>Review</h1>
        </div>
    </div>
</section>
<!-- Banner End -->

<!--Form Page -->
<section class="form-page mt mb">
    @include('frontend.message')
    <div class="container">
        <div class="booking-page-head">
            <h3> {{@$trip->title}} </h3>
            <p>
                Write Your Review:
            </p>
        </div>
        {{ Form::open(['url'=>route('store.review',@$trip->slug),'files'=>true])}}
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="form_page_col">
                        @method('put')
                            <div class="form-group_list">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title:</label>
                                            <select name="title" id="title" class="form-control">
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Ms.">Ms.</option>
                                            </select>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name:</label>
                                            <input type="text" name="full_name"  class="form-control" required >
                                            @error('full_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Company Name:</label>
                                                <input type="text" class="form-control" name="company_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"> 
                                        <div class="form-group">
                                            <label for="review_title">Review Title:</label>
                                            <input type="text" class="form-control" name="review_title">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Review:</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Rating</label>
                                            <div class="rating">
                                                <input type="radio" id="star5" name="rating" value="5" />
                                                <label for="star5" title="5 stars">&#9733;</label>
                                                <input type="radio" id="star4" name="rating" value="4" />
                                                <label for="star4" title="4 stars">&#9733;</label>
                                                <input type="radio" id="star3" name="rating" value="3" />
                                                <label for="star3" title="3 stars">&#9733;</label>
                                                <input type="radio" id="star2" name="rating" value="2" />
                                                <label for="star2" title="2 stars">&#9733;</label>
                                                <input type="radio" id="star1" name="rating" value="1" />
                                                <label for="star1" title="1 star">&#9733;</label>
                                              </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                    <label for="captcha"> CAPTCHA </label>
                                    <div class="g-recaptcha" data-sitekey="6Lfs9jomAAAAAAaejaP35DT_aRWtOcaTIIRD3hYb"></div>
                                    @error('g-recaptcha-response')
                                        <span class="text-danger"> The reCAPTCHA was invalid. Go back and try it again.
                                        </span>
                                    @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div >
                                            <div class="books-btns">
                                                <button type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

            </div>
        {{Form::close()}}
    </div>
</section>
<!--Form Page End -->


 <script>
    setTimeout(function(){
    $('.alert').slideUp();
    }, 3000);
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
  var ratingInputs = document.querySelectorAll('.rating input');

  function handleFormSubmit(event) {
    event.preventDefault();

    var selectedRating = document.querySelector('.rating input:checked').value;
    // Perform further actions with the selected rating value
    console.log("Selected rating: " + selectedRating);
  }

  for (var i = 0; i < ratingInputs.length; i++) {
    ratingInputs[i].addEventListener('change', handleFormSubmit);
  }

});
</script>
@include('frontend.layouts.footer')
