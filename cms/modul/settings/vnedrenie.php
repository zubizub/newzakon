<link rel="stylesheet" type="text/css" href="modul/settings/css.css">
<script type="text/javascript" src="modul/settings/js.js"></script>

<?

	$result_config = mysql_query("SELECT * FROM settings");
	$SETTINGS = mysql_fetch_assoc($result_config); 
	$add_code = $SETTINGS[add_code];
	
?>
<a href="#" class="popup creat_sitemap" style="font-size:16px; font-weight:bold; color:#333">Сгенерировать sitemap.xml</a> 

<a href="modul/settings/backup_htaccess.php" style="font-size:16px; font-weight:bold; color:#333; margin-left:13px;">Восстановить .htaccess</a>


<Br><span class="mag_creat_sitemap" style="color:#F00; font-size:13px"></span><br>


<a href="#" class="popup btn_nav_vnedr btn_nav_vnedr_h" num="1">Код счетчиков</a>
<a href="#" class="popup btn_nav_vnedr" num="2">Файл .htaccess</a>
<a href="#" class="popup btn_nav_vnedr" num="3">Файл robots.txt</a>
<a href="#" class="popup btn_nav_vnedr" num="4">favicon</a>
<a href="#" class="popup btn_nav_vnedr" num="5">Файлы</a>
<a href="#" class="popup btn_nav_vnedr" num="6">Редиректы</a>
<a href="#" class="popup btn_nav_vnedr" num="7">Формулы URL</a>
<a href="#" class="popup btn_nav_vnedr" num="8">CSS</a>

<div style="background-color:#eaf5fe; padding:10px; display: block;" class="box_vnedr box_vnedr1"><br>
Код счетчиков и т.п. (данный код будет встроен на все страницы сайта):<BR>
<form action="modul/settings/obr_vnedrenie.php" method="post">
<table width="100%" border="0">
  <tr>
    <td style="width:500px">
        <textarea name="code" class="code_block" rows="20" style="width:500px; font-size:12px"><? echo $add_code; ?></textarea><br>
        <input name="button" type="submit" value="сохранить" class="button_save">    
    </td>
    <td style="padding-left:20px">
    	<div class="inf_chechik">
<div class='chet_1' <? if (substr_count($add_code, "yandex.ru")==0) {echo "style='display:none'";} ?>>Найден счетчик <b><span style='color:red'>Я</span>ндекс</b></div>
<div class='chet_2' <? if (substr_count($add_code, "mail.ru")==0) {echo "style='display:none'";} ?>>Найден счетчик <b><span style='color:#24609C'>Майл</span></b></div>
<div class='chet_3' <? if (substr_count($add_code, "rambler.ru")==0) {echo "style='display:none'";} ?>>Найден счетчик <b><span style='color:#FF781A'>Рамблер</span></b></div>
<div class='chet_4' <? if (substr_count($add_code, "liveinternet.ru")==0) {echo "style='display:none'";} ?>>Найден счетчик <b><span style='color:#6A93CB'>Live</span>Internet</b></div>
	
        </div>
    </td>
  </tr>
</table>
<input type="hidden" name="edit_code">
</form>

</div>


<div style="background-color:#ebfeea; padding:10px;" class="box_vnedr box_vnedr2">
Файл .htaccess
<br>
<form action="modul/settings/obr_vnedrenie.php" method="post">
<textarea name="code" rows="35" style="width:620px; font-size:12px">
<?php
	 $fp = fopen("../.htaccess", "r"); // Открываем файл в режиме чтения
	 if ($fp) 
	 {
	 while (!feof($fp))
	 {
	 $mytext = fgets($fp, 999);
	 echo $mytext;
	 }
	 }
	 else echo "Ошибка при открытии файла";
	 fclose($fp);
 ?>
</textarea>
<div style="font-size:11px; color:#F00;">Внимание, изменение данного файла может повлиять на работоспособность сайта.</div>

<input type="hidden" name="edit_htaccess">
<input name="button" type="submit" value="сохранить" class="button_save">    
</form>

</div>


<div style="background-color:#fef6ea; padding:10px;" class="box_vnedr box_vnedr3">
Файл robots.txt
<br>
<form action="modul/settings/obr_vnedrenie.php" method="post">
<textarea name="code" rows="10" style="width:500px; font-size:12px">
<?php
	 $fp = fopen("../robots.txt", "r"); // Открываем файл в режиме чтения
	 if ($fp) 
	 {
	 while (!feof($fp))
	 {
	 $mytext = fgets($fp, 999);
	 echo $mytext;
	 }
	 }
	 else echo "Ошибка при открытии файла";
	 fclose($fp);
 ?>
</textarea>
<input type="hidden" name="edit_robots">
<br>
<input name="button" type="submit" value="сохранить" class="button_save">    
</form>
</div>



<a name="edit_favicon"></a>
<div style="background-color:#fde1e1; padding:10px;" class="box_vnedr box_vnedr4">
    <table width="100%" border="0">
      <tr>
        <td style="width:350px; vertical-align:top; border-right:1px solid #CCC; padding-right:30px">
            Файл favicon (мини-изображение отображаемое в заголовке сайта, формат *.ico)
            <br>
            <div style="height:58px; width:177px; position:relative; background-image:url(img/block_favicon.jpg); border:1px dotted #CCC; margin:5px;">
                <img src="/favicon.ico" width="15" height="15" style="position:absolute; top:7px; left:7px;">
            </div>
            
            <form action="modul/settings/obr_vnedrenie.php" method="post" enctype="multipart/form-data">
            Обновить изображение: <input name="img" type="file"> 
            <input type="hidden" name="edit_favicon"><br>
            <input name="button" type="submit" value="сохранить" class="button_save">    
            </form>    
        </td>
        <td style="vertical-align:top; padding-left:35px">
        
            Файл favicon для закладок (мини-изображение отображаемое в закладках браузера, формат *.jpg (300x250px))
            <br>
              <br>
        	<table width="100%" border="0">
              <tr>
                <td style="width:130px; vertical-align:top; padding-right:15px">
                    <img src="/favicon.jpg" width="120" height="90">
                </td>
                <td style="vertical-align:top">
                    <form action="modul/settings/obr_vnedrenie.php" method="post" enctype="multipart/form-data">
                    Обновить изображение: <input name="img" type="file"> 
                    <input type="hidden" name="edit_favicon2"><br>
                    <input name="button" type="submit" value="сохранить" class="button_save">    
                    </form>                  
                </td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
</div>



<div style="background-color:#eef3fe; padding:10px"  class="box_vnedr box_vnedr5">
	Файлы:<br>
    <div style="font-size:11px;">
	<?
            @$dir    = "../";
            @$files_img = scandir($dir);    
            $j=0;
            
            for ($i=0;$i<=30;$i++)
            {
                if ($files_img[$i]!='' && $files_img[$i]!='.' && $files_img[$i]!='..' && $files_img[$i]!="Thumbs.db" && $files_img[$i]!=".htaccess" && $files_img[$i]!="blocks" && $files_img[$i]!="cms" && $files_img[$i]!="css" && $files_img[$i]!="fancybox" && $files_img[$i]!="favicon.ico" && $files_img[$i]!="images" && $files_img[$i]!="img" && $files_img[$i]!="index.php" && $files_img[$i]!="js" && $files_img[$i]!="print.php" && $files_img[$i]!="robots.txt" && $files_img[$i]!="site_ban.php" && $files_img[$i]!="site_off.php" && $files_img[$i]!="uploads") 
                {
                        echo "<div num='div$i'>
                        <a href='#' style='display:inline-block; color:red; margin-right:5px; text-decoration:none' class='popup del_file' num='../$files_img[$i]' value='div$i'>X</a>
                        <a href='../$files_img[$i]' style='display:inline-block; color:#333' target='_blank'>$files_img[$i]</a></div>";	
						$j++;	
                }
            } 
			
			if ($j==0) {echo "Файлов не найдено.";}

    ?>  
    </div>
    <br>
     
    <form action="modul/settings/obr_vnedrenie.php" method="post" enctype="multipart/form-data">
    Загрузить файл: <input name="file" type="file"> 
    <input type="hidden" name="edit_file"><br>
    <input name="button" type="submit" value="сохранить" class="button_save">    
    </form>    
</div>


<a name="pereadresat"></a>
<div style="background-color:#f1f1f1; padding:10px" class="box_vnedr box_vnedr6">

Переадресация (редиректы).<br><br>
<form action="modul/settings/obr_vnedrenie.php" method="post" enctype="multipart/form-data">
	<?
    //запрос к базе
    $result = mysql_query("SELECT * FROM pereadresat ORDER BY id DESC");
    $myrow = mysql_fetch_assoc($result); 
    $num_rows = mysql_num_rows($result);
    
    if ($num_rows!=0)
    {
        do
        {
            echo "<div style='padding-bottom:7px; padding-top:7px' class='pole_$myrow[id]'>Какую <input name='text' value='$myrow[url]' style='width:300px' readonly> на какую страницу 
    <input name='text' style='width:300px' value='$myrow[url_to]' readonly> <a href='#' num='$myrow[id]' class='popup del_pereadr' style='text-decoration:none; color:red'>X</a></div>";
        }while($myrow = mysql_fetch_assoc($result));
    }
    ?>
	<div class="pole_input">
    	Чтобы добавить переадресацию нужно нажать "<b>добавить</b>"
    </div>
	<a href="#" class="popup add_pereadresat" style="color:#000; font-size:13px; display:block; padding-top:10px;">добавить</a>
    
    <input name="button" type="submit" value="сохранить" class="button_save"> 
    <Br>
    <br>
    <div style="font-style:italic; font-size:12px;">
    Чтобы настроить переадресацию необходимо правильно указать адреса страниц, например:
    <div style='padding-bottom:7px; padding-top:7px'>
    Какую <input name='text' value='<? echo $_SERVER[HTTP_HOST]; ?>/about/' style='width:260px'> 
    на какую страницу <input name='text' style='width:260px' value='<? echo $_SERVER[HTTP_HOST]; ?>/contacts/'>
    </div>
    
    Если Вы хотите установить переадресацию на главную страницу, то необходимо в поле "<b>на какую страницу</b>" поставить "<b>/</b>".<br>
    <span style="color:#F00">ВНИМАНИЕ! Переадресации нельзя изменять (уже созданые), можно создать новую, а старую удалить.</span>
    </div>
    
    <input type="hidden" name="pereadresat">
</form>
</div>



<div style="background-color:#fffafb; padding:10px" class="box_vnedr box_vnedr7">

Введите формулы для заголовков и описание товаров.<br>
<form action="modul/settings/obr_vnedrenie.php" method="post" enctype="multipart/form-data">
	<div class="title_pole_vnedr">Title</div>
    <input type="text" name="formula_title_goods" placeholder="Введите формулу" style="width:550px" value="<? echo $SETTINGS[formula_title_goods]; ?>">
    <Br>
    <div class="title_pole_vnedr">Description</div>
    <textarea name="formula_desc_goods" class="desc_goods"><? echo $SETTINGS[formula_desc_goods]; ?></textarea>
    <Br>
    <input type="submit" value="сохранить"/>
</form>
<div>
	<b>Например:</b> Купить [goods] в интернет магазине.<Br>
	<div class="vnedrenie_oboznach">
		Обозначения: 
		<span>[goods]</span> - товар, 
		<span>[cat]</span> - ближайшая категория, 
		<span>[allcat]</span> - все категории и подкатегории товара, 
		<span>[price]</span> - цена руб<Br>
		Используйте <span>{}</span>, для перевода в нижний регистр, например <span>{goods}</span>.
	</div>
</div>

</div>



<div style="background-color:#fef6ea; padding:10px;" class="box_vnedr box_vnedr8">
Файл CSS
<br>
<form action="modul/settings/obr_vnedrenie.php" method="post">
<textarea name="code" rows="40" style="width:680px; font-size:12px">
<?php
	 $fp = fopen("../css/user.css", "r"); // Открываем файл в режиме чтения
	 if ($fp) 
	 {
	 while (!feof($fp))
	 {
	 $mytext = fgets($fp, 999);
	 echo $mytext;
	 }
	 }
	 else echo "Ошибка при открытии файла";
	 fclose($fp);
 ?>
</textarea>
<input type="hidden" name="edit_css">
<br>
<input name="button" type="submit" value="сохранить" class="button_save">    
</form>
</div>



<br><Br>


<?
	$num=1;
	if ($_GET[num])
	{
		$num = f_data($_GET['num'],'text',0);
?>
	<input type="hidden" class="click_btn_select" value="<? echo $num; ?>"/>
<?		
	}
?>