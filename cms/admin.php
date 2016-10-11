<? if (isset($_GET[mob])) {$mob=1; setcookie("mob",1);} else {if (isset($_COOKIE[mob])) {$mob=1;} else {$mob=0;}}?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="Cache-Control" content="no-cache">
<meta name="robots" content="noindex,nofollow" />
<title>Авторизация в системе</title>
<link href="css/css.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="/cms/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/cms/js/admin_script.js"></script>


</head>

<?
	$ip = $_SERVER['REMOTE_ADDR'];
	if (@fopen("logs/$ip.txt", "r")) {
		$fp = fopen("logs/$ip.txt", "r"); $kol_enter = 5-fgets($fp, 1024); fclose($fp);
		if (date ("d.m.Y", filemtime("logs/$ip.txt"))!=date("d.m.Y")) {unlink("logs/$ip.txt");}
	} 
	else {$kol_enter = 5;}

?>

<body class="body_admin">

<?

//откуда пришел пользователь
$url_back = $_GET['url_back'];


//определение мобильного устройства
function mobile_detect()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $ipod = strpos($user_agent,"iPod");
    $iphone = strpos($user_agent,"iPhone");
    $android = strpos($user_agent,"Android");
    $symb = strpos($user_agent,"Symbian");
    $winphone = strpos($user_agent,"WindowsPhone");
    $wp7 = strpos($user_agent,"WP7");
    $wp8 = strpos($user_agent,"WP8");
    $operam = strpos($user_agent,"Opera M");
    $palm = strpos($user_agent,"webOS");
    $berry = strpos($user_agent,"BlackBerry");
    $mobile = strpos($user_agent,"Mobile");
    $htc = strpos($user_agent,"HTC_");
    $fennec = strpos($user_agent,"Fennec/");

    if ($ipod || $iphone || $android || $symb || $winphone || $wp7 || $wp8 || $operam || $palm || $berry || $mobile || $htc || $fennec) 
    {
        return true; 
    } 
    else
    {
        return false; 
    }
}


if  (mobile_detect() && $mob==0)
{
?>
 
<div class="main_bg_mob">
	<a href="/cms/admin.php?mob" class="close_box_to_mob">X</a>
    <div class="box_to_mob">
    	<br /><img src="img/ico_mob_phone.png" width="128" height="128" /><br /><br />
		Вы заходите в систему управления с мобильного устройства, Вы хотите перейти на мобильную версию системы управления?<br /><br />
        <a href="/cmsm/" class="yes_admin_enter">ДА</a><br />
        <a href="/cms/admin.php?mob" class="no_admin_enter">НЕТ</a>
    </div>
</div> 
    
<?	
}
else
{
?>


	<div class="toolbar">
    	<div class="block1_toolbar">
			<a href="http://<? echo $_SERVER[HTTP_HOST]; ?>" target="_blank"><? echo $_SERVER[HTTP_HOST]; ?></a>
            <img src="img/el2_toolbar.png" width="21" height="21" style="position:absolute; top:16px; left:17px;"/>
        </div>
        
    	<div class="block2_toolbar">
			Администрирование
            <img src="img/el3_toolbar.png" width="25" height="26"/>
        </div>    
        
        <div class="el_toolbar"></div>    
    </div>

    
<div class="left_admin_enter">
    <div class="title_admin_form_versiy">
    ЕвроCMS 3.6 | техподдержка info@8630.ru | 2016
    </div> 
    
    <? if ($kol_enter!=5) {echo "<div class='num_error'>Осталось попыток: <span>$kol_enter</span></div>";} ?>
    
    <div class="title_enter_sys">Вход в систему управления</div>
    <div class="title_enter_sys2">
    	Чтобы войти в систему введите свой e-mail, 
        пароль и нажмите кнопку: «Войти».
    </div>
    
    <div class="div_form_ent">
    	<form autocomplete="off" action="" method="post" class="frm_enter">
            <div style="font-size:16px">E-mail</div>
            <input autocomplete="off" name="name" type="text" class='name pole_enter' required tabindex="1" value=""/>
            
            <table width="100%" border="0" style="margin-bottom:-3px;">
              <tr>
                <td><div style="font-size:16px">Пароль</div></td>
                <td style="text-align:right; padding-top:4px;">
                <a href="who_pass.php" class="btn_who_pass" target="_blank">вспомнить пароль</a></td>
              </tr>
            </table>
            <div style="position:relative">
            <input name="pass" type="password" class='pass pole_enter' required tabindex="2"  value=""/>
            <img src="img/oko0.png" alt="" width="32" height="32" class='oko'/></div>
            <br />
     
     		<input name="zapomnit" class="zapomnit_ch" type="checkbox" checked="checked" style="display:none"/>
            <table width="100%" border="0" style="margin-bottom:-3px;">
              <tr>
                <td style="padding-top:5px"><div class="zapomnit"></div></td>
                <td style="text-align:right"><input name="button" type="button" value="войти" class="btn_enter"/></td>
              </tr>
            </table>        
            <input type="hidden" name="url_back" value="<? echo $url_back; ?>" />
            <input type="hidden" name="token" value="VVLJKHJ7789twdVds9yFF5462" />
		</form>
    </div>


	 <div class="line_left_enter"></div>

    <div class="box_dop_inf_mob">
    	<? if (isset($_COOKIE[mob])) { ?>
        <div class="box_dop_inf_mob2">ВЫ НАХОДИТЕСЬ НА САЙТЕ С МОБИЛЬНОГО УСТРОЙСТВА, ВЫ ТАКЖЕ МОЖЕТЕ ВОСПОЛЬЗОВАТЬСЯ МОБИЛЬНОЙ ВЕРСИЕЙ САЙТА. 
        <br /><a href="/cmsm/" class="btn_go_mob">ПЕРЕЙТИ</a><br /> </div><?  } ?>
        Если у вас возникли вопросы со входом, 
        то обратитесь в службу поддержки:
    </div>

    <div class="phone_form_enter">
		Тел: 8 (863) 255-44-22 <br />
        Е-mail: info@eurosites.ru
        <img src="img/ico_phone.png" alt="p" width="14" height="14" style="position:absolute; top:4px; left:2px;"/>
        <img src="img/ico_mail.png" alt="m"  height="12" style="position:absolute; top:26px; left:2px;"/>
    </div>
    
    <div class="inf_pri_obrashen">
        При обращении на e-mail укажите адрес
        сайта в теме письма.
    </div>
    
        
<?
include("../blocks/f_data.php");
if (isset($_GET[msg])) { 

$msg = f_data ($_GET[msg], 'text', 0);
if ($msg==100)
{
	$msg = "Кроссдоменное обращение запрещено!";
}
elseif ($msg==101)
{
	$msg = "Неправильный логин или пароль! Повторите ввод!";
}
elseif ($msg==102)
{
	$msg = "Вы заблокированы!";
}
?>


<div id="msg_admin" style="display:block">
	<div class="msg_admin_box">
    	<div class="msg_admin_title">Информация</div>
        <div class="msg_admin_text"><? echo $msg; ?></div>
         <div class="msg_admin_num_enter"></div>
        <div align="center"><div class="msg_admin_btn">закрыть</div></div>
    </div>
</div>
<? } ?>

</div>

<? } ?>
</body>
</html>