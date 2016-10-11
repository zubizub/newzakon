<?

include("../../blocks/db.php");

$result_add = mysql_query ("INSERT INTO news_es (id_news) VALUES ('$_POST[id_news]')");	

?>