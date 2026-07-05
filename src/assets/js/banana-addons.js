jQuery(document).ready(function ($) {
  //wrapper-link
  $("body").on("click", "[data-banae-element-link]", function () {
    const $wrapper = $(this);
    const data = $wrapper.data("banae-element-link");
    const id = $wrapper.data("id");
    const anchor = document.createElement("a");

    anchor.id = "banana-addons-wrapper-link-" + id;
    anchor.href = data.url;
    anchor.target = data.is_external ? "_blank" : "_self";
    anchor.rel = data.nofollow ? "nofollow noreferer" : "";
    anchor.style.display = "none";

    //append the link
    document.body.appendChild(anchor);
    //self click the link
    const anchorReal = document.getElementById(anchor.id);
    anchorReal.click();

    const timeout = setTimeout(function () {
      document.body.removeChild(anchorReal);
      clearTimeout(timeout);
    });
  });
});
