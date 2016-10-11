<?

include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$id = f_data ($_GET[id], 'text', 0);

if (isset($_GET[id]))
{
	$result = mysql_query("SELECT * FROM forms WHERE id = '$id'");
	$myrow = mysql_fetch_array($result);
	$forma = $myrow[forma];
	$palitra = $myrow[palitra];
	$f_mail = $myrow[f_mail];
	$f_title = $myrow[f_title];
	$capcha = $myrow[capcha];
}


if ($_POST[type]=='form')
{
	$id = f_data ($_POST[id], 'text', 0);
	$result = mysql_query("SELECT * FROM forms WHERE id = '$id'");
	$myrow = mysql_fetch_array($result);
	//echo $myrow[forma];
}


if ($_POST[type]=='palitra')
{
	$id = f_data ($_POST[id], 'text', 0);
	$result = mysql_query("SELECT * FROM forms WHERE id = '$id'");
	$myrow = mysql_fetch_array($result);
	//echo $myrow[palitra];
}


if ($_POST[type]=='f_mail')
{
	$id = f_data ($_POST[id], 'text', 0);
	$result = mysql_query("SELECT * FROM forms WHERE id = '$id'");
	$myrow = mysql_fetch_array($result);
	//echo $myrow[f_mail];
}


if ($_POST[type]=='f_title')
{
	$id = f_data ($_POST[id], 'text', 0);
	$result = mysql_query("SELECT * FROM forms WHERE id = '$id'");
	$myrow = mysql_fetch_array($result);
	//echo $myrow[f_title];
}


if ($_POST[type]=='capcha')
{
	$id = f_data ($_POST[id], 'text', 0);
	$result = mysql_query("SELECT * FROM forms WHERE id = '$id'");
	$myrow = mysql_fetch_array($result);
	//echo $myrow[capcha];
}
?>