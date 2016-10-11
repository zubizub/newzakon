<br>
<?

// модуль поиска товаров и страниц на сайте

$search = f_data($_GET['search'],'text',0);
$search_real= f_data($_GET['search'],'text',0);
$SearchType = f_data($_GET['type'],'text',0);
if (strlen($search)>4) {$search = mb_substr($search,0,-1, "utf-8");}
$search_ok = 0;

?>


<div class="boxHeadSearch boxHeadSearchInPage">
    <img src="/img/ico_lupa.png" class="icoSearchHead"/>
    <input type="text" class="boxHeadSearch-pole" placeholder="Поиск по сайту..." value="<? echo $search_real; ?>"/>
    <span class="boxSearchSelect">
        <input type="text" class="boxHeadSearch-select" value="Везде" readonly=""/>
        <img src="/img/for_option_up.png" class="imgListSelect0" />
        <div class="listSearchSelect ">
            <a href="#" rel="nofollow" class="popup" data-value="По исполнителям">По исполнителям</a>
            <a href="#" rel="nofollow" class="popup" data-value="По заданиям">По заданиям</a>
            <a href="#" rel="nofollow" class="popup" data-value="По документам">По документам</a>
            <a href="#" rel="nofollow" class="popup" data-value="По вопросам">По вопросам</a>
            <a href="#" rel="nofollow" class="popup" data-value="Везде">Везде</a>
        </div>
    </span>
    <div class="boxHeadSearch-btn boxHeadSearch-btnm">Найти</div>
</div>


<?
//поиск товаров
if ($search != '' && $search != 'поиск...')
{	
    /*	
    $result_tu = mysql_query("SELECT * FROM type_uslugi WHERE name='$search_real'");
    $myrow_tu = mysql_fetch_assoc($result_tu); 
    $num_rows_tu = mysql_num_rows($result_tu);
    if ($num_rows_tu!=0) {$where_tu=" || type='$myrow_tu[id]'";} else {$where_tu='';}
    
    $result_napr = mysql_query("SELECT * FROM napravlenie WHERE name='$search_real'");
    $myrow_napr = mysql_fetch_assoc($result_napr); 
    $num_rows_napr = mysql_num_rows($result_napr);
    if ($num_rows_napr!=0) {$where_napr=" || cat='$myrow_napr[id]'";} else {$where_napr='';}
    */
    
    $result = mysql_query("SELECT * FROM zadaniy WHERE (enabled = '1' && inwork='0') && (name LIKE '%$search%' || text LIKE '%$search%' || type LIKE '%$search%' || cat LIKE '%$search%' || city='$search_real') ORDER BY id DESC LIMIT 30");
    $myrow = mysql_fetch_assoc($result); 
    $num_rows = mysql_num_rows($result);
}
else
{
	echo "Не задан параметр поиска";	
	$error=1;
}
	

if ($error!=1 && ($SearchType=='Везде' || $SearchType=='По заданиям'))
{			
	if ($num_rows!=0)
	{
		$search_ok=1;
		echo "
		<b>Задания:</b>
		<Br>
		Результаты по запросу <span style='color:#333'><b>$search_real</b></span>, поиск по заданиям сайта:<br>";
		
        /*
		do
		{
			echo "<a href='/zadaniy_inf/?id=$myrow[id]' target='_blank' class='linkSearchZadanie'>$myrow[name]</a>";
		}while($myrow = mysql_fetch_array($result));
		*/
        
    	do
    	{
            include("blocks/zadanieBox.php");
    	}while($myrow = mysql_fetch_assoc($result));
		echo "<br><br>";
	}
}	



if ($search != '' && $search != 'поиск...')
{		

    $result_napr = mysql_query("SELECT * FROM napravlenie WHERE name LIKE '%$search%'");
    $myrow_napr = mysql_fetch_assoc($result_napr); 
    $num_rows_napr = mysql_num_rows($result_napr);
    if ($num_rows_napr!=0) {$where_napr=" || naprav1='$myrow_napr[id]' || naprav2='$myrow_napr[id]' || naprav3='$myrow_napr[id]' || naprav4='$myrow_napr[id]' || naprav5='$myrow_napr[id]'";} else {$where_napr='';}
    
    $result = mysql_query("SELECT * FROM users WHERE u_status!='' && status!='Администратор' && (fio LIKE '%$search%' || city='$search_real' || text LIKE '%$search%' $where_napr) ORDER BY id DESC LIMIT 30");
    $myrow = mysql_fetch_assoc($result); 
    $num_rows = mysql_num_rows($result);
}
else
{
	echo "Не задан параметр поиска";	
	$error=1;
}
	

if ($error!=1 && ($SearchType=='Везде' || $SearchType=='По исполнителям'))
{			
	if ($num_rows!=0)
	{
		$search_ok=1;
		echo "
		<b>Исполнители:</b>
		<Br>
		Результаты по запросу <span style='color:#333'><b>$search_real</b></span>, поиск по исполнителям сайта:<br>";
		
        /*
		do
		{
			echo "<a href='/userinf/$myrow[uid]/' target='_blank' class='linkSearchZadanie'>$myrow[fio]</a>";
		}while($myrow = mysql_fetch_array($result));
		*/
        
        do
        {
            include("blocks/uristBox.php");
        }while($myrow = mysql_fetch_assoc($result));
		echo "<br><br>";
	}
}	




if ($error!=1 && ($SearchType=='Везде' || $SearchType=='По вопросам'))
{			

		$search_ok=1;
		echo "
		<b>Вопросы:</b>
		<Br>
		Результаты по запросу <span style='color:#333'><b>$search_real</b></span>, поиск по вопросам на сайте:<br>";

        $result = mysql_query("SELECT * FROM vopros WHERE enabled = '1' && podtverdit='1' && (name LIKE '%$search%' || text LIKE '%$search%') ORDER BY id DESC LIMIT 30");
        
        $myrow = mysql_fetch_assoc($result); 
        $num_rows = mysql_num_rows($result);

        if ($num_rows!=0)
        {
        	do
        	{
                if ($myrow[fakeName]=='')
                {
                    $result_us = mysql_query("SELECT * FROM users WHERE uid = '$myrow[uid]'");
                    $myrow_us = mysql_fetch_assoc($result_us); 
                    $user_m = $myrow_us['fio'];
                }
                else
                {
                    $user_m = $myrow[fakeName];
                }
                
                $text = $myrow[text];
                if ($myrow[cat]!='Не знаю')
                {
                    $cat = "$myrow[cat]";
                }
                
                $city = '';
                if ($myrow[city]!='')
                {
                    $city = " $myrow[city]";
                }
                
                
        		echo "
                <div class='boxVoprosTopick'>
                    <div class='boxZadach-name'>
                        <div class='nameUserZadach'><a href='/question/$myrow[name_m]/'>$myrow[name]</a></div>
                    </div>
                    
                    <div class='boxZadach-cat'>
                        <span class='boxVoprosTopick-user'>$user_m</span><span class='boxVoprosTopick-cat'>$cat</span><span class='boxVoprosTopick-sity'>$city</span> 
                    </div>
                    
                    <div class='boxZadach-text'>
                        <div class='textZadach'>
                        $text
                        </div>
                        
                        <div class='row'>
                            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 BoxdateZadach'>$myrow[date]</div>
                            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 boxOtvetZadach'>
                                <a href='/question/$myrow[name_m]/' class='otvetZadach'>ответов $myrow[numOtvet]</a>
                            </div>
                        </div>
                    </div>
                </div>
                ";
        	}while($myrow = mysql_fetch_assoc($result));
        }
		echo "<br><br>";

}


//поиск страниц

if ($search != '' && $search != 'поиск...')
{
	$result = mysql_query("SELECT * FROM pages WHERE (id='$search' || name LIKE '%$search%' || text LIKE '%$search%' || m_keywords LIKE '%$search%') && (enabled='1' && id!='1' && id!='2' && id!='3')  ORDER BY name DESC LIMIT 50");
	$myrow = mysql_fetch_array($result);
	//echo mysql_num_rows($result);
}
else
{
	echo "Не задан параметр поиска";	
	$error=1;
}
	
	
if ($error!=1)
{			
	if (mysql_num_rows($result)>0)
	{
		$search_ok=1;
		echo "
		<b>Страницы:</b>
		<br>
		Результаты по запросу <span style='color:#333'><b>$search_real</b></span>, поиск по страницам сайта:<br>";
		
		do
		{
			if ($myrow[url]!="") {$url=$myrow[url]."";} else {$url="";}	
			$url = "<a href='/$myrow[m_link]/' style='color:#333' target='_blank'>$myrow[name]</a>";				
			echo "<div style='padding-top:3px; padding-bottom:3px'>$url</div>";
		}while($myrow = mysql_fetch_array($result));
	}
}	


if ($search_ok==0)
{
	echo "<br><div align='left' style='color:#333'><span>По запросу <span style='font-size:20px'><b>$search_real</b></span> ничего не найдено </span></div><br><br><br>";
}


?>

<Br><Br>





