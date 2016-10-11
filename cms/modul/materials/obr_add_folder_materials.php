<?

ob_start();
require ("$_SERVER[DOCUMENT_ROOT]/cms/blocks/obr_include.php");

if (isset($_POST[url_back])) {$url_back=$_POST['url_back'];} else {$url_back = $_SERVER[HTTP_REFERER];}

function del_goods($del)
{
	$result = mysql_query("SELECT * FROM pages WHERE url='$del'");
	$myrow = mysql_fetch_assoc($result); 
	set_logs("Страницы","Удаление страницы",$myrow[name]);
	
	
	
	do
	{
		$del = $myrow[id];
		$id = $myrow[id];
		$number = $myrow[number];
		$url = $myrow[url];

		if ($handle = @opendir("upload/files/$del/")) {
			while (false !== ($file = readdir($handle))) { 
				if ($file != "." && $file != "..") { 
					@unlink("upload/files/$del/".$file); 
				} 
			}
			closedir($handle); 
		}	
			
		@unlink("upload/img/".$myrow[img]);
		@unlink("upload/img/mini_".$myrow[img]);
		
		//удаление
		$del1 = mysql_query ("DELETE FROM pages WHERE id = '$del'");
	}while($myrow = mysql_fetch_assoc($result));
}




//удаление
if (isset($_GET[del]))
{
	//запрос к базе
	$del = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM folder_materials WHERE id='$del'");
	$myrow = mysql_fetch_assoc($result); 
	set_logs("Страницы","Удаление папки",$myrow[name]);
	$id = $myrow[id];
	$url = $myrow[url];
	if (substr_count($url,"/")!=0) 
	{
		$url = explode('/',$url);
		for ($i=0; $i<count($url); $i++)
		{
			$new_url .= $url[$i]."/";
		}
		$new_url = substr($new_url,0,-1);
		
		$url = $new_url;
	}

	if ($url!='') 
	{
		$url="&url=$url";
		$del_url = "$myrow[url]/$del";
	}	
	else
	{
		$del_url = "$del";
	}
	
	@unlink("upload/img/".$myrow[img]);
	@unlink("upload/img/mimi_".$myrow[img]);
	
	//удаление
	del_goods($del_url);
	$del = mysql_query ("DELETE FROM folder_materials WHERE id = '$del'",$db);
	

    Session::flash('success', 'Каталог удален!');
    Header("location:$url_back");	
	exit;    
	
}



if (isset($_POST[enabled])) {$enabled=1;} else {$enabled=0;}
//$name =  f_data($_POST['name'],'text',0);
$name = $_POST['name'];
$m_title =  f_data($_POST['m_title'],'text',0);
$m_description =  f_data($_POST['m_description'],'text',0);
$m_keywords =  f_data($_POST['m_keywords'],'text',0);
$m_link =  f_data($_POST['url_m_link'],'text',0)."/".f_data($_POST['m_link'],'text',0);
$url = $_POST[url];
$article = $_POST[article];

//print_r($name);

if ($name==false)
{
    Session::flash('success', 'Вы не ввели название категории!');
    print_r('wtf');
    Header("location:$url_back");	
	//exit;
}


if ($_FILES["img"][size]>3000000)
{
    Session::flash('success', 'Размер изображения привышает 3 Мб!');
    Header("location:$url_back");	
	exit;	
}

if (!isset($_POST[edit]))
{		
	set_logs("Страницы","Создание папки",$name);
	//добавление
	$result_add = mysql_query ("INSERT INTO folder_materials (name,enabled,m_title,m_description,m_keywords,m_link,url,article) 
	VALUES ('$name','$enabled','$m_title','$m_description','$m_keywords','$m_link','$url','$article')");	
	
	//запрос к базе
	$result = mysql_query("SELECT * FROM folder_materials ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];	
		
	if ($_FILES["img"] ["name"] != "")
	{ 
		$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
		$img_name = md5($name.rand(0,999999)).".$ext";
		copy($_FILES["img"]["tmp_name"], "upload/img/".$img_name);
		$url_img = "upload/img/".$img_name;
		$url_mini_img = "upload/img/mimi_".$img_name;		
		resizeimg($url_img, $url_mini_img, 350, 450,$folder,$sfolder);
		$result_edit = mysql_query("UPDATE folder_materials SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}	
	
	if ($url!='') {$url="&url=$url";}
    
	Session::flash('success', 'Операция прошла успешно!');
    Header("location:$url_back");	
	exit;	
}
else
{		
	set_logs("Страницы","Редактирование папки",$name);
	//редактирование
	$edit_g =  f_data($_POST['edit'],'text',0);
	$result_edit = mysql_query("UPDATE folder_materials SET name='$name', enabled='$enabled',m_title='$m_title',m_description='$m_description',m_keywords='$m_keywords',m_link='$m_link', article='$article' WHERE id='$edit_g'", $db);


	//запрос к базе
	$result = mysql_query("SELECT * FROM folder_materials WHERE id='$edit_g'");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];		

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
		$result_edit = mysql_query("UPDATE folder_materials SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}
	
	if ($myrow[url]!='') {$url = "&url=".$myrow[url];}

    Session::flash('success', 'Операция прошла успешно!');
    Header("location:$url_back");	
	exit;		
	
}

ob_flush();	
?>