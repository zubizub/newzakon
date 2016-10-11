<?php

if (isset($_GET[sort]))
{
   if ($_GET[type]=='cat')
   {
       $val = f_data ($_GET['val'], 'text', 0);
       $sortWhere = "&& cat='$val'";
       echo "<siv class='boxSortCat'>Показаны результаты по запросу: <span>$val</span></div><Br>";
   }
}
else
{
    $sortWhere = "";
}

$result = mysql_query("SELECT * FROM zadaniy WHERE enabled = '1' && inwork='0' $sortWhere ORDER BY id DESC $limit_z");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
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
        
		echo "
        <div class='boxZadach'>
            <div class='row'> 
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
                    <div class='nameUserZadach'><a href='/zadaniy_inf/?id=$myrow[id]'>$myrow[name]</a> $city</div>
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
                
                <div class='col-lg-4 col-md-4 col-sm-5 col-xs-12 miniBoxSmallInf miniBoxSmallInf1'>
                    <div class='budjetZadach'>$bujet</div>
                </div>
                
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 miniBoxSmallInf miniBoxSmallInf2'>
                    <div class='srokZadach'>$date_do</div>
                </div>
                
                <div class='col-lg-4 col-md-4 col-sm-3 col-xs-12 textRight miniBoxSmallInf'>
                    $btnOtklik <div class='otklikovZadach'>Откликов <a href='/zadaniy_inf/?id=$myrow[id]'>$myrow[otklik]</a></div>
                </div>
            </div>
        </div>
        ";
	}while($myrow = mysql_fetch_assoc($result));
}


?>