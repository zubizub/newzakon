$(document).ready(function() {
	$(".button_enabl").click(function() {
		$.post("modul/obr_svyz/ajax.php",
		  {
			num: $(this).attr("num"),
			id: $(this).attr("value")
		  }
		);
		
		if ($(this).attr("num")==0) {$(this).attr("src",'img/disabled.png'); $(this).attr("num",'1');} else {$(this).attr("src",'img/enabled.png'); $(this).attr("num",'0');}		
	});
	
	
	$(".del_zayvki1").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/obr_svyz/obr_obr_svyz.php?del="+$(this).attr("num"));
		
	});
	
});
