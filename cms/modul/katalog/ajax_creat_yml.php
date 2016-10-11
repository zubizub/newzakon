<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
set_logs("Каталог","Создание Яндекс XML");


function transliterate($st) {
  $st = str_replace(" ","-",$st);
  $st = strtr($st, 
    "абвгдежзийклмнопрстуфыэАБВГДЕЖЗИЙКЛМНОПРСТУФЫЭ",
    "abvgdegziyklmnoprstufieABVGDEGZIYKLMNOPRSTUFIE"
  );
  $st = strtr($st, array(
    'ё'=>"yo",    'х'=>"h",  'ц'=>"ts",  'ч'=>"ch", 'ш'=>"sh",  
    'щ'=>"shch",  'ъ'=>'',   'ь'=>'',    'ю'=>"yu", 'я'=>"ya",
    'Ё'=>"Yo",    'Х'=>"H",  'Ц'=>"Ts",  'Ч'=>"Ch", 'Ш'=>"Sh",
    'Щ'=>"Shch",  'Ъ'=>'',   'Ь'=>'',    'Ю'=>"Yu", 'Я'=>"Ya",
  ));
  return $st;
}

$yml =  "<?xml version='1.0' encoding='windows-1251'?>
<!DOCTYPE yml_catalog SYSTEM 'shops.dtd'>
<yml_catalog date='".date("Y-m-d H:i")."'>
<shop>
        <name>Текстиль Маркет 161</name>
        <company>Текстиль Маркет 161</company>
        <url>http://$_SERVER[HTTP_HOST]/</url>
        <currencies>
            <currency id='RUR' rate='1' plus='0'/>
        </currencies>
		
<categories>
"; 



	$result = mysql_query("SELECT * FROM katalog WHERE url=''");
	$myrow = mysql_fetch_assoc($result); 
	
	if (mysql_num_rows($result)!=0)
	{
		do
		{
			$yml .= " <category id='$myrow[id]'>$myrow[name]</category>\n";
			
			$result1 = mysql_query("SELECT * FROM katalog WHERE url='$myrow[id]'");
			$myrow1 = mysql_fetch_assoc($result1); 
			if (mysql_num_rows($result1)!=0)
			{
				do
				{ 
					$yml .= "   <category id='$myrow1[id]' parentId='$myrow[id]'>$myrow1[name]</category>\n";
				}while($myrow1 = mysql_fetch_assoc($result1));
			}
		}while($myrow = mysql_fetch_assoc($result));
	}
			

$yml .= "</categories>

<local_delivery_cost>300</local_delivery_cost>
<offers>";

$result_s = mysql_query("SELECT * FROM settings");
$myrow_s = mysql_fetch_assoc($result_s); 
$local_delivery_cost = $myrow_s[price_dostavka];
$local_delivery_cost = str_replace(" от","",$local_delivery_cost);
 
	$result_goods = mysql_query("SELECT * FROM goods");
	$myrow_goods = mysql_fetch_assoc($result_goods); 

	if (mysql_num_rows($result_goods)!=0)
	{
		do
		{
			$result_goods_proverka = mysql_query("SELECT * FROM goods WHERE name='$myrow_goods[name]'");
			$num_rows_proverka = mysql_num_rows($result_goods_proverka);
			
			if ($num_rows_proverka==1)
			{
			
			$m_link = explode("/",$myrow_goods[m_link]);
			$m_link = $m_link[(count($m_link)-1)];		
			
			if ($myrow_goods[img]!='') {$img="http://$_SERVER[HTTP_HOST]/cms/modul/katalog/upload/img/$myrow_goods[img]";}
			
			if (substr_count($myrow_goods[url],"/")==0) 
			{
				$cat=$myrow_goods[url];
			} 
			else 
			{
				if (substr_count($myrow_goods[url],"/")==2)
				{
					$cat_exp = explode("/", $myrow_goods[url]); 
					$cat=$cat_exp[1];
				}
				else
				{
					$cat_exp = explode("/", $myrow_goods[url]); 
					$cat=$cat_exp[1];
				}
				
			}
			
			
			//проверка наличия категории в каталоге			
			$result_kat = mysql_query("SELECT * FROM katalog WHERE id='$cat'");
			$num_rows_kat = mysql_num_rows($result_kat);			


			//проверка наличия категории в каталоге			
			$result_kat = mysql_query("SELECT * FROM katalog WHERE id='$cat_exp[0]'");
			$myrow_kat = mysql_fetch_assoc($result_kat); 
			$num_rows_kat2 = mysql_num_rows($result_kat);			
			
			
			if ($myrow_goods[firm]!='' && $myrow_goods[firm]!=0)
			{
				$result_f = mysql_query("SELECT * FROM firms WHERE id='$myrow_goods[firm]'");
				$myrow_f = mysql_fetch_assoc($result_f); 
				$firm = $myrow_f[name];
				$firm = "
				<vendor>$firm</vendor>";
			}
			else
			{
				$firm = '
				<vendor>Текстиль маркет</vendor>';	
			}
			
				
			
			if ($myrow_goods[art]!='')
			{
				$art = "
				<vendorCode>$myrow_goods[art]</vendorCode>";	
			}
			else
			{
				$art="";
			}

			if ($m_link=='')
			{
				$m_link = transliterate($myrow_goods[name]); 
			}		
			
			$name = $myrow_goods[name];
			$name = f_data ($name, 'text', 0);
			if ($name=='')
			{
				
			}
	
			$m_link = str_replace('"', '', $m_link);
			$m_link = str_replace('&quot;', '', $m_link);

		if ($myrow_goods[price1]>0 && $num_rows_kat!=0 && $num_rows_kat2!=0 && substr_count($m_link,"№")==0)		
		{

	
			if ($myrow_goods[presence]==1) {$available = "false";} else {$available = "true";}
	

	$result_config = mysql_query("SELECT * FROM settings");
	$SETTINGS = mysql_fetch_assoc($result_config); 
	
		
	if ($name!='' && $myrow_goods[price1]!=0 && $myrow_goods[price1]!='')
	{
	
	$text = strip_tags($myrow_goods[text]);
	$text = explode(".",$text);
	$text = trim($text[0]);
	$text = str_replace("&nbsp;","",$text);
	$text = f_data ($text, 'text', 0);

	if ($myrow_goods[price1]<$SETTINGS[price_dostavka_null])
	{
		$price_dostavka = $SETTINGS[price_dostavka];
	}
	else
	{
		$price_dostavka=0;
	}
	
	
$yml .= "
	<offer id='$myrow_goods[id]' type='vendor.model' available='$available'>
		<url>http://$_SERVER[HTTP_HOST]/goods/$myrow_goods[id]/$m_link/</url>
		<price>$myrow_goods[price1]</price>
		<currencyId>RUR</currencyId>
		<categoryId>$cat</categoryId>
		<picture>$img</picture>
		<delivery>true</delivery>	
		<local_delivery_cost>$price_dostavka</local_delivery_cost>
		<typePrefix>$myrow_kat[name]</typePrefix>$firm $art
		<model>$name</model>			
		<description>$text</description>
		<manufacturer_warranty>true</manufacturer_warranty>
	</offer>	
";			

		
	}
}	
	
			}
		}while($myrow_goods = mysql_fetch_assoc($result_goods));
	}			

$yml .= "	</offers>
</shop>
</yml_catalog>";

$fp = fopen("../../../goods.yml", "w");
fputs($fp, $yml);
fclose($fp);
?>