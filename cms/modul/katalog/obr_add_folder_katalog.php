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
	$del = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM katalog WHERE id='$del'");
	$myrow = mysql_fetch_assoc($result); 
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

	if ($url!='') {$url="&url=$url";}
			
	$result = mysql_query("SELECT * FROM katalog WHERE url LIKE '%$myrow[url]/$del%'");
	
	if (mysql_num_rows($result)!=0)
	{
		Header("location:../../?page=katalog$url&msg=Удалите сначала внутренние категории!");	
		exit;	
	}
	else
	{

		$result = mysql_query("SELECT * FROM katalog WHERE id='$del'");
		$myrow = mysql_fetch_assoc($result); 
		set_logs("Каталог","Удаление папки каталога",$myrow[name]);
		$id = $myrow[id];
		
		//url для редиректа
		$url_to_submit = $myrow[url];
		if ($url_to_submit!='') 
		{
			$url_to_submit = "&url=$url_to_submit";
		}
		else
		{
			$url_to_submit = '';
		}
		
		$url = $myrow[url];
		$url_goods = "$myrow[url]/$myrow[id]";
		
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

		if ($url!='') {$url="&url=$url";}	
		@unlink("upload/img/".$myrow[img]);
		@unlink("upload/img/mimi_".$myrow[img]);
		
		$del = mysql_query ("DELETE FROM katalog WHERE id='$del'",$db);
		
		$result2 = mysql_query("SELECT * FROM goods WHERE url='$url_goods'");
		$myrow2 = mysql_fetch_assoc($result2); 
		$num_rows2 = mysql_num_rows($result2);
		
		
		if ($num_rows2!=0)
		{
			do
			{
				$del = $myrow2[id];
				if ($handle = opendir("upload/files/$del/")) {
					while (false !== ($file = readdir($handle))) { 
						if ($file != "." && $file != "..") { 
							unlink("upload/files/$del/".$file); 
						} 
					}
					closedir($handle); 
				}	
				
				@rmdir("upload/files/$del/");
				@unlink("upload/img/".$myrow2[img]);
				@unlink("upload/img/mimi_".$myrow2[img]);
				
			}while($myrow2 = mysql_fetch_assoc($result2));
		}	
		
		$del = mysql_query ("DELETE FROM goods WHERE url='$url_goods'",$db);
		
		Header("location:../../?page=katalog$url_to_submit&msg=Каталог удален!");	
		exit;	
	}
	
	
}



if (isset($_POST[enabled])) {$enabled=1;} else {$enabled=0;}
$name =  f_data($_POST['name'],'text',0);
$m_title =  f_data($_POST['m_title'],'text',0);
$m_description =  f_data($_POST['m_description'],'text',0);
$m_keywords =  f_data($_POST['m_keywords'],'text',0);
$m_link =  f_data($_POST['url_m_link'],'text',0)."/".f_data($_POST['m_link'],'text',0);
$url = $_POST[url];
$har = $_POST[har];
$text = $_POST['text'];

if ($name==false)
{
	Header("location:../../?page=katalog&msg=Вы не ввели название категории!");	
	exit;	
}


if ($_FILES["img"][size]>3000000)
{
	Header("location:../../?page=katalog&msg=Размер изображения привышает 3 Мб!");	
	exit;	
}

if (!isset($_POST[edit]))
{		
	set_logs("Каталог","Добавление новой папки",$name);
	//добавление
	$result_add = mysql_query ("INSERT INTO katalog (name,enabled,m_title,m_description,m_keywords,m_link,url,har,text) 
	VALUES ('$name','$enabled','$m_title','$m_description','$m_keywords','$m_link','$url','$har','$text')");	
	
	//запрос к базе
	$result = mysql_query("SELECT * FROM katalog ORDER BY id DESC LIMIT 1");
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
		$result_edit = mysql_query("UPDATE katalog SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}	
	
	if ($url!='') {$url="&url=$url";}
	Header("location:../../?page=katalog&msg=Операция прошла успешно!$url");	
	exit;
}
else
{		
	$edit = f_data ($_POST[edit], 'text', 0);
	set_logs("Каталог","Редактирование папки",$name);
	//редактирование
	$result_edit = mysql_query("UPDATE katalog SET name='$name', enabled='$enabled',m_title='$m_title',m_description='$m_description',m_keywords='$m_keywords',m_link='$m_link', har='$har',text='$text' 
	WHERE id='$edit'", $db);


	//запрос к базе
	$result = mysql_query("SELECT * FROM katalog WHERE id='$edit'");
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
		$result_edit = mysql_query("UPDATE katalog SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}
	
	if ($myrow[url]!='') {$url = "&url=".$myrow[url];} else {$url='';};
	Header("location:../../?page=katalog&msg=Операция прошла успешно!$url");	
	exit;		
	
}

ob_flush();	
?>