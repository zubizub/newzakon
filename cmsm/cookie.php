<?

if (isset($_GET[uid]))
{
	$uid = explode("-", $_GET[uid]);
	if ($uid[1]==1)
	{
		setcookie("uid",$uid[0],time()+36000000);
	}
	else
	{
		setcookie("uid",$uid[0]);
	}
	
 	Header("location:/cmsm/");	
	exit;		
}

if (isset($_GET['exit']))
{
	setcookie("uid","");
 	Header("location:/cmsm/admin.php");	
	exit;		
}

?>