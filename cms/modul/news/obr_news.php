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
	//запрос к базе
	$del_g = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM news WHERE id='$del_g'");
	$myrow = mysql_fetch_assoc($result); 
	
	set_logs("Новости","Удаление новости",$myrow[name]);
	
	$id = $myrow[id];
	$number = $myrow[number];

	//запрос к базе
	$result2 = mysql_query("SELECT * FROM news WHERE number>'$number'");
	$myrow2 = mysql_fetch_assoc($result2); 
	$num_rows2 = mysql_num_rows($result2);
	
	if ($num_rows2!=0)
	{
		do
		{
			$result_edit = mysql_query("UPDATE news SET number=number-1 WHERE id='$myrow2[id]'", $db);
		}while($myrow2 = mysql_fetch_assoc($result2));
	}
	


	if ($handle = opendir("upload/files/$del_g/")) {
		while (false !== ($file = readdir($handle))) { 
			if ($file != "." && $file != "..") { 
				unlink("upload/files/$del_g/".$file); 
			} 
		}
		closedir($handle); 
	}	
		
	@unlink("upload/img/".$myrow[img]);
	@unlink("upload/img/mimi_".$myrow[img]);
	
	//удаление
	$del = mysql_query ("DELETE FROM news WHERE id = '$del_g'",$db);
	
	Header("location:../../?page=news&msg=Новость удалена!");	
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
//$m_link =  f_data($_POST['url_m_link'],'text',0)."/".f_data($_POST['m_link'],'text',0);
$m_link = f_data($_POST['m_link'],'text',0);

if (!isset($_POST[edit]))
{
	//запрос к базе, - задание номера товара
	$result = mysql_query("SELECT * FROM news ORDER BY number DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result);
	if (mysql_num_rows($result)!=0)
	{
		$number =  $myrow[number]+1;
	}
	else
	{
		$number =  1;
	}
	
		
	//добавление
	$result_add = mysql_query ("INSERT INTO news (name,date,text,form,form_position,enabled,m_title,m_description,m_keywords,m_link,number) 
	VALUES ('$name','$date','$text','$form','$form_position','$enabled','$m_title','$m_description','$m_keywords','$m_link','$number')");	
	
	//запрос к базе
	$result = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];	
	set_logs("Новости","Добавление новости",$myrow[name]);
		
	if ($_FILES["img"] ["name"] != "")
	{ 
		$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
		$img_name = md5($name.$date.rand(0,999999)).".$ext";
		copy($_FILES["img"]["tmp_name"], "upload/img/".$img_name);
		$url_img = "upload/img/".$img_name;
		$url_mini_img = "upload/img/mimi_".$img_name;		
		resizeimg($url_img, $url_mini_img, 350, 450,$folder,$sfolder);
		$result_edit = mysql_query("UPDATE news SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}	
	
	
	$name_folder = $id;
	@mkdir ("upload/files/$name_folder", 0775);
	
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
		$result_edit = mysql_query("UPDATE news SET files='$file_sql' WHERE id='$myrow[id]'", $db);
	}	
	
	Header("location:../../?page=news&msg=Операция прошла успешно!");	
	exit;
}
else
{		
	//запрос к базе, - задание номера товара
	$edit_g =  f_data($_POST['edit'],'text',0);
	$result = mysql_query("SELECT * FROM news WHERE id='$edit_g'");
	$myrow = mysql_fetch_assoc($result);
	set_logs("Новости","Редактирование новости",$myrow[name]);
	
	//запрос к базе, какой последний номер в базе
	$result_all = mysql_query("SELECT * FROM news ORDER BY number DESC LIMIT 1");
	$myrow_all = mysql_fetch_assoc($result_all);
		
	if ($myrow[number]!=$_POST[number] && $_POST[number]<=$myrow_all[number] && $_POST[number]>0)
	{
		$result1 = mysql_query("SELECT * FROM news WHERE id='".($edit_g-1)."'");
		$myrow1 = mysql_fetch_assoc($result1);				
		$p_last_e = $myrow1[id];
		
		$result2 = mysql_query("SELECT * FROM news WHERE id='".($edit_g+1)."'");
		$myrow2 = mysql_fetch_assoc($result2);		
		$p_next_e = $myrow2[id];
		
		$result3 = mysql_query("SELECT * FROM news WHERE id=$edit_g'");
		$myrow3 = mysql_fetch_assoc($result3);		
		$p_this_e = $myrow3[id];

		$result4 = mysql_query("SELECT * FROM news");	
		$num_news = mysql_num_rows($result4);
				
		if ($myrow3[numer]==1) {$max_elem = 1;}
		if ($myrow3[numer]==$num_news) {$max_elem = 0;}
		if ($myrow3[numer]!=$num_news && $myrow3[numer]!=1) {$max_elem = 10;}
		
		include("drag_drop.php");
		$number_g =  f_data($_POST['number'],'text',0);
		drag($myrow[number],$number_g);		
			
	}

	//редактирование
	$result_edit = mysql_query("UPDATE news SET name='$name', date='$date',text='$text',form='$form',form_position='$form_position',
	enabled='$enabled',m_title='$m_title',m_description='$m_description',m_keywords='$m_keywords',m_link='$m_link' 
	WHERE id='$edit_g'", $db);


	//запрос к базе
	$result = mysql_query("SELECT * FROM news WHERE id='$edit_g'");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];
		
	if ($_FILES[files][tmp_name]!="")
	{
		$file_sql = "";
		foreach ($_FILES[files][tmp_name] as $key => $value)
		{
			$name_file = $_FILES[files][name][$key];
			@copy($value, "upload/files/$edit_g/".$name_file);
			@chmod ("upload/files/$edit_g/".$name_file, 0775);
			$file_sql .= $name_file."|";
		}		
		
		$file_sql = substr($file_sql,0,-1);
		
		$result_edit = mysql_query("UPDATE news SET files='$file_sql' WHERE id='$myrow[id]'", $db);
	}	
		

	if ($_FILES["img"] ["name"] != "")
	{ 
		@unlink("../../upload/img/".$myrow[img]);
		@unlink("../../upload/img/mimi_".$myrow[img]);
		$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
		$img_name = md5($name.$date.rand(0,999999)).".$ext";
		copy($_FILES["img"]["tmp_name"], "upload/img/".$img_name);
		$url_img = "upload/img/".$img_name;
		$url_mini_img = "upload/img/mimi_".$img_name;		
		resizeimg($url_img, $url_mini_img, 350, 450,$folder,$sfolder);
		$result_edit = mysql_query("UPDATE news SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}
	
	Header("location:../../?page=news&msg=Операция прошла успешно!");	
	exit;		
	
}

ob_flush();	
?>