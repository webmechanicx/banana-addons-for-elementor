jQuery(document).ready(function ($) {
  const el_card = $("#banae-tab-widgets .banae-card[data-type='free'] input[type='checkbox']");

  $("#banae-save-settings").on("click", function (e) {
    e.preventDefault();

    const submitButton = $(this);
    const buttonLabel = submitButton.find(".banae-button-label");
    const buttonLoading = submitButton.find(".banae-button-loading");
    const form = $("#banae-widget-settings-form");
    const formData = form.serializeArray();

    formData.push({ name: "action", value: "banae_widget_save_settings" });
    formData.push({ name: "security", value: banae_widget_ajax.nonce });

    // change loader visibility
    buttonLabel.hide();
    buttonLoading.show();

    // change the submit button to disable
    submitButton.prop("disabled", true);

    $.post(banae_widget_ajax.ajax_url, formData, function (response) {
      if (response.success) {
        // change loader visibility
        buttonLabel.show();
        buttonLoading.hide();

        $.toast({
          heading: "Success",
          text: response.data.message,
          bgColor: "#4e6276",
          showHideTransition: "slide",
          icon: "success",
          position: "bottom-right",
          stack: 4,
        });

        // change the submit button to disable
        submitButton.prop("disabled", false);
      } else {
        // change loader visibility
        buttonLabel.show();
        buttonLoading.hide();

        $.toast({
          heading: "Error",
          text: response.data.message,
          bgColor: "#93003f",
          showHideTransition: "fade",
          icon: "error",
          position: "bottom-right",
          stack: 4,
        });

        // change the submit button to disable
        submitButton.prop("disabled", false);
      }
    });
  });

  $(".banae-tab").on("click", function (evt) {
    const that = $(this);
    evt.preventDefault();

    // remove all tab li classes
    $(".banae-tabs").find("li").removeClass("banae-tab-current");

    // add current tab li class
    that.parent("li").toggleClass("banae-tab-current");

    // get the current href
    var sel = this.getAttribute("href");

    // switching tabs content
    $(".banae-content-wrap").find(".banae-tab-content").removeClass("banae-active").filter(sel).addClass("banae-active");
  });

  // Filter widgets by type
  $(document).on("change", '.banae-filter-widget__input input[name="filter"]', function () {
    const selected = $(this).val();
    const widgetItem = $("#banae-tab-widgets .banae-card");

    if (selected === "all") {
      widgetItem.show();
    } else {
      widgetItem.hide();
      $('#banae-tab-widgets .banae-card[data-type="' + selected + '"]').show();
    }
  });

  // Enable all widgets
  $("#checkAll").on("change", function () {
    if ($(this).is(":checked")) {
      el_card.prop("checked", true);
    }
  });

  // Disable all widgets
  $("#uncheckAll").on("change", function () {
    if ($(this).is(":checked")) {
      el_card.prop("checked", false);
    }
  });

  // Dismiss admin notice
  $(document).on("click", ".banae-notice.is-dismissible .notice-dismiss", function () {
    $(this)
      .closest(".banae-notice")
      .fadeOut(300, function () {
        $(this).remove();
      });
  });
});
