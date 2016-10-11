<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$result = mysql_query("SELECT * FROM users WHERE name!='AntiBuger' ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$date = date("d.m.Y");
$user_kol=0;

if ($num_rows!=0)
{
	do
	{
		$result_rassilka = mysql_query("SELECT * FROM rassilka WHERE mail='$myrow[mail]'");
		$myrow_rassilka = mysql_fetch_assoc($result_rassilka); 
		$num_rows_rassilka = mysql_num_rows($result_rassilka);
		
		if ($num_rows_rassilka==0)
		{
			$result_add = mysql_query ("INSERT INTO rassilka (name,mail,date) VALUES ('$myrow[fio]','$myrow[mail]','$date')");
			$user_kol++;
		}

	}while($myrow = mysql_fetch_assoc($result));
}

echo $user_kol;


?>