<?

include("blocks/f_data.php");
$search =  f_data($_GET[search],'text',0);

$result = mysql_query("SELECT * FROM goods WHERE name LIKE '%$search%' || text LIKE '%$search%'  LIMIT 0, 40");


echo "Поиск по запросу: <b>$search</b><br><br>";
?>

<div style="padding:7px; background-color:#467bb5; color:#FFF; font-weight:bold; border-radius:3px 3px 0px 0px; font-size:13px">Товары</div>
<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="text-align:center; width:30px">ID</th>
    <th style="text-align:left">Заголовок</th>
    <th style="width:85px">Стоимость</th>
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
			$readonly_del = "<a href='#' class='popop del_page del_link' num='$myrow[id]'>удалить</a>"; 
			$readonly_edit = "<a href='?page=add_goods&url=$myrow[url]&id=$myrow[id]' class='edit_link'>изменить</a>";
		}

		
		if ($myrow[url]!="") {$url=$myrow[url]."";} else {$url="";}
		$url = "<a href='?page=add_goods&url=$url&id=$myrow[id]' style='color:#333'>$myrow[name]</a>";
		
		if ($myrow[stamp]==1) {$stamp = 'style="background-color:#ffdddd !important; border:1px solid #edabab !important"';} else {$stamp = '';}
						
		echo "
			  <tr num='$myrow[number]' id='$myrow[id]' url='$_GET[url]' $stamp>
				<td style='text-align:center'>$myrow[id]</td>
				<td><img src='img/goods.png' height='16' align='left' style='margin-right:5px'> $url</td>
				<td style=''>$myrow[price1] Р</td>
				<td style='text-align:center;'>$readonly_edit</td>
			  </tr>		
		";
	}while($myrow = mysql_fetch_assoc($result));
}


?>

</table>


<br><br>

<?

$result = mysql_query("SELECT * FROM pages WHERE name LIKE '%$search%' || text LIKE '%$search%'  LIMIT 0, 40");

?>

<div style="padding:7px; background-color:#467bb5; color:#FFF; font-weight:bold; border-radius:3px 3px 0px 0px; font-size:13px">Страницы</div>


<table width="100%" border="0" id="tbl_obj" >
  <tr>
    <th style="text-align:center; width:30px">ID</th>
    <th style="text-align:left">Заголовок</th>
    <th style="text-align:left; width:290px">Ссылка</th>
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
		
		$link_page = "<input name='hr' type='text' value='http://$_SERVER[HTTP_HOST]/pages/$myrow[id]/$m_link/' style='width:97%; z-index:70'>";
		if ($myrow[id]==1) {$link_page = "<input name='hr' type='text' value='http://$_SERVER[HTTP_HOST]/' style='width:97%; z-index:70'>";}
		if ($myrow[id]==2) {$link_page = "<input name='hr' type='text' value='http://$_SERVER[HTTP_HOST]/about/' style='width:97%; z-index:70'>";}
		if ($myrow[id]==3) {$link_page = "<input name='hr' type='text' value='http://$_SERVER[HTTP_HOST]/contacts/' style='width:97%; z-index:70'>";}
		
								
		echo "
			  <tr num='$myrow[number]' id='$myrow[id]' url='$_GET[url]'>
				<td style='text-align:center'>$myrow[id]</td>
				<td><img src='img/page.png' height='18' align='left' style='margin-right:5px'> $url</td>
				<td>$link_page</td>
				<td style='text-align:center;'>$readonly_edit</td>
			  </tr>		
		";
	}while($myrow = mysql_fetch_assoc($result));
}


?>

</table>
