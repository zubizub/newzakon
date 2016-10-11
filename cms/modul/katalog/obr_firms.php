<?
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

if (isset($_GET['del']))
{
	$del = f_data ($_GET[del], 'text', 0);
	
	$result = mysql_query("SELECT * FROM firms WHERE id='$del'");
	@$myrow = mysql_fetch_array($result); 
	set_logs("Каталог","Удаление производителя",$myrow[name]);
	
	if (substr_count($url_img,"no_img") == 0) {@unlink("upload/img/img_proizvoditel/$myrow[img]");}
	$del=mysql_query("DELETE FROM firms WHERE id='$del'",$db);
	Header("location:../../?page=goods_firms&msg=Операция прошла успешно!");
	exit;
}


$name = f_data($_POST['firm'],'text',0);
$description = f_data($_POST['description'],'text',0);

if ($name==false || $description==false)
{
	Header("location:../../?page=goods_firms&msg=Заполните поля заново!");
	exit;	
}

if (isset($_POST['firm']))
{
	if (!isset($_POST['edit']))
	{		
		set_logs("Каталог","Добавление производителя",$_POST['firm']);
		if (f_data($_FILES["img_firm"] ["name"],'img',$_FILES['img_firm']['size']) != false)
		{
			$result = mysql_query("SELECT * FROM firms ORDER BY id DESC LIMIT 0 , 1");
			@$myrow = mysql_fetch_array($result); 
			
			if (mysql_num_rows($result) != 0) {$name_img = $myrow['id'] + 1;} else {$name_img = 1;}
			copy($_FILES["img_firm"] ["tmp_name"], "upload/img/img_proizvoditel/".$name_img.'.jpg');
			$url_img = $name_img.'.jpg';
		}
		else
		{
			$url_img = "";
		}
		
		$resultDobavit = mysql_query ("INSERT INTO firms (img,name,description) VALUES ('$url_img','$name','$description')");
	}
	else
	{
		set_logs("Каталог","Редактирование производителя",$_POST['firm']);
		$edit = f_data($_POST['edit'],'text',0);
		
		$resultEdit = mysql_query ("UPDATE firms SET name='$name',description='$description' WHERE id='$edit'",$db);
		
		if ($_FILES["img_firm"] ["name"] != '')
		{
			$result = mysql_query("SELECT * FROM firms WHERE id='$edit'");
			@$myrow = mysql_fetch_array($result); 
			$url_img = $myrow['img'];
			if ($url_img=='') {$url_img=rand(9999999,9999999999999).'.jpg';}
			
			if (substr_count($url_img,"no_img") == 0) {$img_firm = 0;} else {$img_firm = 1;}
			
			if ($img_firm==0) {@unlink("../".$url_img);}
			
			if (f_data($_FILES["img_firm"] ["name"],'img',$_FILES['img_firm']['size']) != false)
			{
				$result = mysql_query("SELECT * FROM firms WHERE id='$edit'");
				@$myrow = mysql_fetch_array($result); 
				
				if (mysql_num_rows($result) != 0) {$name_img = $myrow['id'] + 1;} else {$name_img = 1;}
				copy($_FILES["img_firm"] ["tmp_name"], "upload/img/img_proizvoditel/".$name_img.'.jpg');
				$url_img = $name_img.'.jpg';
				$resultEdit = mysql_query ("UPDATE firms SET img='$url_img' WHERE id='$edit'",$db);
			}	
		}
	}
	
	
	Header("location:../../?page=goods_firms&msg=Операция прошла успешно!");
	exit;
}
else
{
	Header("location:../../?page=goods_firms&msg=Ошибка добавления!");
	exit;	
}

?>