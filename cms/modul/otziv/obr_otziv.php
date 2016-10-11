<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

$name =  f_data($_POST['name'],'text',0);
$mail =  f_data($_POST['mail'],'text',0);
$date = f_data($_POST['date'],'text',0);
$text = f_data($_POST['text'],'text',0);

if (!isset($_POST[edit]))
{
	set_logs("Отзывы","Добавление отзыва",$name);
    
    $img_name='';
    if (f_data ($_FILES["img"] ["name"], 'img', "200") != false)
    { 
        if ($_FILES['img']['size']<=300000)
        {
            $ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
            $img_name = md5($name.$date.rand(111111,999999)).".$ext";
            copy($_FILES["img"]["tmp_name"], "../../../img/otziv/$img_name"); 
        }
        else
        {
            Header("location:../../?page=otziv&msg=Фото должно быть менее 300Кб!");	
    	    exit;
        }
    }
    
	//добавление
	$result_add = mysql_query ("INSERT INTO otziv (name,mail,date,text,enabled,ip,img) VALUES ('$name','$mail','$date','$text','1','127.0.0.1','$img_name')");	
	
	Header("location:../../?page=otziv&msg=Операция прошла успешно!");	
	exit;
}
else
{		
	set_logs("Отзывы","Измение отзыва",$name);
	$edit = f_data($_POST['edit'],'text',0);

    $img_name='';
    if (f_data ($_FILES["img"] ["name"], 'img', "200") != false)
    { 
        if ($_FILES['img']['size']<=300000)
        {
            $ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
            $img_name = md5($name.$date.rand(111111,999999)).".$ext";
            copy($_FILES["img"]["tmp_name"], "../../../img/otziv/$img_name"); 
        }
        else
        {
            Header("location:../../?page=otziv&msg=Фото должно быть менее 300Кб!");	
    	    exit;
        }
    	
        $img_name = ", img='$img_name'";
    }
	
	//редактирование
	$result_edit = mysql_query("UPDATE otziv SET name='$name',mail='$mail', date='$date',text='$text' $img_name WHERE id='$edit'", $db);

	Header("location:../../?page=otziv&msg=Операция прошла успешно!");	
	exit;		
	
}

ob_flush();	
?>