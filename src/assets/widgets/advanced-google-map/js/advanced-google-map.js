(function ($) {
  "use strict";

  const mapStyles = {
    standard: [],
    silver: [
      /* --- Silver Theme --- */ { elementType: "geometry", stylers: [{ color: "#f5f5f5" }] },
      { elementType: "labels.icon", stylers: [{ visibility: "off" }] },
      { elementType: "labels.text.fill", stylers: [{ color: "#616161" }] },
      { elementType: "labels.text.stroke", stylers: [{ color: "#f5f5f5" }] },
    ],
    retro: [
      /* --- Retro Theme --- */ { elementType: "geometry", stylers: [{ color: "#ebe3cd" }] },
      { elementType: "labels.text.fill", stylers: [{ color: "#523735" }] },
      { elementType: "labels.text.stroke", stylers: [{ color: "#f5f1e6" }] },
    ],
    dark: [
      /* --- Dark Theme --- */ { elementType: "geometry", stylers: [{ color: "#212121" }] },
      { elementType: "labels.text.fill", stylers: [{ color: "#757575" }] },
      { elementType: "labels.text.stroke", stylers: [{ color: "#212121" }] },
    ],
    night: [
      /* --- Night Theme --- */ { elementType: "geometry", stylers: [{ color: "#242f3e" }] },
      { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
      { elementType: "labels.text.stroke", stylers: [{ color: "#242f3e" }] },
    ],
    aubergine: [
      /* --- Aubergine Theme --- */ { elementType: "geometry", stylers: [{ color: "#1d2c4d" }] },
      { elementType: "labels.text.fill", stylers: [{ color: "#8ec3b9" }] },
      { elementType: "labels.text.stroke", stylers: [{ color: "#1a3646" }] },
    ],
  };

  function initAdvancedGoogleMap($scope) {
    const $mapDiv = $scope.find(".banae-advanced-google-map");
    if (!$mapDiv.length || $mapDiv.data("init")) return;
    $mapDiv.data("init", true);

    const lat = parseFloat($mapDiv.data("lat"));
    const lng = parseFloat($mapDiv.data("lng"));
    const zoom = parseInt($mapDiv.data("zoom"));
    const styleKey = $mapDiv.data("style");
    const label = $mapDiv.data("marker-label");

    const map = new google.maps.Map($mapDiv[0], {
      center: { lat: lat, lng: lng },
      zoom: zoom,
      styles: mapStyles[styleKey] || [],
    });

    new google.maps.Marker({
      position: { lat: lat, lng: lng },
      map: map,
      title: label,
    });
  }

  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/banae_advanced_google_map.default", initAdvancedGoogleMap);
  });
})(jQuery);
