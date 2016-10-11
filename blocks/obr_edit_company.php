<?php

// обработчик изменения инфомрации о компании пользователя

include("db.php");
include("f_data.php");

$name = f_data ($_POST[name], 'text', 0);
$address = f_data ($_POST[address], 'text', 0);
$inn = f_data ($_POST[inn], 'text', 0);
$kpp = f_data ($_POST[kpp], 'text', 0);
$okato = f_data ($_POST[okato], 'text', 0);
$direktor = f_data ($_POST[direktor], 'text', 0);
$osnovanie = f_data ($_POST[osnovanie], 'text', 0);
$bank_name = f_data ($_POST[bank_name], 'text', 0);
$bank_city = f_data ($_POST[bank_city], 'text', 0);
$bik = f_data ($_POST[bik], 'text', 0);
$raschet_schet = f_data ($_POST[raschet_schet], 'text', 0);
$kor_schet = f_data ($_POST[kor_schet], 'text', 0);


$result = mysql_query("SELECT * FROM company_users WHERE uid='$_COOKIE[uid]' && inn='$inn'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	$result_edit = mysql_query("UPDATE company_users SET name='$name', address='$address',inn='$inn',kpp='$kpp',okato='$okato',direktor='$direktor',osnovanie='$osnovanie',direktor='$direktor',osnovanie='$osnovanie',bank_name='$bank_name',bank_city='$bank_city',bik='$bik',raschet_schet='$raschet_schet',kor_schet='$kor_schet' WHERE id='$myrow[id]'", $db);
}
else
{
	$result_add = mysql_query ("INSERT INTO company_users (uid,name,address,inn,kpp,okato,direktor,osnovanie,bank_name,bank_city,bik,raschet_schet,kor_schet) VALUES ('$_COOKIE[uid]','$name','$address','$inn','$kpp','$okato','$direktor','$osnovanie','$bank_name','$bank_city','$bik','$raschet_schet','$kor_schet')");
}


	
Header("location:/cabinet/?num=2&msg=Изменения сохранены!");	
exit;


?>