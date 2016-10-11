<? 

		$result = mysql_query("SELECT * FROM goods WHERE stamp='1' ORDER BY number ASC");
		echo "<div style='padding:7px; background-color:#467bb5; color:#FFF; font-weight:bold; border-radius:3px 3px 0px 0px; font-size:13px'>Выделеные товары</div>";

?>


<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:30px; text-align:center;">Актив</th>
    <th style="text-align:center; width:30px">№</th>
    <th style="text-align:left">Заголовок</th>
    <th style="width:85px">Стоимость</th>
    <th style="width:65px"></th>
    <th style="width:55px"></th>
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
			$readonly_del = "<a href='#' class='popop del_page del_link' num='$myrow[id]'>удалить</a>"; 
			$readonly_edit = "<a href='?page=add_goods&url=$myrow[url]&id=$myrow[id]' class='edit_link'>изменить</a>";
		}

		
		if ($myrow[url]!="") {$url=$myrow[url]."";} else {$url="";}
		$url = "<a href='?page=add_goods&url=$url&id=$myrow[id]' style='color:#333'>$myrow[name]</a>";
		
		if ($myrow[stamp]==1) {$stamp = 'style="background-color:#ffdddd !important; border:1px solid #edabab !important"';} else {$stamp = '';}
						
		echo "
			  <tr num='$myrow[number]' id='$myrow[id]' url='$_GET[url]' $stamp>
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