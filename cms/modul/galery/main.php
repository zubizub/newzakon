<link rel="stylesheet" type="text/css" href="modul/galery/css.css">
<script type="text/javascript" src="modul/galery/js.js"></script>

<a href="?page=add_galery_cat" class="button_save">Добавить папку</a>

<br><br>


<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:30px">Актив</th>
    <th style="text-align:left; width:30px">№</th>
    <th style="text-align:left">Заголовок</th>
    <th style="width:220px">Пользователь</th>
    <th style="width:100px">Дата</th>
    <th style="width:65px"></th>
    <th style="width:65px"></th>
  </tr>
  
<?
//запрос к базе
$result = mysql_query("SELECT * FROM galery_cat ORDER BY id ASC");
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
		
		
		echo "
		  <tr id='$myrow[id]' >
			<td style='text-align:center'>$enabled</td>
			<td style='text-align:center'>$myrow[id]</td>
			<td><a href='?page=galery_img&id=$myrow[id]' style='color:#333'>$myrow[name]</a></td>
			<td>$user</td>
			<td>$myrow[date]</td>
			<td style='width:55px'><a href='?page=add_galery_cat&id=$myrow[id]' style='display:inline-block' class='edit_link'>изменить</a></td>
			<td style='text-align:center'><a href='#' style='color:red' class='del_news1 popop del_link' num='$myrow[id]'>удалить</a></td>
		  </tr>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
	
}
else
{
		echo "
		  <tr>
			<th colspan='7'>Новостей папок</th>
		  </tr>  		
		";	
}

?>

</table>

<br>
<?
$result = mysql_query("SELECT * FROM galery_cat");
$num_rows = mysql_num_rows($result);
?>

<div class="oboznach">
	<img src="img/disabled.png" height="12">  Папка неактивна <img src="img/enabled.png" height="12">  Папка активна
</div>


<br>

<?  $page="galery"; include("blocks/meta_other.php"); ?>