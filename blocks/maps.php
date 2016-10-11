<?
//карта Яндекс с выводом на нее адреса и офиса
?>

<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU" type="text/javascript"></script>
<script src="/js/multi-geocoder.js" type="text/javascript"></script>
        
<?
 
if ($adress=='') $adress = $SETTINGS[address_admin];
$adress1=urlencode($adress);
$url="http://geocode-maps.yandex.ru/1.x/?geocode=".$adress1;
$content=file_get_contents($url);
preg_match('/<pos>(.*?)<\/pos>/',$content,$point);
$coordinaty = str_replace(' ',', ',trim(strip_tags($point[1])));
$coordinaty = explode(", ",$coordinaty);
$geo_kod = "$coordinaty[1], $coordinaty[0]";

 ?>  

<script type="text/javascript">
ymaps.ready(init);

function init () {
		
	var myMap = new ymaps.Map('map', {
			center: [ <? echo $geo_kod; ?> ],
			zoom: 14,
			behaviors: ['default', 'scrollZoom']
		});
		
		<?
		if ($SETTINGS['address_admin_office']!='')
		{
			$address_admin_office = ", офис $SETTINGS[address_admin_office]";
		}
		?>
		
		myMap.balloon.open(
			// Позиция балуна
			[<? echo $geo_kod; ?>], {
			contentBody: '<? echo  $SETTINGS[company_name].", $SETTINGS[address_admin] $address_admin_office"; ?>'
		}, {
		   // Опции балуна. В данном примере указываем, что балун не должен иметь кнопку закрытия.
			closeButton: false
		 });
}
</script>

     
        
              
<div id="map" style="width: 100%; height:320px; border: 1px solid #999;"></div>
<div id="coord_list"></div>

