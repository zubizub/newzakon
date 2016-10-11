<?

// обработчик заказа пользователя

include("db.php");
include("f_data.php");
include("mailto.php");

$name = f_data ($_POST[name], 'text', 0);
$phone = f_data ($_POST[phone], 'text', 0);
$address = f_data ($_POST[address], 'text', 0);
$mail = f_data ($_POST[mail], 'text', 0);
$text = f_data ($_POST[text], 'text', 0);
$date = date("H:m d.m.Y");
$dostavka = $_POST[dostavka];
if ($dostavka!=0) {$dostavka="Необходима";} else {$dostavka="Нет";}
$kupon = f_data ($_POST[kupon], 'text', 0);
if (isset($_COOKIE[advert])) {$advert=$_COOKIE[advert];} else {$advert="";}

$ip = $_SERVER['REMOTE_ADDR'];
$time = time();


if ($name == false || $phone == false)
{
	Header("location:/oformit_zakaz/?name=$name&phone=$phone&mail=$mail&text=$text&msg=Не заполнены обязательные поля!");
	exit;
}


if (isset($_COOKIE[uid])) 
{
	$uid=$_COOKIE[uid];
	$guest=0;
	$result_edit = mysql_query("UPDATE users SET orders=orders+1 WHERE uid='$uid'", $db);
} 
else 
{
	$uid = $_COOKIE[uid_cart];
	$guest=1;
}


//добавление
$result_add = mysql_query ("INSERT INTO zakaz (fio,price,mail,phone,address,oplata,status,text,dostavka,date,kupon,uid,advert,ip,time) VALUES ('$name','0','$mail','$phone','$address','0','на обработке','$text','$dostavka','$date','$kupon','$uid','$advert','$ip','$time')");

$result = mysql_query("SELECT * FROM zakaz ORDER BY id DESC LIMIT 1");
$myrow = mysql_fetch_assoc($result); 
$zakaz_id = $myrow[id];



$result = mysql_query("SELECT * FROM carts WHERE uid='$uid'");
$num_rows = mysql_num_rows($result);

if ($num_rows!=0) 
{ 
	$myrow = mysql_fetch_assoc($result); 

	do
	{
		$id_carts = $myrow[id];
		
		$result_g = mysql_query("SELECT * FROM goods WHERE id='$myrow[id_g]'");
		$myrow_g = mysql_fetch_assoc($result_g); 
		$m_link = explode("/",$myrow_g[m_link]);
		$m_link = $m_link[(count($m_link)-1)];
		
		$skidka = $myrow[skidka];
		$count_g = $myrow[count];
		
		//$name = "<a href='/goods/$myrow_g[id]/$m_link/' target='_blank'>$myrow_g[name]</a>";
		//if ($myrow_g[img]!='') {$img="/cms/modul/katalog/upload/img/$myrow_g[img]";} else {$img = "/img/no_img2.png";}
		
		$price = $myrow[price];
		
		$summa = ($myrow[count]*$myrow[price]);
		$summa_zakaz = $summa_zakaz+($myrow[count]*$myrow[price]);
		
		$result_add = mysql_query ("INSERT INTO zakaz_goods (id_zakaz,name_goods,id_goods,articul,price,count,skidka) 
		VALUES ('$zakaz_id','$myrow_g[name]','$myrow_g[id]','$myrow_g[art]','$price','$count_g','$skidka')");	
		
		$text_zakaz .= $myrow_g[name]." в количестве ".$count_g." шт. |  $summa руб. <br>";
			
	}while($myrow = mysql_fetch_assoc($result));
}

	
$result_edit = mysql_query("UPDATE zakaz SET price='$summa_zakaz' WHERE id='$zakaz_id'", $db);

$del = mysql_query ("DELETE FROM carts WHERE uid='$uid'",$db);


if ($kupon!='') {$kupon="Купон: $kupon<br>";} else {$kupon="";}

//письмо администратору
$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result);

$text_mail = "<b>Уведомляем Вас, что на сайте $_SERVER[HTTP_HOST]</b><br>
От $name, тел. $phone, e-mail: $mail,<br>
Адрес: $address <br>
Доставка: $dostavka <br>
$kupon
Общая сумма: $summa_zakaz руб.<br>
Примечание: $text<br>
=====================================
<br>
$text_zakaz
";

mailto($text_mail,"Уведомление о заказе",$myrow[mail_admin]);


//письмо пользователю
if ($mail!='')
{
	$text_mail = "<b>Здравствуйте, $name!</b><Br><Br>
	Вы сделали заказ на сайте $_SERVER[HTTP_HOST].<br>
	
	====================================<br>
	<b>Ваши данные:</b><br>
	тел. $phone, e-mail: $mail,<br>
	Адрес: $address <br>
	Доставка: $dostavka <br>
	$kupon
	
	====================================<br>

	Заказ на сумму: $summa_zakaz руб.<br>
	Примечание: $text<br><br>
	=====================================
	
	<br>
	$text_zakaz
	";
	
	mailto($text_mail,"Заказ на сайте $_SERVER[HTTP_HOST]",$mail);
}

$result = mysql_query("SELECT * FROM carts");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		if ((time()-$myrow[date])>864000)
		{
			$del = mysql_query ("DELETE FROM carts WHERE id = '$myrow[id]'",$db);
		}
	}while($myrow = mysql_fetch_assoc($result));
}

Header("location:/pay/$zakaz_id/");	
exit;
	
?>