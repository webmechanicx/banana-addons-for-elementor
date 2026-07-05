(function ($) {
  "use strict";

  function banaeImageCompare($scope) {
    // setting function
    const settings = ($scope) => {
      const data = JSON.stringify($scope.find(".banae-image-compare").data("config"));

      return data;
    };

    // config
    const config = JSON.parse(settings($scope));

    //initiate
    $scope.find(".banae-image-compare").twentytwenty({
      default_offset_pct: config?.percent ? config?.percent / 100 : 0.5, // How much of the before image is visible when the page loads
      orientation: config?.orientation ? config?.orientation : "horizontal", // Orientation of the before and after images ('horizontal' or 'vertical')
      before_label: config?.before_label ? config?.before_label : "Before", // Set a custom before label
      after_label: config?.after_label ? config?.after_label : "After", // Set a custom after label
      no_overlay: config?.no_overlay ? config?.no_overlay : true, //Do not show the overlay with before and after
      move_slider_on_hover: config?.move_slider_on_hover ? config?.move_slider_on_hover : true, // Move slider on mouse hover?
      move_with_handle_only: config?.move_with_handle_only ? config?.move_with_handle_only : true, // Allow a user to swipe anywhere on the image to control slider movement.
      click_to_move: config?.click_to_move ? config?.click_to_move : false,
    });
  }

  $(window).on("elementor/frontend/init", function () {
    window.elementorFrontend.hooks.addAction("frontend/element_ready/banae_image_compare.default", function ($scope) {
      banaeImageCompare($scope);
    });
  });
})(jQuery);
