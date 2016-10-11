<?

// отмена или соглашение на рассылку новостей с сайта

include("db.php");
include("f_data.php");
include("shifr_pass.php");

$rassilka = f_data($_POST['rassilka'],'text',0);
$rassilka2 = f_data($_POST['rassilka2'],'text',0);
if ($rassilka=="on") {$rassilka=1;} else {$rassilka=0;}
if ($rassilka2=="on") {$rassilka2=1;} else {$rassilka2=0;}

$result_edit = mysql_query("UPDATE users SET mail_enabl='$rassilka',mail_enabl2='$rassilka2' WHERE uid='$_COOKIE[uid]'", $db);

Header("location:/cabinet/?num=5&msg=Изменения сохранены!");
exit;


?>