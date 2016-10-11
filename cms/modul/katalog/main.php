<link rel="stylesheet" type="text/css" href="modul/katalog/css.css">
<script type="text/javascript" src="modul/katalog/js.js"></script>

<?
$url = f_data ($_GET[url], 'text', 0);
$page = f_data ($_GET[page], 'text', 0);
?>

<table width="100%" border="0">
  <tr>
    <td style="vertical-align:top">
    	<? if (!isset($_GET[search])) { ?>
    	<a href="?page=add_folder_katalog<? if (isset($_GET[url])) echo "&url=".$url; ?>" class="button_save">Добавить категорию</a> 
    	<? } ?>
    	
        <? if (isset($_GET[url])) { ?>
        <a href="?page=add_goods<? if (isset($_GET[url])) echo "&url=".$url; ?>" class="button_save">Добавить товар</a>
        <? } ?>
    </td>
    <td style="text-align:right; vertical-align:top">
    	<form action="" method="get" style="margin-top:10px" class="frm_search_small">
    		<? if (isset($_GET[search])) {$search = f_data ($_GET[search], 'text', 0);} ?>
        	<input type="hidden" name="page" value="<? echo $page; ?>">
            <input name="search" type="text" class="frm_search_small" placeholder="поиск..." required value="<? echo $search; ?>"> 
            <input name="button" type="submit" value="найти">
        </form>
    </td>
  </tr>
</table>



<?
	if (isset($_GET[url])) 
	{
		$history = $_GET[url];
		$where_url = "WHERE url='$url'";
		if (substr_count($history,"/")>0)
		{
			$history = explode("/",$url);
			
			for ($i=0; $i<count($history); $i++)
			{
				$result = mysql_query("SELECT * FROM katalog WHERE id='$history[$i]'");
				$myrow = mysql_fetch_assoc($result); 	
				if ($myrow[url]!="") {$back_url = "$myrow[url]/$myrow[id]";} else {$back_url = "$myrow[id]";}	
				$new_history .= "<a href='?page=katalog&url=$back_url'>$myrow[name]</a> > ";	
			}
			
			$new_history = substr($new_history,0,-2);
			$history = "<a href='?page=katalog'>Главная категория</a> > $new_history";			
		}
		else
		{
			$result = mysql_query("SELECT * FROM katalog WHERE id='$url'");
			$myrow = mysql_fetch_assoc($result); 
			$history = "<a href='?page=katalog'>Главная категория</a> > $myrow[name]";					
		}
	}
	else
	{
		$where_url = "WHERE url=''";
	}
	
	
if (!isset($_GET[search])) {	
	
	echo "<div class='history'>$history</div>";
?>



<div style="padding:7px; background-color:#467bb5; color:#FFF; font-weight:bold; border-radius:3px 3px 0px 0px; font-size:13px">Категории</div>
<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:30px; text-align:center;">Актив</th>
    <th style="text-align:center; width:30px">№</th>
    <th style="text-align:left">Заголовок</th>
    <th style="width:65px"></th>
    <th style="width:65px"></th>
  </tr>
<?

	
//запрос к базе
$result = mysql_query("SELECT * FROM katalog $where_url ORDER BY id ASC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$url_get = f_data ($_GET[url], 'text', 0);

if ($num_rows!=0)
{
	do
	{
		$enabled = $myrow['enabled']; //активность новости
		$readonly = $myrow['readonly']; //активность новости
		if ($enabled==1) {$enabled="<img src='img/enabled.png' height='20' class='button_enabl' num='0' value='$myrow[id]' num2='material'>";} 
		else {$enabled="<img src='img/disabled.png' height='20' class='button_enabl' num='1' value='$myrow[id]' num2='material'>";}
		if ($readonly!=1) 
		{
			$readonly_del = "<a href='#' class='popop del_folder del_link' num='$myrow[id]'>удалить</a>"; 
			$readonly_edit = "<a href='?page=add_folder_katalog&url=$url_get&id=$myrow[id]' class='edit_link'>изменить</a>";
		}
		else
		{
			$readonly_del = "<span style='color:red'>запрещено</span>"; 
			$readonly_edit = "<span style='color:red'>запрещено</span>"; 			
		}
		
		if ($myrow[url]!="") {$url=$myrow[url]."/";} else {$url="";}
		$url = "<a href='?page=katalog&url=$url$myrow[id]' style='color:#333'>$myrow[name]</a>";
						
		echo "
			  <tr>
				<td style='text-align:center;'>$enabled</td>
				<td style='text-align:center'>$myrow[id]</td>
				<td><img src='img/folder.png' height='18' align='left' style='margin-right:5px'> $url</td>
				<td style='text-align:center;'>$readonly_edit</td>
				<td style='text-align:center;'>$readonly_del</td>
			  </tr>		
		";
	}while($myrow = mysql_fetch_assoc($result));
}

echo "</table>";
}
?>

<br>
<?

$result_settings = mysql_query("SELECT * FROM settings");
$myrow_settings = mysql_fetch_assoc($result_settings); 

?>
<div class="box-goods_in_cat_katalog">
	Отображение доп. товаров в категориях: 
	<select class="goods_in_cat_katalog">
		<option value="1" <? if ($myrow_settings[goods_in_cat_katalog]==1) {echo "selected";}?>>да</option>
		<option value="0" <? if ($myrow_settings[goods_in_cat_katalog]==0) {echo "selected";}?>>нет</option>
	</select>
	<input type="button" value="OK" class="btn-goods_in_cat_katalog"/>
</div>
<Br>


<? 
if (!isset($_GET['pages'])) {$pages = 0;} else {$pages = ($_GET['pages']-1)*28;}

if (isset($_GET[url]) || isset($_GET[search]) || $_GET[url]!='') 
{ 

	if (isset($_GET[search])) 
	{
		$search = f_data ($_GET[search], 'text', 0);
		
		if ($search!='')
		{
			$result = mysql_query("SELECT * FROM goods WHERE name LIKE '%$search%' || text LIKE '%$search%' || art LIKE '%$search%'  LIMIT $pages, 28");
			$history = "<a href='?page=katalog' style='display:inline-block; margin-right:5px; color:#333'>Главная категория</a> | ";

			echo "<div style='color:#333'>$history Поиск по запросу: <b>$search</b></div><br>";
		}
		else
		{
			echo "<div style='padding:5px; background-color:red; color:#FFF; font-weight:bold'>Недопустимое значение поиска!</div>";	
		}
	}
	else
	{
		$result = mysql_query("SELECT * FROM goods WHERE url='$url_get' ORDER BY number ASC LIMIT $pages, 28");
		echo "<div style='padding:7px; background-color:#5995d7; color:#FFF; font-weight:bold; border-radius:3px 3px 0px 0px; font-size:13px'>Товары</div>";
	}

?>


<table width="100%" border="0" class="draggedTable tbl_obj">
  <tr>
  	<th style="width:30px; text-align:center;" class="select_td">
  		<input name="all_chek" id="all_chek" type="checkbox" value="">
  	</th>
    <th style="width:30px; text-align:center;">Актив</th>    
    <th style="text-align:center; width:30px">№</th>
    <th style="text-align:left">Заголовок</th>
    <th style="width:85px">Стоимость</th>
    <th style="width:65px"></th>
    <th style="width:65px"></th>
  </tr>
<?



@$num_rows = mysql_num_rows($result);
if ($num_rows!=0)
{
	//запрос к базе
	$myrow = mysql_fetch_assoc($result); 
	
	do
	{
		$enabled = $myrow['enabled']; //активность новости
		$readonly = $myrow['readonly']; //активность новости
		if ($enabled==1) {$enabled="<img src='img/enabled.png' height='20' class='button_enabl' num='0' value='$myrow[id]' num2='goods'>";} 
		else {$enabled="<img src='img/disabled.png' height='20' class='button_enabl' num='1' value='$myrow[id]' num2='goods'>";}
		
		if ($readonly!=1) 
		{
			$readonly_del = "<a href='#' class='popop del_page del_link popup' num='$myrow[id]'>удалить</a>"; 
			$readonly_edit = "<a href='?page=add_goods&url=$myrow[url]&id=$myrow[id]' class='edit_link'>изменить</a>";
		}

		
		if ($myrow[url]!="") {$url=$myrow[url]."";} else {$url="";}
		$url = "<a href='?page=add_goods&url=$url&id=$myrow[id]' style='color:#333'>$myrow[name]</a>";
		
		if ($myrow[stamp]==1) {$stamp = 'style="background-color:#ffdddd !important; border:1px solid #edabab !important"';} else {$stamp = '';}
						
		echo "
			  <tr class='goods_rows goods_rows_$myrow[id]' num='$myrow[number]' id='$myrow[id]' url='$_GET[url]' $stamp>
			  	<td style='width:30px; text-align:center;' class='select_td'>
			  		<input name='obj_chek[]' class='obj_chek' type='checkbox' value='$myrow[id]'>
			  	</td>
				<td style='text-align:center;'>$enabled</td>
				<td style='text-align:center'>$myrow[number]</td>
				<td><img src='img/goods.png' height='16' align='left' style='margin-right:5px'> $url</td>
				<td style=''>$myrow[price1]</td>
				<td style='text-align:center;'>$readonly_edit</td>
				<td style='text-align:center;'>$readonly_del</td>
			  </tr>		
		";
	}while($myrow = mysql_fetch_assoc($result));
}


?>

</table>
<br>

<!--Форма перемещения товара-->
<a href="#" class="popup select_goods">выделить товары</a>
<div class="dop_deystviy">
	Выделенно товаров: <span class="kol_videlenno">0</span> шт.
	<a href='#' class="popup tofolder_goods">переместить</a>
    <a href='#' class="popup copyfolder_goods">копировать</a>
	<a href='#' class="popup del_goods">удалить</a>
	<input type="hidden" class="pole_url"/>
	
	<div class="box_peremestit">
		<div>Куда переместить товары?</div>
		<div><? include("modul/katalog/list_kategoty.php"); ?></div>
		<a href="#" class="popup btn_ok_peremestit">переместить</a> <a href="#" class="popup btn_cancel_peremestit">отменить</a>
	</div>
</div>

<span style="font-size: 12px; color:#999; display: inline-block; margin-left: 10px; margin-right: 10px;">|</span> 
<img src="/img/preloader.gif" class='img_update_number_goods'/> <a href="#" class="popup update_number_goods">обновить нумерацию</a>
<input type="hidden" class="url_cat" value="<? echo $url_get; ?>"> 




<br><br>
<div align="left">
<?php 

	if (isset($_GET[search])) 
	{
		if ($search!='')
		{
			$result = mysql_query("SELECT * FROM goods WHERE name LIKE '%$search%' || text LIKE '%$search%'");
			$search = "&search=$search";
		}
	}
	else
	{
		$result = mysql_query("SELECT * FROM goods WHERE url='$url_get' ORDER BY number ASC");
		$search = '';
	}
	
	$j=1;
	
	$num_rows = mysql_num_rows($result);
	include("blocks/number_pages.php");
	pages_number($num_rows,"?page=katalog&url=$url_get$search",28);
?>

</div>
<? } ?> 


<? if (!isset($_GET[url]) && !isset($_GET[search])) { $page="katalog"; include("blocks/meta_other.php"); } ?>