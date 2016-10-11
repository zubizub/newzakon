
<div class="row">
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <form action="#" method="get" class="frmMainSearch">
        <div class="boxHeadSearch2">
            <img src="/img/main/forma_search/2.png" class="icoSearch2-2"/>
            <span class="boxSearchSelect2">
                <div class="boxCityPole">
                    <input name="city" class="inpCityMain boxHeadSearch2-select2" type="text" placeholder="Город">
                    <div class="listCityMain">
                        
                    </div>
                </div>
            </span>
            
            <img src="/img/main/forma_search/3.png" class="icoSearch2-3"/>
            <span class="boxSearchSelect3">
                <input type="text" class="boxHeadSearch2-select3" value="Специализация" readonly=""/>
                <img src="/img/for_option_up.png" class="imgListSelect imgListSelect3" />
                <div class="listSearchSelect2-3">
                    <a href="#" rel="nofollow" class="popup" data-value="Везде">любая</a>
                    <?
                    
                        $result_u = mysql_query("SELECT * FROM napravlenie ORDER BY name ASC");
                        $myrow_u = mysql_fetch_assoc($result_u); 
                        $num_rows_u = mysql_num_rows($result_u);

                        if ($num_rows_u!=0)
                        {
                        	do
                        	{
                                echo "<a href='#' rel='nofollow' class='popup' data-value='$myrow_u[name]'>$myrow_u[name]</a>";
                            }while($myrow_u = mysql_fetch_assoc($result_u));
                        }
                    
                    ?>
                </div>
            </span>
            
            <img src="/img/main/forma_search/4.png" class="icoSearch2-4"/>
            <span class="boxSearchSelect4">
                <input type="text" class="boxHeadSearch2-select44" placeholder="стоимость от"/> - 
                <input type="text" class="boxHeadSearch2-select44" placeholder="стоимость до"/>
            </span>
            
            <input type="hidden" value="" name="valMain_search1" class="valMain_search1"/>
            <input type="hidden" value="" name="valMain_search2" class="valMain_search2"/>
            <input type="hidden" value="" name="valMain_search3" class="valMain_search3"/>
            
            <input name="sort" type="hidden"/>
            <input name="type" type="hidden" value="main"/>
            
            <div class="boxHeadSearch2-btn2">Найти</div>
        </div>
        </form>
    </div>
</div>




<?php

$result = mysql_query("SELECT * FROM users WHERE u_status!='' ORDER BY karma DESC");
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
                    Карма: $myrow[karma]<br>
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
?>