<?
// кабинет пользователя

$url_ava = "cms/img/users/$USERARR[img]";

if (@fopen($url_ava, "r") && $USERARR[img]!='') 
{
    $ava = "<Br><div style=\"background-image:url('/cms/img/users/$USERARR[img]')\" class='main_img_sms'></div>";
}
else
{
    $ava = "<Br><div style=\"background-image:url('/img/not_photo.png')\" class='main_img_sms'></div>";
}

$data_reg = $USERARR[date_reg];
$data_now = date("d.m.Y");

$d1 = strtotime($data_reg);
$d2 = strtotime($data_now);

$diff = $d2-$d1;
$diff = $diff/(60*60*24);
$day_now = floor($diff); //сколько дней на сайте


//новые сообщения
$result_sms = mysql_query("SELECT * FROM sms_user WHERE uid_to='$_COOKIE[uid]' && prochitano='0'");
$num_rows_sms = mysql_num_rows($result_sms);
if ($num_rows_sms!=0) {$num_rows_sms=" <span>($num_rows_sms)</span>";} else {$num_rows_sms='';}

//новые отклики
$result_otklik = mysql_query("SELECT * FROM otklik WHERE neprochitan='0' && idz IN (SELECT id FROM zadaniy WHERE uid='$_COOKIE[uid]')");
$num_rows_otklik = mysql_num_rows($result_otklik);
if ($num_rows_otklik!=0) {$num_rows_otklik=" <span>($num_rows_otklik)</span>";} else {$num_rows_otklik='';}

//новые заказы с маркета
//$query = "SELECT id FROM zadaniy WHERE new='1' && uid='$_COOKIE[uid]'";
$query = "SELECT id FROM zadaniy WHERE new='1' && ispolnitel='$_COOKIE[uid]'";
$result_new_offers = mysql_query($query);
$num_rows_market = mysql_num_rows($result_new_offers);
if ($num_rows_market!=0) {$num_rows_market=" <span class='marketNewOffer'>($num_rows_market)</span>";} else {$num_rows_market='';}



$result_otz = mysql_query("SELECT * FROM otziv WHERE uid_ispolnit='$_COOKIE[uid]' ORDER BY id DESC");
$myrow_otz = mysql_fetch_assoc($result_otz); 
$num_rows_otz = mysql_num_rows($result_otz);

?>

<Br><Br>
<div class="row mainInfCab">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
        <div class="right_ava_cabinet">
            <form action="/blocks/obr_edit_user_ava.php" method="post" enctype="multipart/form-data" class="frm_cabinet_user0">
                <input name="img" type="file"  accept="image/jpeg,image/png,image/jpg" class="file_img avacab">
            </form>
            <? echo $ava; ?>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-8 cabPart1Name">
        <b><? echo $USERARR['fio']; ?></b><Br>
        Дней на сайте: <? echo $day_now; ?>
    </div>
    
    <? if ($urist==1) { ?>
    <div class="col-lg-5 col-md-4 col-sm-4 hidden-xs cabPart1Buy">
        <a href="/goldstatus/" target="_blank">Купите аккаунт PROGOLD</a> и воспользуйтесь всеми привелегиями!
    </div>
    <? } ?>
    
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 cabPart1Inf">
        <? if ($urist==1) { ?>
        <div class="cabPart1Inf-1"><img src="/img/ico_rating.png"/> Рейтинг: <span><? echo $myrow[karma]; ?></span></div>
        <div class="cabPart1Inf-2"><img src="/img/ico_otziv.png"/> Отзывов: <span><? echo $num_rows_otz; ?></span></div>
        <? } else {echo "<br>";}?>
        <a href="/cookie.php?exit" class="btn_exit">выход</a>
    </div>
</div>


<Br><Br>


<div class="box_cabinet_nav">
	<a href="#" class="popup btn_cabinet_nav btn_cabinet_nav1 btn_cabinet_nav_h" num="1">Информация</a>
	<a href="#" class="popup btn_cabinet_nav btn_cabinet_nav2" num="2">Сообщения<? echo $num_rows_sms; ?></a>
	<a href="#" class="popup btn_cabinet_nav btn_cabinet_nav3" num="3">Отклики <?= $num_rows_otklik; ?> <?= $num_rows_market;?></a>
	<? if ($urist==1) { ?><a href="#" class="popup btn_cabinet_nav btn_cabinet_nav4" num="4">Документы</a> <? } ?>
    <? if ($urist==1) { ?><a href="#" class="popup btn_cabinet_nav btn_cabinet_nav5" num="5">Отзывы</a> <? } ?>
    <? if ($urist==1) { ?><a href="#" class="popup btn_cabinet_nav btn_cabinet_nav10" num="10">Маркет</a> <? } ?>
    <? if ($urist==0) { ?><a href="#" class="popup btn_cabinet_nav btn_cabinet_nav7" num="7">Избранные юристы</a> <? } ?>
	<? if ($urist==0) { ?><a href="#" class="popup btn_cabinet_nav btn_cabinet_nav7" num="8">Вопросы</a> <? } ?>
    <a href="#" class="popup btn_cabinet_nav btn_cabinet_nav6" num="6">Настройки</a>
</div>



<div class="box_content_cabinet box_content_cabinet1">

<?
$result_u = mysql_query("SELECT * FROM users WHERE uid='$uid'");
$myrow_u = mysql_fetch_array($result_u);

if ($myrow_u[naprav1]!='') {$numNapravlen=1;}
if ($myrow_u[naprav2]!='') {$numNapravlen=2;}
if ($myrow_u[naprav3]!='') {$numNapravlen=3;}
if ($myrow_u[naprav4]!='') {$numNapravlen=4;}
if ($myrow_u[naprav5]!='') {$numNapravlen=5;}

?>

<div style="line-height:10px; font-size:13px; position:relative">
 <form action="/blocks/obr_edit_user.php" method="post" enctype="multipart/form-data" class="frm_cabinet_user">
        <input name="img" type="file"  accept="image/jpeg,image/png,image/jpg" class="file_img_real avacab_real">
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Имя пользователя:
        <span style="color:#F00">*</span></div> <input name="fio" type="text" size="50" value="<? echo $myrow_u[fio]; ?>" required>
        <br><br>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>E-mail:
        <span style="color:#F00">*</span></div> <input name="mail" type="text" size="50" value="<? echo $myrow_u[mail]; ?>" required><br><br>
 		<div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Телефон:
        <span style="color:#F00">*</span></div> <input name="phone" class='phone' type="text" size="50" value="<? echo $myrow_u[phone]; ?>" readonly="" required><br><br>        
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Пароль:</div> 
        <input name="pass" type="text" size="50" value="" placeholder="Если Вы не хотите менять пароль, то не заполняйте"><br><br>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Повтор пароля:</div> 
        <input name="pass2" type="text" size="50" value="" placeholder="Если Вы не хотите менять пароль, то не заполняйте"><br><br>
        
        
        <? if ($urist==1) { ?>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Компания:</div>  
        <input name="company" type="text" size="50" value="<? echo $myrow_u[company]; ?>"><br><br>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Город:</div>  
        <input name="city" type="text" size="50" value="<? echo $myrow_u[city]; ?>"><br><br>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Стаж:</div>  
        <select name="staj">
            <option <? if ($myrow_u[staj]=='менее 1 года') {echo "selected";} ?>>менее 1 года</option>
            <option <? if ($myrow_u[staj]=='от 1 до 3 лет') {echo "selected";} ?>>от 1 до 3 лет</option>
            <option <? if ($myrow_u[staj]=='более 3 лет') {echo "selected";} ?>>более 3 лет</option>
        </select><br><Br>
       
       <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Направление:</div>  
       <select name="naprav1">
            <option value=''>не выбрано</option>
            <?
                $result_n = mysql_query("SELECT * FROM napravlenie ORDER BY name ASC");
                $myrow_n = mysql_fetch_assoc($result_n); 
                $num_rows_n = mysql_num_rows($result_n);

                if ($num_rows_n!=0)
                {
                	do
                	{
                        if ($myrow_u[naprav1]==$myrow_n[id]) {$sel='selected';} else {$sel='';}
                		echo "<option value='$myrow_n[id]' $sel>$myrow_n[name]</option>";
                	}while($myrow_n = mysql_fetch_assoc($result_n));
                }
            ?>
        </select><br><Br>
        
        <div class="blockCabNapravlen2" <? if ($myrow_u[naprav2]!='') {echo "style='display:block'";} ?>>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Направление 2:</div>  
        <select name="naprav2">
            <option value=''>не выбрано</option>
            <?
                $result_n = mysql_query("SELECT * FROM napravlenie ORDER BY name ASC");
                $myrow_n = mysql_fetch_assoc($result_n); 
                $num_rows_n = mysql_num_rows($result_n);

                if ($num_rows_n!=0)
                {
                	do
                	{
                        if ($myrow_u[naprav2]==$myrow_n[id]) {$sel='selected';} else {$sel='';}
                		echo "<option value='$myrow_n[id]' $sel>$myrow_n[name]</option>";
                	}while($myrow_n = mysql_fetch_assoc($result_n));
                }
            ?>
        </select><br><Br>
        </div>
        
        
        <div class="blockCabNapravlen3" <? if ($myrow_u[naprav3]!='') {echo "style='display:block'";} ?>>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Направление 3:</div>  
        <select name="naprav3">
            <option value=''>не выбрано</option>
            <?
                $result_n = mysql_query("SELECT * FROM napravlenie ORDER BY name ASC");
                $myrow_n = mysql_fetch_assoc($result_n); 
                $num_rows_n = mysql_num_rows($result_n);

                if ($num_rows_n!=0)
                {
                	do
                	{
                        if ($myrow_u[naprav3]==$myrow_n[id]) {$sel='selected';} else {$sel='';}
                		echo "<option value='$myrow_n[id]' $sel>$myrow_n[name]</option>";
                	}while($myrow_n = mysql_fetch_assoc($result_n));
                }
            ?>
        </select><br><Br>
        </div>
        
        
        <div class="blockCabNapravlen4" <? if ($myrow_u[naprav4]!='') {echo "style='display:block'";} ?>>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Направление 4:</div>  
        <select name="naprav4">
            <option value=''>не выбрано</option>
            <?
                $result_n = mysql_query("SELECT * FROM napravlenie ORDER BY name ASC");
                $myrow_n = mysql_fetch_assoc($result_n); 
                $num_rows_n = mysql_num_rows($result_n);

                if ($num_rows_n!=0)
                {
                	do
                	{
                        if ($myrow_u[naprav4]==$myrow_n[id]) {$sel='selected';} else {$sel='';}
                		echo "<option value='$myrow_n[id]' $sel>$myrow_n[name]</option>";
                	}while($myrow_n = mysql_fetch_assoc($result_n));
                }
            ?>
        </select><br><Br>
        </div>
        
        
        <div class="blockCabNapravlen5" <? if ($myrow_u[naprav5]!='') {echo "style='display:block'";} ?>>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Направление 5:</div>  
        <select name="naprav5">
            <option value=''>не выбрано</option>
            <?
                $result_n = mysql_query("SELECT * FROM napravlenie ORDER BY name ASC");
                $myrow_n = mysql_fetch_assoc($result_n); 
                $num_rows_n = mysql_num_rows($result_n);

                if ($num_rows_n!=0)
                {
                	do
                	{
                        if ($myrow_u[naprav5]==$myrow_n[id]) {$sel='selected';} else {$sel='';}
                		echo "<option value='$myrow_n[id]' $sel>$myrow_n[name]</option>";
                	}while($myrow_n = mysql_fetch_assoc($result_n));
                }
            ?>
        </select><br><Br>
        </div>
        
        <? if ($numNapravlen!=5) { ?>
        <a href="#" class="popup btnAddNapravlen" num="<? echo $numNapravlen; ?>">Добавить направление +</a>
        <? } ?>
         
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Стоимость услуг:</div>  
        от <input name="price1" type="text" size="10" value="<? echo $myrow_u[price1]; ?>"> руб. - 
        до <input name="price2" type="text" size="10" value="<? echo $myrow_u[price2]; ?>"> руб. <br><br>
        
       
<br>
<div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Информация:</div><br><br>
<textarea name="text" style="width:99%" rows="5" placeholder="Образование, членство в юр. организации, ученые степени и т.п."><? echo $myrow_u[text]; ?></textarea>
<? } ?>

<br><br>
<div style="text-align:right; margin-top:5px"><input name="button" type="submit" value="сохранить" class="btn btnCabSaveUser"></div>
</form> 
</div>

<div style="font-size:12px">
    <span style="color:#F00">*</span> - обязательное поле для заполнения<br>
    <span style="color:#F00">!</span> - пароль не должен быть короче 6 символов
</div>
<Br><br>


</div>



<div class="box_content_cabinet box_content_cabinet2">
	<?
        $result_sms = mysql_query("SELECT * FROM (SELECT * FROM `sms_user` WHERE uid_to='$_COOKIE[uid]' || uid_from='$_COOKIE[uid]' ORDER BY `id` DESC) AS orderedTable GROUP BY uid_from ORDER BY `id` DESC");

		$myrow_sms = mysql_fetch_assoc($result_sms); 
        $num_rows_sms = mysql_num_rows($result_sms);

        if ($num_rows_sms!=0)
        {
        	do
        	{
                $uid_from = $myrow_sms['uid_from'];
                $result_u = mysql_query("SELECT * FROM users WHERE uid='$uid_from'");
		        $myrow_u = mysql_fetch_assoc($result_u);
                $url_ava = "cms/img/users/$myrow_u[img]";
    
                if (@fopen($url_ava, "r")) 
                {
                    $ava = "<div style=\"background-image:url('/cms/img/users/$myrow_u[img]')\" class='main_img_sms'></div>";
                }
                else
                {
                    $ava = "<div style=\"background-image:url('/img/not_photo.png')\" class='main_img_sms'></div>";
                }
                
                $text = strip_tags($myrow_sms['text']);
                
                if (mb_strlen($text,'utf-8')>200)
                {
                    $text = mb_substr($text,0,200,'utf-8');
                }
                 
                $result_sms_new = mysql_query("SELECT * FROM sms_user WHERE uid_to='$_COOKIE[uid]' && uid_from='$uid_from' && prochitano='0'");
                $num_rows_sms_new = mysql_num_rows($result_sms_new);
                if ($num_rows_sms_new!=0) {$num_rows_sms_new="<span>Новых сообщений: $num_rows_sms_new шт.</span> | ";} else {$num_rows_sms_new='';}

        		echo "
                <div class='row boxSmsCab'>
                    <div class='col-lg-2 col-md-2 col-sm-4 hidden-xs'>$ava</div>
                    <div class='col-lg-10 col-md-10 col-sm-8 col-xs-12'>
                        <a href='/im/?from=$myrow_sms[uid_from]' class='name_cab_user'><b>$myrow_u[fio]</b></a>
                        $text
                        <div class='date_cab_user0'>$num_rows_sms_new $myrow_sms[date]</div>
                    </div>
                </div>
                
                ";
        	}while($myrow_sms = mysql_fetch_assoc($result_sms));
        }
        else
        {
            echo "Нет сообщений!";
        }
	?>
	 
</div>



<div class="box_content_cabinet box_content_cabinet3">
<?

$result = mysql_query("SELECT * FROM zadaniy WHERE  (uid='$_COOKIE[uid]' || ispolnitel='$_COOKIE[uid]')  ORDER BY ispolnitel DESC, id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
        $city = '';
        if ($myrow[city]!='')
        {
            $city = "| $myrow[city]";
        }
        
        $enabled = '';
        if ($myrow[enabled]!=1)
        {
            $enabled = "<span style='color:red'>На рассмотрении</span>";
        }
        
        $individ='';
        if ($myrow[individ]==1)
        {
            $individ = "<span style='color:red'>Вас назначили персонально</span>";
        }

        $from_market='';
        unset($marketFlag);
        if ($myrow[from_market]==1)
        {
            $from_market = "<span style='color:red'>Заказ из юридического маркета</span>";
            $marketFlag = 1;
        }

        $new='';
        if ($myrow['new']==1)
        {
           $new = "<span style='color:red'>Новое задание</span>";
        }
        
        $endzayvkaBox = "";
        $endzayvka = $myrow['endzayvka']; 
        if ($endzayvka==1) {$endzayvkaBox = "<span class='infCloseZayvka'>Заявка закрыта!</span>";}
        $text = $myrow[text];
        
        $date_do = $myrow[date1];
        if ($date_do!='') {$date_do = "<img src='/img/ico/1.png'/> Срок выполнения до: <span>$myrow[date1]</span>";}
        
        $bujet = $myrow[bujet];
        if ($bujet!='') {$bujet = "<img src='/img/ico/2.png'/> Бюджет: <span>$myrow[bujet] руб</span>";}
        
        $cat = $myrow[cat];
        if ($cat!='Не знаю') {$cat = "<a href='#' class='typeZadach'>$myrow[cat]</a>";} else {$cat = '';}
        
        $result_otklik = mysql_query("SELECT * FROM otklik WHERE neprochitan='0' && idz='$myrow[id]'");
        $num_rows_otklik = mysql_num_rows($result_otklik);
        
        $result_otklik = mysql_query("SELECT * FROM otklik WHERE ispolnitel='1' && idz='$myrow[id]'");
        $myrow_otklik = mysql_fetch_assoc($result_otklik);
        //print_r($myrow_otklik); 
        
        if ($num_rows_otklik!=0) {$num_rows_otklik="dopClassNewOtklik";} else {$num_rows_otklik='';}
        
        $btnOtklik = "";
        
        if ($USERARR['cat']!='')
        {
            //$btnOtklik = "<div class='btnOtkliknutsa' num='$myrow[id]'>Откликнуться</div>";
        }
        
        $ispolnitel = "";
        if ($myrow['ispolnitel']!='')
        {
            $result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[ispolnitel]' ORDER BY id DESC");
            $myrow_u = mysql_fetch_assoc($result_u); 
            $ispolnitel = "Исполнитель: <a href='/userinf/$myrow_u[uid]/' rel='nofollow' class='nameIspolnitCabZayvka'>$myrow_u[fio]</a>";
            $owner = false;
            if ($myrow_u[uid] == $_COOKIE[uid]) { $owner = true; }
            $selected = false;
            if ($myrow_otklik[uid] == $_COOKIE[uid]) { 
                $selected = "<span style='color:green'>Вас выбрали исполнителем</span>";
            }
        } 

         $individ = "";
        if ($myrow['ispolnitel']!='')
        {
            $result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[ispolnitel]' ORDER BY id DESC");
            $myrow_u = mysql_fetch_assoc($result_u); 
            $ispolnitel = "Исполнитель: <a href='/userinf/$myrow_u[uid]/' rel='nofollow' class='nameIspolnitCabZayvka'>$myrow_u[fio]</a>";
            $owner = false;
            if ($myrow_u[uid] == $_COOKIE[uid]) { $owner = true; }
            $selected = false;
            if ($myrow_otklik[uid] == $_COOKIE[uid]) { 
                $selected = "<span style='color:green'>Вас выбрали исполнителем</span>";
            }
        }
           
        $client = "";
        $result_client = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
        $myrow_client = mysql_fetch_assoc($result_client); 
        if (!empty($myrow_client) && $marketFlag) { $client = "Клиент: $myrow_client[phone]<br/>$myrow_client[fio]"; } 

        $individ='';
        unset($clientData);
        if ($myrow[individ]==1)
        {
            $individ = "<span style='color:red'>Вас назначили персонально</span>";

            $clientData['fio'] = $myrow_client['fio'];
            $clientData['phone'] = $myrow_client['phone'];
            $clientData['mail'] = $myrow_client['mail'];
        }

        ?>
               
		<? echo "
        <div class='boxZadach'>
            <div class='row'> 
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
                    <div class='nameUserZadach'>$enabled <a href='/zadaniy_inf/?id=$myrow[id]'>$myrow[name]</a> $city $new $selected $individ</div>
                </div>
                
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 textRight boxTypeZadach'>
                    $cat
                </div>
                
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='textZadach'>
                    $text
                    </div>";
                if ($clientData) {
                    echo "<div class='textZadach'>
                    Клиент: $clientData[fio]. Тел.: $clientData[phone]. Почта: $clientData[mail]
                    </div>";
                }
                
                echo "</div><div class='col-lg-4 col-md-4 col-sm-5 col-xs-12 miniBoxSmallInf miniBoxSmallInf1'>
                    <div class='srokZadach'>$date_do</div>
                </div>
                
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 miniBoxSmallInf miniBoxSmallInf2'>
                    <div class='budjetZadach'>$bujet</div>
                </div>
                
                <div class='col-lg-4 col-md-4 col-sm-3 col-xs-12 textRight miniBoxSmallInf'>
                   $from_market $individ $ispolnitel $btnOtklik";
                   if ($client) { echo $client; }
                   
                   //if (!$marketFlag) { echo "<div class='otklikovZadach'>Откликов <a href='/zadaniy_inf/?id=$myrow[id]' class='$num_rows_otklik'>$myrow[otklik]</a></div>";}
                   if (!$owner) {
                        //echo "<div class='otklikovZadach'>Откликов <a href='/zadaniy_inf/?id=$myrow[id]' class='$num_rows_otklik'>$myrow[otklik]</a></div>";
                   }
                   echo "<br/><div class='otklikovZadach'>Откликов <a href='/zadaniy_inf/?id=$myrow[id]' class='$num_rows_otklik'>$myrow[otklik]</a></div>";
                   //echo "<br/><div class='otklikovZadach $num_rows_otklik'> Откликов $myrow[otklik]</div>";
                   echo "
                </div>
            </div>
        </div>
        ";
	}while($myrow = mysql_fetch_assoc($result));
}

?>
</div>






<div class="box_content_cabinet box_content_cabinet4">
	<div class="boxAddFile">
        <div class="boxAddFile-title">Загрузить файл</div>
        <form action="/blocks/obr_add_file.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Название файла" required/> 
            <input type="file" name="file" /> <input type="text" name="price" placeholder="0"/> руб
            <input type="submit" value="Загрузить файл" />
        </form>
        <div class="boxAddFile-podpis">Загружать файлы можно только в формате rar или zip</div>
    </div>
    
    <Br><br>
    
    
    <?
    
    $result_d = mysql_query("SELECT * FROM doc WHERE uid='$_COOKIE[uid]' ORDER BY name ASC");
    $myrow_d = mysql_fetch_assoc($result_d); 
    $num_rows_d = mysql_num_rows($result_d);

    if ($num_rows_d!=0)
    {
        echo "<table class='tbl_file'>";
        
    	do
    	{
    		echo "
            <tr class='tbl_file_tr$myrow_d[id]'>
        		<td class='tbl_file_td1'><img src='/img/ico_doc.png' class='hidden-xs'/> <a href='/download.php?file=$myrow_d[secretcod]'>$myrow_d[name]</a></td>
                <td class='tbl_file_td2'><img src='/img/ico_money.png' class='ico_money hidden-xs'/> $myrow_d[price] руб</td>
                <td class='tbl_file_td3 hidden-xs'>Загружен <span>$myrow_d[download]</span> раз</td>
                <td class='tbl_file_td4 tbl_file_td4-$myrow_d[id]'>
                    <a href='#' class='popup delFileNow delFileNow$myrow_d[id]' num='$myrow_d[id]'>удалить</a>
                    <div class='boxDelFile boxDelFile$myrow_d[id]'>
                        <div class='boxDelFile-da' num='$myrow_d[id]' num2='$myrow_d[secretcod]'>Да</div>
                        <div class='boxDelFile-net' num='$myrow_d[id]'>Нет</div>
                    </div>
                </td>
        	</tr>
            ";
    	}while($myrow_d = mysql_fetch_assoc($result_d));
        
        echo "</table>";
    }
    else
    {
        echo "У Вас нет документов! Загрузи файлы и получи дополнительные баллы в рейтинге!";
    }
    
    ?>
    
    <Br>
    <br>
</div>



<div class="box_content_cabinet box_content_cabinet5">
	<?
    
    $result_otz = mysql_query("SELECT * FROM otziv WHERE uid_ispolnit='$_COOKIE[uid]' ORDER BY id DESC");
    $myrow_otz = mysql_fetch_assoc($result_otz); 
    $num_rows_otz = mysql_num_rows($result_otz);

    if ($num_rows_otz!=0)
    {
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
        echo "Отзывов еще нет!";
    }

    
    ?>
</div>




<div class="box_content_cabinet box_content_cabinet6">
	<form action="/blocks/obr_user_settings.php" method="post" enctype="multipart/form-data">
		<label><input type="checkbox" name="rassilka" class="rassilka" <? if ($myrow_u['mail_enabl']=='1') {echo "checked";} ?>/> получать рассылку на e-mail</label><Br>
        
        <label><input type="checkbox" name="rassilka2" class="rassilka2" <? if ($myrow_u['mail_enabl2']=='1') {echo "checked";} ?>/> получать рассылку на телефон</label><Br>
		<input type="submit" value="сохранить" class="btn"/>
	</form>
</div>



<div class="box_content_cabinet box_content_cabinet7">
	<?
    
    include("blocks/favorites_cab.php");
    
    ?>
</div>



<div class="box_content_cabinet box_content_cabinet8">
    <?
        $result_v = mysql_query("SELECT * FROM vopros WHERE podtverdit='1' && uid='$_COOKIE[uid]' ORDER BY id DESC LIMIT 30");
        $myrow_v = mysql_fetch_assoc($result_v); 
        $num_rows = mysql_num_rows($result_v);
        $id_vopros = $myrow[id];

        
        if ($num_rows!=0)
        {
            do
            {
                $enabled = '';
                if ($myrow_v[enabled]=='0')
                {
                    $enabled = "<span>На модерации</span>";
                }
                echo "<a href='/question/$myrow_v[name_m]/' class='linkAll linkLastVoprosRight'>$enabled$myrow_v[name]</a>";
            }while($myrow_v = mysql_fetch_assoc($result_v));
        }
        else
        {
            echo "Вы еще не задали ни одного вопроса!";
        }
    ?>
</div>

<div class="box_content_cabinet box_content_cabinet10">
  
  <h2> Список услуг </h2>
    <?
    
    $query = "SELECT * FROM market WHERE uid = $USERARR[id]";
        $result = mysql_query($query);
        $marketRow = mysql_fetch_assoc($result); 
        $num_rows = mysql_num_rows($result);
        $id_vopros = $marketRow[id];

//        print_r($marketRow);

        if ($num_rows!=0)
        {
            do
            {
               echo "
        <form action='/blocks/obr_del_market.php' method='post' enctype='multipart/form-data' class='frm_cabinet_user marketlist'>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC; color: green;'>Услуга</div><div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC;color: green;'>Стоимость:
         <span>$marketRow[cena]</span></div><br/>
         <span style='display: inline-block; width: 300px;'>$marketRow[usluga]</span>
         <input type='hidden' name='marketId' value='$marketRow[id]'>
        <div style='display:inline-block; text-align:left; margin-top:5px; '><input name='button' type='submit' value='удалить' class='btn btnCabSaveUser'></div>
        </form><div class='clear clearfix'></div>  ";
            }while($marketRow = mysql_fetch_assoc($result));
        }
        else
        {
            echo "У Вас еще нет опубликованных услуг!";
        }
    ?>
<!-- <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC;color: green;'>Описание</div>
         <span>$marketRow[opisanie]</span> -->


<h2> Добавление услуги </h2>

	<form action="/blocks/obr_add_market.php" method="post" enctype="multipart/form-data" class="frm_cabinet_user">
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC; color: green;'>Услуга</div><br/><br/>
        <select name="usluga">
            <option value="Регистрация юридического лица">Регистрация юридического лица</option>
            <option value="Ликвидация юридического лица">Ликвидация юридического лица</option>
            <option value="Оформление самозастроя (самовольные постройки)">Оформление самозастроя (самовольные постройки)</option>
            <option value="Возврат автомобильных прав">Возврат автомобильных прав</option>
            <option value="Ведение бухгалтерии">Ведение бухгалтерии</option>
            <option value="Возврат денежных средств в случае неуплаты страховой">Возврат денежных средств в случае неуплаты страховой</option>
            <option value="Регистрация товарного знака">Регистрация товарного знака</option>
            <option value="Приватизация">Приватизация</option>
            <option value="Алименты">Алименты</option>
            <option value="Получение визы">Получение визы</option>
            <option value="Оформление разрешения на работу">Оформление разрешения на работу</option>
            <option value="Юридическое обслуживание бизнеса">Юридическое обслуживание бизнеса</option>
            <option value="Подготовка договора">Подготовка договора</option>
            <option value="Таможенное оформление грузов">Таможенное оформление грузов</option>
            <option value="Оформление и подача заявки на участие в госзакупках/тендерах">Оформление и подача заявки на участие в госзакупках/тендерах</option>
        </select><br><br>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC;color: green;'>Описание</div><br/><br/>
         <textarea name="opisanie" size="50" class='moxiecut'></textarea><br><br>
         <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC;color: green;'>Стоимость:
        <span style="color:#F00">*</span></div><br/><br/> <input name="cena" type="text" size="50" required><br><br>
        <div style="text-align:left; margin-top:5px"><input name="button" type="submit" value="добавить" class="btn btnCabSaveUser"></div>




</div>


<? //var_dump($_GET); ?>
<script>
	$(document).ready(function() {	
		$(".file_img").change(function() {		
			$(".main_img").attr("src","/img/not_photo2.png");
            $(".frm_cabinet_user0").submit();
		});
		
		//кабинет
		$(".btn_cabinet_nav").click(function() {

			var id_box_cabinet = $(this).attr("num");
            console.log (id_box_cabinet);
			$(".btn_cabinet_nav").removeClass("btn_cabinet_nav_h");
			$(this).addClass("btn_cabinet_nav_h");
			
			$(".box_content_cabinet").css("display","none");
			$(".box_content_cabinet"+id_box_cabinet).css("display","block");
		})
	
				
		<?
			$num = f_data($_GET['num'],'text',0);
			if (isset($_GET['num']))
			{
				echo "$('.btn_cabinet_nav$num').click();";
			}
		?>		
	});
</script>

<script type="text/javascript" src="/cms/tinymce/tinymce.min.js"></script>
<script type="text/javascript">


tinymce.PluginManager.load('moxiecut', '/cms/tinymce/plugins/moxiecut/plugin.min.js');

tinymce.init({
    selector: ".moxiecut",
    theme: "modern",
    language : 'ru',
    height: 300,
    width: 810,
    fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen textcolor",
                "insertdatetime colorpicker emoticons colorpicker media table contextmenu moxiecut"
            ],
        toolbar: "fontsizeselect | code | bullist | styleselect | bold italic | alignleft aligncenter alignright alignjustify | forecolor backcolor | link insertfile image  media | fullscreen",
    autosave_ask_before_unload: false,
    statusbar: false,
    relative_urls: false,
    forced_root_block : false,
    force_br_newlines : true,
    force_p_newlines : false,
    visualblocks_default_state: true,
    verify_html : false,
    image_advtab: true,
    extended_valid_elements : "a[name|href|target|title|onclick|class|rel],ul[],ol[]",
    entity_encoding: 'raw'
});
</script>


