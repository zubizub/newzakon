<?

// обработчик формы изменения данных пользователя

include("db.php");
include("f_data.php");
include("shifr_pass.php");
include("../cms/blocks/resizeimg.php");

$result1 = mysql_query("SELECT * FROM users WHERE uid='$_COOKIE[uid]'");
$myrow = mysql_fetch_array($result1); 
$img_name=md5(md5(rand(1111111,999999999).time()."eurosites"));


if ($_FILES["img"] ["tmp_name"] != "" && $_FILES["img"] ["size"] < 3145728)
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
	Header("location:/cabinet/?msg=Изменения сохранены!");
    exit;
}
else
{
    Header("location:/cabinet/?msg=Файл имеет неверный формат или слишком большой вес!");
    exit;  
}


?>