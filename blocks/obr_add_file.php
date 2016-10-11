<?

// обработчик заявки

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");

$uid = f_data ($_COOKIE[uid], 'text', 0);

$result = mysql_query("SELECT * FROM users WHERE uid='$uid'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows==0)
{
	Header("location:/cabinet/?msg=Ошибка");
	exit;
}

//удалить
if (isset($_GET[del]))
{
    $del = f_data ($_GET[del], 'text', 0);
	
	$result = mysql_query("SELECT * FROM doc WHERE id='$del'");
	$myrow = mysql_fetch_assoc($result); 
    @unlink("../doc/".$myrow[file]);
    
	$del = mysql_query ("DELETE FROM doc WHERE id = '$del'",$db);
    Header("location:/cabinet/?msg=Не заполнены обязательные поля!");
	exit;
}




$name = f_data ($_POST[name], 'text', 0);
$price = f_data ($_POST[price], 'text', 0);
$date = date("H:m d.m.Y");

if ($name == false)
{
	Header("location:/cabinet/?msg=Не заполнены обязательные поля!");
	exit;
}

$secretcod = md5($name.$price.rand(111111,999999)."eur");
$file = md5($secretcod);


if ($_FILES["file"] ["name"] != "")
{ 
	$ext = substr($_FILES['file']['name'], 1 + strrpos($_FILES['file']['name'], "."));
    
    if ($ext=='zip' || $ext=='rar' || $ext=='doc' || $ext=='xls' || $ext=='docx' || $ext=='xlsx' || $ext=='odt')
    {
        $file = $file.".$ext";
        $img_name = $file;
	    copy($_FILES["file"]["tmp_name"], "../doc/".$img_name);	
        $result_add = mysql_query ("INSERT INTO doc (secretcod,name,file,download,price,date,uid) VALUES ('$secretcod','$name','$file','0','$price','$date','$uid')");
        Header("location:/cabinet/?msg=Операция прошла успешно!");	
    }
    else
    {
        Header("location:/cabinet/?msg=Ошибка загрузки!");	
    }
    
}	
else
{
    Header("location:/cabinet/?msg=Ошибка загрузки!");	
}
	

exit;
	
?>