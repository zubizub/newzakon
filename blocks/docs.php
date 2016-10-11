<?
$name_s = f_data ($_GET[name], 'text', 0);
?>

<div class="row">
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <form action="#" method="get" class="frmMainSearch frmMainSearch10">
        <div class="boxHeadSearch2">
            <span class="boxSearchSelect10">
                <div class="boxCityPole">
                    <input name="name" class="inpCityMain boxHeadSearch2-select2" type="text" placeholder="Название документа" value="<? echo $name_s; ?>">
                    <div class="listCityMain">
                        
                    </div>
                </div>
            </span>
            
            <input name="sort" type="hidden"/>
            <input name="type" type="hidden" value="main"/>
            
            <div class="boxHeadSearch10-btn">Найти</div>
        </div>
        </form>
    </div>
</div>


<?
    
    $result_d = mysql_query("SELECT * FROM doc WHERE name LIKE '%$name_s%' ORDER BY name ASC");
    $myrow_d = mysql_fetch_assoc($result_d); 
    $num_rows_d = mysql_num_rows($result_d);

    if ($num_rows_d!=0)
    {
        echo "<table class='tbl_file'>";
        
    	do
    	{
            
            if ($myrow_d[price]=='')
            {
                $price = 0;
                $url_file = "/download.php?file=$myrow_d[secretcod]";
                $url_file_class = "";
                $price = "бесплатно";
            }
            else
            {
                $price = $myrow_d[price];
                $url_file = "#";
                $url_file_class = "class='popup getDoc' num='$myrow_d[secretcod]'";
                $price = "$price руб";
            }
            
            $nameUser='';
            $result_us = mysql_query("SELECT * FROM users WHERE uid='$myrow_d[uid]'");
            $myrow_us = mysql_fetch_assoc($result_us); 
            $num_rows_us = mysql_num_rows($result_us);
            if ($num_rows_us!=0)
            {
               $nameUser="<a href='/userinf/$myrow_us[uid]/' class='nameUserDoc'>$myrow_us[fio]</a>"; 
            }

            
    		echo "
            <tr class='tbl_file_tr$myrow_d[id]'>
        		<td class='tbl_file_td1'><img src='/img/ico_doc.png' class='hidden-xs'/> <a href='$url_file' $url_file_class>$myrow_d[name]</a></td>
                <td class='tbl_file_td2'><img src='/img/ico_money.png' class='ico_money hidden-xs'/> $price</td>
                <td class='tbl_file_td3'>$nameUser</td>
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
        echo "Документов не найдено!";
    }
    
    ?>