<?
 $fp = fopen("../../../.htaccess", "w"); // Открываем файл в режиме записи 
 $buff = fread ($fp,1000);
	 $mytext = "#Deny from all
RewriteEngine On

Options +FollowSymLinks 
Options All -Indexes
ErrorDocument 404 /error404.php

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^([^/\.]+)/$ /$1 [L]
RewriteRule ^([^/\.]+)$ /index.php?page=$1 [L]

RewriteCond %{THE_REQUEST} ^[A-Z]{3,9}\ /index\.html\ HTTP/
RewriteRule ^index\.html$ http://$_SERVER[HTTP_HOST] [R=301,L]
RewriteCond %{THE_REQUEST} ^[A-Z]{3,9}\ /index\.php\ HTTP/
RewriteRule ^index\.php$ http://$_SERVER[HTTP_HOST] [R=301,L]

RewriteCond %{HTTP_HOST} ^www.$_SERVER[HTTP_HOST]
RewriteRule (.*) http://$_SERVER[HTTP_HOST]/$1 [R=301,L]

RewriteRule ^([^/\.]+)/$ /index.php?page=$1 [QSA]
RewriteRule ^galery/([^/\.]+)/$ /index.php?page=galery&id=$1 [QSA]
RewriteRule ^galery/([^/\.]+)/([^/\.]+)/$ /index.php?page=galery&id=$1&pages=$2 [QSA]
RewriteRule ^news_inf/([^/\.]+)/([^/\.]+)/$ /index.php?page=news_inf&id=$1&name=$2 [QSA]
RewriteRule ^article/([^/\.]+)/$ /index.php?page=article&url=$1 [L]
RewriteRule ^pages/([^/\.]+)/([^/\.]+)/$ /index.php?page=pages&id=$1&name=$2 [L]
RewriteRule ^pages/([^/\.]+)/$ /index.php?page=pages&id=$1 [L]
RewriteRule ^vopros_otvet/([^/\.]+)/$ /index.php?page=vopros_otvet&pages=$2 [QSA]
RewriteRule ^katalog/([^/\.]+)/$ /index.php?page=katalog&url=$1 [QSA]
RewriteRule ^katalog/([^/\.]+)/([^/\.]+)/$ /index.php?page=katalog&url=$1&sort=$2 [QSA]
RewriteRule ^goods/([^/\.]+)/([^/\.]+)/$ /index.php?page=goods&id=$1&name=$2 [QSA]
RewriteRule ^firm/([^/\.]+)/$ /index.php?page=firm&id=$1 [QSA]
RewriteRule ^cabinet/([^/\.]+)/$ /index.php?page=cabinet&method=$1 [QSA]
RewriteRule ^buy/([^/\.]+)/$ /index.php?page=buy&id=$1 [QSA]

<IfModule mod_gzip.c>
mod_gzip_on Yes
mod_gzip_dechunk Yes
mod_gzip_item_include file \.(html?|txt|css|js|php|pl)$
mod_gzip_item_include handler ^cgi-script$
mod_gzip_item_include mime ^text\.*
mod_gzip_item_include mime ^application/x-javascript.*
mod_gzip_item_exclude mime ^image\.*
mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
</IfModule>"; 
	 $test = fwrite($fp, $mytext); // Запись в файл

 fclose($fp); //Закрытие файла

?>