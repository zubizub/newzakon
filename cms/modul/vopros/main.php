<link rel="stylesheet" type="text/css" href="modul/vopros/css.css">
<script type="text/javascript" src="modul/vopros/js.js"></script>

<div class='boxZayvkiLink'>
    <a href="?page=vopros">Все задачи</a>
    <a href="?page=vopros&enabled">Только неактивные</a>
</div>

<?php

if (isset($_GET[enabled]))
{
    $enabled = " && enabled = '0'";
}
else
{
    $enabled = "";
}

$result = mysql_query("SELECT * FROM vopros WHERE 1=1 $enabled ORDER BY enabled ASC, id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
        $text = $myrow[text];
        if ($myrow[cat]!='Не знаю')
        {
            $cat = "$myrow[cat]";
        }
        
        $city = '';
        if ($myrow[city]!='')
        {
            $city = " | $myrow[city]";
        }
        
        if ($myrow[file]!='')
        {
            $file = "<Br><a href='/doc/vopros/$myrow[file]' class='linkAll' download>Скачать прикрепленный файл</a>";
        }
        
        if ($myrow[podtverdit]=='0')
        {
            $podtverjd = "<span class='nepodtverjd'>Не подтверждено пользователем</span>";
        }
        else
        {
            $podtverjd = "<span class='podtverjd'>Подтверждено пользователем</span>";
        }
        
		echo "
        <div class='boxZadach $endzayvka'>
            <div class='row'> 
                <div class='boxZadach-name'>
                    $podtverjd <div class='nameUserZadach'>$enabled_false <a href='?page=vopros_inf&id=$myrow[id]'>$myrow[name]</a> $city</div>
                </div>
                
                <div class='boxZadach-cat'>
                     $cat
                </div>
                
                
                <div class='boxZadach-text'>
                    <div href='dateZadach'>$myrow[date]</div>
                    <div class='textZadach'>
                    $text
                    </div>
                </div>
                
                
                $inwork
                
                $user
                
                
                <a href='#' style='color:red' class='del_vopros1 popup' num='$myrow[id]'>удалить</a>
            </div>
        </div>
        ";
	}while($myrow = mysql_fetch_assoc($result));
}


?>


<br>
<?
$result = mysql_query("SELECT * FROM vopros");
$num_rows = mysql_num_rows($result);
?>


<br>

