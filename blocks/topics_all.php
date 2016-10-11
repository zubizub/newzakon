
<?

$search = f_data ($_GET[search], 'text', 0);

?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="#" method="get" class="frm_search_thema">
            <input type="text" name="search" value="<? if (isset($_GET[search])) {echo $search;} ?>" placeholder="Поиск по вопросам"/>
            <input type="submit" value="поиск" />
        </form>
    </div>
</div>

<? if (!isset($_GET[search])) { ?>
<div class="row">
    <a href="#" class="btnShowAllCatVopros popup" rel="nofollow">Показать категории вопросов</a>
    
    
    <div class="boxShowAllCatVopros">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE id='87' ORDER BY name ASC");
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
        
       <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE id='94' ORDER BY name ASC");
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
        
        <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE id='97' ORDER BY name ASC");
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
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE id='90' || id='86' ORDER BY name ASC");
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
        
        <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE id='95' ORDER BY name ASC");
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
    
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE id='88' ORDER BY name ASC");
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
        
        
         <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE  id='89' ORDER BY name ASC");
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
        
        <?
            $result_fm= mysql_query("SELECT * FROM folder_materials WHERE id='92' ORDER BY name ASC");
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
            
        <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE id='96' ORDER BY name ASC");
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
    
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
       
         <?
        $result_fm= mysql_query("SELECT * FROM folder_materials WHERE  id='91' ORDER BY name ASC");
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
        
         <?
            $result_fm= mysql_query("SELECT * FROM folder_materials WHERE id='93' ORDER BY name ASC");
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
    
</div>
<Br>

<? } else { ?>

<a href="/topics/" class="linkA">< Вернуться ко всем темам</a>

<? } ?>

<BR>


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?




if ($search!='')
{
    $result = mysql_query("SELECT * FROM vopros WHERE enabled = '1' && podtverdit='1' && (name LIKE '%$search%' || text LIKE '%$search%') ORDER BY id DESC LIMIT 30");
}
else
{
    $result = mysql_query("SELECT * FROM vopros WHERE enabled = '1' && podtverdit='1' ORDER BY id DESC LIMIT 30");
}

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

?>

    </div>
</div>