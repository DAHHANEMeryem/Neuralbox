
// const { start } = require("alpinejs");
(function ($) {
    ("use strict");

    $(document).ready(function () {
        gsap.registerPlugin(ScrollTrigger);
        $(".section-header").on("click", function (element) {
            const content = element.target.nextElementSibling;
            const arrow = element.target.querySelector(".arrow-icon");

            // Toggle class open
            content.classList.toggle("open");

            // Toggle arrow
            if (content.classList.contains("open")) {
                arrow.innerHTML = "&#9660;"; // 🔼 لفوق = مسدود
            } else {
                arrow.innerHTML = "&#9650;"; // 🔽 لتحت = مفتوح
            }
        });
        
        // Show the popup when any .disabled-link is clicked
        $(".disabled-link").on("click", function (event) {
            $("#popup-payment").css("display", "flex");
        });
        $("#popup-payment .close, .popup-overlay").on(
            "click",
            function (event) {
                $("#popup-payment").css("display", "none");
            }
        );
        // $(".disabled-payment").on("click", function (event) {
        //     $("#popup-login").css("display", "flex");
        // });

        // $("#popup-login .close, .popup-overlay").on("click", function (event) {
        //     $("#popup-login").css("display", "none");
        // });
        // $(".popup-overlay >*").on("click", function (event) {
        //     event.preventDefault();
        // });
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

        $(".slick-carousel").slick({
            centerMode: false,
            centerPadding: "60px",
            slidesToShow: 4,
            rtl: true,
            arrows: true,
            infinite: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        centerPadding: "20px",
                    },
                },
            ],
        });
        const cards = document.querySelectorAll(".slide-card");

        cards.forEach((card, i) => {
            card.addEventListener("mouseenter", () => {
                gsap.to(card, {
                    scale: 1.3,
                    duration: 0.3,
                    zIndex: 10,
                    overwrite: true,
                });

                cards.forEach((otherCard, j) => {
                    if (otherCard !== card) {
                        const offset = j < i ? 50 : -50; // shift left or right
                        gsap.to(otherCard, {
                            x: offset,
                            duration: 0.3,
                            scale: 1,
                            zIndex: 1,
                            overwrite: true,
                        });
                    }
                });
            });

            card.addEventListener("mouseleave", () => {
                gsap.to(cards, {
                    x: 0,
                    scale: 1,
                    zIndex: 1,
                    duration: 0.3,
                    clearProps: "all",
                    overwrite: true,
                });
            });
        });

        // Video carousel
        $(".video-carousel").slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            autoplay: false,
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

        //Masonary
        // function enableMasonry() {
        //     if ($(".masonry-items-container").length) {
        //         var winDow = $(window);
        //         // Needed variables
        //         var $container = $(".masonry-items-container");

        //         $container.isotope({
        //             itemSelector: ".masonry-item",
        //             masonry: {
        //                 columnWidth: ".masonry-item.col-lg-6",
        //             },
        //             animationOptions: {
        //                 duration: 500,
        //                 easing: "linear",
        //             },
        //         });

        //         // GSAP animation after Isotope layout is complete
        //         $container.on("arrangeComplete", function () {
        //             gsap.fromTo(
        //                 ".masonry-item",
        //                 { opacity: 0, y: 50 },
        //                 {
        //                     opacity: 1,
        //                     y: 0,
        //                     duration: 0.6,
        //                     stagger: 0.1,
        //                     ease: "power2.out",
        //                 }
        //             );
        //         });

        //         winDow.bind("resize", function () {
        //             $container.isotope({
        //                 itemSelector: ".masonry-item",
        //                 animationOptions: {
        //                     duration: 500,
        //                     easing: "linear",
        //                     queue: false,
        //                 },
        //             });
        //         });
        //     }
        // }

        // enableMasonry();
    });

    $(window).on("load", function () {
        function enableMasonry() {
            if ($(".masonry-items-container").length) {
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

                // The GSAP animation is now tied to a reliable layout event
                // $container.on("arrangeComplete", function () {
                //     gsap.fromTo(
                //         ".masonry-item",
                //         { opacity: 0, y: 50 },
                //         {
                //             opacity: 1,
                //             y: 0,
                //             duration: 0.6,
                //             stagger: 0.1,
                //             ease: "power2.out",
                //         }
                //     );
                // });

                $(window).bind("resize", function () {
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
    });

    // Observe DOM for dynamically added .masonry-items-container
    const observeMasonry = () => {
        const observer = new MutationObserver((mutationsList, observer) => {
            if (document.querySelector(".masonry-items-container")) {
                enableMasonry();
                observer.disconnect(); // Only need to run once
            }
        });
        observer.observe(document.body, { childList: true, subtree: true });
    };
    // If not present at load, set up observer
    if (!document.querySelector(".masonry-items-container")) {
        observeMasonry();
    }
    function closePopup() {
        const modal = document.getElementById("shareModal");
        if (modal) {
            const modalContent = modal.querySelector(".share-modal-content");
            if (modalContent) {
                modalContent.classList.add("fade-out");

                setTimeout(function () {
                    modal.style.display = "none";
                    modalContent.classList.remove("fade-out");
                }, 300);
            } else {
                modal.style.display = "none";
            }
        }
    }

    gsap.from(".coach-card", {
        opacity: 0,
        y: 50,
        scale: 0.9,
        duration: 0.8,
        ease: "power3.out",
        stagger: 0.2,
        scrollTrigger: {
            trigger: ".coach-card",
            start: "top 90%",
            toggleActions: "play none none none",
        },
    });

    if (typeof gsap !== "undefined" && typeof ScrollTrigger !== "undefined") {
        // Animate title and description on scroll
        gsap.to(".hero-title-animated", {
            scrollTrigger: {
                trigger: ".hero-title-animated",
                start: "top 80%",
                toggleActions: "play none none none",
            },
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 1.2,
            ease: "power2.out",
            overwrite: true,
        });

        gsap.to(".hero-description", {
            scrollTrigger: {
                trigger: ".hero-description",
                start: "top 85%",
                scrub: true,
                toggleActions: "play none none none",
            },
            opacity: 1,
            y: 0,
            scale: 1,

            duration: 1.2,
            ease: "power2.out",
            overwrite: true,
        });

        // Video reveal and playback using ScrollTrigger
        const videoWrapper = document.querySelector(".video-wrapper");
        const video = document.getElementById("about-hero-video");

        if (videoWrapper && video) {
            // Animate video wrapper opacity
            gsap.fromTo(
                videoWrapper,
                {
                    opacity: 0,
                },
                {
                    opacity: 1,
                    duration: 0.5,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: videoWrapper,
                        start: "top 70%",
                        end: "bottom 20%",
                        toggleActions: "play reverse play reverse",

                        onEnter: () => {
                            video.play().catch(() => {});
                            video.removeAttribute("muted");
                        },
                        onLeaveBack: () => {
                            video.pause();
                            video.setAttribute("muted", "");
                        },
                        onLeave: () => {
                            video.setAttribute("muted", "");
                            video.pause();
                        },
                        onEnterBack: () => {
                            video.removeAttribute("muted");
                            video.play().catch(() => {});
                        },
                    },
                }
            );
        }
    }
} ( jQuery ) );