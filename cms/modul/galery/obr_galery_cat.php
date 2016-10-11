<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

//удаление
if (isset($_GET[del]))
{
	//запрос к базе для удаления всех картинок в папке
	$del_id = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM galery_img WHERE cat='$del_id'");
	$myrow = mysql_fetch_assoc($result); 
	set_logs("Галерея","Удаление папки",$myrow[name]);
	$cat = $myrow[cat];
	
	do
	{	
		@unlink("upload/cat/".$myrow[url]);
		@unlink("upload/cat/mini_".$myrow[url]);
		$del = mysql_query ("DELETE FROM galery_img WHERE id = '$myrow[id]'",$db);
	}
	while($myrow = mysql_fetch_assoc($result));
	
	////////////////////////////////////////////////////////////////////////////////////
	
		
	//запрос к базе
	$result = mysql_query("SELECT * FROM galery_cat WHERE id='$del_id'");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];
	$number = $myrow[number];


	if ($handle = opendir("upload/files/$del_id/")) {
		while (false !== ($file = readdir($handle))) { 
			if ($file != "." && $file != "..") { 
				unlink("upload/files/$del_id/".$file); 
			} 
		}
		closedir($handle); 
	}	
		
	@unlink("upload/img/".$myrow[img]);
	@unlink("upload/img/mini_".$myrow[img]);
	
	//удаление
	$del = mysql_query ("DELETE FROM galery_cat WHERE id = '$_GET[del]'",$db);
	
	Header("location:../../?page=galery&msg=Папка удалена!");	
	exit;	
	
}



if (isset($_POST[enabled])) {$enabled=1;} else {$enabled=0;}
$name =  f_data($_POST['name'],'text',0);
$date = f_data($_POST['date'],'text',0);
$text = $_POST['text'];
$form = f_data($_POST['form'],'text',0);
$form_position = f_data($_POST['form_position'],'text',0);

$m_title =  f_data($_POST['m_title'],'text',0);
$m_description =  f_data($_POST['m_description'],'text',0);
$m_keywords =  f_data($_POST['m_keywords'],'text',0);
$m_link =  f_data($_POST['url_m_link'],'text',0)."/".f_data($_POST['m_link'],'text',0);


if (!isset($_POST[edit]))
{	
	set_logs("Галерея","Создание папки",$name);
	//добавление
	$result_add = mysql_query ("INSERT INTO galery_cat (name,date,text,form,form_position,enabled,m_title,m_description,m_keywords,m_link) VALUES ('$name','$date','$text','$form','$form_position','$enabled','$m_title','$m_description','$m_keywords','$m_link')");	
	
	//запрос к базе
	$result = mysql_query("SELECT * FROM galery_cat ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];	
		
	if ($_FILES["img"] ["name"] != "")
	{ 
		$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
		$img_name = md5($name.$date.rand(0,999999)).".$ext";
		copy($_FILES["img"]["tmp_name"], "upload/cat/".$img_name);
		$url_img = "upload/cat/".$img_name;
		$url_mini_img = "upload/cat/mini_".$img_name;		
		resizeimg($url_img, $url_mini_img, 350, 450,$folder,$sfolder);
		$result_edit = mysql_query("UPDATE galery_cat SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}	
	
	
	$name_folder = $id;
	@mkdir ("upload/files/$name_folder", 0777);
	
	if ($_FILES[files][tmp_name]!="")
	{
		$file_sql = "";
		foreach ($_FILES[files][tmp_name] as $key => $value)
		{
			$name_file = $_FILES[files][name][$key];
			//$ext = substr($name_file, 1 + strrpos($name_file, "."));
			@copy($value, "upload/files/$name_folder/".$name_file);
			@chmod ("upload/files/$name_folder/".$name_file, 0777);
			$file_sql .= $name_file."|";
		}		
		
		$file_sql = substr($file_sql,0,-1);
		$result_edit = mysql_query("UPDATE galery_cat SET files='$file_sql' WHERE id='$myrow[id]'", $db);
	}	
	
	Header("location:../../?page=galery&msg=Операция прошла успешно!");	
	exit;
}
else
{		
	set_logs("Галерея","Редактирование папки",$name);
	$edit =  f_data($_POST['edit'],'text',0);
	//редактирование
	$result_edit = mysql_query("UPDATE galery_cat SET name='$name', date='$date',text='$text',form='$form',form_position='$form_position',
	enabled='$enabled',m_title='$m_title',m_description='$m_description',m_keywords='$m_keywords',m_link='$m_link' 
	WHERE id='$edit'", $db);


	//запрос к базе
	$result = mysql_query("SELECT * FROM galery_cat WHERE id='$edit'");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];
		
	if ($_FILES[files][tmp_name]!="")
	{
		$file_sql = "";
		foreach ($_FILES[files][tmp_name] as $key => $value)
		{
			$name_file = $_FILES[files][name][$key];
			@copy($value, "upload/files/$_POST[edit]/".$name_file);
			@chmod ("upload/files/$_POST[edit]/".$name_file, 0777);
			$file_sql .= $name_file."|";
		}		
		
		$file_sql = substr($file_sql,0,-1);
		
		$result_edit = mysql_query("UPDATE galery_cat SET files='$file_sql' WHERE id='$myrow[id]'", $db);
	}	
		

	if ($_FILES["img"] ["name"] != "")
	{ 
		@unlink("../../upload/cat/".$myrow[img]);
		@unlink("../../upload/cat/mini_".$myrow[img]);
		$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
		$img_name = md5($name.$date.rand(0,999999)).".$ext";
		copy($_FILES["img"]["tmp_name"], "upload/cat/".$img_name);
		$url_img = "upload/cat/".$img_name;
		$url_mini_img = "upload/cat/mini_".$img_name;		
		resizeimg($url_img, $url_mini_img, 350, 450,$folder,$sfolder);
		$result_edit = mysql_query("UPDATE galery_cat SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}
	
	Header("location:../../?page=galery&msg=Операция прошла успешно!");	
	exit;		
	
}

ob_flush();	
?>