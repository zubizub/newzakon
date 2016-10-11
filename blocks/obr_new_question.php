<?

// обработчик заявки

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");
include("shifr_pass.php");


$headers = 'From: info@moyzakon.com' . "\r\n" .
    'Reply-To: no-reply@moyzakon.com' . "\r\n" .
    'Content-type: text/html; charset=utf-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$name = f_data ($_POST[name], 'text', 0);
$name_m = translit($name)."_".rand(11111,99999);
$name_user = f_data ($_POST[name_user], 'text', 0);
$city = f_data ($_POST[city], 'text', 0);
$cat = f_data ($_POST[cat], 'text', 0);
//$mail = f_data ($_POST[mail], 'text', 0);
$mail = $_POST[mail];
//$text = f_data ($_POST[text], 'text', 0);
$text = $_POST[text];
//$uid = fdata ($_COOKIE[uid], 'text', 0);
$uid = $_COOKIE[uid];
$date = date("H:m d.m.Y");
$podtverdit = 0;



/*$query = "INSERT INTO vopros (name,name_m,cat,mail,text,date,ip,time,id_secret,uid,podtverdit,city) VALUES ('$name','$name_m','$cat','$mail','$text','$date','$ip','$time','$id_secret','$uid','$podtverdit','$city')";
print_r($query);
print_r($name);*/

if (isset($_COOKIE[advert])) {$advert=$_COOKIE[advert];} else {$advert="";}

$ip = $_SERVER['REMOTE_ADDR'];
$time = time();


if ($name == false || $text == false)
{
	Header("location:/new_question/?msg=Не заполнены обязательные поля!");
	exit;
}


$result = mysql_query("SELECT * FROM vopros WHERE ip='$ip' && time!='' ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
    if ((time()-$myrow[time])<=100)
    {
      /* Header("location:/new_question/?msg=Еще не прошло минуты с последней Вашей заявики!");
	   exit; */
    }
}


if ($uid=='')
{
    $id_secret = rand(11111111,99999999999).md5(date("d.m.Y H:i")."es");
    $result_user = mysql_query("SELECT * FROM users WHERE mail='$mail'");
    $myrow_user = mysql_fetch_assoc($result_user); 
    $num_rows_user = mysql_num_rows($result_user);
    if ($num_rows_user==0)
    {
        $u_pass = "fth".rand(11111111,99999999999)."ru";
        $id_user = md5($id_secret.$id_secret.time());
        $pass=md5(md5($u_pass));
        $date = date("d.m.Y");
        $real_pass = creat_pass($u_pass);
        $u_name1 = "user_".rand(1111111,9999999);
        
        if ($name_user=='')
        {
            $name_user = $u_name1;
        }

        $query = "INSERT INTO users (uid,name,pass,phone,mail,fio,date_reg,status,text,real_pass,u_status,city,site,mail_enabl2,podtverjdenie) 
        VALUES ('$id_user','$u_name1','$pass','','$mail','$name_user','$date','Пользователь','','$real_pass','','$city','','1','1')";
        print_r($query);
        $result_add = mysql_query($query);
        
        $uid = $id_user;
        
        print_r($mail);

        $text_mail = "Здравствуйте!<Br>
        Вы создали вопрос на сайте moyzakon.com, чтобы Ваш вопрос появился в общей ленте вопросов и на него смогли ответить, его необходимо подтвердить. Для подтверждения вопроса перейдите по ссылке:<Br>
        <a href=\"https://moyzakon.com/podtverdit/$id_secret/\">https://moyzakon.com/podtverdit/$id_secret/</a>";
        mailto($text_mail,"Подтверждение вопроса",$mail);
        
        $text_mail = "Здравствуйте!<Br>
        Вы зарегистрированы на портале moyzakon.com<Br>
        Ваши данные для входа:<Br>
        Логин: $mail<Br>
        Пароль: $u_pass";
        mailto($text_mail,"Подтверждение вопроса",$mail);
        /*if( mail('zubizubwork@gmail.com', $sub." [$_SERVER[HTTP_HOST]]", $text_mail, $headers)) {

    print_r('new user ok');
}*/

        //$msg = "Вопрос отправлен на проверку, но его сначала надо подтвердить через e-mail";
        $msgtype =1; 

    }
    else
    {
        $uid = $myrow_user[uid];
        $msgtype =11; 

        $msg = "Вопрос отправлен на проверку!";
    }
}
else
{
    $podtverdit = 1;
    $msgtype =111; 
    $msg = "Вопрос отправлен на проверку, как только администратор его проверит, он появится на сайте.";
}


$query = "INSERT INTO vopros (name,name_m,cat,mail,text,date,ip,time,id_secret,uid,podtverdit,city) VALUES ('$name','$name_m','$cat','$mail','$text','$date','$ip','$time','$id_secret','$uid','$podtverdit','$city')";
//print_r($query);
$result_add = mysql_query ($query);		




$file_name=md5(md5(rand(111111111,99999999999).time()."eutaesdfsg"));
		
if ($_FILES["doc"] ["tmp_name"] != "" && f_data($_FILES["doc"] ["name"], 'file', $_FILES["doc"] ["size"]) == true)
{ 
	$ext = substr($_FILES['doc']['name'], 1 + strrpos($_FILES['doc']['name'], ".")); // расширение файла
	$name_real_file = $_FILES["doc"] ["name"];
    
	copy($_FILES["doc"] ["tmp_name"], "../doc/vopros/".$_FILES["doc"]["name"]);
	$rename = rename ("../doc/vopros/".$_FILES["doc"]["name"], "../doc/vopros/".$file_name.".".$ext);
    
    $result_f = mysql_query("SELECT * FROM vopros ORDER BY id DESC LIMIT 1");
    $myrow_f = mysql_fetch_assoc($result_f); 
    
	$result_edit = mysql_query("UPDATE vopros SET file='$file_name.$ext' WHERE id='$myrow_f[id]'", $db);
}




$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

$text = "<b>Уведомляем Вас, что на сайте $_SERVER[HTTP_HOST]</b><br>
Был получен новый вопрос<br>
$name<Br>
$cat<br>
$city<br>
$text<Br>
<a href='/question/$name_m/'>$myrow[name]</a>
";

mailto($text,"Новый вопрос",$myrow[mail_admin]);


/*if( mail('zubizubwork@gmail.com', $sub." [$_SERVER[HTTP_HOST]]", $text, $headers)) {

    print_r('ok');
}*/

Header("location:/new_question/?msgtype=1");
exit;
	
?>