(function ($) {
  function initBananaEqualHeight($scope) {
    if ($scope.hasClass("banae-equal-height-yes")) {
      // Additionally, apply matchHeight to the children of the widget container if there is only one child
      $scope.find(".elementor-widget-container").each(function () {
        const $container = $(this);
        if ($container.children().length === 1) {
          const child = $container.children().attr("class").split(" ")[0]; // Get the first class name
          //$(`.${child}`).matchHeight();
          $scope.find(`.elementor-element.elementor-widget, .${child}`).matchHeight();
        } else {
          //$(this).matchHeight();
          $scope.find(".elementor-element.elementor-widget, .elementor-widget-container").matchHeight();
        }
      });
    }
  }

  //initialize elementor frontend and editor
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/global", function ($scope) {
      initBananaEqualHeight($scope);
    });
  });
})(jQuery);
