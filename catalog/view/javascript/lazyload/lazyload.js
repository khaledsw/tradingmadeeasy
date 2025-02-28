$("img.img-responsive").each(function() {
    $(this).attr("data-original",$(this).attr("src"));
    $(this).removeAttr("src");
});
$("img.img-responsive").lazyload({
    effect : "fadeIn",
	placeholder: "image/ajax-loader.gif"
});