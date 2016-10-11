<?

$uid = f_data ($_GET[uid], 'text', 0);
$result = mysql_query("SELECT * FROM users WHERE uid='$uid'");
$myrow = mysql_fetch_assoc($result);

if ($myrow['company']!='') {$company = "Компания: <span>".$myrow['company']."</span><br>";} else {$company = '';}
if ($myrow['staj']!='') {$staj = "Стаж: <span>".$myrow['staj']."</span><br>";} else {$staj = '';}
if ($myrow['text']!='') {$text = "<Br><b>Описание:</b><Br>".$myrow['text']."<br>";} else {$text = '';}

if ($myrow['naprav1']!='') 
{
    $result_n = mysql_query("SELECT * FROM napravlenie WHERE id='$myrow[naprav1]'");
    $myrow_n = mysql_fetch_assoc($result_n); 
    $num_rows_n = mysql_num_rows($result_n);
    if ($num_rows_n!=0) {$naprav1 = "Специализация: <span>".$myrow_n['name']."</span><br>";}
} 
else {$naprav1 = '';}

if ($myrow['naprav2']!='') 
{
    $result_n = mysql_query("SELECT * FROM napravlenie WHERE id='$myrow[naprav2]'");
    $myrow_n = mysql_fetch_assoc($result_n);
    $num_rows_n = mysql_num_rows($result_n); 
    if ($num_rows_n!=0) {$naprav2 = "Специализация: <span>".$myrow_n['name']."</span><br>";}
} 
else {$naprav2 = '';}

if ($myrow['naprav3']!='') 
{
    $result_n = mysql_query("SELECT * FROM napravlenie WHERE id='$myrow[naprav3]'");
    $myrow_n = mysql_fetch_assoc($result_n); 
    $num_rows_n = mysql_num_rows($result_n);
    if ($num_rows_n!=0) {$naprav3 = "Специализация: <span>".$myrow_n['name']."</span><br>";}
} 
else {$naprav3 = '';}

if ($myrow['naprav4']!='') 
{
    $result_n = mysql_query("SELECT * FROM napravlenie WHERE id='$myrow[naprav4]'");
    $myrow_n = mysql_fetch_assoc($result_n); 
    $num_rows_n = mysql_num_rows($result_n);
    if ($num_rows_n!=0) {$naprav4 = "Специализация: <span>".$myrow_n['name']."</span><br>";}
} 
else {$naprav4 = '';}

if ($myrow['naprav5']!='') 
{
    $result_n = mysql_query("SELECT * FROM napravlenie WHERE id='$myrow[naprav5]'");
    $myrow_n = mysql_fetch_assoc($result_n); 
    $num_rows_n = mysql_num_rows($result_n);
    if ($num_rows_n!=0) {$naprav5 = "Специализация: <span>".$myrow_n['name']."</span><br>";}
} 
else {$naprav5 = '';}

if ($myrow['price1']!='0') 
{
    $price = "Стоимость услуг: <span>$myrow[price1] руб.</span> - <span>$myrow[price2] руб.</span><br>";
} 
else {$price = '';}


$url_ava = "cms/img/users/$myrow[img]";

if (@fopen($url_ava, "r") && $myrow[img]!='') 
{
    $ava = "<Br><div style=\"background-image:url('/cms/img/users/$myrow[img]')\" class='main_img_sms'></div>";
}
else
{
    $ava = "<Br><div style=\"background-image:url('/img/not_photo.png')\" class='main_img_sms'></div>";
}

$result_otz = mysql_query("SELECT * FROM otziv WHERE uid_ispolnit='$uid' ORDER BY id DESC");
$myrow_otz = mysql_fetch_assoc($result_otz); 
$num_rows_otz = mysql_num_rows($result_otz);
?>



<div class='row'>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
        <? echo $ava; ?>
    </div>
    
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 boxInfUser2">
        <br><span class='boxInfUser2_name'><b><? echo $myrow['fio']."</b> | ".$myrow['city']; ?></span><Br>
        <?
            //если вы уже работали с этом пользователем то показывать контакты
            $result_zad = mysql_query("SELECT * FROM zadaniy WHERE (ispolnitel='$_COOKIE[uid]' && uid='$uid') || (ispolnitel='$uid' && uid='$_COOKIE[uid]')");
            $num_rows_zad = mysql_num_rows($result_zad);
            
            if ($num_rows_zad!=0)
            {
                echo $myrow['phone']."<Br>"; 
                echo $myrow['mail']."<Br>";
            }
            else
            {
                echo "Контактные данные будут доступны только после выбора исполнителя!";
            }
             
        ?>
    </div>
    
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 cabPart1Inf">
        <br><div class="cabPart1Inf-1"><img src="/img/ico_rating.png"/> Рейтинг: <span><? echo $myrow[karma]; ?></span></div>
        <div class="cabPart1Inf-2"><img src="/img/ico_otziv.png"/> Отзывов: <span><? echo $num_rows_otz; ?></span></div>
        <?
            $result_fav = mysql_query("SELECT * FROM favorites WHERE uid='$_COOKIE[uid]' && urist='$uid'");
            $myrow_fav = mysql_fetch_assoc($result_fav); 
            $num_rows_fav = mysql_num_rows($result_fav);
            
            if ($num_rows_fav==0)
            {
                echo "<div class='cabPart1Inf-2'>
                    <a href='#' rel='nofollow' class='addFavorit popup' num='$myrow[uid]' num2='1'>Добавить в избранное</a>
                </div>";
            }
            else
            {
                echo "<div class='cabPart1Inf-2'>
                    <a href='#' rel='nofollow' class='delFavorit popup' num='$myrow[uid]' num2='0'>Удалить из избранное</a>
                </div>";
            }
        ?>
        
    </div>
</div>


<br>
<a href="/new_zadanie/?t=<? echo $uid; ?>" class="btnSendMsgUser0">Предложить задание</a>

<? if ($guest==0 && $_COOKIE['uid']!=$myrow['uid']) { ?>

<div class="btnSendMsgUser">Написать сообщение</div> <a href='/im/?from=<? echo $myrow['uid']; ?>' class='btnToDialog'>Перейти к диалогу</a>
<? } ?>

<Br><Br>

<div class="boxInfAll">
<?

echo $company;
echo $staj;
echo $naprav1;
echo $naprav2;
echo $naprav3;
echo $naprav4;
echo $naprav5;
echo $price;
echo $text;

?>

</div>



<?
    
$result_d = mysql_query("SELECT * FROM doc WHERE uid='$uid' ORDER BY name ASC");
$myrow_d = mysql_fetch_assoc($result_d); 
$num_rows_d = mysql_num_rows($result_d);

if ($num_rows_d!=0)
{
    echo "<Br><Br>
    <div class='docUsers'>Документы исполнителя</div>
    <table class='tbl_file'>";
    
do
{
        
        if ($myrow_d[price]=='')
        {
            $price = 0;
            $url_file = "/download.php?file=$myrow_d[secretcod]";
            $url_file_class = "";
        }
        else
        {
            $price = $myrow_d[price];
            $url_file = "#";
            $url_file_class = "class='popup getDoc' num='$myrow_d[secretcod]'";
        }
        
        
        
	echo "
        <tr class='tbl_file_tr$myrow_d[id]'>
    		<td class='tbl_file_td1'><img src='/img/ico_doc.png' /> <a href='$url_file' $url_file_class>$myrow_d[name]</a></td>
            <td class='tbl_file_td2'><img src='/img/ico_money.png' class='ico_money'/> $price руб</td>
            <td class='tbl_file_td3'>Загружен <span>$myrow_d[download]</span> раз</td>
            <td class='tbl_file_td4 tbl_file_td4-$myrow_d[id]'>
                <a href='$url_file' $url_file_class>скачать</a>
            </td>
    	</tr>
        ";
}while($myrow_d = mysql_fetch_assoc($result_d));
    
    echo "</table>";
}
else
{
    //echo "Нет файлов!";
}

?>


<?
    
    $result_otz = mysql_query("SELECT * FROM otziv WHERE uid_ispolnit='$uid' ORDER BY id DESC");
    $myrow_otz = mysql_fetch_assoc($result_otz); 
    $num_rows_otz = mysql_num_rows($result_otz);

    if ($num_rows_otz!=0)
    {
        echo "<Br><Br><div class='docUsers'>Отзывы</div>";
    	do
    	{
            if ($myrow_otz[bal]==0)
            {
                $bal = "Нормально";
            }
            elseif ($myrow_otz[bal]==1)
            {
                $bal = "Хорошо";
            }
            elseif ($myrow_otz[bal]==2)
            {
                $bal = "Отлично";
            }
            elseif ($myrow_otz[bal]==-1)
            {
                $bal = "Плохо";
            }
            elseif ($myrow_otz[bal]==-2)
            {
                $bal = "Ужасно";
            }
            
    		echo "
            <div class='boxCabOtziv'>
                <div class='boxCabOtziv-text'>$myrow_otz[text]</div>
                <div class='boxCabOtziv-dopinf'>
                    <span class='boxCabOtziv-date'>$myrow_otz[date]</span> 
                    Оценка работы: <span class='boxCabOtziv-bal'>$bal</span> 
                </div>
            </div>
            ";
    	}while($myrow_otz = mysql_fetch_assoc($result_otz));
    }
    else
    {
        //echo "Отзывов еще нет!";
    }

    
    ?>