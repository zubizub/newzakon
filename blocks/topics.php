<?php

$page = f_data ($_GET[name], 'text', 0);
$result = mysql_query("SELECT * FROM pages WHERE m_link='$page'");
$myrow = mysql_fetch_assoc($result); 
if ($myrow[img]!='') {
	$img_page = "<img src='/cms/modul/materials/upload/img/$myrow[img]' class='img_vopros_block'/>";
} else {$img_page = "";}
        
?>





<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <? echo $img_page; ?>
    </div>
    
    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
        <? echo "<div class='content_page content_page_topics'>".$myrow[text]."</div>"; ?>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 textCenter">
        <a href="/new_question/" class="btn_zadat_vopros topic">Задать вопрос</a><br/>
        <? // $cat_id : <?= $cat_id[0]; ?>
        <a href="/new_order/<?=$myrow[m_link];?>.html" class="btn_zadat_vopros topic_one">Заказать услугу у юриста</a>
    </div>
</div>




<Br><br>



<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?

$result = mysql_query("SELECT * FROM vopros WHERE enabled = '1' && podtverdit='1' && type='$name_page_for_vopros' ORDER BY enabled ASC, id DESC");
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
                $user_m <div class='nameUserZadach'><a href='/question/$myrow[name_m]/'>$myrow[name]</a></div>
            </div>
            
            <div class='boxZadach-cat'>
                <span class='boxVoprosTopick-user'>$user_m</span>
                <span class='boxVoprosTopick-cat'>$cat</span> 
                <span class='boxVoprosTopick-sity'>$city</span> 
            </div>
            
            <div class='boxZadach-text'>
                <div class='textZadach'>
                $text
                </div>
                <div href='dateZadach'>$myrow[date]</div>
            </div>
        </div>
        ";
	}while($myrow = mysql_fetch_assoc($result));
}

?>

    </div>
</div>