<? setcookie("mob",''); ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Авторизация в системе</title>
<link href="css/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-2.0.3.min.js"></script>

<script>
$(document).ready(function() {
	$(".b_ent").click(function() {
		$(".main_bg_preload").fadeIn();
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
		  if (data!='' && data!='0')
		  {
			  $(".main_bg_preload").fadeOut();
			  window.location.href = 'cookie.php?uid='+data;
		  }
		  else
		  {
			$(".main_bg_preload").fadeOut();
			alert('Неправильный логин или пароль!');  
		  }
		}
	});
	
});
</script>

</head>

<body>
    <div style="padding:8px; font-size:12px; position:absolute; bottom:0px; left:0px; font-weight:bold; color:#FFF; text-align:center">
    ЕвроCMS 3.0 | техподдержка info@8630.ru | 2013
    </div>  
    
<div class="main_bg_preload"><img src="../img/add_cart.gif" alt="" width="128" height="100" /></div>
    
<div style="position:relative; height:100%">
    <div style="font-size:24px; color:#FFF; font-weight:bold; text-align:center; margin-top:60px; margin-bottom:30px">ВХОД В СИСТЕМУ</div>
    
    <div align="center">
        <input name="name" ype="text" class='name pole_enter' required placeholder="Введите свой e-mail"/>
        <input name="pass" type="text" class='pass pole_enter' required placeholder="Пароль"/>
        <label class="label_enter"><input name="zapomnit" class="zapomnit" type="checkbox" value="" checked="checked" /> запомнить меня</label>
        <div class="b_ent">войти</div>
    </div>

<br /><br /><br /><br /><br /><br /><br />

</div>
</body>
</html>