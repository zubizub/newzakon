<title>Сайт временно недоступен</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<div id="page_site_off">
  <p><img src="img/site_off.png" width="115" height="115" align="left" style="margin:10px">

  <div style="width:340px; font-size:18px; font-weight:bold; text-align:center; line-height:25px;">
<p>Сайт временно недоступен. <br>
  &nbsp;В ближайшее время мы  всё исправим.</p>
<br>
<div align="left" style="font-size:18px; font-weight:normal">
Вы можете связаться с нами по контактной информации представленной ниже: <br>
</div>
  </div>
  <br>
    <br>
    <?
	include("blocks/db.php");
	@$res_main = mysql_query("SELECT * FROM contact",$db);
	@$row_main = mysql_fetch_array($res_main);
	echo $row_main['text'];

?>
<br>
	--------------------------------------
    <br>
    техподдержка: admin@eurosites.ru
  </p>
</div>