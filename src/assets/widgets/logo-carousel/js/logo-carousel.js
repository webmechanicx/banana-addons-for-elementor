(function ($) {
  "use strict";

  function banaeLogoCarousel($scope) {
    const $el = $scope.find(".banae-logo-carousel-swiper");

    // setting function
    const get_settings = ($scope) => {
      const data = JSON.stringify($scope.find(".banae-logo-carousel-wrapper").data("config"));

      return data;
    };

    // parse config
    const config = JSON.parse(get_settings($scope));

    // default basic slider settings
    const $nextEl = `#${config.wrapper_id} .banae-logo-carousel-swiper .swiper-button-next`;
    const $prevEl = `#${config.wrapper_id} .banae-logo-carousel-swiper .swiper-button-prev`;
    const $pagination = `#${config.wrapper_id} .banae-logo-carousel-swiper .swiper-pagination`;
    const autoplay_speed = config?.autoplay_speed ? parseInt(config.autoplay_speed) : 3000;
    const slidesPerView = config?.slider_per_view ? parseInt(config.slider_per_view) : 5;
    const spaceBetween = config?.space_between_logos ? parseInt(config.space_between_logos) : 20;
    const show_nav = config?.show_nav == "yes" ? { nextEl: $nextEl, prevEl: $prevEl } : false;
    const show_pagination = config?.show_pagination == "yes" ? { el: $pagination, clickable: true } : false;

    // swiper init
    if (typeof Swiper !== "undefined" && $el.length) {
      new Swiper($el[0], {
        slidesPerView: slidesPerView,
        spaceBetween: spaceBetween,
        loop: true,
        autoplay: { delay: autoplay_speed, disableOnInteraction: false },
        navigation: show_nav, //config.show_nav == "yes" ? { nextEl: $nextEl, prevEl: $prevEl } : false,
        pagination: show_pagination, //config.show_pagination == "yes" ? { el: $pagination, clickable: true } : false,
        breakpoints: {
          320: { slidesPerView: 2 },
          768: { slidesPerView: 3 },
          1024: { slidesPerView: 5 },
        },
      });
    }
  }

  $(window).on("elementor/frontend/init", function () {
    window.elementorFrontend.hooks.addAction("frontend/element_ready/banae_logo_carousel.default", function ($scope) {
      banaeLogoCarousel($scope);
    });
  });
})(jQuery);
