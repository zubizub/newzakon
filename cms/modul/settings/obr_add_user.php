<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");
include("shifr_pass.php");

//удаление
if (isset($_GET[del]))
{
	set_logs("Пользователи","Удаление пользователя");
	$del_g = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM users WHERE uid='$del_g'");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];
		
	@unlink("../../img/users/".$myrow[img]);
	
	//удаление
	$del = mysql_query ("DELETE FROM users WHERE uid = '$del_g'",$db);
	
	Header("location:../../?page=users&msg=Пользователь удален!");	
	exit;	
	
}


$fio =  f_data($_POST['fio'],'text',0);
$phone = f_data($_POST['phone'],'text',0);
$mail = f_data($_POST['mail'],'text',0);
$organization = f_data($_POST['organization'],'text',0);
$name =  f_data($_POST['name'],'text',0);
$pass =  f_data($_POST['pass'],'text',0);
$data_rojden =  f_data($_POST['data_rojden'],'text',0);
$text =  f_data($_POST['text'],'text',0);
$status =  f_data($_POST['status'],'text',0);
if (isset($_POST[edit])) {$edit="&id=$_POST[edit]";}
$url_back = "&name=$name&fio=$fio&phone=$phone&mail=$mail&organization=$organization&data_rojden=$data_rojden&text=$text&status=$status$edit";


if (!isset($_POST[edit]))
{
	set_logs("Пользователи","Создание пользователя");
	$result = mysql_query("SELECT * FROM users WHERE name='$name'");
	if (mysql_num_rows($result)!=0)
	{
		Header("location:../../?page=add_users$url_back&msg=Такой логин уже занят!");			
	}
			
				
	//Определение на наличие русских символов в пароле
	if(preg_match('/[^0-9a-zA-Z]/', $pass) || preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$pass)) {
		Header("location:../../?page=add_users$url_back&msg=Пароль должен содержать только латинские символы!");	
		exit;			
	}
		
	if ($fio!='' && $name!='' && $pass!='')
	{	
		$real_pass = creat_pass($pass);
		$pass = md5(md5($pass));
		$uid = md5($name.$pass.date("H:m d.m.Y"));
		$date_reg = date("H:m d.m.Y");
		$result_add = mysql_query ("INSERT INTO users (uid,name,pass,phone,mail,fio,data_rojden,date_reg,status,podtverjdenie,text,real_pass) 
		VALUES ('$uid','$name','$pass','$phone','$mail','$fio','$data_rojden','$date_reg','$status','1','$text','$real_pass')");	
		

		
		if ($_FILES["img"] ["name"] != "")
		{ 
			//запрос к базе
			$result = mysql_query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
			$myrow = mysql_fetch_assoc($result); 
			$id = $myrow[id];	
					
			$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
			$img_name = md5($name.$date.rand(0,999999)).".$ext";
			copy($_FILES["img"]["tmp_name"], "../../img/users/".$img_name);
			$url_img = "../../img/users/".$img_name;	
			resizeimg($url_img, $url_img, 350, 450,$folder,$sfolder);
			$result_edit = mysql_query("UPDATE users SET img='$img_name' WHERE id='$myrow[id]'", $db);
		}			
		
		Header("location:../../?page=users&msg=Пользователь добавлен!");	
		exit;			
	}
	else
	{
		Header("location:../../?page=add_users$url_back&msg=Обязательные поля не заполнены!");	
		exit;		
	}
}
else
{
	set_logs("Пользователи","Редактирование пользователя");
	$edit_g =  f_data($_POST['edit'],'text',0);
	
	$result = mysql_query("SELECT * FROM users WHERE name='$name' && id!='$edit_g'");
	if (mysql_num_rows($result)!=0)
	{
		Header("location:../../?page=add_users$url_back&msg=Такой логин уже занят!");			
	}
			
	
	if ($pass!='')
	{		
		//Определение на наличие русских символов в пароле
		if(preg_match('/[^0-9a-zA-Z]/', $pass) || preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$pass)) {
			Header("location:../../?page=add_users$url_back&msg=Пароль должен содержать только латинские символы!");	
			exit;			
		}
		
		$real_pass = creat_pass($pass);
		$pass = md5(md5($pass));
		
		$pass_sql = ",pass='$pass', real_pass='$real_pass'";		
	}
	
		
	if ($fio!='' && $name!='')
	{
		$result_edit = mysql_query("UPDATE users SET name='$name', phone='$phone', mail='$mail', fio='$fio', data_rojden='$data_rojden', status='$status', text='$text' $pass_sql WHERE id='$edit_g'", $db);	
		
		
		if ($_FILES["img"] ["name"] != "")
		{ 
			//запрос к базе
			$result = mysql_query("SELECT * FROM users WHERE id='$edit_g'");
			$myrow = mysql_fetch_assoc($result); 
			$id = $myrow[id];	
			
			@unlink("../../img/users/$myrow[img]");		
			$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
			$img_name = md5($name.$date.rand(0,999999)).".$ext";
			copy($_FILES["img"]["tmp_name"], "../../img/users/".$img_name);
			$url_img = "../../img/users/".$img_name;	
			resizeimg($url_img, $url_img, 350, 450,$folder,$sfolder);
			$result_edit = mysql_query("UPDATE users SET img='$img_name' WHERE id='$myrow[id]'", $db);		
		}	
		
		Header("location:../../?page=users&msg=Пользователь изменен!");	
		exit;							
	}
	else
	{
		Header("location:../../?page=add_users$url_back&msg=Обязательные поля не заполнены!");	
		exit;			
	}
}

?>