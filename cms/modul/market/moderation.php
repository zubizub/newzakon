<link rel="stylesheet" type="text/css" href="modul/vopros/css.css">


<?php


$result = mysql_query("SELECT * FROM market");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

$opisanie = $myrow[opisanie];

$usluga = $myrow[usluga];



if ($num_rows!=0)
{
    do
    {
        //print_r($myrow);


        $users = mysql_query("SELECT * FROM users WHERE id='$myrow[uid]'");
        $myrow_user = mysql_fetch_assoc($users); 
        
        echo "
        <form action=\"/cms/modul/market/change_status.php\" method=\"post\">
            <div class='boxVoprosComment'>
                <div class='boxVoprosComment-text'>Разместил: $myrow_user[fio]</div>
                <div class='boxVoprosComment-text'>$myrow[usluga]</div>
                <div class='boxVoprosComment-podval'>$myrow[opisanie]</div>
                  
    <div class='frmLineZadaniy'>Статус:</div>
    <select name=\"moderation\">
        <option value=\"1\""; 
        if ($myrow[moderation]=='1') {echo "selected";} 
        echo ">Активный</option>
        <option value=\"0\"";
        if ($myrow[moderation]=='0') {echo "selected";}
        echo ">Неактивный</option>
    </select>
    <input name='id' value='$myrow[id]' type='hidden'>
    <input value='изменить' type='submit'>
    <a href='modul/market/delete.php?id=$myrow[id]'>удалить</a>
            </div>
    </form>
    
        ";
    }while($myrow = mysql_fetch_assoc($result));
}

?>