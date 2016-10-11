<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>Печать</title>
<link href="/css/reset.less" type="text/css" rel="stylesheet/less">
<link href="/css/style.less" type="text/css" rel="stylesheet/less">

<script type="text/javascript" src="/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/js/less-1.3.3.min.js"></script>
<script type="text/javascript" src="/js/script.js"></script>
</head>

<body>
<div style="width:880px; margin:auto">
<?

@include("blocks/db.php");


$result1 = mysql_query("SELECT * FROM settings");
$SETTINGS = mysql_fetch_assoc($result1); 
$adress = $SETTINGS[address_admin];

echo "<br><br><div style='text-align:center; font-size:28px;'><b>$SETTINGS[company_name]</b></div><br><br>";
//запрос к базе
$result = mysql_query("SELECT * FROM pages WHERE id=3");
$myrow = mysql_fetch_assoc($result); 

echo $myrow[text];

echo "<br><div style='text-align:center; font-size:22px;'><b> Наш сайт: www.$_SERVER[HTTP_HOST]</b></div><br>";
?>

<br><br>

<?  include("blocks/maps.php"); ?>


<? echo "<br><div style='text-align:center; font-size:12px;'>P.S. Клиент – не помеха в работе, а смысл нашего существования, не мы делаем ему одолжение, а он оказывает нам любезность, предоставляя такую возможность!</div><br>"; ?>
</div>


</body>
</html>