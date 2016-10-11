<link rel="stylesheet" type="text/css" href="modul/desktop/css.css">
<script type="text/javascript" src="modul/desktop/js.js"></script>



<?

//заказы
$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("01.Y")."%'");
$num_z1 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("02.Y")."%'");
$num_z2 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("03.Y")."%'");
$num_z3 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("04.Y")."%'");
$num_z4 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("05.Y")."%'");
$num_z5 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("06.Y")."%'");
$num_z6 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("07.Y")."%'");
$num_z7 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("08.Y")."%'");
$num_z8 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("09.Y")."%'");
$num_z9 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("10.Y")."%'");
$num_z10 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("11.Y")."%'");
$num_z11 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%".date("12.Y")."%'");
$num_z12 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("01.Y")."%'");
$num_p1 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("02.Y")."%'");
$num_p2 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("03.Y")."%'");
$num_p3 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("04.Y")."%'");
$num_p4 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("05.Y")."%'");
$num_p5 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("06.Y")."%'");
$num_p6 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("07.Y")."%'");
$num_p7 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("08.Y")."%'");
$num_p8 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("09.Y")."%'");
$num_p9 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("10.Y")."%'");
$num_p10 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("11.Y")."%'");
$num_p11 = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM stat_vizit WHERE date LIKE '%".date("12.Y")."%'");
$num_p12 = mysql_num_rows($result);
?>

 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Месяц', 'Заказы', 'Посещения'],
          ['Янв',  <? echo $num_z1; ?>, <? echo $num_p1; ?>],
          ['Фев',  <? echo $num_z2; ?>, <? echo $num_p2; ?>],
          ['Март',  <? echo $num_z3; ?>, <? echo $num_p3; ?>],
          ['Апр',  <? echo $num_z4; ?>, <? echo $num_p4; ?>],
		  ['Май',  <? echo $num_z5; ?>,  <? echo $num_p5; ?>],
		  ['Июнь',  <? echo $num_z6; ?>,  <? echo $num_p6; ?>],
		  ['Июль',  <? echo $num_z7; ?>,  <? echo $num_p7; ?>],
		  ['Авг',  <? echo $num_z8; ?>,  <? echo $num_p8; ?>],
		  ['Сент',  <? echo $num_z9; ?>,  <? echo $num_p9; ?>],
		  ['Окт',  <? echo $num_z10; ?>,  <? echo $num_p10; ?>],
		  ['Ноя',  <? echo $num_z11; ?>,  <? echo $num_p11; ?>],
		  ['Дек',  <? echo $num_z12; ?>,  <? echo $num_p12; ?>]
        ]);

        var options = {
		title: 'График заказов (конверсия) за <? echo date("Y"); ?> год',
			curveType: 'function',
			legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
		chart.setColumns([{calc: function(data, row) { return data.getFormattedValue(row, 0); }, type:'string'}, 1]);			
      }




    </script>
    
    
    
 <div style="width:900px; height: 380px; margin-left:-0px; overflow:hidden">   
 <div id="chart_div" class="chart_div" style="width:1000px; height: 380px; margin-left:-90px"></div>   
 </div>   
 
 
 <br><Br>
 
 <?
 
 	$result = mysql_query("SELECT * FROM zakaz");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$date = date("d.m.Y");
	
	$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%$date%'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_now = mysql_num_rows($result);
	if ($num_rows_now!=0) {$num_rows_now="<a href='?page=goods_zakaz' style='color:red'>$num_rows_now</a>";}
	
	$result = mysql_query("SELECT * FROM zakaz WHERE status='на обработке'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab11 = mysql_num_rows($result);

	$result = mysql_query("SELECT * FROM zakaz WHERE status='отгружен'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab12 = mysql_num_rows($result);
	
	$result = mysql_query("SELECT * FROM zakaz WHERE status='отправлен'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab13 = mysql_num_rows($result);
	
	$result = mysql_query("SELECT * FROM zakaz WHERE status='исполнен'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab14 = mysql_num_rows($result);
	
	
	$result = mysql_query("SELECT * FROM zakaz ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);	
				
	$text =  "
	<span>От <b>$myrow[fio]</b> (<i>$myrow[status]</i>)</span><br>
	<span>Телефон <b>$myrow[phone]</b> | $myrow[mail]</span><br>
	<span>Стоимоть <b>$myrow[price]</b> рублей</span><br>
	<span>Дата <b>$myrow[date]</b></span><br>
	<a href='?page=goods_zakaz' style='color:#6eafe5'>смотреть все</a>
	";	
	
	echo "
		<table width='750' border='0' class='tbl_desktop'>
		  <tr>
			<th>За сегодня</th>
			<th>На обработке</th>
			<th>Отгруженых</th>
			<th>Отправленых</th>
			<th>Исполненых</th>
			<th>Всего</th>
			<th style=''>Последний</th>
		  </tr>		  
		  <tr>
			<td>$num_rows_now</td>
			<td>$num_rows_enab11</td>
			<td>$num_rows_enab12</td>
			<td>$num_rows_enab13</td>
			<td>$num_rows_enab14</td>
			<td>$num_rows</td>
			<td style='font-size:11px; line-height:14px; text-align:left'>$text</td>
		  </tr>
		</table>	
	";
	
 
 ?>