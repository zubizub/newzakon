<?

// обработчик заявки

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");
include("shifr_pass.php");
include("send_sms.php");

error_reporting(E_ALL & ~E_NOTICE);

$type = f_data ($_POST[type], 'text', 0);
$cat = f_data ($_POST[cat], 'text', 0);
$text = f_data ($_POST[text], 'text', 0);
$text_z = f_data ($_POST[text], 'text', 0);
$bujet = f_data ($_POST[bujet], 'text', 0);
$city = f_data ($_POST[city], 'text', 0);
$date1 = f_data ($_POST[date1], 'text', 0);
$date2 = f_data ($_POST[date2], 'text', 0);
$name_zadanie = f_data ($_POST[name], 'text', 0);
if ($name_zadanie=='') {$name_zadanie="Новое задание";}
$name = f_data ($_POST[u_name], 'text', 0);
$phone  = f_data ($_POST[u_phone_verify] , 'text',0);
$ispolnitel  = f_data ($_POST[ispolnitel], 'text', 0);
$enabled = 0;
if (isset($_POST['bigZadanie']))
{
    $enabled=0;
}
$phone = clearPhone($phone);
//print_r($phone);


//print_r($_COOKIE);
//$_COOKIE[uid] = 358;

$date = date("H:m d.m.Y");
if (isset($_COOKIE[advert])) {$advert=$_COOKIE[advert];} else {$advert="";}

$ip = $_SERVER['REMOTE_ADDR'];
$time = time();



if ($text == false)
{
	Header("location:/new_zadanie/?msg=Не заполнены обязательные поля!");
	exit;
}


if (!isset($_COOKIE[uid]))
{
    $result = mysql_query("SELECT * FROM users WHERE phone='$phone' ORDER BY id DESC");
    $myrow = mysql_fetch_assoc($result); 
    $num_rows = mysql_num_rows($result);
    
    //$num_rows =0;

    print_r('БЛОК1');
    print_r('<hr/>');
    print_r($myrow);
    if ($num_rows==0)
    {

        //print_r($num_rows);
        $kod = md5(date("d.m.Y")."евро".time()."ffga");
        $uid = md5($kod.$phone.date("d.m.Y").time());
        $u_pass = generate_password(7);
        $pass=md5(md5($u_pass));
        $date = date("d.m.Y");
        $real_pass = creat_pass($u_pass);

        $query ="INSERT INTO users (uid,name,pass,phone,mail,fio,date_reg,status,text,real_pass,podtverjdenie) VALUES ('$uid','$phone','$pass','$phone','','$name','$date','Пользователь','-','$real_pass','1')";
        $result_add = mysql_query ($query);
        //print_r($query);
        
        //если задание дается персонально
        if ($ispolnitel!='')
        {

            $query = "INSERT INTO zadaniy (name,type,cat,text,bujet,date1,date2,city,uid,enabled,ispolnitel,inwork,individ) VALUES ('$name_zadanie','$type','$cat','$text','$bujet','$date1','$date2','$city','$uid','1','$ispolnitel','1','1')";
            print_r($query);
            $result_add = mysql_query ($query);
            
            $result_user = mysql_query("SELECT * FROM users WHERE uid='$ispolnitel'");
            $myrow_user = mysql_fetch_assoc($result_user); 
            $text = "Здравствуйте!<Br>
            Вам пришло новое задание. Зайдите в личный кабинет чтобы узнать подробнее. ";
        
        //mailto($text,"Уведомление с сайта",$myrow_user[mail]);
        }
        else
        {
           $query = "INSERT INTO zadaniy (name,type,cat,text,bujet,date1,date2,city,uid,enabled) VALUES ('$name_zadanie','$type','$cat','$text','$bujet','$date1','$date2','$city','$uid','$enabled')";
           print_r($query);
           $result_add = mysql_query($query); 
        }
        
        
        $text = "Регистрация на сайте $_SERVER[HTTP_HOST] завершена! Ваш логин: $phone, Ваш пароль: $u_pass";
        sendSms($phone,$text);
    } 
}


else
{
    $uid = $_COOKIE['uid'];

    print_r('БЛОК2');
    print_r('<hr/>');
    $date = date("d.m.Y");
    
    $result_us = mysql_query("SELECT * FROM users WHERE uid='$uid' ORDER BY id DESC");
    $myrow_us = mysql_fetch_assoc($result_us); 
    $phone = $myrow_us['phone'];


    
    //если задание дается персонально
    if ($ispolnitel!='')
    {
        $query = "INSERT INTO zadaniy (name,type,cat,text,bujet,date1,date2,city,uid,enabled,ispolnitel,inwork,individ) VALUES ('$name_zadanie','$type','$cat','$text','$bujet','$date1','$date2','$city','$uid','1','$ispolnitel','1','1')";
        $result_add = mysql_query ($query);
        print_r($query);
        
        $result_user = mysql_query("SELECT * FROM users WHERE uid='$ispolnitel'");
        $myrow_user = mysql_fetch_assoc($result_user); 
        $text = "Здравствуйте!<Br>
        Вам пришло новое задание. Зайдите в личный кабинет чтобы узнать подробнее. ";
        
        mailto($text,"Уведомление с сайта",$myrow_user[mail]);
    }
    else
    {
       $query = "INSERT INTO zadaniy (name,type,cat,text,bujet,date1,date2,city,uid,enabled) VALUES ('$name_zadanie','$type','$cat','$text','$bujet','$date1','$date2','$city','$uid','$enabled')";
       $result_add = mysql_query ($query); 
       print_r($query);
    }    
    
}


$img_name=md5(md5(rand(111111111,99999999999).time()."eutesdfsg"));
		
if ($_FILES["doc"] ["tmp_name"] != "" && f_data($_FILES["doc"] ["name"], 'file', $_FILES["doc"] ["size"]) == true)
{ 
	$ext = substr($_FILES['doc']['name'], 1 + strrpos($_FILES['doc']['name'], ".")); // расширение файла
	$name_real_file = $_FILES["doc"] ["name"];
    
	copy($_FILES["doc"] ["tmp_name"], "../doc_zadanie/".$_FILES["doc"]["name"]);
	$rename = rename ("../doc_zadanie/".$_FILES["doc"]["name"], "../doc_zadanie/".$img_name.".".$ext);
    
    $result_f = mysql_query("SELECT * FROM zadaniy ORDER BY id DESC LIMIT 1");
    $myrow_f = mysql_fetch_assoc($result_f); 
    
	$result_edit = mysql_query("UPDATE zadaniy SET file='$img_name.$ext',name_file='$name_real_file' WHERE id='$myrow_f[id]'", $db);
}


$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

$text = "<b>Уведомляем Вас, что на сайте $_SERVER[HTTP_HOST]</b><br>
От $name, тел. $phone,<br>
Была получена задача $name_zadanie<br>
$text_z
";


print_r('<hr/>');
print_r($_POST);
mailto($text,"Уведомление с сайта",$myrow[mail_admin]);

if ($enabled==1)
{
    Header("location:/zadaniy/?msg=Спасибо. Ваше задание опубликовано!");	
}
else
{
    if ($ispolnitel!='')
    {
        Header("location:/?msg=Задание отправлено исполнителю!");
    }
    else
    {
       Header("location:/?msg=Спасибо. Заявка отправлена на модерацию!"); 
    }
    	
}

//exit;*/
	
?>