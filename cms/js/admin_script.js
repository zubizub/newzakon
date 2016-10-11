$(document).ready(function() {
	$(".b_ent").click(function() {
		$(".main_bg_preload").fadeIn();
		
		  $.post("blocks/ajax_num_enter.php",
		  {
				name1: 1
			  },
			  onAjaxSuccess2
		  );
		 
		  function onAjaxSuccess2(data)
		  {	
		  	$(".msg_admin_num_enter").html("Осталось попыток: "+(data-1));
		  }
		  
		  
		  $.post("blocks/ajax_enter.php",
		  {
				name: $(".name").val(),
				pass: $(".pass").val(),
				zapomnit: $(".zapomnit").prop("checked")
			  },
			  onAjaxSuccess
			);
		 
		function onAjaxSuccess(data)
		{
		  if (data!='' && data!='772' && data!='771' && data!='773')
		  {
			  $(".main_bg_preload").fadeOut();
			  window.location.href = '../cookie.php?u='+data;
		  }
		  else if (data=='772')
		  {
			$(".main_bg_preload").fadeOut();
			$(".msg_admin_text").html("Неправильный логин или пароль!<Br>Повторите ввод!");
			$("#msg_admin").fadeIn(); 
		  }
		  else if (data=='773')
		  {
			$(".main_bg_preload").fadeOut();
			$(".msg_admin_text").html("Вы заблокированы!");
			$(".msg_admin_num_enter").html("Осталось попыток: 0");
			$("#msg_admin").fadeIn(); 
		  }		  
		  else if (data=='771')
		  {
			$(".main_bg_preload").fadeOut();
			$(".msg_admin_text").html("Кросдоменное обращение запрещено!");
			$("#msg_admin").fadeIn(); 
		  }	
		  else
		  {
			  alert('Ошибка');
		  }
		}
	});
	
	
	$(".msg_admin_btn").click(function() {
		$("#msg_admin").fadeOut();
	});
	
	var $zapomnit = 1;
	$(".zapomnit").on('click',function() {
		if ($zapomnit==0)
		{
			$(this).css("background-image","url(img/zapomnit.png)");
			$zapomnit = 1;
			$(".zapomnit_ch").click();
		}
		else
		{
			$(this).css("background-image","url(img/zapomnit0.png)");
			$zapomnit = 0;
			$(".zapomnit_ch").click();
		}
		
	});
	
	$(".btn_enter").on('click',function() {
		$(this).val("ждите...");
		$(".pole_enter").removeClass("error_pole");
		$(".pole_enter").each(function(indx, element){
			if ($(element).val()=='' && $(element).val()==' ') {$(element).addClass("error_pole"); $(".btn_enter").val("войти");} 
			else {$(".frm_enter").attr("action","blocks/enter.php"); if ($(".btn_enter").attr("type")=='button') {$(".btn_enter").val("войти");}}
		});
	});
	
	var $pass_type = 0;
	
	$(".oko").on('click',function() {
		if ($pass_type==0) {$(".pass").attr("type","text"); $(this).attr('src','img/oko1.png'); $pass_type=1;} 
		else {$(".pass").attr("type","password"); $(this).attr('src','img/oko0.png'); $pass_type=0;}
	});
	
	$(".left_admin_enter").css("min-height",($(window).height()-90)+"px"); 
	$(".toolbar").css("width",($(window).width()+55)+"px"); 
	$(".main_bg_mob").css("min-height",($(window).height())+"px"); 
	
	var $ent=0;
	$('.pass').keyup(function (e) { 
		testString($('.pass').val());
	});	
	
	$(".name").val(' ');
	$(".name").focusin(function() {
		if ($(this).val()==" ") {$(this).val('');}	
	})
	
	
	$(".pass").focusin(function() {
		testString($(".name").val());
		testString($(".pass").val());
	})

	$(".name").focusout(function() {
		testString($(".name").val());
		testString($(".pass").val());
	})	
});

//валидность пароля
function testString(obj){
	var re=new RegExp('^[a-zA-Z0-9]+$');
	if(!re.test(obj)) {$(".error_pass").fadeIn(); $(".btn_enter").attr('type','button');} 
	else {$(".btn_enter").attr('type','submit'); $(".error_pass").fadeOut();}
}