<link rel="stylesheet" type="text/css" href="modul/materials/css.css">
<script type="text/javascript" src="modul/materials/js.js"></script>

<?
$url_g = f_data ($_GET[url], 'text', 0)
?>

<table width="100%" border="0">
  <tr>
    <td>
    	<a href="?page=add_folder_materials<? if (isset($_GET[url])) echo "&url=".$url_g; ?>" class="button_save">Добавить категорию</a> 
        <? if (isset($_GET[url])) { ?><a href="?page=add_pages<? if (isset($_GET[url])) echo "&url=".$url_g; ?>" class="button_save">Добавить страницу</a><? } ?>
    </td>
    <td style="text-align:right;">
    	<form action="" method="get" class="frm_search_small">
    		<? if (isset($_GET[search])) {$search = f_data ($_GET[search], 'text', 0);} ?>
        	<input type="hidden" name="page" value="<? echo $_GET[page]; ?>">
            <input name="search" type="text" placeholder="поиск..." required value="<? echo $search; ?>"> 
            <input name="button" type="submit" value="найти">
        </form>
    </td>
  </tr>
</table>



<?
	if (isset($_GET[url])) 
	{
		$history = $_GET[url];
		$history = f_data ($history, 'text', 0);
		
		$where_url = "WHERE url='$_GET[url]'";
		if (substr_count($history,"/")>0)
		{
			$history = explode("/",$_GET[url]);
			
			for ($i=0; $i<count($history); $i++)
			{
				$result = mysql_query("SELECT * FROM folder_materials WHERE id='$history[$i]'");
				$myrow = mysql_fetch_assoc($result); 	
				if ($myrow[url]!="") {$back_url = "$myrow[url]/$myrow[id]";} else {$back_url = "$myrow[id]";}	
				$new_history .= "<a href='?page=materials&url=$back_url'>$myrow[name]</a> > ";	
			}
			
			$new_history = substr($new_history,0,-2);
			$history = "<a href='?page=materials'>Главная категория</a> > $new_history";			
		}
		else
		{
			$result = mysql_query("SELECT * FROM folder_materials WHERE id='$_GET[url]'");
			$myrow = mysql_fetch_assoc($result); 
			$history = "<a href='?page=materials'>Главная категория</a> > $myrow[name]";					
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
$result = mysql_query("SELECT * FROM folder_materials $where_url ORDER BY id ASC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

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
			$readonly_edit = "<a href='?page=add_folder_materials&url=$_GET[url]&id=$myrow[id]' class='edit_link'>изменить</a>";
		}
		else
		{
			$readonly_del = "<span style='color:red'>запрещено</span>"; 
			$readonly_edit = "<span style='color:red'>запрещено</span>"; 			
		}
		
		if ($myrow[url]!="") {$url=$myrow[url]."/";} else {$url="";}
		$url = "<a href='?page=materials&url=$url$myrow[id]' style='color:#333'>$myrow[name]</a>";
						
		echo "
			  <tr>
				<td style='text-align:center;'>$enabled</td>
				<td style='text-align:center'>$myrow[id]</td>
				<td><img src='img/folder.png' height='18' align='left' style='margin-right:5px'> $url</td>
				<td style='text-align:center;'>$readonly_edit</td>
				<td style='text-align:center; width:65px'>$readonly_del</td>
			  </tr>		
		";
	}while($myrow = mysql_fetch_assoc($result));
}

echo "</table>";
}
?>


<br>



<? 
if (isset($_GET[url]) || isset($_GET[search])) 
{ 

	if (isset($_GET[search])) 
	{
		$search = trim($_GET[search]);
		$search = f_data ($search, 'text', 0);
		
		if ($search!='')
		{
			$result = mysql_query("SELECT * FROM pages WHERE name LIKE '%$search%' || text LIKE '%$search%'");
			$history = "<a href='?page=materials' style='display:inline-block; margin-right:5px; color:#333'>Вернуться назад</a> | ";
			//echo $history;
			echo "<div style='color:#333'>$history Поиск по запросу: <b>$search</b></div><br>";
		}
		else
		{
			echo "<div style='padding:5px; background-color:red; color:#FFF; font-weight:bold'>Недопустимое значение поиска!</div>";	
		}
	}
	else
	{
		$result = mysql_query("SELECT * FROM pages WHERE url='$_GET[url]' ORDER BY number ASC");
		echo "<div style='padding:7px; background-color:#5995d7; color:#FFF; font-weight:bold; border-radius:3px 3px 0px 0px; font-size:13px'>Страницы</div>";
	}

?>


<table width="100%" border="0" id="tbl_obj"  class="draggedTable">
  <tr>
    <th style="width:30px; text-align:center;">Актив</th>
    <th style="text-align:center; width:30px">№</th>
    <th style="text-align:left">Заголовок</th>
    <th style="text-align:left; width:290px">Ссылка</th>
    <th style="width:65px"></th>
    <th style="width:65px"></th>
  </tr>
<?



@$num_rows = mysql_num_rows($result);
if ($num_rows!=0)
{
	$myrow = mysql_fetch_assoc($result); 
	
	do
	{
		$enabled = $myrow['enabled']; //активность новости
		$readonly = $myrow['readonly']; //активность новости
		if ($enabled==1) {$enabled="<img src='img/enabled.png' height='20' class='button_enabl' num='0' value='$myrow[id]' num2='pages'>";} 
		else {$enabled="<img src='img/disabled.png' height='20' class='button_enabl' num='1' value='$myrow[id]' num2='pages'>";}
		
		if ($readonly!=1) 
		{
			$readonly_del = "<a href='#' class='popop del_page del_link' num='$myrow[id]'>удалить</a>"; 
		}
		
		$readonly_edit = "<a href='?page=add_pages&url=$myrow[url]&id=$myrow[id]' class='edit_link'>изменить</a>";
		
		if ($myrow[url]!="") {$url=$myrow[url]."";} else {$url="";}
		$url = "<a href='?page=add_pages&url=$url&id=$myrow[id]' style='color:#333'>$myrow[name]</a>";

		$m_link = explode("/",$myrow[m_link]);
		$m_link = $m_link[(count($m_link)-1)];
		
		$link_page = "<input name='hr' type='text' value='http://$_SERVER[HTTP_HOST]/$m_link/' style='width:97%; z-index:70'>";
		if ($myrow[id]==1) {$link_page = "<input name='hr' type='text' value='http://$_SERVER[HTTP_HOST]/' style='width:97%; z-index:70'>";}
		if ($myrow[id]==2) {$link_page = "<input name='hr' type='text' value='http://$_SERVER[HTTP_HOST]/o-nas/' style='width:97%; z-index:70'>";}
		if ($myrow[id]==3) {$link_page = "<input name='hr' type='text' value='http://$_SERVER[HTTP_HOST]/kontakty/' style='width:97%; z-index:70'>";}
		
								
		echo "
			  <tr num='$myrow[number]' id='$myrow[id]' url='$_GET[url]'>
				<td style='text-align:center;'>$enabled</td>
				<td style='text-align:center'>$myrow[number]</td>
				<td><img src='img/page.png' height='18' align='left' style='margin-right:5px'> $url</td>
				<td>$link_page</td>
				<td style='text-align:center;'>$readonly_edit</td>
				<td style='text-align:center;'>$readonly_del</td>
			  </tr>		
		";
	}while($myrow = mysql_fetch_assoc($result));
}


?>

</table>


<? } ?> 