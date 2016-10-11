<?
$ROOT_DIR = __DIR__;
include("blocks/db.php");
include("blocks/f_data.php");

if (isset($_GET[del_cart]))
{
	foreach($_COOKIE as $ind=>$val)
	{
		if (substr_count($ind,"id_goods")!=0) {@setcookie($ind,'');}
	}
	
 	Header("location:/");	
	exit;			
}

if (isset($_GET[u]))
{
	$uid = f_data ($_GET[u], 'text', 0);
	$token = f_data ($_GET[token], 'text', 0);
	$uid = explode("-", $uid);
	
	$result = mysql_query("SELECT * FROM users WHERE uid='$uid[0]' && token='$token'");
	$num_rows = mysql_num_rows($result);
	
	if ($num_rows!=0)
	{	
		if ($uid[1]==1)
		{
			setcookie("uid",$uid[0],time()+36000000);
			setcookie("token",$token,time()+36000000);
		}
		else
		{
			setcookie("uid",$uid[0]);
			setcookie("token",$token);
		}

		$url_back = str_replace("115511", "&", $_GET[url_back]);
		$url_back = str_replace("117711", "=", $url_back);
		if ($url_back!='') {$url_back = "?$url_back";} else {$url_back='';}
		
	 	Header("location:/cms/$url_back");	
		exit;
	}	
	else
	{
	 	Header("location:/?msg=Ошибка авторизации!");	
		exit;		
	}	
}


//удаляем из сравнения
if (isset($_GET[del_compare]))
{
	setcookie("$_GET[type]","");
 	Header("location:/compare.php");	
	exit;
}


if (isset($_GET[uid]))
{
	$uid = f_data ($_GET[uid], 'text', 0);
	$token = f_data ($_GET[token], 'text', 0);

	$result = mysql_query("SELECT * FROM users WHERE uid='$uid' && token='$token'");
	$num_rows = mysql_num_rows($result);
	
	if ($num_rows!=0)
	{	
		if ($_GET[zapomnit]==1)
		{
			setcookie("uid",$uid,time()+36000000);
			setcookie("token",$token,time()+36000000);
		}
		else
		{
			setcookie("uid",$uid);
			setcookie("token",$token);
		}
		
	 	Header("location:/");	
		exit;
	}	
	else
	{
	 	Header("location:/?msg=Ошибка авторизации!");	
		exit;		
	}		
}



if (isset($_GET['exit']))
{
	$uid = f_data ($_COOKIE[uid], 'text', 0);
	$token = f_data ($_COOKIE[token], 'text', 0);
	$result = mysql_query("SELECT * FROM users WHERE uid='$uid' && token='$token'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	if ($num_rows!=0)
	{
		setcookie("uid","");
		setcookie("token","");
		$result_edit = mysql_query("UPDATE users SET token='' WHERE uid='$myrow[uid]'", $db); //присваеваем одноразовый токен
	}	
	
 	Header("location:/");	
	exit;		
}

?>