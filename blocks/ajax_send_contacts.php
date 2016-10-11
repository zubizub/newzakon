<?

//Отрпавка контактов на электронный адрес со страницы контактов

include("db.php");
include("f_data.php");
include('mailto.php');

$result1 = mysql_query("SELECT * FROM settings");
$myrow1 = mysql_fetch_assoc($result1); 

$email = f_data ($_POST[email], 'mail', 0);

if ($email!=false)
{
	$result = mysql_query("SELECT * FROM pages WHERE id=3");
	$myrow = mysql_fetch_assoc($result); 	
	$text = "<br>Здравствуйте.<br><br>
	Направляем Вам нашу контактную информацию.<br><br>
	$myrow[text]
	<br><br>С Уважением компания $myrow1[company_name]";
	mailto($text,"Контактная информация компании $myrow1[company_name]",$email);
	echo "1";
}
else
{
	echo "0";	
}

?>