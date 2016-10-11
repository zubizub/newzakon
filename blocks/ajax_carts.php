<?

//получение информации о количестве товаров в корзине

include("db.php");

//для режима отладки на localhost
$local = 1;
if ($local!=1 && $_SERVER["REMOTE_ADDR"]!='127.0.0.1') {$enkod_to = "utf-8";} else {$enkod_to = "windows-1251";}

$i=0;
$price=0;
$count=0;

if (isset($_COOKIE[uid])) {$uid=$_COOKIE[uid]; $guest=0;} 
else 
{
	$uid = $_COOKIE[uid_cart];
	$guest=1;
}

$result = mysql_query("SELECT * FROM carts WHERE uid='$uid'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		$i++;
		$price = $price + $myrow[price];	
		$count = $count + $myrow[count];
	}while($myrow = mysql_fetch_assoc($result));
}


if ($_POST[all_inf]==1)
{
	if ($count!=0)
	{
		 echo iconv("windows-1251", "$enkod_to", "Всего товаров: <b>$count</b><br>На сумму <b>$price</b> рублей <div align='right'> <a href='/carts/' style='color:#EF7222; font-size:17px'>в корзину</a></div>");
	}
	else
	{
		 echo iconv("windows-1251", "$enkod_to", "<div style='padding-left:25px; padding-top:20px'>Тут может быть Ваш товар!</div>");
	}
}
else
{
	echo $count;
}
?>