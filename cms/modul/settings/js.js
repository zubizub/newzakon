$(document).ready(function() {
	$(".code_block").focusout(function() {
		var code_block = $(".code_block").val();
		if (code_block.match("yandex.ru")) {$(".chet_1").fadeIn();} else {$(".chet_1").fadeOut();}
		if (code_block.match("mail.ru")) {$(".chet_2").fadeIn();} else {$(".chet_2").fadeOut();}
		if (code_block.match("rambler.ru")) {$(".chet_3").fadeIn();} else {$(".chet_3").fadeOut();}
		if (code_block.match("liveinternet.ru")) {$(".chet_4").fadeIn();} else {$(".chet_4").fadeOut();}
	});
	
	
	$(".del_file").click(function() {
		$("div [num="+$(this).attr("value")+"]").fadeOut();
		$.post("modul/settings/ajax_delfile.php",
		  {
			file_url: $(this).attr("num")
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  alert("Файл удален!");
		}		
	});	
	
	
	$(".ch_modul").click(function() {
		var id_ch = $(this).val();
		var val_ch = $(this).attr('num');
		
		$.post("modul/settings/ajax_moduls.php",
		  {
			id: $(this).val(),
			ch: $(this).attr('num')
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  $(".s_ch_"+id_ch).fadeIn().delay(400).fadeOut();
		}		
	});	
	
	
	
	$(".button_enabl").click(function() {
		$.post("modul/settings/ajax.php",
		  {
			num: $(this).attr("num"),
			id: $(this).attr("value")
		  }
		);
		
		if ($(this).attr("num")==0) {$(this).attr("src",'img/disabled.png'); $(this).attr("num",'1');} else {$(this).attr("src",'img/enabled.png'); $(this).attr("num",'0');}		
	});	
	
	
	$(".del_user").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/settings/obr_add_user.php?del="+$(this).attr("num"));
		
	});	
	
	
	$(".creat_sitemap").click(function() {
		$.post("modul/settings/ajax_creat_sitemap.php",
		  {
			creat: "1"
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
			$(".mag_creat_sitemap").html("sitemap.xml создан, он содержит страниц: "+data+" шт.");
		    $(".mag_creat_sitemap").fadeIn().delay(3000).fadeOut();
		}		
	});
	
	
	$(".gen_htaccess").click(function() {
		$.post("modul/settings/gen_htaccess.php",
		  {
			param1: "param1"
		  },
		  onAjaxSuccess
		);
 
		function onAjaxSuccess(data)
		{
		  $(".gen_htaccess_msg").fadeIn().delay(3000).fadeOut();
		}
	});
	
	
	$(".gen_adm").click(function() {
		$.post("modul/settings/gen_adm.php",
		  {
			param1: "param1"
		  },
		  onAjaxSuccess
		);
 
		function onAjaxSuccess(data)
		{
		  $(".gen_adm_msg").fadeIn().delay(3000).fadeOut();
		}
	});	
	

	var pole_p = 1;
	
	$(".add_pereadresat").on("click",function(){ 
		$(".pole_input").append("<div style='padding-bottom:7px; padding-top:2px' class='pole_"+pole_p+"'>Какую <input name='pole_pereadr_"+pole_p+"' placeholder='ссылка, какую страницу переадресовать' required style='width:240px'> на какую страницу <input name='pole_pereadr_to_"+pole_p+"' style='width:240px' placeholder='ссылка, на какую страницу переадресовать' required> <a href='#' num='"+pole_p+"' class='popup' style='text-decoration:none; color:red'>X</a></div>");
		
		$(".pole_input").delegate("a", "click", function(e){
		  $(".pole_"+$(this).attr("num")).remove()
		  e.preventDefault();
		});		
		
		pole_p++;	
	});
	
	
	$(".del_pereadr").on("click",function() {
		 $(".pole_"+$(this).attr("num")).remove();
		 $.post("modul/settings/ajax_del_dereadres.php",{id: $(this).attr("num")});
	});
	
	
	$(".btn_nav_vnedr").on("click",function() {
		$(".box_vnedr").css("display","none");
		$(".box_vnedr"+$(this).attr("num")).css("display","block");
		$(".btn_nav_vnedr").removeClass("btn_nav_vnedr_h");
		$(this).addClass("btn_nav_vnedr_h");
	})
	
	$(".btn_nav_vnedr[num='"+$(".click_btn_select").val()+"']").click();
	
});
