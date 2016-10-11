<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<meta name="robots" content="noindex,nofollow">
<title>Печать</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<?
include("blocks/db.php");

	$result_podcat = mysql_query("SELECT * FROM produkc_tovar WHERE id='$_GET[id]'");
	$myrow_podcat = mysql_fetch_array($result_podcat);  
	

	
	if (mysql_num_rows($result_podcat)>0)
	{
		do
		{
			$description_small = nl2br($myrow_podcat['description_small']);
			$description = nl2br($myrow_podcat['description']);
			if ($myrow_podcat['presence'] == 0) {$presence = "<span style='color:red'>[ нет в наличии ]</span>";}
			
			
			$url = "cms/img/tovar_produkc/$myrow_podcat[img]";
			$url2 = "cms/img/tovar_produkc/mini/mini_$myrow_podcat[img]";
			if (@fopen($url, "r")) {$img1 = "cms/img/tovar_produkc/$myrow_podcat[img]";} 
			else {$img1 = "cms/img/tovar_produkc/no_img.png";}
			if (@fopen($url2, "r")) {$img2 = "cms/img/tovar_produkc/mini/mini_$myrow_podcat[img]";} 
			else {$img2 = "cms/img/tovar_produkc/no_img.png";}
			
			$text = nl2br($myrow_podcat['description']);

			$result_podcat_img = mysql_query("SELECT * FROM katalog_tovar_img WHERE id_tovar='$_GET[id]'");
			$myrow_podcat_img = mysql_fetch_array($result_podcat_img);  
			
			if ($myrow_podcat_img['img1'] != '') 
			{$dopimg1 = "<a href='cms/img/tovar_produkc/many_img/$_GET[id]/$myrow_podcat_img[img1]' class='gallery_fancybox'>
			<img src='cms/img/tovar_produkc/many_img/$_GET[id]/mini/$myrow_podcat_img[img1]' width='64' style='max-height:60px'>
			</a>";}
			if ($myrow_podcat_img['img2'] != '') 
			{$dopimg2 = "<a href='cms/img/tovar_produkc/many_img/$_GET[id]/$myrow_podcat_img[img2]' class='gallery_fancybox'>
			<img src='cms/img/tovar_produkc/many_img/$_GET[id]/mini/$myrow_podcat_img[img2]' width='64' style='max-height:60px'>
			</a>";}
			if ($myrow_podcat_img['img3'] != '') 
			{$dopimg3 = "<a href='cms/img/tovar_produkc/many_img/$_GET[id]/$myrow_podcat_img[img3]' class='gallery_fancybox'>
			<img src='cms/img/tovar_produkc/many_img/$_GET[id]/mini/$myrow_podcat_img[img3]' width='64' style='max-height:60px'>
			</a>";}
					
			$tags_tovar = str_replace(',',', ',	$myrow_podcat['keywords']);
			$tags_tovar = explode(", ", $tags_tovar);
			
			foreach ($tags_tovar as $key=>$element)
			{
				$tags.= "<a href='?page=search_tovar&search=$element' style='color:#333'>".trim($element)."</a>, ";
			}
				
			$tags = substr($tags,0,strlen($tags)-2);
					
			echo "
			<div style='border:1px dashed #CCC; padding:10px; color:#000; min-height:650px'>
				<div style='border:1px solid #d2d2d2; background-color:#f2f1f1; padding:7px; font-size:20px'>
					<b>$myrow_podcat[name]</b> $presence
				</div><br>
			
				<table width='100%' border='0'>
				  <tr>
					<td style='vertical-align:top; padding:10px; padding-top:0px'>
						<a href='".$img1."' class='gallery_fancybox'>
							<img src='$img2' width='200' style='border:2px solid #999'>
						</a><br><br>
						$dopimg1 	$dopimg2   $dopimg3				
					</td> 
					<td style='vertical-align:top; padding:10px; padding-top:0px; line-height:22px; font-size:16px; color:#333'>
						<div style='margin-top:10px; height:118px;'>
							$description_small		
						</div>
						
						<div class='keys_for_tovar'>
							$tags
						</div>
					</td>
				  </tr>
				</table>
				
				<br>
				<div style='text-align:justify'>
				$description
				</div>
				<br><br>
				<div style='position:relative; height:50px;'>
					<div class='cena_tovar'><b>$myrow_podcat[price]<b> руб.</div>	
				</div>	
			</div>
			<br>";
		}while($myrow_podcat = mysql_fetch_array($result_podcat));
	}

?>
</body>
</html>