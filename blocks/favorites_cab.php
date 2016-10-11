<?

$result_ur = mysql_query("SELECT * FROM favorites WHERE uid='$_COOKIE[uid]'");
$myrow_ur = mysql_fetch_assoc($result_ur); 
$num_rows_ur = mysql_num_rows($result_ur);

if ($num_rows_ur!=0)
{
	do
	{
            $result = mysql_query("SELECT * FROM users WHERE uid='$myrow_ur[urist]' ORDER BY fio ASC");
            $myrow = mysql_fetch_assoc($result); 
            $num_rows = mysql_num_rows($result);


            if ($num_rows!=0)
            {
                do
                {
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
                         
                	echo "
                        <div class='row boxSmsCab'>
                            <div class='col-lg-1 col-md-1 col-sm-4 hidden-xs'>$ava</div>
                            <div class='col-lg-6 col-md-6 col-sm-4 col-xs-12'>
                                <a href='/userinf/$myrow[uid]/' class='name_cab_user'><b>$myrow[fio]</b></a>
                                Рейтинг: $myrow[karma]<br>
                                Город: $myrow[city]<br>
                            </div>
                            
                            <div class='col-lg-5 col-md-5 col-sm-4 col-xs-12'>
                                Стаж: $myrow[staj]<br>
                                Специализация: $napravlenie<br>
                                Специализация: $napravlenie2<br>
                            </div>
                        </div>
                        
                        ";
                }while($myrow = mysql_fetch_assoc($result));
            }
    }while($myrow_ur = mysql_fetch_assoc($result_ur));
}
else
{
    echo "Нет исполнителей в избранном!";
}

?>