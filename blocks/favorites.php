<?php

//товары добавленные в избранное

if (isset($_COOKIE[uid])) {$uid=$_COOKIE[uid]; $guest=0;} 
else 
{
	$uid = $_COOKIE[uid_cart];
	$guest=1;
}


$result_f = mysql_query("SELECT * FROM favorites WHERE uid='$uid' ORDER BY id DESC");
$myrow_f = mysql_fetch_assoc($result_f); 
$num_rows = mysql_num_rows($result_f);

if ($num_rows!=0)
{
	do
	{
		$result = mysql_query("SELECT * FROM goods WHERE id='$myrow_f[id_g]'");
		@$num_rows2 = mysql_num_rows($result);
		
		if ($num_rows2!=0)
		{
			$myrow = mysql_fetch_assoc($result); 
			do
			{
				echo "<div class='line_goods_favorites line_goods_favorites_$myrow_f[id]'>
				<a href='#' class='del_favorites del_favorites_$myrow_f[id] popup' num='$myrow_f[id]'>x</a> | $myrow_f[date] | 
				<a href='/goods/$myrow[id]/$myrow[m_link]/' target='_blank' class='name_goods_favorites'>$myrow[name]</a>
				</div>";
			}while($myrow = mysql_fetch_assoc($result));		
		}
	}while($myrow_f = mysql_fetch_assoc($result_f));
}



?>