(function ($) {
  "use strict";

  function initViewer($root) {
    // Prevent double initialization
    if (!$root.length || $root.data("init")) return;
    $root.data("init", true);

    const pdfUrl = $root.data("pdf-url");
    const showToolbar = $root.data("show-toolbar");

    // Ensure canvas exists
    const $canvas = $root.find(".banae-pdf-canvas");
    if (!$canvas.length) {
      console.warn("PDF.js Viewer: No canvas element found inside widget.");
      return;
    }

    const canvas = $canvas.get(0);
    const ctx = canvas.getContext("2d");
    let pdfDoc = null;
    let pageNum = 1;
    let scale = 1.0;

    if (!pdfUrl) {
      $root.html('<div class="banae-pv-error">No PDF URL specified.</div>');
      return;
    }

    function renderPage(num) {
      pdfDoc.getPage(num).then(function (page) {
        const viewport = page.getViewport({ scale: scale });
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        const renderContext = {
          canvasContext: ctx,
          viewport: viewport,
        };
        page.render(renderContext).promise.then(function () {
          $root.find(".banae-pv-page-info").text(pageNum + " / " + pdfDoc.numPages);
        });
      });
    }

    // Load PDF/document
    pdfjsLib
      .getDocument(pdfUrl)
      .promise.then(function (pdf) {
        pdfDoc = pdf;
        renderPage(pageNum);
        $root.find('a[data-action="download"]').attr("href", pdfUrl);
      })
      .catch(function (err) {
        $root.html('<div class="banae-pv-error">Failed to load PDF: ' + err.message + "</div>");
      });

    // Toolbar
    $root.on("click", ".banae-pv-btn", function () {
      const action = $(this).data("action");

      if (action === "prev") {
        if (pageNum <= 1) return;
        pageNum--;
        renderPage(pageNum);
      } else if (action === "next") {
        if (pageNum >= pdfDoc.numPages) return;
        pageNum++;
        renderPage(pageNum);
      } else if (action === "zoom_in") {
        scale += 0.25;
        renderPage(pageNum);
      } else if (action === "zoom_out") {
        scale = Math.max(0.25, scale - 0.25);
        renderPage(pageNum);
      } else if (action === "fullscreen") {
        const wrapper = $root.get(0);
        if (!document.fullscreenElement) {
          wrapper.requestFullscreen?.() || wrapper.mozRequestFullScreen?.() || wrapper.webkitRequestFullscreen?.() || wrapper.msRequestFullscreen?.();
        } else {
          document.exitFullscreen?.() || document.mozCancelFullScreen?.() || document.webkitExitFullscreen?.() || document.msExitFullscreen?.();
        }
      }
    });

    if (!showToolbar) {
      $root.find(".banae-pv-toolbar").hide();
    }
  }

  // Elementor hook (only one, for this widget)
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/banae-pdf-viewer.default", function ($scope) {
      initViewer($scope.find(".banana-pdf-viewer")); // consistent selector
    });
  });
})(jQuery);
