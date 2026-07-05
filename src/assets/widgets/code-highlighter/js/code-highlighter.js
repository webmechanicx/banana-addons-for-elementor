jQuery(document).ready(function ($) {
  // Copy to clipboard
  /*
  $(document).on("click", ".copy-code-btn", function () {
    const codeBlock = $(this).siblings("pre").find("code").text();
    navigator.clipboard.writeText(codeBlock);
    $(this).text("Copied!");
    setTimeout(() => $(this).text("Copy"), 2000);
  });
  */

  // Apply theme dynamically when editor updates (Elementor live)
  if (window.elementorFrontend && window.elementorFrontend.hooks) {
    elementorFrontend.hooks.addAction("frontend/element_ready/banae_code_highlighter.default", function ($scope) {
      //const theme = $scope.find(".banae-code-highlighter-container").data("theme");
      //applyPrismTheme(theme);
      Prism.highlightAllUnder($scope[0]);
      // Highlight all code initially
      //Prism.highlightAll();
    });
  }
});
