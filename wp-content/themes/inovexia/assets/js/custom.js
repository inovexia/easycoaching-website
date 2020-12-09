jQuery(document).ready(function () {
  jQuery(".content-layout:nth-child(2n+1)").addClass(
    "border-top border-bottom"
  );
  jQuery(".content-layout:nth-child(2n+1) .right").addClass("order-first");
  jQuery(".content-layout:last-child").addClass("border-bottom");
});

jQuery(document).ready(function () {
  var videoSrc;
  jQuery(".video-btn").click(function () {
    var videoSrc = jQuery(this).data("src");
  });
  console.log(videoSrc);

  jQuery("#myModal").on("shown.bs.modal", function (e) {
    jQuery("#video").attr(
      "src",
      videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"
    );
  });
  jQuery("#myModal").on("hide.bs.modal", function (e) {
    jQuery("#video").attr("src", videoSrc);
  });
});
