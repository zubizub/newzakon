<?php

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$search = f_data ($_POST[search_pole], 'text', 0);
$search = iconv('utf-8','windows-1251',$search);

$i=1;
$result = mysql_query("SELECT * FROM goods WHERE id='$search' || name LIKE '%$search%' || text LIKE '%$search%' || art='$search' ORDER BY name ASC LIMIT 30");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		if ($myrow[img]!='')
		{
			$img = "modul/katalog/upload/img/$myrow[img]";
		}
		else
		{
			$img = "img/no_img.jpg";
		}
		
		if ($myrow[url]!="") {$url=$myrow[url]."";} else {$url="";}
		
		echo "<div class='contaner_search_goods'>
				<div style='text-align:center'>
					<a href='?page=add_goods&url=$url&id=$myrow[id]' target='_blank'>
					<img src='$img' height='80' style='max-width:130px'>
					</a>
				</div>
				
			<a href='?page=add_goods&url=$url&id=$myrow[id]' target='_blank' class='contaner_search_goods-a_name'>
				$myrow[name]
			</a>
			
			<div align='center'><a class='popup btn_contaner_search_goods btn_contaner_search_add' num='$myrow[id]'>добавить</a></div>
		</div>";
	}while($myrow = mysql_fetch_assoc($result));
}		

?>