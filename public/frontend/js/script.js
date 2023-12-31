$(document).ready(function () {
    // search toggle
    $(".search_button_icon").click(function () {
        $(".search_box").slideToggle("fast");
    });

    // search toggle End

    // Mobile Menu
    $("#menu1").metisMenu();

    $("#close-btn, .hamburger_menu").click(function() {
    $("#mySidenav, body").toggleClass("active");
    });
    // Mobile Menu End

    $('.reviews-main #v-pills-tab button').hover(function() {
        $(this).trigger('click');
      });

    // $('#mySidenav .dropdown .nav-link').removeAttr('href');
    $('#mySidenav .dropdown').hover(function(){
        $('#mySidenav .dropdown-wrapper').toggle();
    });

    // Popular Tours
    $('#popular-tours').owlCarousel({
        loop:true,
        margin:20,
        nav:true,
        dots:true,
        navText : ["<i class='las la-long-arrow-alt-left'></i>","<i class='las la-long-arrow-alt-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })
    // Popular Tours End



    // Popular Tours
    $('#testimonial-wrapper').owlCarousel({
        loop:true,
        margin:20,
        nav:false,
        dots:true,
        navText : ["<i class='las la-long-arrow-alt-left'></i>","<i class='las la-long-arrow-alt-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })
    // Popular Tours End



    // Popular Tours
    $('#special-tours').owlCarousel({
        loop:true,
        margin:20,
        nav:true,
        dots:false,
        navText : ["<i class='las la-long-arrow-alt-left'></i>","<i class='las la-long-arrow-alt-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    })
    // Popular Tours End

    // Travel Package
    $('#travel-package').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        dots:false,
        navText : ["<i class='las la-long-arrow-alt-left'></i>","<i class='las la-long-arrow-alt-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        }
    })
    // Travel Package End

    // Travel Package
    $('#testimonials').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        dots:false,
        navText : ["<i class='las la-long-arrow-alt-left'></i>","<i class='las la-long-arrow-alt-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })
    // Travel Package End


    // Price Filter
    $(".price-filters").ionRangeSlider({
        type: "double",
        min: 0,
        max: 5000,
        from: 700,
        to: 3900,
        grid: true
    });
    // Price Filter End


    // Filter
    $(".m-filter-wrap").click(function () {
        if ($(this).find("ul").hasClass("active")) {
            $(this).find("ul").removeClass("active");
        } else {
            $(".show_hide").removeClass("active");
            $(this).find("ul").addClass("active");
        }
    });
    // Filter End

    // Click Active Color
    $(".filter ul li").click(function () {
        $(event.target).closest(".filter ul li").toggleClass("active");
    });
    // Click Active Color End

    // Scroll Top Js
    $(function () {
        // Scroll Event
        $(window).on("scroll", function () {
            var scrolled = $(window).scrollTop();
            if (scrolled > 600) $(".go-top").addClass("active");
            if (scrolled < 600) $(".go-top").removeClass("active");
        });
        // Click Event
        $(".go-top").on("click", function () {
            $("html, body").animate({ scrollTop: "0" }, 300);
        });
    });

    // Map
    // Map End

    //   Add Remove
    $(document).ready(function () {
        $("#addmore").click(function () {
            $(".datainputs").append(
                '<div class="required_inp"><div class="row"><div class="col-md-6"><div class="form-group"><label>Full Name</label><input name="member_name[]" placeholder="" type="text" class="form-control"></div></div><div class="col-md-6"><label>Email</label><input name="member_email[]" placeholder="" type="email" class="form-control"></div></div>' +
                    '<div class="form-group inputRemove"><label>&nbsp;</label><i class="las la-times-circle"></i></div></div>'
            );
        });
        $("body").on("click", ".inputRemove", function () {
            $(this).parent("div.required_inp").remove();
        });
    });


    // Mobile Filter
    $('.filters-icons').click(function(){
        $('.mobile-only-filter').slideToggle('fast');
    });
    // Mobile Filter End

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 50) {
            $(".middle-header").addClass("darkHeader");
        } else {
            $(".middle-header").removeClass("darkHeader");
        }
    });


    // Add Remove End

    // Gallery
    $(document).ready(function(){
        $('#lightgallery').lightGallery();
    });



    // $(document).ready(function() {
    //   $('.dynamic').on('click', function(e) {
    //       $(document).lightGallery({
    //           dynamic: true,
    //           dynamicEl: [{
    //               src: 'https://megaadventuresintl.com/public/storage/photos/1/MEga Original New/aabbcc image.jpg',
    //               thumb: 'https://megaadventuresintl.com/public/storage/photos/1/MEga Original New/aabbcc image.jpg'
    //           },{
    //               src: 'https://www.megaadventuresintl.com/wp-content/uploads/2018/05/Majh-Gaun-02.jpg',
    //               thumb: 'https://www.megaadventuresintl.com/wp-content/uploads/2018/05/Majh-Gaun-02.jpg',
    //           },{
    //               thumb: 'https://www.megaadventuresintl.com/wp-content/uploads/2018/05/Majh-Gaun-03.jpg',
    //               poster: 'https://www.megaadventuresintl.com/wp-content/uploads/2018/05/Majh-Gaun-03.jpg'
    //           },{
    //               src: 'https://www.megaadventuresintl.com/wp-content/uploads/2018/05/Majh-Gaun-04.jpg',
    //               thumb: 'https://www.megaadventuresintl.com/wp-content/uploads/2018/05/Majh-Gaun-04.jpg'
    //           }]
    //       });
    //   });
    // });
    // Gallery End
});

