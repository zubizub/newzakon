<?php

$idz = f_data($_GET['id'],'text',0);

$result = mysql_query("SELECT * FROM zadaniy WHERE enabled = '1' && id='$idz' ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$uid_zadanie = $myrow[uid];
$num_rows = mysql_num_rows($result);
$inWork = $myrow['inwork'];
$ispolnitel = $myrow['ispolnitel']; 
$endzayvka = $myrow['endzayvka']; 
$text = $myrow[text];

$date_do = $myrow[date1];
if ($date_do!='') {$date_do = "<img src='/img/ico/1.png'/> Срок выполнения до: <span>$myrow[date1]</span>";}

$bujet = $myrow[bujet];
if ($bujet!='') {$bujet = "<img src='/img/ico/2.png'/> Бюджет: <span>".price_convert($myrow[bujet])." руб</span>";}

$cat = $myrow[cat];
if ($cat!='Не знаю') {$cat = "<a href='/zadaniy/?sort&type=cat&val=$myrow[cat]' class='typeZadach'>$myrow[cat]</a>";} else {$cat = '';}

$btnOtklik = "";
        
$city = '';
if ($myrow[city]!='')
{
    $city = "| $myrow[city]";
}


if ($endzayvka==1)
{
    echo "<br><Br><div class='msgEndZadanie'>Задание закрыто!</div><br><Br>";
}

if (isset($_COOKIE[uid]))
{
    $writeNow = "<a href='/im/?from=$myrow[uid]' class='labelSendMsg'>написать заказчику</a>";
}

      
echo "
<div class='boxZadach'>
    <div class='row'> 
        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
            <div class='nameUserZadach'>$myrow[name] $city  $writeNow</div>
        </div>
        
        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 textRight boxTypeZadach'>
            $cat
        </div>
        
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div href='dateZadach'>$myrow[date]</div>
            <div class='textZadach'>
            $text
            </div>
        </div>
        
        <div class='col-lg-4 col-md-4 col-sm-5 col-xs-12 miniBoxSmallInf1'>
            <div class='srokZadach'>$date_do</div>
        </div>
        
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 miniBoxSmallInf2'>
            <div class='budjetZadach'>$bujet</div>
        </div>
        
        <div class='col-lg-4 col-md-4 col-sm-3 col-xs-12 textRight'>
            $btnOtklik <div class='otklikovZadach'>Откликов <a href='/zadaniy_inf/?id=$myrow[id]'>$myrow[otklik]</a></div>
        </div>
    </div>
</div>
";


if ($myrow[file]!='')
{
    echo "<div class='titlePrikreplenFile'>Прикрепленный файл:</div>
    <a href='/doc_zadanie/$myrow[file]' rel='nofollow' class='linkPrikreplenFile' download>$myrow[name_file]</a>";
}


$result_otkl = mysql_query("SELECT * FROM otklik WHERE idz='$idz' && uid='$_COOKIE[uid]' ORDER BY ispolnitel DESC, id DESC"); 
$num_rows_otkl = mysql_num_rows($result_otkl);


?>

<? 


if ($USERARR[u_status]!='' && $num_rows_otkl==0 && $endzayvka==0) { ?>

<form class="frmOtklik" method="post" action="#">
    <div class="frmOtklik-title">Чтобы откликнуться на задание, опишите свое предложение подробнее:</div>
    <textarea name="text" class="frmOtklik-text"></textarea>
    <input name="zadanie" value="<? echo $idz; ?>" type="hidden"/>
    <div class="btnOtklikInZadanie">Откликнуться</div>
</form>

<? } ?>



<? if ($uid_zadanie==$_COOKIE[uid] && $inWork==1 && $endzayvka==0) { ?>
    <div align="center"><a href='#' rel="nofollow" class="btnEndProject" data-ispolnit="<? echo $ispolnitel; ?>">Завершить проект</a></div>
<? } ?>



<br><Br>
<div class="titleOtkl">Отклики</div>
<br>

<?

$result = mysql_query("SELECT * FROM otklik WHERE idz='$idz' ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($inWork==0 && $uid_zadanie==$_COOKIE[uid])
{
    $btnViborIspolnitely = "<a href='#' rel='nofollow' class='btnViborIspolnitely' data-uid='$myrow[uid]' data-id='$idz'>Выбрать исполнителя</a>";
}

if ($num_rows!=0)
{
	do
	{
        $ispolnitelClass = '';
        $ispolnitelStamp = '';
        $ispolnitel = '';
        $ispolnitelCancel='';
        if ($myrow[ispolnitel]==1)
        {
           $ispolnitelClass = "ispolnitelClass";
           $ispolnitelStamp = "<div class='ispolnitelStamp'></div>";
           $ispolnitel = "<span class='stampIspolnitel'>Исполнитель</span>";

           if ($myrow[endzayvka]==0 && $uid_zadanie==$_COOKIE[uid] && $endzayvka!=1) 
           {
               $ispolnitelCancel = " <span class='btnCancelUspolni' num='$idz' num2='$myrow[id]'>Отменить исполнителя</span>";
           }
        }
        
        $result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]' ORDER BY id DESC");
        $myrow_u = mysql_fetch_assoc($result_u); 
        $fio = $myrow_u[fio];
        
        $newOtklik='';
        if ($myrow[neprochitan]=='0')
        {
            $newOtklik = "<span class='neprochitan'>Новый отклик</span>";
        }
        
		echo "
        <div class='boxOtklik $ispolnitelClass'>
            $ispolnitelStamp
            $newOtklik<a href='/userinf/$myrow[uid]/' rel='nofollow' class='boxOtklik-name'>$fio</a> $ispolnitel $ispolnitelCancel<Br>
            $myrow[text]
            <div class='boxOtklik-date'>
                $myrow[date]<Br>
                $btnViborIspolnitely
            </div>
        </div>
        ";
	}while($myrow = mysql_fetch_assoc($result));
    
    
    //если это задание пользователя, то отмечаем все отклики как прочитаные
    if ($uid_zadanie==$_COOKIE[uid])
    {
        $result_edit = mysql_query("UPDATE otklik SET neprochitan='1' WHERE idz='$idz' && neprochitan='0'", $db);
    }
    
}
else
{
    echo "Еще нет откликов!<Br><Br>";
}



?>