(function ($) {
  ("use strict");

  function initViewer($root) {
    // Prevent double initialization
    if ($root.data("init")) return;
    $root.data("init", true);

    const pdfUrl = $root.data("pdf-url");
    const showToolbar = $root.data("show-toolbar");

    // Ensure canvas exists
    var $canvas = $root.find(".banae-pdf-canvas");
    if ($canvas.length === 0) {
      console.warn("PDF.js Viewer: No canvas element found inside widget.");
      return;
    }

    var canvas = $canvas.get(0);
    var ctx = canvas.getContext("2d");
    var pdfDoc = null;
    var pageNum = 1;
    var scale = 1.0;

    if (!pdfUrl) {
      $root.html('<div class="banae-pv-error">No PDF URL specified.</div>');
      return;
    }

    function renderPage(num) {
      pdfDoc.getPage(num).then(function (page) {
        var viewport = page.getViewport({ scale: scale });
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        // stop auto increament canvas wrapper height each time zoom-in
        //$root.find(".banae-pdf-canvas-wrap").css({ height: viewport.height + "px" });

        var renderContext = {
          canvasContext: ctx,
          viewport: viewport,
        };
        page.render(renderContext).promise.then(function () {
          $root.find(".banae-pv-page-info").text(pageNum + " / " + pdfDoc.numPages);
        });
      });
    }

    // Load document
    var loadingTask = pdfjsLib.getDocument(pdfUrl);
    loadingTask.promise
      .then(function (pdf) {
        pdfDoc = pdf;
        renderPage(pageNum);
        $root.find('a[data-action="download"]').attr("href", pdfUrl);
      })
      .catch(function (err) {
        $root.html('<div class="banae-pv-error">Failed to load PDF: ' + err.message + "</div>");
      });

    // Toolbar actions
    $root.on("click", ".banae-pv-btn", function () {
      // get current action
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
        const viewerWrapper = $root.get(0); // entire viewer container

        if (!document.fullscreenElement && !document.webkitFullscreenElement && !document.mozFullScreenElement && !document.msFullscreenElement) {
          // Enter fullscreen
          if (viewerWrapper.requestFullscreen) {
            viewerWrapper.requestFullscreen();
          } else if (viewerWrapper.mozRequestFullScreen) {
            // Firefox
            viewerWrapper.mozRequestFullScreen();
          } else if (viewerWrapper.webkitRequestFullscreen) {
            // Chrome, Safari
            viewerWrapper.webkitRequestFullscreen();
          } else if (viewerWrapper.msRequestFullscreen) {
            // IE/Edge
            viewerWrapper.msRequestFullscreen();
          }
        } else {
          // Exit fullscreen
          if (document.exitFullscreen) {
            document.exitFullscreen();
          } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
          } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
          } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
          }
        }
      }
    });

    if (!showToolbar) {
      $root.find(".banae-pv-toolbar").hide();
    }
  }

  /*
  function initAll() {
    $(".banana-pdf-viewer").each(function () {
      initViewer($(this));
    });
  }

  // Frontend load only
  if (typeof elementorFrontend === "undefined") {
    $(document).ready(initAll);
  }

  // Elementor editor preview
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/global", function ($scope) {
      initViewer($scope.find(".banana-pdf-viewer"));
    });
  });
  */

  // Run on frontend (live site)
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/widget-pdf-viewer.default", function ($scope) {
      initViewer($scope.find(".banana-pdf-viewer"));
    });
  });

  // Run on backend (editor refresh/reload)
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/global", function ($scope) {
      initViewer($scope.find(".banana-pdf-viewer"));
    });
  });
})(jQuery);
