$(document).ready(function() {
	var id_slid2 = 1;
	
	$(".slider2_nav_left").click(function() {
		if (id_slid2!=1) {id_slid2--;} else {id_slid2=4;}
		slider2_left(id_slid2);
		timer.stop();
	});
	
	$(".slider2_nav_right").click(function() {
		if (id_slid2!=4) {id_slid2++;} else {id_slid2=1;}
		slider2_right(id_slid2);
		timer.stop();
	});	
	
	
	var timer;
	var timeout = 3700;
	timer = $.timer(timeout, function() {
		if (id_slid2!=4) {id_slid2++;} else {id_slid2=1;} 
		slider2_right(id_slid2)
	});		
	
	
	 $("#box_slider2").on("swiperight", function(e){
	 	$(".slider2_nav_left").click();
	 });
	 
	 $("#box_slider2").on("swipeleft", function(e){
	 	$(".slider2_nav_right").click();
	 });		
});


function slider2_left(id_slid2)
{
	var id_slid2_left = 0;
	if (id_slid2!=4) {id_slid2_left = id_slid2+1;} else {id_slid2_left=1;}
	
	$(".slider2_img").css("right","-980px");

	$(".slider2_img"+id_slid2_left).css("right","0px");
	$(".slider2_img"+id_slid2_left).animate({right:"-980px"},500,"easeInOutQuart");	
	
	$(".slider2_img"+id_slid2).css("right","980px");
	$(".slider2_img"+id_slid2).animate({right:"0px"},400);
}


function slider2_right(id_slid2)
{
	var id_slid2_right = 0;
	if (id_slid2>1 && id_slid2<=4) {id_slid2_right = id_slid2-1;} else {id_slid2_right=1;}
	if (id_slid2==1) {id_slid2_right=4;}
	
	$(".slider2_img").css("right","-980px");
	$(".slider2_img"+id_slid2_right).css("right","0px");
	$(".slider2_img"+id_slid2_right).animate({right:"980px"},500,"easeInOutQuart");
	
	$(".slider2_img"+id_slid2).animate({right:"0px"},500,"easeInOutQuart");
}