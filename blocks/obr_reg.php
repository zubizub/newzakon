<?

// обработчик регистриции пользователя

include("db.php");
include("f_data.php");
include("mailto.php");
include("shifr_pass.php");

$u_status = f_data($_POST['u_status'],'text',0);
$u_fio = f_data($_POST['u_fio'],'text',0);
$u_login = f_data($_POST['u_login'],'text',0);
$u_pass = generate_password(7);
$u_pass2 = f_data($_POST['u_pass2'],'text',0);
$u_mail = f_data($_POST['u_mail'],'mail',0);
$u_phone = f_data($_POST['u_phone'],'text',0);
$u_phone = clearPhone($u_phone);
$u_city = f_data($_POST['u_city'],'text',0);
$u_site = f_data($_POST['u_site'],'text',0);
$text = f_data($_POST['text'],'text',0);
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();


if ($u_phone=="" || $u_mail=="")
{
	Header("location:/reg/?msg=ФИО и email не могут быть пустые!");
	exit;	
}


if ($u_mail==false)
{
	Header("location:/reg/?msg=Неверный формат электронного адреса!");
	exit;	
}


$result = mysql_query("SELECT * FROM users WHERE ip='$ip' && time!='' ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
    if ((time()-$myrow[time])<=1000)
    {
       Header("location:/reg/?msg=Вы уже регистрировались, попробуйте восстановить пароль!");
	   exit; 
    }
}


$result_u = mysql_query("SELECT * FROM users WHERE mail='$u_mail' || phone='$u_phone'");
if (mysql_num_rows($result_u)!=0)
{
	Header("location:/reg/?msg=Такой логин уже есть!");
	exit;	
}

$id_user = md5($u_fio.$u_pass.$u_mail.date("d.m.Y").time());
$pass=md5(md5($u_pass));
$date = date("d.m.Y");
$real_pass = creat_pass($u_pass);

$result_add = mysql_query ("INSERT INTO users (uid,name,pass,phone,mail,fio,date_reg,status,text,real_pass,u_status,city,site,time,ip,mail_enabl2) VALUES ('$id_user','$u_phone','$pass','$u_phone','$u_mail','$u_fio','$date','Пользователь','$text','$real_pass','$u_status','$u_city','$u_site','$time','$ip','1')");

$text = "
ФИО: $u_fio<br>
Статус: $u_status<br>
Пароль: $u_pass<br>
E-mail: $u_mail<br>
Телефон: $u_phone<br>
Дополнительная информация:<br>$text
";


$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

mailto($text,'Зарегистрирован новый пользователь',$myrow[mail_admin]);


$text = "
Здравствуйте!<Br>
Спасибо за регистрацию у нас на сайте. <Br>
Ваши данные:<Br>
E-mail: $u_mail<br>
Пароль: $u_pass<br>
<Br>
Для подтверждения регистрации перейдите по ссылке <a href='http://$_SERVER[HTTP_HOST]/reg_ok/?uid=$id_user'>http://$_SERVER[HTTP_HOST]/reg_ok/?uid=$id_user</a><br><br><br>Данное письмо сформировано автоматически и на него отвечать не надо!";
mailto($text,'Подтверждение регистрации',$u_mail);


Header("location:/reg/?reg_ok&mail=$u_mail&msg=Регистрация завершена!");
exit;	
?>