jQuery(document).ready(function ($) {
  const buttonStateChange = (button) => {
    const title = $("#banana-template-title").val();
    const tp_type = $("#banana-template-type").val();
    const conditions = $("#banana-template-condition").val();

    if (title && tp_type && conditions) {
      button.prop("disabled", false);
    } else {
      button.prop("disabled", true);
    }
  };

  $(document).on("click", "#banana-close-modal", function () {
    $("#banana-template-modal").fadeOut();
  });

  $(document).on("click", '.wrap a.page-title-action[href*="post-new.php?post_type=banana_template"]', function (e) {
    e.preventDefault();

    // reset exiting fields
    $("#banana-template-title").val("");
    $("#banana-template-type").val("");
    $("#banana-template-condition").val("");

    // override modal title
    $(".modal__title").text("Add Template");

    $("#banana-template-modal").fadeIn();
  });

  //submit button state handler dropdown
  $(document).on("change", "#banana-template-type, #banana-template-condition", function (e) {
    const btn = $("#banana-save-template");
    buttonStateChange(btn);
  });

  //submit button state handler input
  $(document).on("keyup", "#banana-template-title", function (e) {
    const btn = $("#banana-save-template");
    buttonStateChange(btn);
  });

  // add template handler
  $(document).on("click", "#banana-save-template", function () {
    const that = $(this);
    const title = $("#banana-template-title").val();
    const tp_type = $("#banana-template-type").val();
    const conditions = $("#banana-template-condition").val();
    const postID = $("#banana-template-modal").attr("data-post-id");
    const loading = that.find(".banae-btn-loading");

    //display loading
    loading.show();
    that.prop("disabled", true);

    $.ajax({
      url: banana_ajax.ajax_url,
      type: "POST",
      data: {
        action: "banana_create_template",
        nonce: banana_ajax.nonce,
        post_id: parseInt(postID),
        title: title,
        type: tp_type,
        conditions: conditions,
      },
      success: function (response) {
        //hide loading
        loading.hide();

        if (response.success) {
          // hide the modal
          $("#banana-template-modal").fadeOut();

          // toast success message
          $.toast({
            heading: "Success",
            text: "Template Created.",
            bgColor: "#4e6276",
            showHideTransition: "slide",
            icon: "success",
            position: "bottom-right",
            stack: 4,
          });
        } else {
          // hide the modal
          $("#banana-template-modal").fadeOut();

          // toast success message
          $.toast({
            heading: "Error",
            text: "Failed to create template",
            bgColor: "#4e6276",
            showHideTransition: "slide",
            icon: "error",
            position: "bottom-right",
            stack: 4,
          });
        }

        that.prop("disabled", false);
      },
    });
  });

  // edit template handler
  $(document).on("click", "body.post-type-banana_template a.row-title, body.post-type-banana_template .row-actions .edit a", function (e) {
    const that = $(this);
    const btn = $("#banana-save-template");
    const url = that.attr("href");

    if (!url.includes("post_type=banana_template") && !url.includes("post=")) {
      return;
    }

    const loader = '<div class="banae-tb-loading-state"><div class="banae-tb-loading"></div></div>';

    e.preventDefault();

    let postID = new URL(url).searchParams.get("post");

    // display loading
    that.html(loader);

    $.ajax({
      url: banana_ajax.ajax_url,
      type: "POST",
      data: {
        action: "banana_get_template",
        nonce: banana_ajax.nonce,
        post_id: postID,
      },
      success: function (response) {
        if (response.success) {
          $("#banana-template-title").val(response.data.title);
          $("#banana-template-type").val(response.data.type);
          $("#banana-template-condition").val(response.data.condition);

          // override modal title
          $(".modal__title").text("Edit Template");
          $("#banana-template-modal").attr("data-post-id", parseInt(postID)).fadeIn();

          // change loading state to edit
          that.html("Edit");

          // button state change
          buttonStateChange(btn);
        }
      },
    });
  });
});
