(function ($) {
  "use strict";

  /*
        =====================================
        JavaScript Configurations
        =====================================
        01. Preloader 
        02. Data Attribute
        03. Wow js 
        04. Nice Select
        05. RTL Toggle Functionality
        06. Owl Carousels
        07. Scroll To Top
        08. Sticky header
        09. Counter Js
        10. Magnific Popup
        11. Cursor Move Function
        12. Color Switcher
        13. GSAP Animations
        14. Lenis js
        15. Project Custom Codes
    */

  // 01. Preloader
  $(window).on("load", function () {
    setTimeout(() => {
      $(".preloader").fadeOut(0); //500
    }, 0); //1000
  });

  // 02. Data Attribute
  $("[data-background]").each(function () {
    $(this).css(
      "background-image",
      "url(" + $(this).attr("data-background") + ")"
    );
  });

  $("[data-bg-color]").each(function () {
    $(this).css("background-color", $(this).attr("data-bg-color"));
  });

  $("[data-width]").each(function () {
    $(this).css("width", $(this).attr("data-width"));
  });

  // 03. Wow js
  new WOW().init();

  // 04. Nice Select
  $(".rs-nice-select").niceSelect();

  // 05. RTL Toggle Functionality
  function isRTL() {
    return $("body").hasClass("rtl-enabled");
  }

  // Function to toggle RTL mode
  function enableRTLMode() {
    const body = $("body");
    body.addClass("rtl-enabled");

    // Reinitialize all carousels with updated RTL mode
    reinitializeOwlCarousels(isRTL());
  }
  function disableRTLMode() {
    const body = $("body");
    body.removeClass("rtl-enabled");

    // Reinitialize all carousels with updated RTL mode
    reinitializeOwlCarousels(isRTL());
  }

  // Attach click event to the RTL switcher button
  $(document).on(
    "click",
    ".direction-wraper .direction-btn.rtl",
    enableRTLMode
  );
  $(document).on(
    "click",
    ".direction-wraper .direction-btn.ltr",
    disableRTLMode
  );

  // 06. Owl Carousels
  function initializeOwlCarousels(rtl) {
    $(".brands-carousel-wraper.left").owlCarousel({
      dots: false,
      nav: false,
      items: 6,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      loop: true,
      rtl: rtl,
      responsive: {
        0: { items: 1 },
        425: { items: 2 },
        575: { items: 2 },
        768: { items: 3 },
        992: { items: 4 },
        1600: { items: 5 },
        1920: { items: 6 },
      },
    });

    $(".brands-carousel-wraper.right").owlCarousel({
      dots: false,
      nav: false,
      items: 6,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      loop: true,
      rtl: !rtl, // Right carousel will follow the same RTL state
      responsive: {
        0: { items: 1 },
        425: { items: 2 },
        575: { items: 2 },
        768: { items: 3 },
        992: { items: 4 },
        1600: { items: 5 },
        1920: { items: 6 },
      },
    });

    $(".roister-gallery-slider").owlCarousel({
      dots: false,
      nav: false,
      items: 3,
      margin: 32,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      loop: true,
      rtl: rtl,
      stagePadding: 50,
      autoHeight: false,
      responsive: {
        0: { items: 1 },
        425: { items: 2 },
        575: { items: 2 },
        768: { items: 2 },
        992: { items: 3 },
      },
    });

    $(".roister-test-wraper").owlCarousel({
      dots: false,
      nav: false,
      items: 2,
      margin: 30,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      loop: true,
      rtl: rtl,
      responsive: {
        0: { items: 1 },
        768: { items: 2 },
      },
    });

    $(".roister-banner-slider-wraper").owlCarousel({
      dots: false,
      nav: false,
      items: 4,
      margin: 20,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      loop: true,
      rtl: rtl,
      responsive: {
        0: { items: 1 },
        575: { items: 2 },
        992: { items: 3 },
        1200: { items: 4 },
      },
    });

    $(".roister-hm2-gallery-slider-wraper").owlCarousel({
      dots: true,
      nav: false,
      items: 4,
      margin: 20,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      loop: true,
      rtl: rtl,
      responsive: {
        0: { items: 1 },
        575: { items: 2 },
        992: { items: 3 },
        1200: { items: 4 },
      },
    });

    $(".roister-hm2-testimonial-slider-wraper").owlCarousel({
      dots: true,
      nav: false,
      items: 2,
      margin: 20,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      loop: true,
      rtl: rtl,
      slideBy: 2,
      responsive: {
        0: { items: 1, slideBy: 1 },
        575: { items: 2 },
      },
    });

    $(".home2-testi-slider").owlCarousel({
      dots: true,
      nav: false,
      items: 1,
      margin: 30,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      loop: true,
      rtl: rtl,
      stagePadding: 170,
      center: true,
      responsive: {
        0: {
          stagePadding: 0,
        },
        992: {
          stagePadding: 150,
        },
        1200: {
          stagePadding: 170,
        },
      },
    });

    $(".hm-2-footer-gallery-slider").owlCarousel({
      loop: true,
      margin: 0,
      nav: false,
      rtl: rtl,
      dots: false,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
        0: { items: 2 },
        600: { items: 4 },
        1000: { items: 6 },
      },
    });

    const singleTestimonialSliderWraper = $(".roister-testi-slider-wraper");
    singleTestimonialSliderWraper.owlCarousel({
      dots: true,
      nav: false,
      items: 1,
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      rtl: rtl,
    });

    const singleBlogSliderWraper = $(".single-blog-slider-wraper");
    singleBlogSliderWraper.owlCarousel({
      dots: false,
      nav: false,
      items: 1,
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      rtl: rtl,
    });

    $(document).on("click", ".roister-single-blog-4 .owl-prev", function () {
      $(".single-blog-slider-wraper").trigger("prev.owl.carousel");
    });

    $(document).on("click", ".roister-single-blog-4 .owl-next", function () {
      $(".single-blog-slider-wraper").trigger("next.owl.carousel");
    });
  }

  // Function to destroy and reinitialize Owl Carousels
  function reinitializeOwlCarousels(rtl) {
    $(
      ".brands-carousel-wraper.left, .brands-carousel-wraper.right, .roister-test-wraper,.home2-brand-slider , .home2-testi-slider , .single-blog-slider-wraper, .roister-banner-slider-wraper, .roister-testi-slider-wraper, .roister-gallery-slider , .roister-hm2-gallery-slider-wraper , .roister-hm2-testimonial-slider-wraper , .hm-2-footer-gallery-slider"
    )
      .trigger("destroy.owl.carousel")
      .removeClass("owl-loaded")
      .find(".owl-stage-outer")
      .children()
      .unwrap(); // Fix layout issues after destroy

    initializeOwlCarousels(rtl);
  }

  // Initialize Owl Carousels on page load
  initializeOwlCarousels(isRTL());

  // 07. Scroll To Top
  $(window).on("scroll", function () {
    var scrollBar = $(this).scrollTop();
    if (scrollBar > 150) {
      $(".scroll-top-btn").fadeIn(400);
    } else {
      $(".scroll-top-btn").fadeOut(400);
    }
  });

  $(".scroll-top-btn").on("click", function () {
    $("html, body").animate({ scrollTop: 0 }, 400);
  });

  // 08. Sticky header
  const $header = $(".roister-header");
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 100) {
      $header.addClass("sticky-header");
    } else {
      $header.removeClass("sticky-header");
    }
  });

  // 09. Counter Js
  $(".counter").counterUp({
    delay: 10,
    time: 1000,
  });

  // 10. Magnific Popup
  $(".vdo-play-btn").magnificPopup({
    type: "iframe",
    mainClass: "mfp-fade",
    removalDelay: 160,
    preloader: true,
    fixedContentPos: false,
  });

  // 11. Cursor Move Function
  $(document).on("mousemove", function (n) {
    window.requestAnimationFrame(() => {
      a.css({ left: n.clientX, top: n.clientY });
      b.css({ left: n.clientX, top: n.clientY });
      c.css({ left: n.clientX, top: n.clientY });
    });
  });

  var a = $("#cursor"),
    b = $("#cursor2"),
    c = $("#cursor3");
  function n(t) {
    b.addClass("hover");
    c.addClass("hover");
  }
  function s(t) {
    b.removeClass("hover");
    c.removeClass("hover");
  }
  s();
  $("a, button").on("mouseover", n);
  $("a, button").on("mouseout", s);

  $(".cursor-circle").on("click", function (e) {
    e.preventDefault();

    $(".cursor, .cursor2, .cursor3").css({
      opacity: "1",
    });
  });

  $(".cursor-normal").on("click", function (e) {
    e.preventDefault();

    $(".cursor, .cursor2, .cursor3").css({
      opacity: "0",
    });
  });

  // 12. Color Switcher
  $(".color-switcher-btn").on("click", function () {
    $(this).removeClass("active");
    $(".theme-color-switch").addClass("active");
  });

  $(".theme-color-switch .close-switcher").on("click", function () {
    $(".theme-color-switch").removeClass("active");
    $(".color-switcher-btn").addClass("active");
  });

  $(".theme-color-switch .color-list li a:not(.primary)").each(function () {
    $(this).on("click", function () {
      var class_name = $(this).attr("data-bg-color");

      $(":root").css({
        "--primary-color": class_name,
      });
    });
  });

  $(".theme-color-switch a.primary").on("click", function () {
    $("body").removeAttr("class");

    $(":root").css({
      "--primary-color": "#5044EB",
    });
  });

  // 13. GSAP Animations
  gsap.registerPlugin(ScrollTrigger);

  // all image reveal
  let revealContainers = document.querySelectorAll(".reveal-img");

  revealContainers.forEach((container) => {
    let image = container.querySelector("img");
    let tl = gsap.timeline({
      scrollTrigger: {
        trigger: container,
      },
    });

    tl.set(container, { autoAlpha: 1 });
    tl.from(container, 1.5, {
      xPercent: -100,
      ease: Power2.out,
    });
    tl.from(image, 1.5, {
      xPercent: 100,
      scale: 1.3,
      delay: -1.5,
      ease: Power2.out,
    });
  });

  // 14. Lenis js
  const lenis = new Lenis({
    duration: 2,
  });

  function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
  }

  requestAnimationFrame(raf);

  // 15. Project Custom Codes
  //  roister-single-team show social btn
  $(document).on("click", ".roister-single-team .show-social-btn", function () {
    $(this).parent().parent().toggleClass("show-social");
  });

  // home 1 photo gallery trigger gallery
  $(".gallery-trigger").on("click", function (e) {
    e.preventDefault();

    // Get the sibling .column-overlay and open the popup
    $(this)
      .siblings(".column-overlay")
      .magnificPopup({
        delegate: "a",
        type: "image",
        gallery: {
          enabled: true,
        },
      })
      .magnificPopup("open");
  });

  // Increase qty for add to cart input
  document.querySelectorAll(".quantity-wrapper").forEach((wrapper) => {
    const input = wrapper.querySelector(".add-to-cart-input");
    wrapper.querySelector(".increase").addEventListener("click", () => {
      input.value = parseInt(input.value || 0) + 1;
    });
    wrapper.querySelector(".decrease").addEventListener("click", () => {
      if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
      }
    });
  });
})(jQuery);
