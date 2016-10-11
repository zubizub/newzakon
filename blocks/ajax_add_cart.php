<?

//добавление в корзину товаров

include("db.php");
include("f_data.php");

$id_g = f_data ($_POST[id], 'text', 0);
$price = f_data ($_POST[price], 'text', 0);
$count_goods = f_data ($_POST[count_goods], 'text', 0);
$skidka = f_data ($_POST[numskidka], 'text', 0);
$date = time();

if (isset($_COOKIE[uid])) {$uid=$_COOKIE[uid]; $guest=0;} 
else 
{
	$uid = $_COOKIE[uid_cart];
	$guest=1;
}

if (isset($_POST[del_all]))
{
	$del = mysql_query ("DELETE FROM carts WHERE uid='$uid'",$db);
	exit;
}


if (isset($_POST[del]))
{
	$del = f_data($_POST[del], 'text', 0);
	echo $del;
	$del = mysql_query ("DELETE FROM carts WHERE id='$del' && uid='$uid'",$db);
	exit;
}


$result = mysql_query("SELECT * FROM carts WHERE uid='$uid' && id_g='$id_g'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows==0)
{
	if ($count_goods=='') {$count_goods=1;}
	$result_add = mysql_query ("INSERT INTO carts (id_g,price,count,uid,date,guest,skidka) 
	VALUES ('$id_g','$price','$count_goods','$uid','$date','$guest','$skidka')");
	
	$result = mysql_query("SELECT * FROM carts ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	echo $myrow[id];
}
else
{
	if ($count_goods=='') {$count_goods=$myrow[count]+1;}
	$result_edit = mysql_query("UPDATE carts SET count='$count_goods' WHERE uid='$uid' && id_g='$id_g'", $db);
	
	$result = mysql_query("SELECT * FROM carts WHERE uid='$uid' && id_g='$id_g'");
	$myrow = mysql_fetch_assoc($result); 
	echo $myrow[id];
}



?>