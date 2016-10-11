<?

// обработчик формы изменения данных пользователя

include("db.php");
include("f_data.php");
include("send_sms.php");

//print_r($_POST);

$offerId = f_data($_POST['id'],'text',0);
$user = f_data($_POST['user'],'text',0);

$result = mysql_query("SELECT * FROM market WHERE id='$offerId'");
$offerData = mysql_fetch_array($result); 

$result1 = mysql_query("SELECT * FROM users WHERE id='$offerData[uid]'");
$myrow = mysql_fetch_array($result1); 

if (!$_COOKIE[uid]) {

Header("location:/urmarket/?msg=Вам необходимо зарегистрироваться для заказа услуги.");
exit;

}

else {

$query = "INSERT INTO `zadaniy` (`name`, `text`, `bujet`, `uid`, `enabled`, `inwork`, `ispolnitel`, `from_market`, `new`) VALUES 
('$offerData[usluga]', '$offerData[opisanie]', '$offerData[cena]', '$_COOKIE[uid]', 1, 0, '$myrow[uid]', 1, 1)";
//INSERT INTO `market_offer` (`offerId`, `user`) VALUES ($offerId, '$myrow[id]')";

print_r($query);

$text = "Новая задача с юридического маркета";

if (mail($myrow['mail'], $text, $offerData[usluga], "From: info@zakon.zubformat.ru", "-finfo@zakon.zubformat.ru")) {

	print_r('ok');
}

sendSms($myrow[phone],$text);


$addRecord = mysql_query($query);
Header("location:/urmarket/?msg=Ваш заказ направлен Исполнителю!");
exit;

}

?>