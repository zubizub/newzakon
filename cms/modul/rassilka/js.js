$(document).ready(function() {

	$(".del_zayvki1").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/rassilka/obr_zayvki.php?del="+$(this).attr("num"));
		
	});
	
	
	
var num_chek=0;
		var url_link = "";		
			
	  $("#all_chek").click(function () {
		  	num_chek=0;
			url_link='';
			if (!$("#all_chek").is(":checked"))
			{
				$(".obj_chek").removeAttr("checked");
			}
			else 
			{
				$(".obj_chek").prop("checked","checked");
				$(".link_del").fadeIn();
			}
			
			$(".obj_chek").each(function(indx){
			  if ($(this).is(":checked")) {$(".link_de").fadeIn(); num_chek++; url_link+=$(this).val()+",";}
			});	

			if (num_chek==0) {$(".link_del").fadeOut();} 
			else {
				$(".link_del").attr("href","modul/rassilka/obr_zayvki.php?del="+url_link);
			}
	  });			
	

		

		$(".obj_chek").click(function ()
		{
			num_chek=0;
			url_link='';
			if ($(this).is(":checked")==false) {$("#all_chek").attr("checked",false); $(".link_del").fadeIn();}
			
			$(".obj_chek").each(function(indx){
			  if ($(this).is(":checked")) {$(".link_del").fadeIn(); num_chek++; url_link+=$(this).val()+",";}
			});	

			if (num_chek==0) {$(".link_del").fadeOut();} 
			else 
			{
				$(".link_del").attr("href","modul/rassilka/obr_zayvki.php?del="+url_link);
			}
		});		
		
		
	$(".btn_import_users").click(function() {
		$(".box_link_import_user").html("<img src='img/add_cart.gif' height='15'/>");
		 
		$.post("modul/rassilka/ajax_import.php",  {param1: "param1"}, onAjaxSuccess);
		 
		function onAjaxSuccess(data)
		{
		  $(".box_link_import_user").html("Импортировано пользователей: "+data).delay(400);
		  window.location.href = '?page=rassilka'
		}			
	})

});
