<div class='row'>

<a href="#" rel="nofollow" class="showFaqMenu popup">Показать разделы FAQ</a>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 leftFaq">
    <div class="leftFaq-title">Правила портала</div>
    <?
    
        $result = mysql_query("SELECT * FROM pages WHERE url='76/77' ORDER BY name ASC");
        $myrow = mysql_fetch_assoc($result); 
        $num_rows = mysql_num_rows($result);

        if ($num_rows!=0)
        {
        	do
        	{
                if ($page==$myrow[m_link]) {$active = "class='leftFaqActive'";} else {$active = "";}
        		echo "<a href='/$myrow[m_link]/' $active>$myrow[name]</a>";
        	}while($myrow = mysql_fetch_assoc($result));
        }
    ?>
    
    
    <div class="leftFaq-title">О портале</div>
    <?
    
        $result = mysql_query("SELECT * FROM pages WHERE url='76/78' ORDER BY name ASC");
        $myrow = mysql_fetch_assoc($result); 
        $num_rows = mysql_num_rows($result);

        if ($num_rows!=0)
        {
        	do
        	{
                if ($page==$myrow[m_link]) {$active = "class='leftFaqActive'";} else {$active = "";}
        		echo "<a href='/$myrow[m_link]/' $active>$myrow[name]</a>";
        	}while($myrow = mysql_fetch_assoc($result));
        }
    ?>
    
    
    <div class="leftFaq-title">Безопасность пользователя</div>
    <?
    
        $result = mysql_query("SELECT * FROM pages WHERE url='76/79' ORDER BY name ASC");
        $myrow = mysql_fetch_assoc($result); 
        $num_rows = mysql_num_rows($result);

        if ($num_rows!=0)
        {
        	do
        	{
                if ($page==$myrow[m_link]) {$active = "class='leftFaqActive'";} else {$active = "";}
        		echo "<a href='/$myrow[m_link]/' $active>$myrow[name]</a>";
        	}while($myrow = mysql_fetch_assoc($result));
        }
    ?>
    
    
    <div class="leftFaq-title">Служба поддержки</div>
    <?
    
        $result = mysql_query("SELECT * FROM pages WHERE url='76/80' ORDER BY name ASC");
        $myrow = mysql_fetch_assoc($result); 
        $num_rows = mysql_num_rows($result);

        if ($num_rows!=0)
        {
        	do
        	{
                if ($page==$myrow[m_link]) {$active = "class='leftFaqActive'";} else {$active = "";}
        		echo "<a href='/$myrow[m_link]/' $active>$myrow[name]</a>";
        	}while($myrow = mysql_fetch_assoc($result));
        }
    ?>
</div>

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 rightBlockFaq">
    <?
        if ($history!='') {echo "<div class='histor'>$history</div>";} //история
        if ($_GET[page]!='goods' && isset($_GET[page])) {echo "<h1>$name_page</h1>";}
                    
        $page = f_data ($_GET[page], 'text', 0);
        if ($page=='') {$page = "/FAQ/";}
        $result = mysql_query("SELECT * FROM pages WHERE id='$id' || m_link='$page'");
        $myrow = mysql_fetch_assoc($result); 
        $id_page = $myrow[id];

        echo "<div class='content_page'>".$myrow[text]."</div>";
    ?>
</div>


</div>