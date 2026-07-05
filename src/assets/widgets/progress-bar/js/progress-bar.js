/*
jQuery(document).ready(function ($) {
  $(".banae-progress-bar-wrapper").each(function () {
    var speed = $(this).data("speed") || 800;

    $(this)
      .find(".banae-progress-bar")
      .each(function () {
        var $bar = $(this);
        var percent = $bar.data("percent");

        if ($bar.hasClass("circular")) {
          $bar.find(".circle").css("stroke-dasharray", percent + ", 100");
        } else {
          var $inner = $bar.find(".banae-bar-inner");
          var target = $inner.data("target") || percent;
          // Start at 0 width
          $inner.css("width", "0");

          // Animate smoothly to target
          $inner.animate({ width: target + "%" }, speed);
        }
      });
  });
});
*/

(function ($) {
  function initBananaProgressBar($scope) {
    const $wrapper = $scope.find(".banae-progress-bar-wrapper");
    const speed = $wrapper.data("speed") || 800;

    $wrapper.find(".banae-progress-bar").each(function () {
      var $bar = $(this);
      var percent = $bar.data("percent");
      var $inner = $bar.find(".banae-bar-inner");
      var target = $inner.data("target") || percent;
      // Start at 0 width
      $inner.css("width", "0");

      // Animate smoothly to target
      $inner.animate({ width: target + "%" }, speed);
    });
  }

  //initialize elementor frontend and editor
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/banae_progress_bar.default", function ($scope) {
      initBananaProgressBar($scope);
    });
  });
})(jQuery);
