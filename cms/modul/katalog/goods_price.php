<link rel="stylesheet" type="text/css" href="modul/katalog/css.css">
<script type="text/javascript" src="modul/katalog/js.js"></script>

<?
	if (isset($_GET[del]))
	{
		//удаление
		$del = mysql_query ("DELETE FROM curent WHERE id = '$_GET[del]'",$db);	
		echo "<script>window.location.href = '?page=goods_price&msg=”даление прошло успешно!'</script>";	
	}

	if (trim($_POST[curent])!='' && !isset($_POST[edit]))
	{
		//добавление
		$result_add = mysql_query ("INSERT INTO curent (name) VALUES ('$_POST[curent]')");	
		echo "<script>window.location.href = '?page=goods_price&msg=¬алюта дабавлена!'</script>";		
	}
	
	if (isset($_GET[cur]))
	{
		//редактирование
		$result_edit = mysql_query("UPDATE curent SET enabled='0'", $db);
		$result_edit = mysql_query("UPDATE curent SET enabled='1' WHERE id='$_GET[cur]'", $db);
		echo "<script>window.location.href = '?page=goods_price&msg=»зменение прошло успешно!'</script>";
	}
	
	if (isset($_GET[edit]))
	{
		$result = mysql_query("SELECT * FROM curent WHERE id='$_GET[edit]'");
		$myrow = mysql_fetch_assoc($result); 
		$num_rows = mysql_num_rows($result);		
	}

	if (isset($_POST[edit]) && trim($_POST[curent])!='')
	{
		$result_edit = mysql_query("UPDATE curent SET name='$_POST[curent]' WHERE id='$_POST[edit]'", $db);		
		echo "<script>window.location.href = '?page=goods_price&msg=¬алюта изменена!'</script>";
	}	
?>

<form action="" method="post">
Ќова€ валюта <input name="curent" type="text" size="20" value="<? echo $myrow[name]; ?>">
<input name="button" type="submit" value="сохранить" class="button_save">
<?
	if ($num_rows!=0) {echo "<input type='hidden' name='edit' value='$myrow[id]'>";}
?> 
</form>

<br><br>

<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:180px">Ќазначить по умолчанию</th>
    <th style="text-align:left;">Ќазвание</th>
    <th style="text-align:right; width:60px"></th>
  </tr>
  
<?
//запрос к базе
$result = mysql_query("SELECT * FROM curent");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		$enabled = $myrow['enabled']; //активность новости
		if ($enabled==1) {$enabled="<span style='color:red'>приоритетна€ валюта</span>";} 
		else {$enabled="<a href='?page=goods_price&cur=$myrow[id]' style='color:green'>назначить приоритетной</a>";}
		if ($myrow[readonly]!=1) {$del="<a href='#' style='color:red' class='del_cur1 popop del_link' num='$myrow[id]'>удалить</a>";} else {$del='';}
		
		echo "
		  <tr>
			<td style='text-align:left'>$enabled</td>
			<td style='text-align:left'><a href='?page=goods_price&edit=$myrow[id]' style='color:#333'>$myrow[name]</a></td>
			<td style='text-align:center'>$del</td>
		  </tr>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
?>

</table>