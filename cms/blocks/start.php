<?
setcookie("close_left_menu",'1');
session_start();
date_default_timezone_set('Europe/Moscow');


if (!isset($_COOKIE[uid]))
{
	$url_back = $_SERVER['QUERY_STRING'];
	$url_back = str_replace("&", "115511", $url_back);
	$url_back = str_replace("=", "117711", $url_back);
 	Header("location:/cms/admin.php?url_back=$url_back");	
	exit;		
}
else
{
	include("blocks/db.php");
	include("blocks/f_data.php"); 
    
	$uid = f_data ($_COOKIE[uid], 'text', 0);
	$token = f_data ($_COOKIE[token], 'text', 0);
	$result_u = mysql_query("SELECT * FROM users WHERE uid='$uid' && token='$token' && status='�������������'");
	$myrow_u = mysql_fetch_assoc($result_u);
	$num_rows = mysql_num_rows($result_u);	
	$name_user_admin = $myrow_u[name];
	
	if ($num_rows==0)
	{

	 	Header("location:/cms/admin.php?msg=������ �����������! ��������� ����!");	
		exit;				

	}		
}



include("../class/Session.php");
include("blocks/mailto.php");
include("blocks/first_start.php");
$page = $_GET[page];

//������ � ����, ��������� ��������
$result_s = mysql_query("SELECT * FROM settings");
$SETTINGS = mysql_fetch_assoc($result_s); 

//���� �������� ������
$d_domain = $SETTINGS[date_domain];
$d_host = $SETTINGS[date_host];
@$ostatok_day_domain = time()-mktime(0,0,0,$d_domain[3].$d_domain[4],$d_domain[0].$d_domain[1],substr($d_domain,-4));
$ostatok_day_domain = 365-round($ostatok_day_domain/(60*60*24));
@$ostatok_day_host = time()-mktime(0,0,0,$d_host[3].$d_host[4],$d_host[0].$d_host[1],substr($d_host,-4));
$ostatok_day_host = 365-round($ostatok_day_host/(60*60*24));

if ($ostatok_day_domain<15 && !isset($_COOKIE[ostatok_day_domain])) 
{
	$text = "<b>���������� ���, ��� ���� �������� ������ $_SERVER[HTTP_HOST] �������� � �����!</b><br>
	��� ��������� ������ ��������� � ���� �� e-mail: info@eurosites.ru ��� ���. 8 (863) 255-44-22";
	
	setcookie("ostatok_day_domain","1");
	mailto($text,"�����������",$SETTINGS[mail_admin]);

}

if ($ostatok_day_host<15 && !isset($_COOKIE[ostatok_day_host])) 
{
	$text = "<b>���������� ���, ��� ���� �������� �������� ��� $_SERVER[HTTP_HOST] �������� � �����!</b><br>
	��� ��������� ��������� � ���� �� e-mail: info@eurosites.ru ��� ���. 8 (863) 255-44-22";
	
	setcookie("ostatok_day_host","1");
	mailto($text,"�����������",$SETTINGS[mail_admin]);

}
//////////////////////////////////////

$result_u = mysql_query("SELECT * FROM users WHERE uid='$_COOKIE[uid]'");
$myrow_u = mysql_fetch_assoc($result_u); 	
$NAME_USER = $myrow_u[fio];
$N_USER = $myrow_u[name];
$STATUS_USER = $myrow_u[status];
$UID_USER = $myrow_u[uid];
//������ � ����, ��� �������� ���������
$now_date = date("d.m.Y");
$now_time = date("H:m");
$result_control = mysql_query("SELECT * FROM control_dostup WHERE date='$now_date' && ip='$_SERVER[REMOTE_ADDR]'");
if (mysql_num_rows($result_control)==0)
{
	$result_u = mysql_query("SELECT * FROM users WHERE uid='$_COOKIE[uid]'");
	$myrow_u = mysql_fetch_assoc($result_u); 	
	$NAME_USER = $myrow_u[fio];
	
	if ($NAME_USER != 'AntiBuger')
	{
		$result_add = mysql_query ("INSERT INTO control_dostup (date,user,ip,time) VALUES ('$now_date','$myrow_u[fio]','$_SERVER[REMOTE_ADDR]','$now_time')");	
	}
}

?>