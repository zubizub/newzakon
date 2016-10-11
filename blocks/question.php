<?php

$name_v = f_data($_GET['name_v'],'text',0);
$result = mysql_query("SELECT * FROM vopros WHERE name_m='$name_v'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$id_vopros = $myrow[id];

if ($num_rows!=0)
{
    if ($myrow[enabled]==1)
    {
        $result_us = mysql_query("SELECT * FROM users WHERE uid = '$myrow[uid]'");
        $myrow_us = mysql_fetch_assoc($result_us); 
        $user_m = $myrow_us['fio'];
        
        if ($myrow[cat]!='Не знаю')
        {
            $cat = "$myrow[cat]";
        }
        
        if ($myrow[city]!='')
        {
            $city = " | $myrow[city]";
        }
        
        if ($myrow[file]!='')
        {
            $file = "<Br><a href='/doc/vopros/$myrow[file]' class='linkAll' download>Скачать прикрепленный файл</a>";
        }
        
        
        echo "
            <div class='boxVoprosIn'>
                <div class='boxVoprosIn-text'>$myrow[text]</div>
                <div class='boxVoprosIn-dopinf'>
                    $cat $city $file | $myrow[date]<Br>
                    <!--<span class='boxVoprosTopick-user2'>$user_m</span>-->
                </div>
            </div>
        ";
    }
    else
    {
       echo "Вопрос еще на модерации."; 
    }
	
}
else
{
    echo "Вопрос был удален!";
}

?>



<? if (isset($_COOKIE[uid])) { ?>
<textarea class="text_comment" placeholder="Введите свой ответ на вопрос"></textarea>
<div class="textRight">
    <div class="btn_send_comment">отправить</div>
</div>
<input type="hidden" class="h_id_vopros" value="<? echo $id_vopros; ?>"/>
<?
}
else
{
    echo "<div class='textRight'>Отвечать на вопросы могут только зарегистрированые <a href='/reg/' class='linkA'>юристы</a></div>";
}
?>
<Br>
<div class="boxJsContent"></div>
<Br>
<?
$result_vc = mysql_query("SELECT * FROM vopros_comment WHERE id_vopros='$id_vopros' ORDER BY id DESC");
$myrow_vc = mysql_fetch_assoc($result_vc); 
$num_rows_vc = mysql_num_rows($result_vc);

if ($num_rows_vc!=0)
{
	do
	{
        
        $result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow_vc[uid]' ORDER BY id DESC");
        $myrow_u = mysql_fetch_assoc($result_u); 
        $fio = $myrow_u[fio];
        
		echo "
            <div class='boxVoprosComment'>
                <div class='boxVoprosComment-text'>$myrow_vc[text]</div>
                <div class='boxVoprosComment-podval'><a href='/userinf/$myrow_u[uid]/'>$fio</a> $myrow_vc[date]</div>
            </div>
        ";
	}while($myrow_vc = mysql_fetch_assoc($result_vc));
}



?>
