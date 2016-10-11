
$(document).ready(function() {
	var open_right = 0;
	$(".open_right").click(function() {
		if (open_right==0) {$(".top_block").fadeIn(); open_right=1;} 
		else {$(".top_block").fadeOut(); open_right=0;}
	});
});

