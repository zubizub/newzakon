<?

//восстановление пароля пользователя

include("db.php");
include("f_data.php");
include("mailto.php");
include("send_sms.php");


$mail = f_data ($_POST[mail], 'text', 0);

if ($mail!='')
{
    $result_user = mysql_query("SELECT * FROM users WHERE mail='$mail' || phone='$mail'");
    
    if (mysql_num_rows($result_user)!=0)
    {
    	$myrow_user = mysql_fetch_array($result_user);	
    	$edit_pass = md5($mail.$myrow_user[uid].$myrow_user[id]);
    	
    	$result_edit = mysql_query("UPDATE users SET edit_pass='$edit_pass' WHERE id='$myrow_user[id]'", $db);
    	

    	if ($myrow_user[u_status]=='Юрист' || $myrow_user[u_status]=='Адвокат')

    	if ($myrow_user[mail]!='')
    
        {
           $text = "Здравствуйте! <BR><BR>
        	<b>Вы прошли процедуру восстановления пароля на сайте $_SERVER[HTTP_HOST]</b><br>
        	Для изменения пароля перейдите по ссылке: <a href='http://$_SERVER[HTTP_HOST]/who_pass/?id=s5dfhtr335$myrow_user[uid]$myrow_user[id]&edit_pass=$edit_pass'>http://$_SERVER[HTTP_HOST]/who_pass/?id=s5dfhtr335$myrow_user[uid]$myrow_user[id]&edit_pass=$edit_pass</a><br>
        	"; 
            mailto($text,"Восстановление доступа",$mail);

            echo "1";

        }
        else
        {
            $text = "Здравствуйте! 
        	Для восстановления пароля для сайта $_SERVER[HTTP_HOST], перейдите по ссылке: 
        	http://$_SERVER[HTTP_HOST]/who_pass/?id=s5dfhtr335$myrow_user[uid]$myrow_user[id]&edit_pass=$edit_pass"; 

            //$text="Тестирование";
            sendSms($myrow_user[phone],$text);
            echo "11";

            sendSms($myrow_user[phone],$text);

        }
    	

    	

    	echo "1";

    }
    else
    {
    	echo "0";	
    }
}

?>