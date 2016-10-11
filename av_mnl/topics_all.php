
<Br>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE url='85' ORDER BY name ASC LIMIT 2,2");
        $myrow_fm = mysql_fetch_assoc($result_fm); 
        $num_rows_fm = mysql_num_rows($result_fm);

        if ($num_rows_fm!=0)
        {
        	do
        	{
                ?>
                <div class="name_all_topics"><? echo $myrow_fm[name]; ?></div>
                <div class="link_all_topics">
                    <?
                        $result_topick = mysql_query("SELECT * FROM pages WHERE url='85/$myrow_fm[id]' ORDER BY name ASC");
                        $myrow_topick = mysql_fetch_assoc($result_topick); 
                        $num_rows_topick = mysql_num_rows($result_topick);

                        if ($num_rows_topick!=0)
                        {
                        	do
                        	{
                        		echo "<a href='/topics/$myrow_topick[m_link]/'>$myrow_topick[name]</a>";
                        	}while($myrow_topick = mysql_fetch_assoc($result_topick));
                        }
                    ?>
                </div>
                
                <?
            }while($myrow_fm = mysql_fetch_assoc($result_fm));
        }
        ?>
    </div>
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE url='85' ORDER BY name ASC LIMIT 0,2");
        $myrow_fm = mysql_fetch_assoc($result_fm); 
        $num_rows_fm = mysql_num_rows($result_fm);

        if ($num_rows_fm!=0)
        {
        	do
        	{
                ?>
                <div class="name_all_topics"><? echo $myrow_fm[name]; ?></div>
                <div class="link_all_topics">
                    <?
                        $result_topick = mysql_query("SELECT * FROM pages WHERE url='85/$myrow_fm[id]' ORDER BY name ASC");
                        $myrow_topick = mysql_fetch_assoc($result_topick); 
                        $num_rows_topick = mysql_num_rows($result_topick);

                        if ($num_rows_topick!=0)
                        {
                        	do
                        	{
                        		echo "<a href='/topics/$myrow_topick[m_link]/'>$myrow_topick[name]</a>";
                        	}while($myrow_topick = mysql_fetch_assoc($result_topick));
                        }
                    ?>
                </div>
                
                <?
            }while($myrow_fm = mysql_fetch_assoc($result_fm));
        }
        ?>
    </div>
</div>



<Br><BR>



<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?

$result = mysql_query("SELECT * FROM vopros WHERE enabled = '1' && podtverdit='1' ORDER BY id DESC LIMIT 30");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
        $result_us = mysql_query("SELECT * FROM users WHERE uid = '$myrow[uid]'");
        $myrow_us = mysql_fetch_assoc($result_us); 
        $user_m = $myrow_us['fio'];
        
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
                <span class='boxVoprosTopick-user'></span><span class='boxVoprosTopick-cat'>$cat</span><span class='boxVoprosTopick-sity'>$city</span> 
            </div>
            
            <div class='boxZadach-text'>
                <div class='textZadach'>
                $text
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 BoxdateZadach'>$myrow[date]</div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 boxOtvetZadach'><a href='/question/$myrow[name_m]/' class='otvetZadach'>ответить</a></div>
            </div>
        </div>
        ";
	}while($myrow = mysql_fetch_assoc($result));
}

?>

    </div>
</div>