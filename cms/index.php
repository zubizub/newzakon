<? include("blocks/start.php"); ?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta name="robots" content="noindex,nofollow" />
<? include("blocks/description.php"); ?>
<title><? echo $name_page; ?></title>


<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link type="text/css" rel="stylesheet" href="tinymce/all.min.css" />
<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="js/jquery.timer.js"></script>
<script type="text/javascript" src="js/tablednd.js"></script>
<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<? if (isset($_GET[page]) && 1==2) { ?><script type="text/javascript" src="tinymce/all.min.js"></script><? } ?>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>


<body>
<div style="height:55px; background-image:url(img/toolbar.png); position:relative" class="toolbar">
    <div class="block1_toolbar">
        <a href="http://<? echo $_SERVER[HTTP_HOST]; ?>" target="_blank"><? echo $_SERVER[HTTP_HOST]; ?></a>
        <img src="img/el2_toolbar.png" alt="" width="21" height="21" style="position:absolute; top:16px; left:17px;"/>
    </div>
    
    <div class="block2_toolbar">
        Администрирование
        <img src="img/el3_toolbar.png" alt="" width="25" height="26" style="position:absolute; top:14px; left:17px;"/>
    </div>    
    
    <div class="block3_toolbar">
        <a href="#"><? echo $NAME_USER; ?><img src="img/down_strel.png" width="7" height="9" style="margin-left:6px"></a>
        <img src="img/el4_toolbar.png" alt="" width="25" height="26" style="position:absolute; top:14px; left:17px;"/>
        <div class="block3_toolbar_list">
        	<a href="?page=admin_contacts">настройки сайта</a>
            <a href="?page=dostup">контроль доступа</a>
            <a href="http://eurosites.ru/help/" target="_blank">база знаний</a>
            <a href="../cookie.php?exit">выход</a>
            <div class="enter_who">Вошли как: [<? echo $STATUS_USER; ?>]</div>
            <div style="height:5px; background-color:#2f5984;"></div>
        </div>
    </div> 
    
    <div class="block4_toolbar">
        <form action="" method="get">
        	<input name="search" type="text" required placeholder="Поиск...">
            <input type="hidden" name="page" value="search_site">
            <input name="button" type="submit" value="">
        </form>
    </div>      
             
             
    <div class="stat_toolbar">
    	<div class="stat_toolbar_div">
			<?
                echo "Домен: ".$ostatok_day_domain." дня (ей)<br>";
                echo "Хостинг: ".$ostatok_day_host." дня (ей)<br>";
            ?>        
        </div>
    </div>         
             
</div>

<table width="100%" border="0">
  <tr>
    <td style="width:300px; overflow:hidden; position:relative; border-right:1px solid #e9ecee; position:relative" class='td_left'>
    	<? include("blocks/left_menu.php"); ?>
        <a href="#" class="popup close_left_menu" style="font-weight:bold; display:block; font-size:12px; color:#3a6592; text-decoration:none; position:absolute; right:7px; top:12px">
        <img src="img/close_left.png" width="15" height="15" border="0">
        </a>
    </td>
    <td style="background-color:#FFF">
        <div id="center_div">
            <?	
				echo "<div id='name_page'>$name_page</div>";
				
				include("blocks/include.php");           
            ?>
        </div>    
    </td>
  </tr>
</table>

<br>

<div style="height:55px; background-image:url(img/toolbar.png); position:relative" class="toolbar">
	<div class="footer_menu">
    	ЕвроCMS 3.6 
        <a href="http://eurosites.ru" style="margin-left:22px" target="_blank">Разработчики</a> | 
        <a href="http://eurosites.ru/help/" target="_blank">Справочное руководство</a> | 
        <a href="/cmsm/">Мобильная версия</a>
    </div>
</div>

<? include("blocks/msgBox.php"); ?>

</body>
</html>
