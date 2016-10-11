<?

if (isset($_GET['exit']))
{

	setcookie("uid","");
 	Header("location:/cms/admin.php");	
	exit;		
}


if (isset($_GET[lang]))
{
	setcookie("lang",$_GET[lang]);
	$url_lang = str_replace("--", "=", $_GET[url]);
	if ($url_lang!="") {$url="/cms/?$url_lang";}
	Header("location:$url");
}


if (isset($_GET[katalog_view]))
{
	setcookie("katalog_view",$_GET[katalog_view]);
	
	if (!isset($_GET[cat]))
	{
		Header("location:/cms/?page=katalog");
	}
	else if (isset($_GET[cat]) && !isset($_GET[podcat]))
	{
		Header("location:/cms/?page=katalog&cat=$_GET[cat]");	
	}
	else if(isset($_GET[cat]) && isset($_GET[podcat]))
	{
		Header("location:/cms/?page=katalog&cat=$_GET[cat]&podcat=$_GET[podcat]");
	}
	
	exit;	
}


?>