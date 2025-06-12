(function ($) {
    "use strict";

    //Hide Loading Box (Preloader)
    function handlePreloader() {
        if ($(".preloader").length) {
            $(".preloader").delay(200).fadeOut(500);
        }
    }

    //Submenu Dropdown Toggle
    if ($(".main-header li.dropdown ul").length) {
        $(".main-header li.dropdown").append(
            '<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>'
        );

        //Dropdown Button
        $(".main-header li.dropdown .dropdown-btn").on("click", function () {
            $(this).prev("ul").slideToggle(500);
        });

        //Disable dropdown parent link
        $(
            ".main-header .navigation li.dropdown > a,.hidden-bar .side-menu li.dropdown > a"
        ).on("click", function (e) {
            e.preventDefault();
        });
    }

    //Update Header Style and Scroll to Top
    function headerStyle() {
        if ($(".main-header").length) {
            var windowpos = $(window).scrollTop();
            var siteHeader = $(".main-header");
            var scrollLink = $(".scroll-to-top");
            var sticky_header = $(".main-header .sticky-header");
            if (windowpos > 100) {
                siteHeader.addClass("fixed-header");
                sticky_header.addClass("animated slideInDown");
                scrollLink.fadeIn(300);
            } else {
                siteHeader.removeClass("fixed-header");
                sticky_header.removeClass("animated slideInDown");
                scrollLink.fadeOut(300);
            }
        }
    }

    headerStyle();

    //Hidden Sidebar
    if ($(".hidden-bar").length) {
        var hiddenBar = $(".hidden-bar");
        var hiddenBarOpener = $(".nav-toggler");
        var hiddenBarCloser = $(".hidden-bar-closer");
        $(".hidden-bar-wrapper").mCustomScrollbar();

        //Show Sidebar
        hiddenBarOpener.on("click", function () {
            hiddenBar.addClass("visible-sidebar");
        });

        //Hide Sidebar
        hiddenBarCloser.on("click", function () {
            hiddenBar.removeClass("visible-sidebar");
        });
    }

    //Hidden Bar Menu Config
    function hiddenBarMenuConfig() {
        var menuWrap = $(".hidden-bar .side-menu");
        // appending expander button
        menuWrap
            .find(".dropdown")
            .children("a")
            .append(function () {
                return '<button type="button" class="btn expander"><i class="icon fa fa-angle-right"></i></button>';
            });
        // hidding submenu
        menuWrap.find(".dropdown").children("ul").hide();
        // toggling child ul
        menuWrap.find(".btn.expander").each(function () {
            $(this).on("click", function () {
                $(this)
                    .parent() // return parent of .btn.expander (a)
                    .parent() // return parent of a (li)
                    .children("ul")
                    .slideToggle();

                // adding class to expander container
                $(this).parent().toggleClass("current");
                // toggling arrow of expander
                $(this).find("i").toggleClass("fa-angle-right fa-angle-down");

                return false;
            });
        });
    }

    hiddenBarMenuConfig();

    //Mobile Nav Hide Show
    if ($(".mobile-menu").length) {
        $(".mobile-menu .menu-box").mCustomScrollbar();

        var mobileMenuContent = $(".main-header .nav-outer .main-menu").html();
        $(".mobile-menu .menu-box .menu-outer").append(mobileMenuContent);
        $(".sticky-header .main-menu").append(mobileMenuContent);

        //Dropdown Button
        $(".mobile-menu li.dropdown .dropdown-btn").on("click", function () {
            $(this).toggleClass("open");
            $(this).prev("ul").slideToggle(500);
        });
        //Menu Toggle Btn
        $(".mobile-nav-toggler").on("click", function () {
            $("body").addClass("mobile-menu-visible");
        });

        //Menu Toggle Btn
        $(".mobile-menu .menu-backdrop,.mobile-menu .close-btn").on(
            "click",
            function () {
                $("body").removeClass("mobile-menu-visible");
            }
        );
    }

    //Parallax Scene for Icons
    if ($(".parallax-scene-1").length) {
        var scene = $(".parallax-scene-1").get(0);
        var parallaxInstance = new Parallax(scene);
    }
    if ($(".parallax-scene-2").length) {
        var scene = $(".parallax-scene-2").get(0);
        var parallaxInstance = new Parallax(scene);
    }
    if ($(".parallax-scene-3").length) {
        var scene = $(".parallax-scene-3").get(0);
        var parallaxInstance = new Parallax(scene);
    }

    //Fact Counter + Text Count
    if ($(".count-box").length) {
        $(".count-box").appear(
            function () {
                var $t = $(this),
                    n = $t.find(".count-text").attr("data-stop"),
                    r = parseInt($t.find(".count-text").attr("data-speed"), 10);

                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: $t.find(".count-text").text(),
                    }).animate(
                        {
                            countNum: n,
                        },
                        {
                            duration: r,
                            easing: "linear",
                            step: function () {
                                $t.find(".count-text").text(
                                    Math.floor(this.countNum)
                                );
                            },
                            complete: function () {
                                $t.find(".count-text").text(this.countNum);
                            },
                        }
                    );
                }
            },
            { accY: 0 }
        );
    }

    //Progress Bar
    if ($(".progress-line").length) {
        $(".progress-line").appear(
            function () {
                var el = $(this);
                var percent = el.data("height");
                $(el).css("height", percent + "%");
            },
            { accY: 0 }
        );
    }

    //Tabs Box
    if ($(".tabs-box").length) {
        $(".tabs-box .tab-buttons .tab-btn").on("click", function (e) {
            e.preventDefault();
            var target = $($(this).attr("data-tab"));

            if ($(target).is(":visible")) {
                return false;
            } else {
                target
                    .parents(".tabs-box")
                    .find(".tab-buttons")
                    .find(".tab-btn")
                    .removeClass("active-btn");
                $(this).addClass("active-btn");
                target
                    .parents(".tabs-box")
                    .find(".tabs-content")
                    .find(".tab")
                    .fadeOut(0);
                target
                    .parents(".tabs-box")
                    .find(".tabs-content")
                    .find(".tab")
                    .removeClass("active-tab");
                $(target).fadeIn(300);
                $(target).addClass("active-tab");
            }
        });
    }

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

    if ($(".paroller").length) {
        $(".paroller").paroller({
            factor: 0.2, // multiplier for scrolling speed and offset, +- values for direction control
            factorLg: 0.4, // multiplier for scrolling speed and offset if window width is less than 1200px, +- values for direction control
            type: "foreground", // background, foreground
            direction: "horizontal", // vertical, horizontal
        });
    }

    // Single Item Carousel
    if ($(".single-item-carousel").length) {
        $(".single-item-carousel").owlCarousel({
            //animateOut: 'fadeOut',
            //animateIn: 'fadeIn',
            loop: true,
            margin: 0,
            nav: true,
            smartSpeed: 500,
            autoplay: 6000,
            navText: [
                '<span class="fa fa-angle-left"></span>',
                '<span class="fa fa-angle-right"></span>',
            ],
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                800: {
                    items: 1,
                },
                1024: {
                    items: 1,
                },
                1200: {
                    items: 1,
                },
                1500: {
                    items: 1,
                },
            },
        });
    }

    // Single Item Carousel
    if ($(".banner-carousel").length) {
        $(".banner-carousel").owlCarousel({
            //animateOut: 'fadeOut',
            //animateIn: 'fadeIn',
            loop: true,
            margin: 0,
            nav: true,
            autoHeight: true,
            smartSpeed: 500,
            autoplayTimeout: 10000,
            autoplay: 6000,
            navText: [
                '<span class="fa fa-angle-left"></span>',
                '<span class="fa fa-angle-right"></span>',
            ],
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                800: {
                    items: 1,
                },
                1024: {
                    items: 1,
                },
                1200: {
                    items: 1,
                },
                1500: {
                    items: 1,
                },
            },
        });
    }

    //Gallery Filters
    if ($(".filter-list").length) {
        $(".filter-list").mixItUp({});
    }

    //LightBox / Fancybox
    if ($(".lightbox-image").length) {
        $(".lightbox-image").fancybox({
            openEffect: "fade",
            closeEffect: "fade",
            helpers: {
                media: {},
            },
        });
    }

    //Contact Form Validation
    if ($("#contact-form").length) {
        $("#contact-form").validate({
            rules: {
                username: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                phone: {
                    required: true,
                },
                message: {
                    required: true,
                },
            },
        });
    }

    // Scroll to a Specific Div
    if ($(".scroll-to-target").length) {
        $(".scroll-to-target").on("click", function () {
            var target = $(this).attr("data-target");
            // animate
            $("html, body").animate(
                {
                    scrollTop: $(target).offset().top,
                },
                1500
            );
        });
    }

    // Elements Animation
    if ($(".wow").length) {
        var wow = new WOW({
            boxClass: "wow", // animated element css class (default is wow)
            animateClass: "animated", // animation css class (default is animated)
            offset: 0, // distance to the element when triggering the animation (default is 0)
            mobile: true, // trigger animations on mobile devices (default is true)
            live: true, // act on asynchronously loaded content (default is true)
        });
        wow.init();
    }

    /* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */

    $(window).on("scroll", function () {
        headerStyle();
    });

    /* ==========================================================================
   When document is loading, do
   ========================================================================== */

    $(window).on("load", function () {
        handlePreloader();
        enableMasonry();
    });

    //     //hide nav
    //     let lastScrollY = window.scrollY;
    //     $(window).on("scroll", function () {
    //         const navBar = document.getElementById("header-upper");
    //         const currentScrollY = window.scrollY;

    //         if (currentScrollY > lastScrollY) {
    //             // Scrolling down
    //             navBar.classList.add("hidden");
    //         } else {
    //             // Scrolling up
    //             navBar.classList.remove("hidden");
    //         }

    //         lastScrollY = currentScrollY;
    //     });

    // Open video in Fancybox when the button is clicked
    $(document).ready(function () {
        // Attach Fancybox to elements with .open-video
        $(".open-video").on("click", function (e) {
            e.preventDefault(); // Prevent default behavior (e.g., opening a link)

            var filename = $(".open-video").data("video");
            var signedUrl = "/video-url/" + filename; // Backend route to fetch the signed URL

            // Fetch the signed URL dynamically
            $.get(signedUrl, function (data) {
                if (data.url) {
                    console.log("Video URL fetched:", data.url);

                    // Create video content dynamically
                    var videoContent = `<video id="video-player" width="920" height="540" style="background:transparent" controls>
                        <source src="${data.url}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `;

                    // Open Fancybox with the video content
                    $.fancybox.open({
                        src: videoContent, // Pass dynamic video content
                        type: "html",
                        opts: {
                            afterShow: function () {
                                console.log("Video loaded successfully.");
                            },
                            beforeClose: function () {
                                console.log("Closing video modal.");
                            },
                        },
                    });
                } else {
                    console.error("Error: No video URL returned.");
                }
            }).fail(function () {
                console.error("Error fetching the video URL.");
            });
        });
    });

    ////////// dot grow

    gsap.registerPlugin(ScrollTrigger);
    // let section = document.getElementById("section"),
    //     title = document.getElementById("dotimage"),
    //     mark = title.querySelector("span"),
    //     dot = document.querySelector(".dot");

    // gsap.set(dot, {
    //     width: "142vmax", // ensures it fills every part of the screen.
    //     height: "142vmax",
    //     xPercent: -50, // center the dot in the section area
    //     yPercent: -50,
    //     top: "50%",
    //     left: "50%",
    // });

    // let tl1 = gsap.timeline({
    //     scrollTrigger: {
    //         trigger: section,
    //         start: "top top",
    //         end: "bottom top",
    //         markers: false,
    //         scrub: 1.5,
    //         pin: section,
    //         pinSpacing: true,
    //         invalidateOnRefresh: true,
    //     },
    //     defaults: { ease: "none" },
    // });

    // tl1.to(title, { opacity: 1 }).fromTo(
    //     dot,
    //     {
    //         scale: 0,
    //         x: () => {
    //             let markBounds = mark.getBoundingClientRect(),
    //                 px = markBounds.left + markBounds.width * 0.54; // dot is about 54% from the left of the bounds of the character
    //             return px - section.getBoundingClientRect().width / 2;
    //         },
    //         y: () => {
    //             let markBounds = mark.getBoundingClientRect(),
    //                 py = markBounds.top + markBounds.height * 0.73; // dot is about 73% from the top of the bounds of the character
    //             return py - section.getBoundingClientRect().height / 2;
    //         },
    //     },
    //     {
    //         x: 0,
    //         y: 0,
    //         ease: "power3.in",
    //         scale: 1,
    //     }
    // );

    const textElements = gsap.utils.toArray(".text.scrolled-opacity");

    textElements.forEach((text) => {
        console.log(text);
        gsap.to(text, {
            backgroundSize: "100%",
            ease: "none",
            scrollTrigger: {
                trigger: text,
                start: "center 60%",
                end: "center 900%",
                scrub: true,
            },
        });
    });


        $(".open-video-2").fancybox({
            type: "iframe",
            iframe: {
                css: {
                    width: "800px",
                    height: "450px",
                },
                attr: {
                    allowfullscreen: true,
                    autoplay: true,
                },
            },
            buttons: ["close"],
        });


})(window.jQuery);
