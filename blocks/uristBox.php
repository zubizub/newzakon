<?php
$uid_from = $myrow_sms['uid_from'];
$url_ava = "cms/img/users/$myrow[img]";

if (@fopen($url_ava, "r") && $myrow[img]!='') 
{
    $ava = "<div style=\"background-image:url('/cms/img/users/$myrow[img]')\" class='main_img_urist'></div>";
}
else
{
    $ava = "<div style=\"background-image:url('/img/not_photo.png')\" class='main_img_urist'></div>";
}

$napravlenie = '-';
$result_n = mysql_query("SELECT * FROM napravlenie WHERE id='$myrow[naprav1]' ORDER BY name ASC");
$myrow_n = mysql_fetch_assoc($result_n); 
if ($myrow_n[name]!='') {$napravlenie = $myrow_n[name];}

$napravlenie2 = '-';
$result_n = mysql_query("SELECT * FROM napravlenie WHERE id='$myrow[naprav2]' ORDER BY name ASC");
$myrow_n = mysql_fetch_assoc($result_n); 
if ($myrow_n[name]!='') {$napravlenie2 = $myrow_n[name];}
 
if ($napravlenie!='-') {$napravlenie = "Специализация: $napravlenie<br>";} else {$napravlenie = '';} 
if ($napravlenie2!='-') {$napravlenie2 = "Специализация: $napravlenie2<br>";} else {$napravlenie2 = '';}
if ($myrow[staj]!='') {$staj="Стаж: $myrow[staj]<br>";} else {$staj='';}

     
echo "
    <div class='row boxSmsCab'>
        <div class='col-lg-1 col-md-1 col-sm-4 hidden-xs'>$ava</div>
        <div class='col-lg-6 col-md-6 col-sm-4 col-xs-12'>
            <a href='/userinf/$myrow[uid]/' class='name_cab_user'><b>$myrow[fio]</b></a>
            Рейтинг: $myrow[karma]<br>
            Город: $myrow[city]<br>
        </div>
        
        <div class='col-lg-5 col-md-5 col-sm-4 col-xs-12'>
            $staj
            $napravlenie
            $napravlenie2
        </div>
    </div>
    
    ";
?>