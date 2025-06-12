
// const { start } = require("alpinejs");
(function ($) {
    ("use strict");

    $(document).ready(function () {
        

        // Handle hover effects for video playback
        //   document.querySelectorAll('.video-card video').forEach(video => {
        //     video.addEventListener('mouseenter', () => {
        //       video.play();
        //     });
        //     video.addEventListener('mouseleave', () => {
        //       video.pause();
        //       video.currentTime = 0;
        //       video.load(); // Reset to show poster
        //     });
        //   });

        // Classes carousel
        $(".classes-carousel").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false,
                    },
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ],
        });

        // Blog carouse - blog.html
        $(".blog-carousel").slick({
            slidesToShow: 1,
            infinite: true,
            slidesToScroll: 1,
            autoplay: true,
            dots: false,
            arrows: true,
            autoplaySpeed: 2000,
        });

        // Classes carousel in the sidebar - class-single.html
        $(".classes-section-sidebar").slick({
            slidesToShow: 1,
            infinite: true,
            slidesToScroll: 1,
            autoplay: true,
            dots: true,
            arrows: true,
            autoplaySpeed: 2000,
        });

        /**
         * Responsive Mobile Menu
         */
        $(".menu-btn").on("click", function () {
            $(this).toggleClass("active");
            $(".responsive-menu").toggleClass("active");
            $("body").toggleClass("scroll-hide");
        });

        $(".responsive-menu ul ul").parent().addClass("menu-item-has-children");
        $(".responsive-menu ul li.menu-item-has-children > a").on(
            "click",
            function () {
                $(this)
                    .parent()
                    .toggleClass("active")
                    .siblings()
                    .removeClass("active");
                $(this).next("ul").slideToggle();
                $(this).parent().siblings().find("ul").slideUp();
                return false;
            }
        );

        /**
         * AJAX Contact Form Script
         * Working Contact Form
         */
        if ($("#contact-form").length) {
            $("#submit").on("click", function () {
                var o = new Object();
                var form = "#contact-form";
                var name = $("#contact-form .name").val();
                var email = $("#contact-form .email").val();

                if (name == "" || email == "") {
                    $("#contact-form .response").html(
                        '<div class="failed">Please fill the required fields.</div>'
                    );
                    return false;
                }

                $.ajax({
                    url: "mail.php",
                    method: "POST",
                    data: $(form).serialize(),
                    beforeSend: function () {
                        $("#contact-form .response").html(
                            '<div class="text-info"><img src="assets/img/preloader.gif" alt="Loading..."> Loading...</div>'
                        );
                    },
                    success: function (data) {
                        $("form").trigger("reset");
                        $("#contact-form .response").fadeIn().html(data);
                        setTimeout(function () {
                            $("#contact-form .response").fadeOut("slow");
                        }, 5000);
                    },
                    error: function () {
                        $("#contact-form .response").fadeIn().html(data);
                    },
                });
            });
        }

        /**
         * Back to top button
         */
        $(".back-to-top").on("click", function () {
            scrollTo({ top: 0, behavior: "smooth" });
        });
    });

    //Masonary
    function enableMasonry() {
        if ($(".masonry-items-container").length) {
            var winDow = $(window);
            // Needed variables
            var $container = $(".masonry-items-container");

            $container.isotope({
                itemSelector: ".masonry-item",
                masonry: {
                    columnWidth: ".masonry-item.col-lg-6",
                },
                animationOptions: {
                    duration: 500,
                    easing: "linear",
                },
            });

            // GSAP animation after Isotope layout is complete
            $container.on("arrangeComplete", function () {
                gsap.fromTo(
                    ".masonry-item",
                    { opacity: 0, y: 50 },
                    {
                        opacity: 1,
                        y: 0,
                        duration: 0.6,
                        stagger: 0.1,
                        ease: "power2.out",
                    }
                );
            });
            
            winDow.bind("resize", function () {
                $container.isotope({
                    itemSelector: ".masonry-item",
                    animationOptions: {
                        duration: 500,
                        easing: "linear",
                        queue: false,
                    },
                });
            });
        }
    }

    enableMasonry();
} ( jQuery ) );