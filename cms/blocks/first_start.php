<?
/*
 $fp = fopen("../robots.txt", "r"); // Открываем файл в режиме записи 
 $buff = fread ($fp,100);
 if ($buff=='' && $_SERVER['HTTP_HOST']!='test1.ru' && $_SERVER['HTTP_HOST']!='localhost')
 {
	 fclose($fp); //Закрытие файла	
	 $fp = fopen("../robots.txt", "w"); // Открываем файл в режиме записи 
	 $mytext = "User-agent: *
Sitemap: http://$_SERVER[HTTP_HOST]/sitemap.xml
Host: http://$_SERVER[HTTP_HOST]
Disallow: /cgi/
Disallow: /css/
Disallow: /blocks/
Disallow: /fancybox/
Disallow: /js/
Disallow: /jquery-mobile/
Disallow: /cms/
Disallow: /cmsm/
	 "; 
	 $test = fwrite($fp, $mytext); // Запись в файл
 }
 fclose($fp); //Закрытие файла		
*/
?>