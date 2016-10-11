<link rel="stylesheet" type="text/css" href="modul/katalog/css.css">
<script type="text/javascript" src="modul/katalog/js.js"></script>

<div><a href='index.php?page=add_cat_harakteristika' title='добавление характеристики' class="button_save">Добавить группу характеристик</a></div><br>

<?

	$result_h = mysql_query("SELECT * FROM goods_harakteristiki");
	
	
	if (mysql_num_rows($result_h)!=0)
	{
		
	$myrow_h = mysql_fetch_array($result_h);  
?>


<table width="100%" id="tbl_obj">
  <tr>
    <th style="width:20px; text-align:center">№</th>
    <th style="width:320px; text-align:left">Имя</th>
    <th>Описание</th>
    <th style="width:50px;"></th>
    <th style="width:50px;"></th>
  </tr>

<?
		do
		{
			echo "
			  <tr>
				<td style='text-align:center'>$myrow_h[id]</td>
				<td><a href='?page=harakter_all&cat=$myrow_h[id]' style='color:#333'>$myrow_h[name]</a></td>
				<td>$myrow_h[descript]</td>
				<td style='text-align:center; width:60px'><a href='?page=add_cat_harakteristika&id=$myrow_h[id]' title='изменить' class='edit_link'>изменить</a></td>
				<td style='text-align:center; width:60px'><a href='#' title='удалить' class='del_har popop del_link' num='$myrow_h[id]'>удалить</a></td>
			  </tr>			
			";
		}while($myrow_h = mysql_fetch_array($result_h));

	}

?>

</table>

