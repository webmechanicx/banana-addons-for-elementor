(function ($) {
  "use strict";
  const BananaInitPayPalButton = function ($scope) {
    const wrapper = $scope.find(".paypal-button-container");
    const buttonId = wrapper.find('[id^="banae-paypal-button-"]').attr("id");

    // setting function
    const settings = ($scope) => {
      const data = JSON.stringify(wrapper.data("config"));

      return data;
    };

    // config
    const config = JSON.parse(settings($scope));

    if (typeof paypal !== "undefined") {
      paypal
        .Buttons({
          style: {
            color: "gold",
            shape: "rect",
            label: "paypal",
            layout: "vertical",
          },
          createOrder: function (data, actions) {
            return actions.order.create({
              purchase_units: [
                {
                  description: config.item_name,
                  amount: {
                    value: config.amount,
                    currency_code: config.currency,
                  },
                },
              ],
            });
          },
          onApprove: function (data, actions) {
            return actions.order.capture().then(function (orderData) {
              alert("Payment successful!");
              if (config.return_url) {
                window.location.href = config.return_url;
              }
            });
          },
          onCancel: function (data) {
            alert("Payment cancelled.");
            if (config.cancel_url) {
              window.location.href = config.cancel_url;
            }
          },
          onError: function (err) {
            console.error("PayPal error:", err);
            alert("Something went wrong during payment.");
          },
        })
        .render("#" + buttonId);
    }
  };

  $(window).on("elementor/frontend/init", function () {
    window.elementorFrontend.hooks.addAction("frontend/element_ready/banae_smart_paypal_button.default", function ($scope) {
      BananaInitPayPalButton($scope);
    });
  });
})(jQuery);
