<?

$text = $myrow[text];
        
if (mb_strlen($text,'UTF-8')>250)
{
    $text = mb_substr($text,0,250, "utf-8")."...";
}

$date_do = $myrow[date1];
$date_do_box='';
if ($date_do!='') 
{
    $date_do = "<img src='/img/ico/1.png'/> <div class='hidden-xs'>Срок выполнения до: </div><span>$myrow[date1]</span>";

}

$bujet = $myrow[bujet];
if ($bujet!='') {$bujet = "<img src='/img/ico/2.png'/> Бюджет: <span>".price_convert($myrow[bujet])." руб</span>";}

$cat = $myrow[cat];
if ($cat!='Не знаю') {$cat = "<a href='/zadaniy/?sort&type=cat&val=$myrow[cat]' class='typeZadach'>$myrow[cat]</a>";} else {$cat = '';}

$btnOtklik = "";

$city = '';
if ($myrow[city]!='')
{
    $city = " <span>$myrow[city]</span>";
}

$type = '';
$razdelitel = '';
if ($myrow[type]!='-')
{
    if ($cat!='') {$razdelitel = ' | ';}
    $type = "<a href='/zadaniy/?sort&type=type&val=$myrow[type]' class='typeZadach0'>$myrow[type]</a> $razdelitel ";
}

$youOtklik='';
if ($myrow[otklik]!=0)
{
    //отмечаем если вы уже откликнулись на задание
    $result_otkik = mysql_query("SELECT * FROM otklik WHERE uid='$_COOKIE[uid]' && idz='$myrow[id]'");
    $num_rows_otkik = mysql_num_rows($result_otkik);
    if ($num_rows_otkik!=0)
    {
        $youOtklik = "<div class='youOtklik'>Вы уже откликнулись на задание</div>";
    }
}

$nameUser='';
$result_us = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
$myrow_us = mysql_fetch_assoc($result_us); 
$num_rows_us = mysql_num_rows($result_us);
//print_r($myrow);
if ($num_rows_us!=0 && empty($myrow['fakeName']))
{
   $nameUser="<span class='fioUserzadanie'>$myrow_us[fio]</span>"; 
}
elseif (!empty($myrow['fakeName'])) {
    $nameUser="<span class='fioUserzadanie'>$myrow[fakeName]</span>"; 
}



$date_do='';
if ($myrow[date]!='')
{
    $date_do = "Сделать до: $myrow[date]";
}

echo "
<div class='boxZadach'>
    <div class='row'> 
        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
            <div class='nameUserZadach'><a href='/zadaniy_inf/?id=$myrow[id]'>$myrow[name]</a> $city</div>
        </div>
        
        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 textRight boxTypeZadach'>
            $type $cat
        </div>
        
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        $nameUser
        </div>
        
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div href='dateZadach'>$date_do</div>
            <div class='textZadach'>
            $text
            </div>
        </div>
        
        <div class='col-lg-4 col-md-4 col-sm-5 col-xs-12 miniBoxSmallInf miniBoxSmallInf1'>
            <div class='budjetZadach'>$bujet</div>
        </div>
        
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-6 miniBoxSmallInf miniBoxSmallInf2'>
            <div class='srokZadach'>$date_do</div>
        </div>
        
        <div class='col-lg-4 col-md-4 col-sm-3 col-xs-6 textRight miniBoxSmallInf'>
            $btnOtklik <div class='otklikovZadach'>Откликов <a href='/zadaniy_inf/?id=$myrow[id]'>$myrow[otklik]</a></div>
        </div>
        
        $youOtklik
    </div>
    </div>
";

?>