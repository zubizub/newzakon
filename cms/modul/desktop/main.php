<link rel="stylesheet" type="text/css" href="modul/desktop/css.css">
<script type="text/javascript" src="modul/desktop/js.js"></script>


<table width="100%" border="0" style="max-width:750px">
              <tr>
                <td>
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
    
<?
	if ($SETTINGS[desc_7]==1) {
		
	$date = new DateTime();
	$date->modify('-1 day');
	$old_date = $date->format('d.m.Y');

	$result = mysql_query("SELECT * FROM stat_vizit WHERE date='".date("d.m.Y")."'");
	$result_old = mysql_query("SELECT * FROM stat_vizit WHERE date='".$old_date."'");
	
	$num = mysql_num_rows($result);
	$num2 = mysql_num_rows($result_old);
	@$procent = floor(100-($num2*100)/$num);
	if ($procent<0) {$procent=substr($procent,1);}
	if ($num<$num2) {$procent = "<span style='color:#eb0c26'>-$procent%</span>";} else {$procent = "<span style='color:#55d82c'>+$procent%</span>";}

} 


if ($SETTINGS[desc_8]==1) {
?>

<div style="width:450px; height: 100px; position:relative; display:inline-block; overflow:hidden">
<a href="?page=stat_zakaz" id="chart_div" class="chart_div" style="display:block; width:450px; height: 100px;  position:absolute; top:-4px; left:0px"></a>
</div>

<? } ?>
	</td>
  </tr>
</table><br>


<div class="inf_enbl_block">Обновите страницу чтобы увидеть изменения!</div>

<? if ($SETTINGS[desc_1]==1) { ?><div class="zakaz_div" style="display:inline-block;  max-width:700px;"></div><? } ?><br>
<div style="border-bottom:1px dotted #CCC; margin-top:15px; margin-bottom:15px;"></div>

<table width='100%' border='0' class='tbl_desktop' style="max-width:700px">
  <tr>
    <th>Модуль</th>
    <th>Сегодня</th>
    <th>Неактивных</th>
    <th>Всего</th>
    <th style='width:300px'>Последний</th>
  </tr>
  <? if ($SETTINGS[desc_2]==1) { ?><tr class="zayvki_div"></tr> <? } ?>
  <? if ($SETTINGS[desc_3]==1) { ?> <tr class="obr_svyz_div"></tr>  <? } ?>
  <? if ($SETTINGS[desc_4]==1) { ?> <tr class="comment_div"></tr> <? } ?>
  <? if ($SETTINGS[desc_5]==1) { ?><tr class="vopros_otvet_div"></tr>  <? } ?>
  <? if ($SETTINGS[desc_6]==1) { ?><tr class="otziv_div"></tr>     <? } ?> 
</table>
