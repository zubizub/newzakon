<br>

<?

$from = f_data ($_GET['from'], 'text', 0);

$result_sms = mysql_query("SELECT * FROM sms_user WHERE (uid_to='$_COOKIE[uid]' && uid_from='$from') || (uid_from='$_COOKIE[uid]' && uid_to='$from') ORDER BY `id` ASC");
$myrow_sms = mysql_fetch_assoc($result_sms); 
$num_rows_sms = mysql_num_rows($result_sms);

if ($num_rows_sms!=0)
{
    do
    {
            $uid_from = $myrow_sms['uid_from'];
            $zadanie = $myrow_sms['zadanie'];
            
            $result_z = mysql_query("SELECT * FROM zadaniy WHERE id='$zadanie'");
            $myrow_z = mysql_fetch_assoc($result_z);
            $zadanie_name = '';
            if ($zadanie!='')
            {
                $zadanie_name = "<a href='/zadanie/?id=$myrow_z[id]' class='smsNameZadanie'>$myrow_z[name]</a>";
            }
            
            $result_u = mysql_query("SELECT * FROM users WHERE uid='$uid_from'");
            $myrow_u = mysql_fetch_assoc($result_u);
            $url_ava = "cms/img/users/$myrow_u[img]";

            if (@fopen($url_ava, "r") && $myrow_u[img]!='') 
            {
                $ava = "<div style=\"background-image:url('/cms/img/users/$myrow_u[img]')\" class='main_img_sms'></div>";
            }
            else
            {
                $ava = "<div style=\"background-image:url('/img/not_photo.png')\" class='main_img_sms'></div>";
            }
            
            $text = strip_tags($myrow_sms['text']);
            
            //если собщение еще не прочитано
            $neprochitanoSmsClass='';
            $neprochitanoSmsDiv='';
            if ($myrow_sms['prochitano']==0)
            {
                $neprochitanoSmsClass = "neprochitano";
                if ($myrow_sms['uid_from']==$_COOKIE['uid'])
                {
                   $neprochitanoSmsDiv = "<div class='neprochitanoTitle'>Не прочитано</div>"; 
                }
                else
                {
                    $neprochitanoSmsDiv = "<div class='neprochitanoTitle'>Новое сообщение</div>";
                }
                
            }
             
    	    echo "
            <div class='row boxSms'>
                <div class='col-lg-2 col-md-2 col-sm-4 hidden-xs blockAvaSms'>$ava</div>
                <div class='col-lg-10 col-md-10 col-sm-8 col-xs-12'>
                    <div class='name_cab_user'><b>$myrow_u[fio]</b> $zadanie_name</div>
                    $text
                    <div class='date_cab_user'>$myrow_sms[date]</div>
                </div>
                $neprochitanoSmsDiv
            </div>
            
            <div class='blockBoxMsg'></div>
            ";
    }while($myrow_sms = mysql_fetch_assoc($result_sms));
}
else
{
    echo "Нет сообщений!<br><Br>";
}


$result_edit = mysql_query("UPDATE sms_user SET prochitano='1' WHERE uid_to='$_COOKIE[uid]' && uid_from='$from' && prochitano='0'", $db);

?>

<div class="boxSendMsg">
    <form name="frmSendMsg" method="post" action="#" class="frmSendMsg">
        <textarea name="frmSendMsg-text" class="frmSendMsg-text" placeholder="Введите текст сообщения"></textarea>
        <div class="boxFrmSendMsg-btn"><div class="frmSendMsg-btn">отправить</div></div>
        <input type="hidden" name="uid_from" value="<? echo $from; ?>"/>
    </form>
</div>