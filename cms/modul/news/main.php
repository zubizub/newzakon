<link rel="stylesheet" type="text/css" href="modul/news/css.css">
<script type="text/javascript" src="modul/news/js.js"></script>

<? $page_g = f_data ($_GET[page], 'text', 0); ?>

<table width="100%" border="0">
  <tr>
    <td>
    	<a href="?page=add_news" class="button_save">Добавить новость</a>
    </td>
    <td style="text-align:right;">
    	<form action="" method="get">
        	<input type="hidden" name="page" value="<? echo $page_g; ?>">
            <input name="search" type="text" class="text_pole" value="поиск..."> 
            <input name="button" type="submit" value="найти">
        </form>
    </td>
  </tr>
</table>


<br>
<?
	if (isset($_GET[search]))
	{
		$search = trim($_GET[search]);
		$search = f_data ($search, 'text', 0);
		
		$sql_search = "WHERE name LIKE '%$search%' || text LIKE '%$search%'";	
		echo "<a href='?page=news' style='color:#60a6ee'>Вернуться к новостям</a> | Вы искали: <b>$search</b><br><br>";
	}
	else
	{
		$sql_search = "";
	}
?>

<table width="100%" border="0" id="tbl_obj" class="draggedTable">
  <tr>
    <th style="width:30px">Актив</th>
    <th style="text-align:left; width:30px">№</th>
    <th style="text-align:left">Заголовок</th>
    <th style="width:220px">Пользователь</th>
    <th style="width:100px">Дата</th>
    <th style="width:65px"></th>
  </tr>
  
<?
//запрос к базе
$result = mysql_query("SELECT * FROM news $sql_search ORDER BY number ASC LIMIT 100");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
		$enabled = $myrow['enabled']; //активность новости
		if ($enabled==1) {$enabled="<img src='img/enabled.png' height='20' class='button_enabl' num='0' value='$myrow[id]'>";} 
		else {$enabled="<img src='img/disabled.png' height='20' class='button_enabl' num='1' value='$myrow[id]'>";}
		
		//кто из пользователей добавил
		@$result1 = mysql_query("SELECT * FROM users WHERE uid='$myrow[user]'");
		@$myrow1 = mysql_fetch_assoc($result1); 
		@$num_rows1 = mysql_num_rows($result1);
		if ($num_rows1==0) {$user = "Администратор";} else {$user = $myrow1[fio];}
		
		if ($i>$SETTINGS[num_rows]) {$display="style='display:none' class='fide_rows'";} else {$display="";}
		
		echo "
		  <tr $display num='$myrow[number]' id='$myrow[id]' >
			<td style='text-align:center'>$enabled</td>
			<td style='text-align:center'>$myrow[number]</td>
			<td><a href='?page=add_news&id=$myrow[id]' style='color:#333'>$myrow[name]</a></td>
			<td>$user</td>
			<td>$myrow[date]</td>
			<td style='text-align:center'><a href='#' style='color:red' class='del_news1 popop' num='$myrow[id]'>удалить</a></td>
		  </tr>  		
		";
		
		$i++;
		$j++;		
	}while($myrow = mysql_fetch_assoc($result));
	
	if ($num_rows>$SETTINGS[num_rows])
	{
		echo "
		  <tr>
			<th colspan='6'><a href='#' class='popop fadein_news'>Показать все новости</a></th>
		  </tr>  		
		";			
	}
}
else
{
		echo "
		  <tr>
			<th colspan='6'>Новостей нет</th>
		  </tr>  		
		";	
}

?>

</table>


<br>
<?
$result = mysql_query("SELECT * FROM news");
$num_rows = mysql_num_rows($result);
?>
<div style="text-align:right; padding:3px; color:#333; font-size:12px">Всего новостей: <b><? echo $num_rows; ?></b> 
| В архиве: <span title='Новости, за вычетом 100 последних'><b><? if ($num_rows>100) {echo $num_rows-100;} else {echo "0";} ?></b></span></div>

<div class="oboznach">
	<img src="img/disabled.png" height="12">  Новость неактивна <img src="img/enabled.png" height="12">  Новость активна
</div>

<br>

<? $page="news"; include("blocks/meta_other.php"); ?>