<?php

include("billing_sms.php");

function sendSms($phone,$text)
{
    $date = date("m:h d.m.Y");
    $result_add = mysql_query ("INSERT INTO sms (phone,text,date) VALUES ('$phone','$text','$date')");	
    send_sms($text,$phone);
}





?>