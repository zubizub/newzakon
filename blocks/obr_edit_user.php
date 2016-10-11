<?

// обработчик формы изменения данных пользователя

include("db.php");
include("f_data.php");
include("shifr_pass.php");

$fio = f_data($_POST['fio'],'text',0);
$mail = f_data($_POST['mail'],'text',0);
$pass = f_data($_POST['pass'],'text',0);
$pass2 = f_data($_POST['pass2'],'text',0);
$company = f_data($_POST['company'],'text',0);
$city = f_data($_POST['city'],'text',0);
$text = f_data($_POST['text'],'text',0);
$staj = f_data($_POST['staj'],'text',0);
$naprav1 = f_data($_POST['naprav1'],'text',0);
$naprav2 = f_data($_POST['naprav2'],'text',0);
$naprav3 = f_data($_POST['naprav3'],'text',0);
$naprav4 = f_data($_POST['naprav4'],'text',0);
$naprav5 = f_data($_POST['naprav5'],'text',0);
$price1 = f_data($_POST['price1'],'text',0);
$price2 = f_data($_POST['price2'],'text',0);

if ($fio == false || $mail == false)
{
	Header("location:/cabinet/?msg=Некорректно введены данные!");
	exit;
}

if ($pass!="")
{
	if ($pass != $pass2 || strlen($pass)<6 || strlen($pass2)<6)
	{
		Header("location:/cabinet/?msg=Введите пароль длиной не менее 6 символов!");
		exit;
	}
	
	$real_pass = ",real_pass='".creat_pass($pass)."'";
	$pass=",pass='".md5(md5($pass))."'";
}
else
{
	$pass="";
	$real_pass='';
}

include("../cms/blocks/resizeimg.php");


$img_name=md5(md5($fio.$pass.$mail));
$result_edit = mysql_query("UPDATE users SET fio='$fio', mail='$mail' $pass, city='$city', company='$company', staj='$staj', text='$text',naprav1='$naprav1',naprav2='$naprav2',naprav3='$naprav3',price1='$price1',price2='$price2',naprav4='$naprav4',naprav5='$naprav5' $real_pass WHERE uid='$_COOKIE[uid]'", $db);

$result1 = mysql_query("SELECT * FROM users WHERE uid='$_COOKIE[uid]'");
$myrow = mysql_fetch_array($result1); 
		
		
if ($_FILES["img"] ["tmp_name"] != "" && f_data($_FILES["img"] ["name"], 'img',$_FILES["img"] ["size"]) == true)
{ 
	$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла
	
	if ($myrow['img'] != 'img/users/no_ava.jpg' && $myrow['img']!='')
	{
		@unlink("../cms/img/users/$myrow[img]");
	}
	
	copy($_FILES["img"] ["tmp_name"], "../cms/img/users/".$_FILES["img"]["name"]);
	$rename = rename ("../cms/img/users/".$_FILES["img"]["name"], "../cms/img/users/".$img_name.".".$ext);
	if ($rename) {$result_edit = mysql_query("UPDATE users SET img='$img_name.$ext' WHERE uid='$_COOKIE[uid]'", $db);}
	$url = "../cms/img/users/$img_name.$ext";
	$url_img = "../cms/img/users/$img_name.$ext";
	resizeimg($url_img, $url_img, 350, 450,$folder,$sfolder);
	@chmod ("$url", 0775,$img_name);	
	
}

Header("location:/cabinet/?msg=Изменения сохранены!");
exit;
?>