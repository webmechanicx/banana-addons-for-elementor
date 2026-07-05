(function ($) {
  "use strict";
  const BananaOpenStreetMap = function ($scope) {
    const wrapper = $scope.find(".banae-openstreet__map");
    const mapId = wrapper.attr("id");

    // setting function
    const settings = ($scope) => {
      const data = JSON.stringify(wrapper.data("config"));

      return data;
    };

    // config
    const config = JSON.parse(settings($scope));

    const zoom = config.zoom_level.size || 13;
    const firstMarker = config.markers.length ? config.markers[0] : null;
    const lat = firstMarker ? parseFloat(firstMarker.marker_lat) : 0;
    const lng = firstMarker ? parseFloat(firstMarker.marker_lng) : 0;

    const map = L.map(mapId, {
      scrollWheelZoom: config.scroll_wheel === "yes",
      center: [lat, lng],
      zoom: zoom,
    });

    // Define map styles (tile layers)
    const styles = {
      standard: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      light: "https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png",
      dark: "https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png",
      drawing: "https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png",
      satellite: "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
    };

    L.tileLayer(
      styles[config.map_style] || styles.standard,
      { minZoom: 2, maxZoom: 19 },
      {
        attribution: "&copy; OpenStreetMap contributors",
      }
    ).addTo(map);

    // Add markers
    config.markers.forEach(function (marker) {
      if (!marker.marker_lat || !marker.marker_lng) return;

      const globalSize = config.global_marker_size?.size || 16;
      const iconSize = marker.marker_icon_size?.size ? [marker.marker_icon_size.size, marker.marker_icon_size.size] : [globalSize, globalSize];

      const icon = marker.marker_icon?.url
        ? L.icon({
            iconUrl: marker.marker_icon.url,
            iconSize: iconSize,
            iconAnchor: [iconSize[0] / 2, iconSize[1]], // bottom center of icon
            popupAnchor: [0, -iconSize[1] / 2], // popup opens just above marker
          })
        : L.icon({
            iconUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png",
            iconSize: iconSize,
            iconAnchor: [iconSize[0] / 2, iconSize[1]],
            popupAnchor: [0, -iconSize[1] / 2],
          });

      const m = L.marker([marker.marker_lat, marker.marker_lng], { icon: icon }).addTo(map);

      if (marker.marker_popup) {
        //m.bindPopup(marker.marker_popup);
        m.bindPopup(marker.marker_popup, {
          autoClose: false, // prevents popup from closing when clicking elsewhere
          closeOnClick: false, // prevents closing when clicking on map
        });

        if (config.open_popups === "yes") {
          m.openPopup();
        }
      }
    });
  };

  $(window).on("elementor/frontend/init", function () {
    window.elementorFrontend.hooks.addAction("frontend/element_ready/banana_openstreet_map.default", function ($scope) {
      BananaOpenStreetMap($scope);
    });
  });
})(jQuery);
