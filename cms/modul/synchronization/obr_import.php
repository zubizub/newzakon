<?
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");


$result_cur = mysql_query("SELECT * FROM curent ORDER BY id ASC LIMIT 1");
$myrow_cur = mysql_fetch_assoc($result_cur);
$curent = $myrow_cur[id];							

	if ($_FILES["file"] ["name"] != "")
	{ 
		set_logs("Каталог","Импорт товаров из файла");
		$result4 = mysql_query("SELECT * FROM goods WHERE url='$_POST[import]' ORDER BY number DESC LIMIT 1");
		$myrow4 = mysql_fetch_assoc($result4); 
		$end_number = $myrow4[number];
		
		@unlink("upload/files/import.csv");
		copy($_FILES["file"]["tmp_name"], "upload/files/import.csv");
		
		$handle = fopen("upload/files/import.csv", "r");
		  $contents = '';
			while (!feof($handle))
			$contents .= fread($handle, 4096);
		  fclose($handle);
		
		
		$contents = str_replace(",", " 12001200 ", $contents);
		$contents = str_replace("'", "", $contents);
		

		  $handle = fopen("upload/files/import.csv", "w");
		  fwrite($handle, $contents);
		  fclose($handle);
		
		$handle = fopen("upload/files/import.csv", "r");
		  $contents1 = '';
			while (!feof($handle))
			$contents1 .= fread($handle, 4096);
		  fclose($handle);		
				
		
		$import = $_POST[import];
		$ext = substr($_FILES['file']['name'], 1 + strrpos($_FILES['file']['name'], ".")); // расширение файла	

			$date = date("d.m.Y");
			
			if ($ext=="csv")
			{
				$row = 1;
				$handle = fopen("upload/files/import.csv", "r");
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data);
					$row++;
					for ($c=0; $c < $num; $c++) {
						$data = explode(";", $data[$c]);
						$artic = $data[$_POST[artic]];
						$name_goods = $data[$_POST[name_goods]];
						$name_goods_t = "$_SERVER[HTTP_HOST]/page/".transliterate($name_goods);	
						if ($_POST[price_goods]!='') 
						{
							$price_goods = $data[$_POST[price_goods]];
							$price_goods = str_replace(" ", "", $price_goods);
							$price_goods = str_replace("руб.", "", $price_goods);
							$price_goods = str_replace("руб", "", $price_goods);
							$price_goods = str_replace("р", "", $price_goods);
							$price_goods = str_replace("р.", "", $price_goods);
							if (substr_count($price_goods,'.')!=0) 
							{$price_goods = explode(".", $price_goods); $price_goods=$price_goods[0];}
							
							if (substr_count($price_goods,',')!=0) 
							{$price_goods = explode(",", $price_goods); $price_goods=$price_goods[0];}
														
						} else {$price_goods = '0';}
						
						if ($_POST[desc_goods]!='')
						{
							$desc_goods = $data[$_POST[desc_goods]];
							$desc_goods = str_replace(" 12001200 ", ",", $desc_goods);
							//$desc_goods = strip_tags($desc_goods);
						} else {$desc_goods = '';}
						
						
						
						if ($_POST[img_goods]!='' && $data[$_POST[img_goods]] && substr_count($data[$_POST[img_goods]], ".")!=0)
						{
							$ext = substr($data[$_POST[img_goods]], 1 + strrpos($data[$_POST[img_goods]], ".")); // расширение файла
							if ($ext=='') {$ext='.jpg';}
							$img_name = md5($data[$_POST[img_goods]]).".$ext";			
							$img_prefix = $_POST[img_prefix];
							
							$img_main = $data[$_POST[img_goods]];
							if ($img_main[0]!='/') {$img_main = "/".$img_main;} 		
							wwwcopy('http://'.$img_prefix.$img_main, "../katalog/upload/img/".$img_name);	
							resizeimg("../katalog/upload/img/".$img_name, "../katalog/upload/img/mimi_".$img_name, 350, 450,$folder,$sfolder);					
						}
						else
						{
							$img_name = "";	
						}
						
						
						if ($name_goods!="" && $price_goods!='' && $row!=2)
						{
							$end_number++;				
							$result_add = mysql_query ("INSERT INTO goods (name,m_title,art,price1,text,date,url,enabled,number,m_link,img,curent) VALUES ('$name_goods','$name_goods','$artic','$price_goods','$desc_goods','$date','$import','1','$end_number','$name_goods_t','$img_name','1')");	
						}
					}
					
				}
				fclose($handle);

			
			Header("location:../../?page=goods_export&msg=Операция прошла успешно!&nom=$end_number");	
			exit;			
		}
		else
		{
			Header("location:../../?page=goods_export&msg=Неверный формат файла!");	
			exit;			
		}		
		
	}
	
	
	
	function wwwcopy($file,$nfile)   {
		@$content = file_get_contents($file);
		@file_put_contents($nfile,$content);
	}  

	
	
function transliterate($st) {

  $st = strtr($st, 

    "абвгдежзийклмнопрстуфыэАБВГДЕЖЗИЙКЛМНОПРСТУФЫЭ",

    "abvgdegziyklmnoprstufieABVGDEGZIYKLMNOPRSTUFIE"

  );

  $st = strtr($st, array(

    'ё'=>"yo",    'х'=>"h",  'ц'=>"ts",  'ч'=>"ch", 'ш'=>"sh",  

    'щ'=>"shch",  'ъ'=>'',   'ь'=>'',    'ю'=>"yu", 'я'=>"ya",

    'Ё'=>"Yo",    'Х'=>"H",  'Ц'=>"Ts",  'Ч'=>"Ch", 'Ш'=>"Sh",

    'Щ'=>"Shch",  'Ъ'=>'',   'Ь'=>'',    'Ю'=>"Yu", 'Я'=>"Ya", ' '=>"-", 'Я'=>"-", '/'=>"-",  '['=>"", ']'=>"", '.'=>"-", ','=>"-", '?'=>"", '<'=>"", '>'=>"",

  ));

  return $st;

}


?>