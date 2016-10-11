$(document).ready(function() {
	$(".slid_btn").click(function() {
		var id_slid = $(this).attr("num_slide");
		$(".slid_img").css('display','none');
		$(".title_slid").css('display','none');
		$(".text_slid").css('display','none');
		
		$(".slid_img"+id_slid).fadeIn();
		$(".title_slid"+id_slid).fadeIn();
		$(".text_slid"+id_slid).fadeIn();
		
		$('.slid_btn').removeClass('slid_btn_h');
		$(this).addClass('slid_btn_h');
		timer.stop();;
	});
	
	
	var timer;
	var timeout = 3700;
	var id_slid = 2;
	timer = $.timer(timeout, function() {
		$(".slid_img").css('display','none');
		$(".title_slid").css('display','none');
		$(".text_slid").css('display','none');
		
		$(".slid_img"+id_slid).fadeIn();
		$(".title_slid"+id_slid).fadeIn();
		$(".text_slid"+id_slid).fadeIn();
		
		$('.slid_btn').removeClass('slid_btn_h');
		$('[num_slide = '+id_slid+']').addClass('slid_btn_h');		
		if (id_slid<($(".count_slide").val()-1)) {id_slid++;} else {id_slid=1;}		 
	});			
});