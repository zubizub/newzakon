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
	$del = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM pages WHERE id='$del'");
	$myrow = mysql_fetch_assoc($result); 
	set_logs("—траницы","”даление страницы",$myrow[name]);
	
	$id = $myrow[id];
	$number = $myrow[number];
	$url = $myrow[url];
	
	//запрос к базе
	$result2 = mysql_query("SELECT * FROM pages WHERE url='$url' && number>'$number'");
	$myrow2 = mysql_fetch_assoc($result2); 
	$num_rows2 = mysql_num_rows($result2);
	
	if ($num_rows2!=0)
	{
		do
		{
			$result_edit = mysql_query("UPDATE pages SET number=number-1 WHERE id='$myrow2[id]'", $db);
		}while($myrow2 = mysql_fetch_assoc($result2));
	}
	


	if ($handle = opendir("upload/files/$del/")) {
		while (false !== ($file = readdir($handle))) { 
			if ($file != "." && $file != "..") { 
				unlink("upload/files/$del/".$file); 
			} 
		}
		closedir($handle); 
	}	
		
	@unlink("upload/img/".$myrow[img]);
	@unlink("upload/img/mini_".$myrow[img]);
	
	//удаление
	$del = mysql_query ("DELETE FROM pages WHERE id = '$del'",$db);
	
	Header("location:../../?page=materials&url=$url&msg=Ќовость удалена!");	
	exit;	
	
}



if (isset($_POST[enabled])) {$enabled=1;} else {$enabled=0;}
//$name =  f_data($_POST['name'],'text',0);
$name =  $_POST['name'];
$date = f_data($_POST['date'],'text',0);
$text = $_POST['text'];
$form = f_data($_POST['form'],'text',0);
$form_position = f_data($_POST['form_position'],'text',0);
$h1 = f_data($_POST['h1'],'text',0);
$article = $_POST['article'];

$m_title =  $_POST['m_title'];
$m_description =  f_data($_POST['m_description'],'text',0);
$m_keywords =  f_data($_POST['m_keywords'],'text',0);
$m_link =  f_data($_POST['m_link'],'text',0);
$url = $_POST[url];

if (!isset($_POST[edit]))
{
	set_logs("—траницы","ƒобавление страницы",$name);
	//запрос к базе, - задание номера товара
	$result = mysql_query("SELECT * FROM pages WHERE url='$url' ORDER BY number DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result);
	if (mysql_num_rows($result)!=0)
	{
		$number =  $myrow[number]+1;
	}
	else
	{
		$number =  1;
	}
	

	//проверка на одинаковые m_link
	$result_mlink = mysql_query("SELECT * FROM pages WHERE m_link='$m_link'");
	$kol_mlink = mysql_num_rows($result_mlink);
	if ($kol_mlink!=0) {$m_link=$m_link."_".rand(1000,9999);}
		
		
	//добавление
	$result_add = mysql_query ("INSERT INTO pages (name,date,text,form,form_position,enabled,m_title,m_description,m_keywords,m_link,number,url,h1,article) VALUES ('$name','$date','$text','$form','$form_position','$enabled','$m_title','$m_description','$m_keywords','$m_link','$number','$url','$h1', '$article')");	
	
	//запрос к базе
	$result = mysql_query("SELECT * FROM pages ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];	
		
	if ($_FILES["img"] ["name"] != "")
	{ 
		$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
		$img_name = md5($name.$date.rand(0,999999)).".$ext";
		copy($_FILES["img"]["tmp_name"], "upload/img/".$img_name);
		$url_img = "upload/img/".$img_name;
		$url_mini_img = "upload/img/mini_".$img_name;		
		if ($url!=3) //если изображение не дл€ слайдера
		{
			resizeimg($url_img, $url_mini_img, 350, 450,$folder,$sfolder);
		}
		$result_edit = mysql_query("UPDATE pages SET img='$img_name' WHERE id='$myrow[id]'", $db);
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
		$result_edit = mysql_query("UPDATE pages SET files='$file_sql' WHERE id='$myrow[id]'", $db);
	}	
	
	if (!isset($_POST[primenit]))
	{
		Header("location:../../?page=materials&url=$url&msg=ќпераци€ прошла успешно!");	
	}
	else
	{
		Header("location:../../?page=add_pages&url=$url&id=$id&msg=ќпераци€ прошла успешно!");	
	}
	exit;
}
else
{		
	set_logs("—траницы","»зменение страницы",$name);
	//запрос к базе, - задание номера товара
	$edit =  f_data($_POST['edit'],'text',0);
	$result = mysql_query("SELECT * FROM pages WHERE id='$edit'");
	$myrow = mysql_fetch_assoc($result);
	
	//запрос к базе, какой последний номер в базе
	$result_all = mysql_query("SELECT * FROM pages ORDER BY number DESC LIMIT 1");
	$myrow_all = mysql_fetch_assoc($result_all);
		
	if ($myrow[number]!=$_POST[number] && $_POST[number]<=$myrow_all[number] && $_POST[number]>0)
	{
		$result1 = mysql_query("SELECT * FROM pages WHERE id='".($edit-1)."'");
		$myrow1 = mysql_fetch_assoc($result1);				
		$p_last_e = $myrow1[id];
		
		$result2 = mysql_query("SELECT * FROM pages WHERE id='".($edit+1)."'");
		$myrow2 = mysql_fetch_assoc($result2);		
		$p_next_e = $myrow2[id];
		
		$result3 = mysql_query("SELECT * FROM pages WHERE id='$edit'");
		$myrow3 = mysql_fetch_assoc($result3);		
		$p_this_e = $myrow3[id];

		$result4 = mysql_query("SELECT * FROM pages");	
		$num_pages = mysql_num_rows($result4);
				
		if ($myrow3[numer]==1) {$max_elem = 1;}
		if ($myrow3[numer]==$num_pages) {$max_elem = 0;}
		if ($myrow3[numer]!=$num_pages && $myrow3[numer]!=1) {$max_elem = 10;}
		
		include("drag_drop.php");
		drag($myrow[number],$_POST[number]);		
			
	}

	//редактирование
	print_r($m_title);
	$result_edit = mysql_query("UPDATE pages SET name='$name', date='$date',text='$text',form='$form',form_position='$form_position',
	enabled='$enabled',m_title='$m_title',m_description='$m_description',m_keywords='$m_keywords',m_link='$m_link',h1='$h1', article='$article'
	WHERE id='$edit'", $db);



	if ($edit==3)
	{
		$address_admin = f_data($_POST['address_admin'],'text',0);
		$address_admin_office = f_data($_POST['address_admin_office'],'text',0);
		$company_name = f_data($_POST['company_name'],'text',0);
		
		$result_edit = mysql_query("UPDATE settings SET address_admin='$address_admin',address_admin_office='$address_admin_office',company_name='$company_name', desabl_site='$desabl_site'", $db);
	}


	//запрос к базе
	$result = mysql_query("SELECT * FROM pages WHERE id='$edit'");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];
		
	if ($_FILES[files][tmp_name]!="")
	{
		$file_sql = "";
		foreach ($_FILES[files][tmp_name] as $key => $value)
		{
			$name_file = $_FILES[files][name][$key];
			@copy($value, "upload/files/$edit/".$name_file);
			@chmod ("upload/files/$edit/".$name_file, 0777);
			$file_sql .= $name_file."|";
		}		
		
		$file_sql = substr($file_sql,0,-1);
		
		$result_edit = mysql_query("UPDATE pages SET files='$file_sql' WHERE id='$myrow[id]'", $db);
	}	
		

	if ($_FILES["img"] ["name"] != "")
	{ 
		@unlink("../../upload/img/".$myrow[img]);
		@unlink("../../upload/img/mini_".$myrow[img]);
		$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
		$img_name = md5($name.$date.rand(0,999999)).".$ext";
		copy($_FILES["img"]["tmp_name"], "upload/img/".$img_name);
		$url_img = "upload/img/".$img_name;
		$url_mini_img = "upload/img/mini_".$img_name;	
		if ($url!=3) //если изображение не дл€ слайдера
		{	
			resizeimg($url_img, $url_mini_img, 350, 450,$folder,$sfolder);
		}
		$result_edit = mysql_query("UPDATE pages SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}



	if (!isset($_POST[primenit]))
	{
		Header("location:../../?page=materials&url=$url&msg=ќпераци€ прошла успешно!");	
	}
	else
	{
		Header("location:../../?page=add_pages&url=$url&id=$id&msg=ќпераци€ прошла успешно!");	
	}	
	
	exit;		
	
}

ob_flush();	
?>