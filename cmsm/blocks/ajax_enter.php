<?
include("db.php");
include("../../blocks/f_data.php");

$mail =  f_data($_POST['name'],'text',0);
$pass = md5(md5(f_data($_POST['pass'],'text',0)));
if ($_POST[zapomnit]==true) {$zapomnit=1;} else {$zapomnit=0;}

$result = mysql_query("SELECT * FROM users WHERE (name='$mail' || mail='$mail') && pass='$pass'");

if (mysql_num_rows($result)!=0)
{
	$myrow = mysql_fetch_assoc($result); 	
	echo $myrow[uid]."-".$zapomnit;
}
else
{
	echo '0';	
}

?>