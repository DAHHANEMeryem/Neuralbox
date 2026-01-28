
// const { start } = require("alpinejs");



$(document).ready(function () {

        const $spinner = $("#global-spinner");
        
        // const content = document.querySelector('main-section');
        
        // content.classList.remove('hidden');
        
        $spinner.css('display','none');

        function setupVideoModal({
            videoPlayerSelector = "#video-player",
            triggerSelector = ".play-video",
            modalSelector = "#exampledsModal",
        } = {}) {
            const videoPlayer = document.querySelector(videoPlayerSelector);
            const videoModalElement = document.querySelector(modalSelector);

            let hls = null;

            if (!videoPlayer || !videoModalElement) return;

            document.querySelectorAll(triggerSelector).forEach(function (el) {
                el.addEventListener("click", function (e) {
                    e.preventDefault();

                    const videoSrc = this.getAttribute("data-video-url");
                    if (!videoSrc) return;

                    videoPlayer.pause();
                    videoPlayer.removeAttribute("src");
                    if (hls) {
                        hls.destroy();
                        hls = null;
                    }

                    if (window.Hls && Hls.isSupported()) {
                        hls = new Hls();
                        hls.loadSource(videoSrc);
                        hls.attachMedia(videoPlayer);
                        hls.on(Hls.Events.MANIFEST_PARSED, function () {
                            videoPlayer.play();
                        });
                    } else {
                        videoPlayer.src = videoSrc;
                        videoPlayer.play();
                    }
                    if (this.classList.contains("ignite"))
                        this.classList.add("hidden");
                });
            });

            videoModalElement.addEventListener("hidden.bs.modal", function () {
                videoPlayer.pause();
                videoPlayer.currentTime = 0;
                videoPlayer.removeAttribute("src");
                if (hls) {
                    hls.destroy();
                    hls = null;
                }
            });
        }

        // Example usage:
        setupVideoModal({
            videoPlayerSelector: "#video-player",
            triggerSelector: ".play-video",
            modalSelector: "#exampledsModal",
        });

        gsap.registerPlugin(ScrollTrigger);
        if (
            typeof gsap !== "undefined" &&
            typeof ScrollTrigger !== "undefined"
        ) {
            // 1. Target all elements with the specific animation class or data attribute
            const $animatedElements = $(
                ".gsap-anim-target, .main-timeline5 .timeline-icon, .main-timeline5 .timeline-content"
            );

            // 2. Loop through each element using jQuery's .each()
            $animatedElements.each(function (index) {
                const $element = $(this);
                const element = this; // Get the native DOM element for GSAP

                // Get animation type from a data attribute or hardcoded for timeline elements
                let animType = $element.data("animation");

                // Default animation logic for timeline components
                if ($element.hasClass("timeline-icon")) {
                    animType = "zoom-in";
                } else if ($element.hasClass("timeline-content")) {
                    // Determine slide direction based on index (even = right side, odd = left side)
                    animType = index % 2 === 0 ? "slide-right" : "slide-left";
                }

                // --- Define Start Properties ---
                let startProps = {
                    opacity: 0,
                    duration: 0.8,
                    ease: "power2.out",
                };

                switch (animType) {
                    case "slide-left":
                        startProps.x = 50; // Starts right, slides left
                        break;
                    case "slide-right":
                        startProps.x = -50; // Starts left, slides right
                        break;
                    case "zoom-in":
                        startProps.scale = 0.8;
                        startProps.y = 20;
                        startProps.ease = "back.out(1.2)"; // Bouncy pop
                        break;
                    case "fade-up":
                    default:
                        startProps.y = 30; // Starts 30px below
                        break;
                }

                // --- Apply GSAP with ScrollTrigger ---
                gsap.from(element, {
                    ...startProps,
                    scrollTrigger: {
                        trigger: element,
                        start: "top bottom", // Trigger when the element enters the viewport
                        toggleActions: "play none none none",
                    },
                });
            });

            // 3. Special animation for the main title (always fade-down)
            gsap.from($(".newsz-ltr-text h2").get(0), {
                y: -50,
                opacity: 0,
                duration: 1,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: ".newsletter-section.call",
                    start: "top 80%",
                    toggleActions: "play none none none",
                },
            });
        }

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
        

        $(".abt-carousel").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            focusOnSelect: true,
            centerPadding: "60px",
            centerMode: true,
            speed: 700, // Duration of the slide transition in milliseconds
            cssEase: "ease-in-out",
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        centerPadding: "5px",
                    },
                },
            ],
            // arrows: true,
            dots: true,
            rtl: true,
        });

        $(".slick-carousel").slick({
            centerMode: false,
            centerPadding: "60px",
            slidesToShow: 1,
            rtl: true,
            arrows: true,
            infinite: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
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
        $(".responsive-menu ul li > a").on(
            "click", function () {
                $(".menu-btn").toggleClass("active");
                $(".responsive-menu").toggleClass("active");
            }
        );
        

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

        $(".back-to-top").on("click", function () {
            scrollTo({ top: 0, behavior: "smooth" });
        });

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


    if (typeof gsap !== "undefined" && typeof ScrollTrigger !== "undefined") {
       

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

