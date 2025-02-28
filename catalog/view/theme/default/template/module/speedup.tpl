<script language="javascript">
$("img").each(function() {
	$(this).attr("data-original",$(this).attr("src"));
	$(this).removeAttr("src");
});
$(function() {
	$("img").lazyload({
		event : "sporty",
		effect : "fadeIn",
		placeholder: "<?php echo $imglazyload_placeholder_thmb;?>",
	});
});
$(window).bind("load", function() {
	var timeout = setTimeout(function() {
		$("img").trigger("sporty")
	}, <?php echo $speedup_imglazyload_delaytime;?>);
}); 
</script>