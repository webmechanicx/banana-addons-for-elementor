(function ($) {
  "use strict";

  function banaeTestimonialCarousel($scope) {
    const $el = $scope.find(".banae-testimonial-carousel-swiper");

    // setting function
    const get_settings = ($scope) => {
      const data = JSON.stringify($scope.find(".banae-testimonial-carousel-wrapper").data("config"));

      return data;
    };

    // parse config
    const config = JSON.parse(get_settings($scope));

    // default basic slider settings
    const $nextEl = `#${config.wrapper_id} .banae-testimonial-carousel-swiper .swiper-button-next`;
    const $prevEl = `#${config.wrapper_id} .banae-testimonial-carousel-swiper .swiper-button-prev`;
    const $pagination = `#${config.wrapper_id} .banae-testimonial-carousel-swiper .swiper-pagination`;
    const autoplay_speed = config?.autoplay_speed ? parseInt(config.autoplay_speed) : 3000;
    const slidesPerView = config?.slider_per_view ? parseInt(config.slider_per_view) : 5;
    const spaceBetween = config?.space_between_slides ? parseInt(config.space_between_slides) : 20;
    const show_nav = config?.show_nav == "yes" ? { nextEl: $nextEl, prevEl: $prevEl } : false;
    const show_pagination = config?.show_pagination == "yes" ? { el: $pagination, clickable: true } : false;

    // swiper init
    if (typeof Swiper !== "undefined" && $el.length) {
      new Swiper($el[0], {
        slidesPerView: slidesPerView,
        spaceBetween: spaceBetween,
        loop: true,
        autoplay: { delay: autoplay_speed, disableOnInteraction: false },
        navigation: show_nav,
        pagination: show_pagination,
        breakpoints: {
          320: { slidesPerView: config.break_points?.small },
          768: { slidesPerView: config.break_points?.medium },
          1024: { slidesPerView: config.break_points?.large },
        },
      });
    }
  }

  $(window).on("elementor/frontend/init", function () {
    window.elementorFrontend.hooks.addAction("frontend/element_ready/banae_testimonial_carousel.default", function ($scope) {
      banaeTestimonialCarousel($scope);
    });
  });
})(jQuery);
