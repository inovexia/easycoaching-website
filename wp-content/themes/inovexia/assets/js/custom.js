jQuery(document).ready(function () {
  jQuery(".content-layout:nth-child(2n+1)").addClass(
    "border-top pt-3 border-bottom"
  );
  jQuery(".content-layout:nth-child(2n+1) .right").addClass("order-first");
});
