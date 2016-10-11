<?
include("../../blocks/db.php");

//для режима отладки на localhost
$local = 0;
if ($local!=1 && $_SERVER["REMOTE_ADDR"]!='127.0.0.1') {$enkod_to = "utf-8";} else {$enkod_to = "windows-1251";}

$dir = "../../..$_POST[dir]";
$dh  = opendir($dir);

while (false !== ($filename = readdir($dh))) {
   if ($filename!='.' && $filename!='..' && $filename!=""  && substr_count($filename, ".")!=0) {  
   		$mytext='';
		 $fp = fopen("../../..$_POST[dir]/$filename", "r"); // Открываем файл в режиме чтения
		 if ($fp) 
		 {
			 while (!feof($fp))
			 {
			 	$mytext .= fgets($fp, 999);
			 }
		 }
		 fclose($fp);	
		 
		//запрос к базе
		$result = mysql_query("SELECT * FROM signature");
		$myrow = mysql_fetch_assoc($result); 
		$vir = "";
		
		if (substr_count($filename, "jquery")!=0) {$mytext = substr($mytext,0,350).substr($mytext,strlen($mytext)-350,350);}

		$dir_new = @opendir($cur_dir);
		if (substr($filename,-3)!="css")
		{
			do
			{
				if (substr_count($mytext, $myrow[code])!=0) {
					$next_file=0;	
					if ($filename=="db.php" && $myrow[id]==7) {$next_file=1;}
					if ($filename=="include.php" && $myrow[id]==5) {$next_file=1;}
					if ($filename=="image.php" && $myrow[id]==5) {$next_file=1;}
					if ($filename=="mailto.php" && $myrow[id]==2) {$next_file=1;}
					if ($filename=="maps.php" && $myrow[id]==7) {$next_file=1;}
					if ($next_file==0) {$vir .= "C".$myrow[id].", ";}
				}
			}while($myrow = mysql_fetch_assoc($result));	
		}
		
		$vir = substr($vir,0,-2);
		
		if ($vir!='') 
		{echo iconv("windows-1251", "$enkod_to", "<span style='color:red'> $_POST[dir]/$filename - файл заражен (Вирус $vir)</span><br>");} else 
		{echo iconv("windows-1251", "$enkod_to", "<span style='color:green'> $_POST[dir]/$filename - файл чист</span><br>");}    
	}
}

echo "<div style='border-top:1px dotted #494949; margi-top:4px; margin-bottom:3px; width:400px'></div>";
?>