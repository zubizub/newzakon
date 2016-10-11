<link rel="stylesheet" type="text/css" href="modul/zadaniy/css.css">
<script type="text/javascript" src="modul/zadaniy/js.js"></script>

<div class='boxZayvkiLink'>
    <a href="?page=zadaniy">Все задачи</a>
    <a href="?page=zadaniy&enabled">Только неактивные</a>
</div>

<?php

if (isset($_GET[enabled]))
{
    $enabled = " && enabled = '1'";
}
else
{
    $enabled = "";
}

$result = mysql_query("SELECT * FROM zadaniy WHERE 1=1 $enabled ORDER BY enabled ASC, id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
        $text = $myrow[text];
        
        $date_do = $myrow[date1];
        if ($date_do!='') {$date_do = "Срок выполнения до: <span>$myrow[date1]</span>";}
        
        $bujet = $myrow[bujet];
        if ($bujet!='') {$bujet = "Бюджет: <span>$myrow[bujet] руб</span>";}
        
        $cat = $myrow[cat];
        if ($cat!='Не знаю') {$cat = "$myrow[cat]";} else {$cat = '';}
        
        $city = '';
        if ($myrow[city]!='')
        {
            $city = "| $myrow[city]";
        }
        
        $inwork='';
        if ($myrow[inwork]!='')
        {
            $inwork = "<div class='boxZadach-inwork'>Задание в работе</div>";
        }
        
        
        $inwork='';
        if ($myrow[inwork]!='' && $myrow['endzayvka']==0)
        {
            $inwork = "<div class='boxZadach-inwork'>Задание в работе</div>";
        }
        
        $ispolnitel = "";
        if ($myrow['ispolnitel']!='')
        {
            $result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[ispolnitel]' ORDER BY id DESC");
            $myrow_u = mysql_fetch_assoc($result_u); 
            $ispolnitel = "<div class='boxZadach-ispol'>Исполнитель: $myrow_u[fio]</div>";
        }
        
        
        $user = "";
        if ($myrow['uid']!='')
        {
            $result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]' ORDER BY id DESC");
            $myrow_u = mysql_fetch_assoc($result_u); 
            $user = "<a href='?page=user_inf&id=$myrow_u[id]' target='_blank' class='boxZadach-ispol' style='display:block'>Создал: $myrow_u[phone]</a>";
        }
        
        $endzayvka = "";
        if ($myrow['endzayvka']!=0)
        {
            $endzayvka = "endzayvka_class";
        }
        
        
        $enabled_false = "";
        if ($myrow['enabled']==0)
        {
            $enabled_false = "<p title='Непроверенное задание'>[ ! ]</p>";
        }
        
		echo "
        <div class='boxZadach $endzayvka'>
            <div class='row'> 
                <div class='boxZadach-name'>
                    <div class='nameUserZadach'>$enabled_false <a href='?page=zadaniy_inf&id=$myrow[id]'>$myrow[name]</a> $city</div>
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
                
                <div class='boxZadach-datedo'>
                    <div class='srokZadach'>$date_do</div>
                </div>
                
                <div class='boxZadach-datebujet'>
                    <div class='budjetZadach'>$bujet</div>
                </div>
                
                <div class='boxZadach-otklik'>
                    <div class='otklikovZadach'>Откликов $myrow[otklik]</div>
                </div>
                
                $inwork
                
                $ispolnitel
                
                $user
                
                <a href='#' style='color:red' class='del_zadanie1 popup' num='$myrow[id]'>удалить</a>
            </div>
        </div>
        ";
	}while($myrow = mysql_fetch_assoc($result));
}


?>


<br>
<?
$result = mysql_query("SELECT * FROM zadaniy");
$num_rows = mysql_num_rows($result);
?>


<br>

