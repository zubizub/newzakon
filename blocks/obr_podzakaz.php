<?

// обработчик товара находящегося со статусом ПОДЗАКАЗ

include("db.php");
include("f_data.php");
include("mailto.php");

$name = f_data ($_POST[name], 'text', 0);
$one_click = f_data ($_POST[one_click], 'text', 0);
$phone = f_data ($_POST[phone], 'text', 0);
$address = f_data ($_POST[address], 'text', 0);
$mail = f_data ($_POST[mail], 'text', 0);
$text = f_data ($_POST[text], 'text', 0);
$date = date("H:m d.m.Y");
$dostavka = $_POST[dostavka];
if ($dostavka==0) {$dostavka="Необходима";} else {$dostavka="Нет";}
$kupon = f_data ($_POST[kupon], 'text', 0);

if ($name == false || $phone == false)
{
	Header("location:/podzakaz/$one_click/?name=$name&phone=$phone&mail=$mail&text=$text&msg=Не заполнены обязательные поля!");
	exit;
}


if (isset($_COOKIE[uid])) {$uid=$_COOKIE[uid]; $guest=0;} 
else 
{
	$uid = md5(date("d.m.Y H:i")."eurosites".rand(1111,9999999));
	setcookie('uid_cart', $uid, time()+30*24*3600, '/');
	$guest=1;
}


$result_g = mysql_query("SELECT * FROM goods WHERE id='$one_click'");
$myrow_g = mysql_fetch_assoc($result_g);
$price = $myrow_g[price1]-($myrow_g[price1]*$myrow_g[sale]/100);
$summa_zakaz=floor($price);

//добавление
$result_add = mysql_query ("INSERT INTO zakaz (fio,price,mail,phone,address,oplata,status,text,dostavka,date,kupon) VALUES ('$name','$summa_zakaz','$mail','$phone','$address','0','на обработке','$text','$dostavka','$date','$kupon')");

$result = mysql_query("SELECT * FROM zakaz ORDER BY id DESC LIMIT 1");
$myrow = mysql_fetch_assoc($result); 
$zakaz_id = $myrow[id];

$result_add = mysql_query ("INSERT INTO zakaz_goods (id_zakaz,name_goods,id_goods,articul,price,count,skidka,podzakaz) 
VALUES ('$zakaz_id','$myrow_g[name]','$myrow_g[id]','$myrow_g[art]','$price','1','$myrow_g[sale]','1')");	

$text_zakaz = $myrow_g[name]."в количестве 1 шт. |  $price руб. <br>";


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

mailto($text_mail,"Уведомление о предзаказе",$myrow[mail_admin]);


//письмо пользователю
if ($mail!='')
{
	$text_mail = "<b>Здравствуйте, $name!</b><Br>
	Вы сделали заказ на сайте $_SERVER[HTTP_HOST].<br>
	
	====================================<br>
	<b>Ваши данные:</b><br>
	тел. $phone, e-mail: $mail,<br>
	Адрес: $address <br>
	Доставка: $dostavka <br>
	$kupon
	
	====================================<br>

	Заказ на сумму: $summa_zakaz руб.<br>
	Примечание: $text
	=====================================
	
	<br>
	$text_zakaz
	";
	
	mailto($text_mail,"Заказ на сайте $_SERVER[HTTP_HOST]",$mail);
}

Header("location:/pay/$zakaz_id/");	
exit;
	
?>