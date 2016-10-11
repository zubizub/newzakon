
<?

if (isset($_GET[sort]))
{
    $city = f_data ($_GET[city], 'text', 0);
    $spec = f_data ($_GET[valMain_search2], 'text', 0);
    $price1 = f_data ($_GET[price1], 'text', 0);
    $price2 = f_data ($_GET[price2], 'text', 0);
    
    if ($city!='') {$city_w="&& city='$city'";} else {$city_w="";}
    if ($spec!='' && $spec!='Специализация') 
    {
        $result_u1 = mysql_query("SELECT * FROM napravlenie WHERE name='$spec'");
        $myrow_u1 = mysql_fetch_assoc($result_u1); 
        $naprav1_w="&& (naprav1='$myrow_u1[id]' || naprav2='$myrow_u1[id]' || naprav3='$myrow_u1[id]' || naprav4='$myrow_u1[id]' || naprav5='$myrow_u1[id]')";
        
    } 
    else {$naprav1_w="";}
    
    if ($price1=='') {$price1_w="0";}
    if ($price2=='') {$price2_w="1000000";}
    $price_w="&& ((price1>='$price1' && price1<='$price1') || (price2>='$price2' && price2<='$price2'))";
    
    
    $where_u = " $city_w $naprav1_w $price_w";
}
else
{
    $where_u='';
}

?>

<div class="row frmSortUrist">
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <form action="#" method="get" class="frmMainSearch">
        <div class="boxHeadSearch2">
            <img src="/img/main/forma_search/2.png" class="icoSearch2-2"/>
            <span class="boxSearchSelect2">
                <div class="boxCityPole">
                    <input name="city" class="inpCityMain boxHeadSearch2-select2" type="text" placeholder="Город" value="<? if ($city!='') {echo $city;} ?>">
                    <div class="listCityMain">
                        
                    </div>
                </div>
            </span>
            
            <img src="/img/main/forma_search/3.png" class="icoSearch2-3"/>
            <span class="boxSearchSelect3">
                <input type="text" class="boxHeadSearch2-select3" value="<? if ($spec!='') {echo $spec;} else {echo "Специализация";} ?>" readonly=""/>
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
                <input name="price1" type="text" class="boxHeadSearch2-select44" placeholder="стоимость от" value="<? if ($price1!='') {echo $price1;} ?>"/> - 
                <input name="price2" type="text" class="boxHeadSearch2-select44" placeholder="стоимость до" value="<? if ($price2!='') {echo $price2;} ?>"/>
            </span>
            
            <input type="hidden" value="" name="valMain_search1" class="valMain_search1"/>
            <input type="hidden" value="" name="valMain_search2" class="valMain_search2"/>
            <input type="hidden" value="" name="valMain_search3" class="valMain_search3"/>
            <input type="hidden" value="" name="valMain_search4" class="valMain_search4"/>
            
            <input name="sort" type="hidden"/>
            <input name="type" type="hidden" value="main"/>
            
            <div class="boxHeadSearch2-btn2">Найти</div>
        </div>
        </form>
    </div>
</div>




<?php

$result = mysql_query("SELECT * FROM users WHERE u_status!='' && status!='Администратор' $where_u ORDER BY karma DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);


if ($num_rows!=0)
{
    do
    {
        include("blocks/uristBox.php");
    }while($myrow = mysql_fetch_assoc($result));
}
else
{
    if (isset($_GET[sort]))
    {
        echo "По Вашему запросу не нашлось юристов!<Br><Br><a href='/urists/' class='showAllUrist'>Показать всех юристов</a>";
    }
}
?>