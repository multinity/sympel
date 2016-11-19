$(function(){
	$(".main").css({
		minHeight: $(window).height() -72
	})

	$(window).on("load resize", function(){
		if($(window).width() < 480) {
			$("#toggle-sidebar").on("click", function() {
				if(!$(this).hasClass("hide-sidebar")) {
					$(".sidebar").show();
					$(this).addClass("hide-sidebar");
				}else{
					$(".sidebar").hide();
					$(this).removeClass("hide-sidebar");
				}
				return false;
			})
		}else{
			var $logoW = $(".navbar .logo").width(),
					$mainP = $(".sidebar").outerWidth();
			$("#toggle-sidebar").on("click", function() {
				var $this = $(this);

				if(!$this.hasClass("hide-sidebar")) {
					$(".sidebar").animate({
						marginLeft: -200
					})
					$(".navbar .logo").css({
						overflow: 'hidden'
					})
					.animate({
						width: 0
					})
					$(".main").animate({
						paddingLeft: 20
					})
					$this.addClass("hide-sidebar");
				}else{
					$(".sidebar").animate({
						marginLeft: 0
					})
					$(".navbar .logo").css({
						overflow: 'initial'
					})
					.animate({
						width: $logoW + 1
					})
					$(".main").animate({
						paddingLeft: $mainP + 19
					})
					$this.removeClass("hide-sidebar");
				}
				return false;
			})
		}
	})
})