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
	
		$import = $_POST[import];
		$ext = substr($_FILES['file']['name'], 1 + strrpos($_FILES['file']['name'], ".")); // расширение файла	

			$date = date("d.m.Y");
			
			if ($ext=="csv")
			{
				
				$handle = fopen("upload/files/import.csv", "r");
				$contents = '';
				while (!feof($handle))
				{
					$buffer = nl2br(fgets($handle, 4096));
					$buffer = str_replace('/n','<br>',$buffer);				
				}
				fclose($handle);
				  
				$buffer = str_replace('<br />',';',$buffer);
				$buffer = explode(";",$buffer);
				$count_row = count($buffer);
				
				for ($i=0;$i<=count($buffer);$i=$i+5)
				{
					$artic = $buffer[$i];
					$name_goods = $buffer[$i+1];
					$name_goods_t = "$_SERVER[HTTP_HOST]/page/".transliterate($buffer[$i+1]);	
					

					$price_goods = $buffer[$i+4];
					$price_goods = str_replace(" ", "", $price_goods);
					$price_goods = str_replace("руб.", "", $price_goods);
					$price_goods = str_replace("руб", "", $price_goods);
					$price_goods = str_replace("р", "", $price_goods);
					$price_goods = str_replace("р.", "", $price_goods);
					if (substr_count($price_goods,'.')!=0) 
					{$price_goods = explode(".", $price_goods); $price_goods=$price_goods[0];}
					if (substr_count($price_goods,',')!=0) 
					{$price_goods = explode(",", $price_goods); $price_goods=$price_goods[0];}						
							
					$desc_goods = $buffer[$i+2];
					$desc_goods = strip_tags($desc_goods);
					$desc_goods = htmlspecialchars($desc_goods, ENT_QUOTES);



					if ($_POST[img_goods]!='')
					{
						$ext = substr($buffer[$i+3], 1 + strrpos($buffer[$i+3], ".")); // расширение файла
						if ($ext=='') {$ext='.jpg';}
						$img_name = md5($buffer[$i+3]).".$ext";	
						$content = file_get_contents('http://'.$_POST[img_prefix].$buffer[$i+3]);
						if ($content!=false)
						{					
							wwwcopy('http://'.$_POST[img_prefix].$buffer[$i+3], "../katalog/upload/img/".$img_name);	
							@resizeimg("../katalog/upload/img/".$img_name, "../katalog/upload/img/mimi_".$img_name, 350, 450,$folder,$sfolder);
						}
					}
					else
					{
						$img_name = "";	
					}
											
					$result_add = mysql_query ("INSERT INTO goods (name,m_title,art,price1,text,date,url,enabled,number,m_link,img,curent) VALUES ('$name_goods','$name_goods','$artic','$price_goods','$desc_goods','$date','$import','1','$end_number','$name_goods_t','$img_name','1')");	
				}  				
						
				
			

			
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