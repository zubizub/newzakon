<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Востановление пароля</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/js/jquery.maskedinput-1.3.min.js"></script>

<script>

$(document).ready(function() {
	$(".phone").mask("8 999 999-9999");
	
	$(".send_admin_btn").on('click',function() {
		$(".bg_form").fadeIn();
		$.post("blocks/ajax_whopass.php", {data_post: $(".phone").val()},  onAjaxSuccess);
 
		function onAjaxSuccess(data)
		{
			$(".bg_form").fadeOut();
			if (data==1) {alert("Информация Вам отправлена");} else {alert("Вы ввели неправильную информацию");}
		}
	});
	
	
		$(document).keypress(function (e) { 
            if ((e.which == 13)) {
                   $(".btn_enter").click();
            }
        });	
	
});

</script>

</head>

<body style="background-image:url(img/who_pass.jpeg)">

<div style="width:980px; margin:auto; position:relative">

<div id="msg_admin" style="display:block; font-size:12px !important">
	<div class="msg_admin_box">
    	<div class="msg_admin_title">Востановление пароля</div>
        <div class="msg_admin_text" style="font-size:18px !important; line-height:22px">Для того чтобы востановить пароль, введите свой номер мобильного телефона: 
        <input name="phone" autofocus type="text" class="phone" style="isplay:block; width:63%; padding:10px; font-size:37px; color:#02296c; border:1px solid #5d7588; border-radius:3px 3px 3px 3px; margin-bottom:-10px; margin-top:5px; box-shadow: 0px 0px 10px rgba(198, 211, 231, 1);"></div>
         <div class="msg_admin_num_enter"></div>
        <div align="center"><div class="send_admin_btn btn_enter">отправить</div></div>
        <div class="bg_form" style="background-color:rgba(41,106,239,0.6);  position:absolute; top:0px; left:0px; height:100%; width:100%; background-image:url(../img/add_cart.gif); background-repeat:no-repeat; background-position:162px 100px; display:none;"></div>
    </div>
</div>

</div>

</body>
</html>