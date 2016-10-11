<? 
setcookie("mob",''); 
if (!isset($_COOKIE[uid]))
{
 	Header("location:/cmsm/admin.php");	
	exit;		
}
include("blocks/db.php"); 

//запрос к базе, получение настроек
$result_s = mysql_query("SELECT * FROM settings");
$SETTINGS = mysql_fetch_assoc($result_s); 

?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Система управления сайтом</title>
<link href="css/css.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript" src="/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>

<body style="background:none !important">
<div id="telo">
    <div class="head_mini">
    <a href="/cmsm/" style="text-decoration:none; color:#FFF; font-weight:bold">ЕвроCMS 3.0</a>
    <a href="#" style="position:absolute; right:9px; top:14px; display:block; color:#FFF; font-size:14px; color:#FFF" class="open_right">меню</a>
    </div>
    
    <div class="top_block">
    	<div style="height:100%; width:100%; position:relative">
        <br />
            <a href="/cmsm/">Главная</a>
             <? if ($SETTINGS[desc_1]==1) { ?><a href="?page=zakaz">Заказы</a><? } ?>
             <? if ($SETTINGS[desc_2]==1) { ?><a href="?page=zayvki">Заявки</a><? } ?>
             <? if ($SETTINGS[desc_3]==1) { ?><a href="?page=obr_svyz">Обратная связь</a><? } ?>
             <? if ($SETTINGS[desc_4]==1) { ?><a href="?page=comments">Комментарии</a><? } ?>
             <? if ($SETTINGS[desc_5]==1) { ?><a href="?page=vopros_otvet">Вопрос ответ</a><? } ?>
             <? if ($SETTINGS[desc_6]==1) { ?><a href="?page=otziv">Отзывы</a><? } ?>
             <a href="#" style="position:absolute; right:1px; top:6px; display:block; color:#FFF; font-size:14px; color:#FFF" class="open_right">меню</a>
        </div>
  	</div>
    
    <?
    	if (isset($_GET[page]))
		{
			echo "<div class='title_page'>";
			if ($_GET[page]=="zakaz") {echo "Заказы";}
			if ($_GET[page]=="zayvki") {echo "Заявки";}
			if ($_GET[page]=="obr_svyz") {echo "Обратная связь";}
			if ($_GET[page]=="comments") {echo "Комментарии";}
			if ($_GET[page]=="vopros_otvet") {echo "Вопрос-ответ";}
			if ($_GET[page]=="otziv") {echo "Отзывы";}
			echo "</div>";	
		}
	?>
    
    <div style="padding:5px;">    
    <?
    
	include("blocks/include.php");
	
	
	$result_u = mysql_query("SELECT * FROM users WHERE uid='$_COOKIE[uid]'");
	$myrow_u = mysql_fetch_assoc($result_u); 
	?>
    </div>

    <div style="padding:8px; font-size:12px; position:relative; font-weight:bold; color:#6c6c6c; text-align:center">
        <table width="100%" border="0">
          <tr>
            <td style="text-align:center; width:49%"><? echo $_SERVER['HTTP_HOST']; ?></td>
            <td style="text-align:center; width:50%; font-weight:bold">
            <div style='display:inline-block; margin-right:5px;'><? echo $myrow_u[name]; ?></div> | 
            <a href="cookie.php?exit" style="color:red; font-size:16px; margin-left:5px">выход</a></td>
          </tr>
        </table>
    </div>
    
    <div class="footor_mini">
    ЕвроCMS 3.0 | техподдержка info@8630.ru | 2013
    <a href="#" style="position:absolute; right:4px; top:2px; display:block; " class="open_right"></a>
    </div>    
</div>
</body>
</html>