<?php

$id_secret = f_data ($_GET[id_secret], 'text', 0);

$result = mysql_query("SELECT * FROM vopros WHERE id_secret='$id_secret' && podtverdit='0'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
    $uid = $myrow['uid'];
	$result_edit = mysql_query("UPDATE vopros SET podtverdit='1' WHERE id_secret='$id_secret'", $db);
    $result_edit = mysql_query("UPDATE vopros SET podtverjdenie='1' WHERE uid='$uid'", $db);
    
    $result_user = mysql_query("SELECT * FROM vopros WHERE uid='$uid'");
    $myrow_user = mysql_fetch_assoc($result_user); 
    $mail = $myrow_user['mail'];
    $text = "Здравствуйте!<Br>
    Ваш вопрос подтвержден. Спасибо Вам. Вопрос находится по адресу:<Br>
    <a href=\"https://moyzakon.com/question/$myrow[name_m]/\">https://moyzakon.com/question/$myrow[name_m]/</a>";
    mailto($text,"Вопрос подтвержден",$mail);
    
    echo "Здравствуйте!<Br>
    Ваш вопрос подтвержден. Спасибо Вам! Вопрос находится по адресу:<Br>
    <a href='https://moyzakon.com/question/$myrow[name_m]/' class='linkAll'>https://moyzakon.com/question/$myrow[name_m]/</a>";
}
else
{
    echo "Ссылка недействительна или вопрос уже активирован!";
}


?>