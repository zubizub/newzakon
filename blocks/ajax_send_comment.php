<?

//получение информации о количестве товаров в корзине

include("db.php");
include("f_data.php");

$text_comment = f_data ($_POST[text_comment], 'text', 0);
$id_vopros = f_data ($_POST[id_vopros], 'text', 0);
$uid = f_data ($_COOKIE[uid], 'text', 0);
$date = date("H:m d.m.Y");
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();

if ($text_comment=='' || $text_comment==false)
{
    echo "0";
    exit;
}

$result = mysql_query("SELECT * FROM vopros_comment WHERE ip='$ip' && time!='' && id_vopros='$id_vopros' ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
    if ((time()-$myrow[time])<=100)
    {
       echo "0";
       exit;
    }
}


$result_add = mysql_query ("INSERT INTO vopros_comment (uid,text,date,ip,time,id_vopros) VALUES ('$uid','$text_comment','$date','$ip','$time','$id_vopros')");		

$result_edit = mysql_query("UPDATE vopros SET numOtvet=numOtvet+1 WHERE id='$id_vopros'", $db);

//new rating system : answer +1 karma
$result = mysql_query("SELECT * FROM users WHERE uid='$uid'");
$myrow = mysql_fetch_assoc($result); 
$bal = 1;
$bal_user = intval($myrow['karma'])+$bal;
mysql_query("UPDATE users SET karma='$bal_user' WHERE uid='$uid'", $db);


$result = mysql_query("SELECT * FROM vopros_comment WHERE id_vopros='$id_vopros' ORDER BY id DESC LIMIT 1");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	$result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]' ORDER BY id DESC");
    $myrow_u = mysql_fetch_assoc($result_u); 
    $fio = $myrow_u[fio];
    
	echo "
        <div class='boxVoprosComment'>
            <div class='boxVoprosComment-text'>$text_comment</div>
            <div class='boxVoprosComment-podval'><a href='/userinf/$myrow_u[uid]/'>$fio</a> $myrow[date]</div>
        </div>
    ";
}

?>