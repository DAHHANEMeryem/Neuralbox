/***************************************************
==================== JS INDEX ======================
****************************************************
01. Preloader
02. Go top Top
03. Offcanvas Menu Control
04. Header Search
05. Header | Home One
06. Header | Home Two
07. Counter Activation
08. Testimonial Slider | Home 1
09. Testimonial Slider | Home 2
10. Team Slider
11. MixitUp activation
12. WOW JS Activation
13. Mobile Menu Activation
14. ProgressBar activation
15. Banner Slider



****************************************************/


(function ($) {
    ("use strict");

    $("#contactForm").submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            url: "send_email.php", // The PHP file that sends the email
            type: "POST",
            data: formData,
            success: function (response) {
                // Handle success response from the PHP file
                if (response == "success") {
                    // Show success message
                    $("#successMessage").fadeIn().delay(3000).fadeOut(); // Show and hide after 3 seconds
                } else {
                    alert("There was an error sending your message.");
                }
            },
            error: function () {
                alert("An error occurred while sending your message.");
            },
        });
    });

    /////////////////////////////////////////////////////
    // 01. Preloader
    var preloader = document.querySelector("#preloader");
    var get_body = document.querySelector("body");

    get_body.onload = function () {
        preloader.style.display = "none";
    };
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 02. Go top Top
    let scroll_top = document.getElementById("scroll_top");

    if (scroll_top) {
        window.onscroll = function () {
            scrollTopFunc();
        };

        function scrollTopFunc() {
            if (
                document.body.scrollTop > 100 ||
                document.documentElement.scrollTop > 100
            ) {
                scroll_top.classList.add("showed");
            } else {
                scroll_top.classList.remove("showed");
            }
        }

        scroll_top.addEventListener("click", function () {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
    }
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 03. Offcanvas Menu Control
    $(".menu_icon").on("click", function () {
        $(".offcanvas__area").addClass("showed");
    });

    $("#offcanvas_close").on("click", function () {
        $(".offcanvas__area").removeClass("showed");
    });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 04. Header Search
    $(".search-icon").on("click", function () {
        $(this).hide();
        $(".search-close").show();
        $(".search__form").addClass("showed");
    });

    $(".search-close").on("click", function () {
        $(this).hide();
        $(".search-icon").show();
        $(".search__form").removeClass("showed");
    });

    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 06.
    var share_btn = document.querySelectorAll(".share-btn");
    var social_share = document.querySelectorAll(".social-share");

    for (let i = 0; i < share_btn.length; i++) {
        share_btn[i].addEventListener("click", function () {
            social_share[i].classList.toggle("active");
        });
    }
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 06. Magnific Popup Activate
    // $(".popup-link")?.magnificPopup({ type: "iframe" });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 07. Counter Activation
    // const counter_1 = window.counterUp.default;
    // const counter_cb = (entries) => {
    //     entries.forEach((entry) => {
    //         const el = entry.target;
    //         if (entry.isIntersecting && !el.classList.contains("is-visible")) {
    //             counter_1(el, {
    //                 duration: 1500,
    //                 delay: 16,
    //             });
    //             el.classList.add("is-visible");
    //         }
    //     });
    // };

    // const counter_1_io = new IntersectionObserver(counter_cb, {
    //     threshold: 1,
    // });

    // const counter_1_els = document.querySelectorAll(".counter_fast");
    // counter_1_els.forEach((el) => {
    //     counter_1_io.observe(el);
    // });

    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 07. Counter Activation
    // const counter_2 = window.counterUp.default;
    // const counter_cb_2 = (entries) => {
    //     entries.forEach((entry) => {
    //         const el = entry.target;
    //         if (entry.isIntersecting && !el.classList.contains("is-visible")) {
    //             counter_2(el, {
    //                 duration: 3000,
    //                 delay: 16,
    //             });
    //             el.classList.add("is-visible");
    //         }
    //     });
    // };

    // const counter_2_io = new IntersectionObserver(counter_cb_2, {
    //     threshold: 1,
    // });

    // const counter_2_els = document.querySelectorAll(".counter_medium");
    // counter_2_els.forEach((el) => {
    //     counter_2_io.observe(el);
    // });

    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 07. Counter Activation
    // const counter_3 = window.counterUp.default;
    // const counter_cb_3 = (entries) => {
    //     entries.forEach((entry) => {
    //         const el = entry.target;
    //         if (entry.isIntersecting && !el.classList.contains("is-visible")) {
    //             counter_3(el, {
    //                 duration: 5000,
    //                 delay: 16,
    //             });
    //             el.classList.add("is-visible");
    //         }
    //     });
    // };

    // const counter_3_io = new IntersectionObserver(counter_cb_3, {
    //     threshold: 1,
    // });

    // const counter_3_els = document.querySelectorAll(".counter_slow");
    // counter_3_els.forEach((el) => {
    //     counter_3_io.observe(el);
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // Progress Bar Activate
    // $(".skill_active").progressBar({
    //     height: "10",
    //     animation: true,
    //     barColor: "#2B4D8E",
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // AOS.init({
    //     once: true,
    //     offset: 200,
    //     duration: 1000,
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 10. Text Slider
    // var text_slider = new Swiper(".textslider__active", {
    //     loop: true,
    //     speed: 7000,
    //     spaceBetween: 0,
    //     autoplay: {
    //         delay: 1,
    //     },
    //     breakpoints: {
    //         640: {
    //             slidesPerView: 1,
    //         },
    //         768: {
    //             slidesPerView: 2,
    //         },
    //         1024: {
    //             slidesPerView: 4,
    //         },
    //     },
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 15. Text Slider
    // var text_slider_2 = new Swiper(".textslider__active-2", {
    //     loop: true,
    //     speed: 3000,
    //     spaceBetween: 30,
    //     slidesPerView: "auto",
    //     autoplay: {
    //         delay: 1,
    //     },
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 10. Text Slider
    // var text_slider = new Swiper(".textslider__active-3", {
    //     spaceBetween: 0,
    //     centeredSlides: true,
    //     speed: 7000,
    //     autoplay: {
    //         delay: 1,
    //         reverseDirection: true,
    //     },
    //     loop: true,
    //     loopedSlides: 4,
    //     slidesPerView: "auto",
    //     allowTouchMove: false,
    //     disableOnInteraction: true,
    //     breakpoints: {
    //         640: {
    //             slidesPerView: 1,
    //         },
    //         768: {
    //             slidesPerView: 2,
    //         },
    //         1024: {
    //             slidesPerView: 4,
    //         },
    //     },
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 15. Text Slider down
    // var text_slider_2 = new Swiper(".textslider__down-2", {
    //     loop: true,
    //     speed: 3000,
    //     spaceBetween: 30,
    //     autoplay: {
    //         delay: 1,
    //     },
    //     breakpoints: {
    //         640: {
    //             slidesPerView: 1,
    //         },
    //         768: {
    //             slidesPerView: 2,
    //         },
    //         1024: {
    //             slidesPerView: 2,
    //         },
    //         1200: {
    //             slidesPerView: 2,
    //         },
    //     },
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 11.
    // var brand_slider = new Swiper(".brand__slider", {
    //     loop: true,
    //     speed: 3000,
    //     spaceBetween: 50,
    //     autoplay: {
    //         delay: 1,
    //     },
    //     breakpoints: {
    //         640: {
    //             slidesPerView: 1,
    //         },
    //         768: {
    //             slidesPerView: 2,
    //         },
    //         1024: {
    //             slidesPerView: 4,
    //         },
    //         1400: {
    //             slidesPerView: 6,
    //         },
    //     },
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 12.
    // var testimonial_slider_3 = new Swiper(".testimonial__slider-3", {
    //     loop: true,
    //     speed: 3000,
    //     spaceBetween: 50,
    //     slidesPerView: 1,
    //     autoplay: {
    //         delay: 1500,
    //     },
    // });

    // var testimonial_five_active = new Swiper(".testimonial-five-active", {
    //     loop: true,
    //     speed: 3000,
    //     spaceBetween: 50,
    //     slidesPerView: 2,
    //     autoplay: {
    //         delay: 1500,
    //     },
    //     breakpoints: {
    //         375: {
    //             slidesPerView: 1,
    //         },
    //         640: {
    //             slidesPerView: 1,
    //         },
    //         734: {
    //             slidesPerView: 1,
    //         },
    //         768: {
    //             slidesPerView: 1,
    //         },
    //         1024: {
    //             slidesPerView: 2,
    //         },
    //         1400: {
    //             slidesPerView: 2,
    //         },
    //     },
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // // 13. Mobile Menu Activation
    // $(".offcanvas-menu").meanmenu({
    //     meanScreenWidth: "1365",
    //     meanMenuContainer: ".offcanvas__menu",
    //     meanMenuCloseSize: "24px",
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 14.
    // var team_slider_3 = new Swiper(".team__slider-3", {
    //     loop: true,
    //     speed: 3000,
    //     spaceBetween: 30,
    //     breakpoints: {
    //         640: {
    //             slidesPerView: 1,
    //         },
    //         768: {
    //             slidesPerView: 2,
    //         },
    //         1000: {
    //             slidesPerView: 3,
    //         },
    //         1300: {
    //             slidesPerView: 4,
    //         },
    //     },
    // });
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // 14.
    // var portfolio_slider_4 = new Swiper(".portfolio__slider-4", {
    //     loop: true,
    //     speed: 3000,
    //     spaceBetween: 30,
    //     breakpoints: {
    //         640: {
    //             slidesPerView: 1,
    //         },
    //         768: {
    //             slidesPerView: 2,
    //         },
    //         1000: {
    //             slidesPerView: 3,
    //         },
    //         1300: {
    //             slidesPerView: 3,
    //         },
    //     },
    // });
    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    gsap.registerPlugin(
        ScrollTrigger
        // ScrollSmoother,
        // TweenMax,
        // ScrollToPlugin,
        // SplitText
    );

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    //nav scroll to
   /* document.querySelectorAll("nav a").forEach((link) => {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Extract the target ID from the href attribute
            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                // Use GSAP's scrollTo to animate scrolling
                gsap.to(window, {
                    duration: 1, // Adjust scroll duration
                    scrollTo: {
                        y: targetElement,
                        offsetY: 70, // Adjust offset if you have a sticky header
                    },
                    ease: "power2.out", // Smooth easing effect
                });
            }
        });
    });*/

    let device_width = window.innerWidth;

    // let skewSetter = gsap.quickTo(".portfolio__item-5 img", "skewY"),
    //   clamp = gsap.utils.clamp(-15, 15);
    // const smoother = ScrollSmoother.create({
    //     smooth: 2,
    //     // effects: device_width < 1025 ? false : true,
    //     effects: true,
    //     smoothTouch: 0.1,
    //     // normalizeScroll: false,
    //     ignoreMobileResize: true,
    //     // onUpdate: (self) => skewSetter(clamp(self.getVelocity() / -80)),
    //     // onStop: () => skewSetter(0),
    // });

    // P Animation
    // let pAnimationLines = gsap.utils.toArray(".p-animation p");

    // pAnimationLines.forEach((pAnimationLine) => {
    //     const tl = gsap.timeline({
    //         scrollTrigger: {
    //             trigger: pAnimationLine,
    //             start: "top 90%",
    //             duration: 2,
    //             end: "bottom 60%",
    //             scrub: false,
    //             markers: false,
    //             toggleActions: "play none none none",
    //         },
    //     });

    //     const pSplitLine = new SplitText(pAnimationLine, { type: "lines" });
    //     gsap.set(pAnimationLine, { perspective: 400 });
    //     pSplitLine.split({ type: "lines" });
    //     tl.from(pSplitLine.lines, {
    //         duration: 1,
    //         delay: 0.3,
    //         opacity: 0,
    //         x: 50,
    //         force3D: true,
    //         transformOrigin: "top center -50",
    //         stagger: 0.1,
    //     });
    // });

    // 25. Title Animation

    // let headingAnimationLines = gsap.utils.toArray(".heading-animation");
    // headingAnimationLines.forEach((headingAnimationLine) => {
    //     const tl = gsap.timeline({
    //         scrollTrigger: {
    //             trigger: headingAnimationLine,
    //             start: "top 90%",
    //             end: "bottom 60%",
    //             scrub: false,
    //             markers: false,
    //             toggleActions: "play none none none",
    //         },
    //     });

    //     const headingSplitLine = new SplitText(headingAnimationLine, {
    //         type: "words",
    //     });
    //     gsap.set(headingAnimationLine, { perspective: 400 });
    //     headingSplitLine.split({ type: "words" });
    //     tl.from(headingSplitLine.words, {
    //         duration: 1,
    //         delay: 0.3,
    //         opacity: 0,
    //         rotationX: -50,
    //         force3D: true,
    //         transformOrigin: "top center -50",
    //         stagger: 0.1,
    //     });
    // });

    // Home 3 Hero shape animaton

    // let home3HeroShape = gsap.timeline();

    // home3HeroShape.from(
    //   ".hero__title-3-wrap .line",
    //   {
    //     xPercent: -100,
    //     duration: 1,
    //   },
    //   "+=1"
    // );

    if ($("#hero_video").length) {
        // Hero Video
        var hero_video = document.querySelector(".hero__video");
        var hero_video_icon = document.querySelector("#hero_video");

        hero_video_icon.addEventListener("click", function (e) {
            e.preventDefault();

            hero_video.classList.toggle("show");
        });
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // gsap.registerPlugin(ScrollTrigger);
    // gsap.registerPlugin(ScrollSmoother);
    // gsap.registerPlugin(ScrollToPlugin);
    // gsap.registerPlugin(SplitText);

    select = (e) => document.querySelector(e);
    selectAll = (e) => document.querySelectorAll(e);

    const stage = gsap.utils.toArray(".stage");
    const slides = gsap.utils.toArray(".stage .slide");
    const links = selectAll(".slide__scroll-link");
    const titles = selectAll(".col__content-title");
    // const introTitle = new SplitText(".intro__title", {
    //     type: "lines",
    //     linesClass: "intro-line",
    // });
    // const splitTitles = new SplitText(titles, {
    //     type: "lines, chars",
    //     linesClass: "line",
    //     charsClass: "char",
    //     position: "relative",
    // });
    let slideID = 0;
    // console.log(slides);
    // const smoother = ScrollSmoother.create({
    //     smooth: 2,
    //     effects: true,
    //     // normalizeScroll: true,
    //     smoothTouch: 0.1,
    // });

    // function initHeader() {

    //     // animate the logo and fake burger button into place

    //     let tl = gsap.timeline({ delay: 0.5 });

    //     tl.from('.logo', {
    //         y: -40,
    //         opacity: 0,
    //         duration: 2,
    //         ease: 'power4'
    //     })

    //         .from('.nav-btn__svg rect', {
    //             scale: 0,
    //             transformOrigin: "center right",
    //             duration: 0.6,
    //             ease: 'power4',
    //             stagger: 0.1
    //         }, 0.6)
    //         .to('.nav-rect', {
    //             scale: 0.8,
    //             transformOrigin: "center left",
    //             duration: 0.4,
    //             ease: 'power2',
    //             stagger: 0.1
    //         }, "-=0.6")

    //     // create mouse animations for the faux burger button

    //     let navBtn = select('.nav-btn');

    //     navBtn.addEventListener("mouseover", (e) => {
    //         gsap.to('.nav-rect', {
    //             scaleX: 1,
    //             transformOrigin: "top left",
    //             duration: 0.4,
    //             ease: "power4"
    //         });
    //     });

    //     navBtn.addEventListener("mouseout", (e) => {
    //         gsap.to('.nav-rect', {
    //             scaleX: 0.8,
    //             transformOrigin: "top left",
    //             duration: 0.6,
    //             ease: "power4"
    //         });
    //     });
    // }

    function initIntro() {
        // animate the intro elements into place

        let tl = gsap.timeline({ delay: 1.2 });

        tl.from(".intro-line", {
            // x: 100,
            y: 400,
            ease: "power4",
            duration: 3,
        })
            // .from('.intro__txt', {
            //     x: -100,
            //     opacity: 0,
            //     ease: 'power4',
            //     duration: 3
            // }, 0.7)
            .from(
                ".intro__img--1",
                {
                    // x: -50,
                    y: 50,
                    opacity: 0,
                    ease: "power2",
                    duration: 10,
                },
                1
            )
            .from(
                ".intro__img--2",
                {
                    // x: 50,
                    y: -50,
                    opacity: 0,
                    ease: "power2",
                    duration: 10,
                },
                1
            );

        // set up scrollTrigger animation for the when the intro scrolls out

        let stl = gsap.timeline({
            scrollTrigger: {
                trigger: ".intro",
                scrub: 1,
                start: "top bottom", // position of trigger meets the scroller position
                end: "bottom top",
            },
        });

        stl.to(".intro__title", {
            x: 400,
            ease: "power4.in",
            duration: 3,
        });
        // .to('.intro__txt', {
        //     y: 100,
        //     ease: 'power4.in',
        //     duration: 3,
        // }, 0);
    }

    function initLinks() {
        // ScrollToPlugin links

        // links.forEach((link, index, e) => {
        //     let linkST = link.querySelector(".slide__scroll-line");

        //     link.addEventListener("click", (e) => {
        //         e.preventDefault();
        //         gsap.to(window, {
        //             duration: 2,
        //             scrollTo: {
        //                 y: "#slide-" + (index + 2),
        //             },
        //             ease: "power2.inOut",
        //         });
        //         slideID++;
        //     });

        //     link.addEventListener("mouseover", (e) => {
        //         gsap.to(linkST, {
        //             y: 40,
        //             transformOrigin: "bottom center",
        //             duration: 0.6,
        //             ease: "power4",
        //         });
        //     });

        //     link.addEventListener("mouseout", (e) => {
        //         gsap.to(linkST, {
        //             y: 0,
        //             transformOrigin: "bottom center",
        //             duration: 0.6,
        //             ease: "power4",
        //         });
        //     });
        // });

        // ScrollToPlugin link back to the top

        // let top = select('.footer__link-top');

        // top.addEventListener("click", (e) => {
        //     e.preventDefault();
        //     scrollTop();
        // });

        // top.addEventListener("mouseover", (e) => {
        //     gsap.to('.footer__link-top-line', {
        //         scaleY: 3,
        //         transformOrigin: "bottom center",
        //         duration: 0.6,
        //         ease: "power4"
        //     });
        // });

        // top.addEventListener("mouseout", (e) => {
        //     gsap.to('.footer__link-top-line', {
        //         scaleY: 1,
        //         transformOrigin: "bottom center",
        //         duration: 0.6,
        //         ease: "power4"
        //     });
        // });

        // Dummy slide links

        let slideLinks = selectAll(".slide-link");

        slideLinks.forEach((slideLink, index, e) => {
            let slideL = slideLink.querySelector(".slide-link__line");

            slideLink.addEventListener("mouseover", (e) => {
                gsap.to(slideL, {
                    x: 20,
                    scaleX: 0.3,
                    transformOrigin: "right center",
                    duration: 0.8,
                    ease: "power4",
                });
            });
            slideLink.addEventListener("mouseout", (e) => {
                gsap.to(slideL, {
                    x: 0,
                    opacity: 1,
                    scaleX: 1,
                    transformOrigin: "right center",
                    duration: 0.8,
                    ease: "power4",
                });
            });
        });
    }

    function initSlides() {
        // Animation of each slide scrolling into view

        slides.forEach((slide, i) => {
            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: slide,
                    start: "40% 50%", // position of trigger meets the scroller position
                    // end:"bottom bottom"
                    // endTrigger: "80% 80%",
                },
            });

            tl.from(slide.querySelectorAll(".col__content-title"), {
                ease: "power4",
                y: "+=5vh",
                duration: 2.5,
            })
                .from(
                    slide.querySelectorAll(".line__inner"),
                    {
                        y: 200,
                        duration: 2,
                        ease: "power4",
                        stagger: 0.1,
                    },
                    0
                )
                .from(
                    slide.querySelectorAll(".col__content-txt"),
                    {
                        x: 100,
                        y: 50,
                        opacity: 0,
                        duration: 2,
                        ease: "power4",
                    },
                    0.4
                )
                .from(
                    slide.querySelectorAll(".slide-link"),
                    {
                        x: -100,
                        y: 100,
                        opacity: 0,
                        duration: 2,
                        ease: "power4",
                    },
                    0.3
                )
                .from(
                    slide.querySelectorAll(".slide__scroll-link"),
                    {
                        y: 200,
                        duration: 3,
                        ease: "power4",
                    },
                    0.4
                )
                .to(
                    slide.querySelectorAll(".slide__scroll-line"),
                    {
                        scaleY: 0.6,
                        transformOrigin: "bottom left",
                        duration: 2.5,
                        ease: "elastic(1,0.5)",
                    },
                    1.4
                );
        });

        // External footer link scroll animation

        // gsap.from('.footer__link', {
        //     scrollTrigger: {
        //         trigger: '.footer',
        //         scrub: 2,
        //         start: "50% 100%", // position of trigger meets the scroller position
        //         end: "0% 0%",
        //     },
        //     y: "20vh",
        //     ease: 'sine'
        // })
    }

    function initParallax() {
        slides.forEach((slide, i) => {
            let imageWrappers = slide.querySelectorAll(".col__image-wrap");

            gsap.fromTo(
                imageWrappers,
                {
                    y: "-30vh",
                },
                {
                    y: "30vh",
                    scrollTrigger: {
                        trigger: slide,
                        scrub: true,
                        // pin: 1,
                        // pinSpacing:false,
                        start: "top bottom", // position of trigger meets the scroller position
                        snap: {
                            snapTo: 0.5, // 0.5 'cause the scroll animation range is 200vh for parallax effect
                            duration: 1,
                            ease: "power4.inOut",
                        },
                    },
                    ease: "none",
                }
            );
        });
    }

    // function scrollTop() {
    //     gsap.to(window, {
    //         duration: 2,
    //         scrollTo: {
    //             y: "#slide-0"
    //         },
    //         ease: "power2.inOut"
    //     });
    // gsap.to('.footer__link-top-line', {
    //     scaleY: 1,
    //     transformOrigin: "bottom center",
    //     duration: 0.6,
    //     ease: "power4"
    // });
    // }

    /*function initKeys() {
        document.addEventListener("keydown", (e) => {
            e.preventDefault();
            if (e.keyCode == 40) {
                //down arrow to next slide
                if (slideID <= slides.length) {
                    slideID++;
                    gsap.to(window, {
                        duration: 2,
                        scrollTo: {
                            y: "#slide-" + slideID,
                        },
                        ease: "power2.inOut",
                    });
                }
            } else if (e.keyCode == 38) {
                // up arrow to top

                if (slideID != 0) {
                    slideID--;
                    gsap.to(window, {
                        duration: 2,
                        scrollTo: {
                            y: "#slide-" + slideID,
                        },
                        ease: "power2.inOut",
                    });
                }
            }
        });
    }*/
   

    function init() {
        gsap.set(stage, { autoAlpha: 1 });
        // initHeader();
        initIntro();
        initLinks();
        initSlides();
        initParallax();
        // initKeys();
    }

    init();

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    const rotate = document.querySelectorAll(".rotate__scroll");

    rotate.forEach((section) => {
        gsap.fromTo(
            section,
            {
                ease: "sine",
                rotate: 0,
            },
            {
                rotate: 360,
                scrollTrigger: {
                    trigger: section,
                    scrub: true,
                    toggleActions: "play none none reverse",
                },
            }
        );
    });

    ////////////////////////////////////////dot grow

    let slideUpAnimation = gsap.utils.toArray(".slide-up");

    slideUpAnimation.forEach((slideUp) => {
        gsap.from(slideUp, {
            y: -200,
            opacity: 0.5,
            duration: 1,
            scrollTrigger: {
                trigger: slideUp,
                start: "top 90%",
                end: "bottom 60%",
                scrub: true,
                markers: false,
                toggleActions: "play none none none",
            },
        });
    });
})(jQuery);
