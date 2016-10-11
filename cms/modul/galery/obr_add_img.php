<?

include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");
$date = date("H:m d.m.Y");
$j=0;



//удаление
if (isset($_GET[del]))
{
	//запрос к базе
	$del_id = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM galery_img WHERE id='$del_id'");
	$myrow = mysql_fetch_assoc($result); 
	$cat = $myrow[cat];
		
	@unlink("upload/img/".$myrow[url]);
	@unlink("upload/img/mini_".$myrow[url]);
	
	//удаление
	$del = mysql_query ("DELETE FROM galery_img WHERE id = '$del_id'",$db);
	
	set_logs("Галерея","Удаление изображения","$myrow[id]");
	Header("location:../../?page=galery_img&id=$cat&msg=Изображение удалено!");	
	exit;	
	
}


if (isset($_POST[edit]))
{
	$description =  f_data($_POST['description'],'text',0);
	set_logs("Галерея","Изменение описания изображения");
	$edit_id = f_data ($_GET[edit], 'text', 0);
	$result_edit = mysql_query("UPDATE galery_img SET description='$description' WHERE id='$edit_id'", $db);	
	Header("location:../../?page=galery_img&id=$_POST[cat]&msg=Операция прошла успешно!");	
	exit;		
}

$cat = f_data ($_POST[cat], 'text', 0);	
for ($i=0; $i<=100; $i++)
{
	if (isset($_POST['img'.$i])) 
	{
		$description =  f_data($_POST['description'.$i],'text',0);
		$url =  f_data($_POST['img'.$i],'text',0);
		$result_add = mysql_query ("INSERT INTO galery_img (cat,description,url,date) VALUES ('$cat','$description','$url','$date')");	
		$j=1;	
	}
}


$dir = "upload/img/";
$files = @scandir($dir);

for ($i=0; $i<count($files); $i++)
{	
	if (substr_count($files[$i], "mini")==0) 
	{
		$result = mysql_query("SELECT * FROM galery_img WHERE url='$files[$i]'");
		$num_rows = mysql_num_rows($result);
		if ($num_rows==0) {@unlink("upload/img/".$files[$i]); @unlink("upload/img/mini_".$files[$i]);}
		
	}
}


if ($j==1)
{
	Header("location:../../?page=galery_img&id=$cat&msg=Операция прошла успешно!");	
	exit;	
}
else
{
	Header("location:../../?page=galery_img&id=$cat&msg=Операция прошла успешно!");	
	exit;	
}



?>