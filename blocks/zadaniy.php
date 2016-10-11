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
                <input type="text" class="boxHeadSearch2-select3" value="Категория" readonly=""/>
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
                <input type="text" class="boxHeadSearch2-select4" value="Вид задания" readonly=""/>
                <img src="/img/for_option_up.png" class="imgListSelect imgListSelect4" />
                <div class="listSearchSelect2-4">
                    <?
                        $result_u = mysql_query("SELECT * FROM type_uslugi ORDER BY name ASC");
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
                    <a href='#' rel='nofollow' class='popup' data-value='Другое'>Другое</a>
                </div>
            </span>
            
            <input type="hidden" value="" name="valMain_search1" class="valMain_search1"/>
            <input type="hidden" value="" name="valMain_search2" class="valMain_search2"/>
            <input type="hidden" value="" name="valMain_search3" class="valMain_search3"/>
            
            <input name="sort" type="hidden"/>
            <input name="type" type="hidden" value="main"/>
            
            <div class="boxHeadSearch2-btn">Найти</div>
        </div>
        </form>
    </div>
</div>



<?php

if (isset($_GET[sort]))
{
   if ($_GET[type]=='cat')
   {
       $val = f_data ($_GET['val'], 'text', 0);
       $sortWhere = "&& cat='$val'";
       echo "<div class='boxSortCat'>Показаны результаты по запросу: <span>$val <a href='/zadaniy/'>x</a></span></div><Br>";
   }
   
   if ($_GET[type]=='type')
   {
       $val = f_data ($_GET['val'], 'text', 0);
       $sortWhere = "&& type='$val'";
       echo "<div class='boxSortCat'>Показаны результаты по запросу: <span>$val <a href='/zadaniy/'>x</a></span></div><Br>";
   }
   
   
   if ($_GET[type]=='main')
   {
       $city = f_data ($_GET['valMain_search1'], 'text', 0);
       $cat = f_data ($_GET['valMain_search2'], 'text', 0);
       $vid = f_data ($_GET['valMain_search3'], 'text', 0);
       
       $sortWhereCity = '';
       if ($city!=false && $city!='')
       {
           $sortWhereCity = "&& city='$city'";
           $line1 = "Город: <span>$city <a href='/zadaniy/?sort&type=main&valMain_search2=$cat&valMain_search3=$vid'>x</a></span>";
       }
       
       $sortWhereCat = '';
       if ($cat!=false && $cat!='Категория' && $cat!='' && $cat!='Любая')
       {
           $sortWhereCat = "&& cat='$cat'";
           $line2 = "Категория: <span>$cat <a href='/zadaniy/?sort&type=main&valMain_search1=$city&valMain_search3=$vid'>x</a></span>";
       }
       
       $sortWhereVid = '';
       if ($vid!=false && $vid!='' && $vid!='Вид задания')
       {
           $sortWhereVid = "&& type='$vid'";
           $line3 = "Вид задания: <span>$vid <a href='/zadaniy/?sort&type=main&valMain_search1=$city&valMain_search3=$vid'>x</a></span>";
       }

       $sortWhere = "$sortWhereCity $sortWhereCat $sortWhereVid";
       
       
       if ($city=='' && $cat=='' && $vid=='')
       {
           
       }
       else
       {
           echo "
           <div class='boxSortCat'>
               Показаны результаты по запросу:<Br>
               $line1
               $line2
               $line3
           </div><Br>";
       }
       
   }

}
else
{
    $sortWhere = "";
}

$result = mysql_query("SELECT * FROM zadaniy WHERE enabled = '1' && inwork='0' && from_market ='0' $sortWhere ORDER BY id DESC $limit_z");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
        include("blocks/zadanieBox.php");
	}while($myrow = mysql_fetch_assoc($result));
}



?>
