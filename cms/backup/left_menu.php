<? 

$p = $_GET[page];

if ($p=="materials" || $p=="add_folder_materials" || $p=="news" || $p=="galery" || $p == "add_pages" || $p=="fmanager" || $p=="formmanager" || $p=="add_news" || $p=="add_galery_cat" || $p=="galery_img" || $p=="zadaniy" || $p=="zadaniy_inf") 
{$d = "display:block;"; $d_left_ico1 = " left_menu_a_hover";} else {$d = "display:none;";} 

if ($p=="katalog" || $p=='harakter_all' || $p=="add_cat_harakteristika" || $p=="goods_stamp" || $p=="goods_harakteristiki" || $p=="goods_firms" || $p=="kupon" || $p=="goods_export" || $p=="goods_export" || $p=="goods_price" || $p=="goods_newprice" || $p=="yml" || $p=="goods_zakaz" || $p=="inf_zakaz" || $p=="add_folder_katalog" || $p=="add_goods" || $p=="add_kupon") 
{$d2 = "display:block;"; $d_left_ico2 = " left_menu_a_hover";} else {$d2 = "display:none;";}
 
if ($p=="moduls" || $p=='user_inf' || $p=="license" || $p=="add_users" || $p=="admin_contacts" || $p=="dostup" || $p=="vnedrenie" || $p=="antivir" || $p=="config_magazin" || $p=="config_magazin" || $p=="main_adm" && $_COOKIE[close_left_menu]==1) 
{$d3 = "display:block;"; $d_left_ico3 = " left_menu_a_hover";} else {$d3 = "display:none;";} 

if ($p=="zayvki" || $p=="obr_svyz_inf" || $p=='zayvka_inf' || $p=="obr_svyz" || $p=="users" || $p=="comment" || $p=="vopros_otvet" || $p=="otziv" || $p=="rassilka" && $_COOKIE[close_left_menu]==1) 
{$d4 = "display:block;"; $d_left_ico4 = " left_menu_a_hover";} else {$d4 = "display:none;";}

if ($p=="stat_zakaz" || $p=="statistika_cms") 
{$d5 = "display:block;"; $d_left_ico5 = " left_menu_a_hover";} else {$d5 = "display:none;";} 


?>


<?

//смотрим включенные модули
$result_modul = mysql_query("SELECT * FROM moduls ORDER BY id ASC");
$MODULS = mysql_fetch_assoc($result_modul); 
$i=0;

do
{
	$MODULS[$myrow_modul[id]] = $myrow_modul[enabled];
	$i++;
}while($myrow_modul = mysql_fetch_assoc($result_modul));

?>

<div style="width:110px; position:relative; float:left" id="left_menu">
    <a href="#" class="left_menu_a left_menu_a1 <? if (!isset($_GET[page]) || $_GET[page]=='search_site') {echo " left_menu_a_hover";} ?>"><img src="img/left_ico/desctop.png" ><br>Рабочий стол</a>
    <a href="#" class="left_menu_a left_menu_a2 <? echo $d_left_ico1; ?>"><img src="img/left_ico/content.png"><br>Контент</a>
    <? if ($MODULS[17]==1) { ?><a href="#" class="left_menu_a left_menu_a3 <? echo $d_left_ico2; ?>"><img src="img/left_ico/katalog.png"><br>Каталог</a><? } ?>
    
	<? if ($MODULS[6]==1 || $MODULS[7]==1 || $MODULS[3]==1 || $MODULS[11]==1 || $MODULS[10]==1 || $MODULS[9]==1) { ?>
    <a href="#" class="left_menu_a left_menu_a5 <? echo $d_left_ico4; ?>"><img src="img/left_ico/insite.png"><br>Инсайт</a>
    <? } ?>
    
    <a href="#" class="left_menu_a left_menu_a6 <? echo $d_left_ico5; ?>"><img src="img/left_ico/statistic.png"><br>Статистика</a>
    <a href="#" class="left_menu_a left_menu_a4 <? echo $d_left_ico3; ?>"><img src="img/left_ico/settings.png"><br>Настройки</a>
</div>


<div style="width:173px; position:relative; <? if (!isset($_GET[page]) || $_GET[page]=='search_site') {echo "display:block;";} else {echo "display:none;";} ?> padding:5px; float:right" class='div2_left dop_podmenu'>
    <div class="menu1">
        <div class="menu_title">
            Рабочий стол
        </div>
        
        <div style="float:none">
            <a href="/cms" style="float:none; display:block !important; width:170px; background:none; padding-left:0px; font-size:14px; margin-bottom:10px">
            Смотреть рабочий стол</a>
        </div>
        
        <div style="float:none">
        <a href="#" class="popup enbl_btn_desktop <? if ($SETTINGS[desc_1]==1) {echo "enbl_btn_desktop2";} ?>" num="1"></a> 
        Заказы
        </div><br>
        
        <div style="float:none">
        <a href="#" class="popup enbl_btn_desktop <? if ($SETTINGS[desc_2]==1) {echo "enbl_btn_desktop2";} ?>" num="2"></a> 
        Заявки
        </div><br>
        
        <div style="float:none">
        <a href="#" class="popup enbl_btn_desktop <? if ($SETTINGS[desc_3]==1) {echo "enbl_btn_desktop2";} ?>" num="3"></a> 
        Обратная связь
        </div><br>
        
        <div style="float:none">
        <a href="#" class="popup enbl_btn_desktop <? if ($SETTINGS[desc_4]==1) {echo "enbl_btn_desktop2";} ?>" num="4"></a> 
        Комментарии
        </div><br>
        
        <div style="float:none">
        <a href="#" class="popup enbl_btn_desktop <? if ($SETTINGS[desc_5]==1) {echo "enbl_btn_desktop2";} ?>" num="5"></a> 
        Вопрос-ответ
        </div><br>
        
        <div style="float:none">
        <a href="#" class="popup enbl_btn_desktop <? if ($SETTINGS[desc_6]==1) {echo "enbl_btn_desktop2";} ?>" num="6"></a> 
        Отзывы
        </div><br>
        
        <div style="float:none">
        <a href="#" class="popup enbl_btn_desktop <? if ($SETTINGS[desc_7]==1) {echo "enbl_btn_desktop2";} ?>" num="7"></a> 
        Стат. посещения
        </div><br>
        
        <div style="float:none">
        <a href="#" class="popup enbl_btn_desktop <? if ($SETTINGS[desc_8]==1) {echo "enbl_btn_desktop2";} ?>" num="8"></a> 
        Стат. заказов
        </div><br>
        
    </div>
</div>



<div style="width:173px; position:relative; <? echo $d; ?> padding:5px; float:right" class='div2_left2 dop_podmenu'>
    <div class="menu1 pod_link_left">
        <div class="menu_title">
            Контент сайта
        </div>
        <a href="?page=zadaniy" <? if ($p=="zadaniy" || $p=="zadaniy_inf") {echo "class='now_page'";} ?>>Задания</a>
        
        <a href="?page=materials" <? if ($p=="materials" || $p=="add_folder_materials" || $p=="add_pages") {echo "class='now_page'";} ?>>Страницы</a>
        <? if ($MODULS[4]==1) { ?><a href="?page=news" <? if ($p=="news" || $p=="add_news") {echo "class='now_page'";} ?>>Новости</a> <? } ?>
        <? if ($MODULS[5]==1) { ?><a href="?page=galery" <? if ($p=="galery" || $p=="add_galery_cat" || $p=="galery_img") {echo "class='now_page'";} ?>>Галерея</a> <? } ?>
        <? if ($MODULS[23]==1) { ?><a href="?page=fmanager" <? if ($p=="fmanager") {echo "class='now_page'";} ?>>Файловый менеджер</a> <? } ?>
        <a href="?page=formmanager" <? if ($p=="formmanager") {echo "class='now_page'";} ?>>Редактор форм</a>
    </div>
</div> 


<div style="width:173px; position:relative; <? echo $d2; ?> padding:5px; float:right" class='div2_left3 dop_podmenu'>
    <div class="menu1 pod_link_left">
        <div class="menu_title">
            Каталог
        </div>
        
        <a href="?page=katalog" <? if ($p=="katalog" || $p=="add_folder_katalog" || $p=="add_goods") {echo "class='now_page'";} ?>>Категории</a>
        <a href="?page=goods_stamp" <? if ($p=="goods_stamp") {echo "class='now_page'";} ?>>Выделенные</a>
        <? if ($MODULS[18]==1) { ?><a href="?page=goods_harakteristiki" <? if ($p=="goods_harakteristiki") {echo "class='now_page'";} ?>>Характеристики</a><? } ?>
        <a href="?page=goods_firms" <? if ($p=="goods_firms") {echo "class='now_page'";} ?>>Производители</a>
        <a href="?page=kupon" <? if ($p=="kupon") {echo "class='now_page'";} ?>>Купоны</a>
        <!--<a href="?page=1c" style="margin-left:10px">- 1С</a>-->
        <? if ($MODULS[20]==1) { ?><a href="?page=goods_export" <? if ($p=="goods_export") {echo "class='now_page'";} ?>>Синхронизация</a><? } ?>
        <a href="?page=goods_price" <? if ($p=="goods_price") {echo "class='now_page'";} ?>>Цены и валюты</a>
        <a href="?page=goods_newprice" <? if ($p=="goods_newprice") {echo "class='now_page'";} ?>>Наценки</a>
        <a href="?page=yml" <? if ($p=="yml") {echo "class='now_page'";} ?>>Генерация YML</a>
        <? if ($MODULS[21]==1) { ?><a href="?page=goods_zakaz" <? if ($p=="goods_zakaz" || $p=='inf_zakaz') {echo "class='now_page'";} ?>>Заказы</a><? } ?>
    </div>
</div> 


<div style="width:173px; position:relative; <? echo $d3; ?> padding:5px; float:right" class='div2_left4 dop_podmenu'>
    <div class="menu1 pod_link_left">
        <div class="menu_title">
            Конфигурация
        </div>
     
        <? if ($N_USER=="AntiBuger") { ?><a href="?page=moduls">Модули</a> <? } ?>
        <a href="?page=license">Лицензия</a>
        <a href="?page=admin_contacts">Контакты админа</a>
        <a href="?page=users">Пользователи</a>
        <a href="?page=dostup">Контроль доступа</a>
        <a href="?page=vnedrenie">Внедрение</a>
        <a href="?page=antivir">Антивирус</a>
        <a href="?page=config_magazin">Магазин</a>
        <? if ($N_USER=="AntiBuger") { ?><a href="?page=main_adm">Настройки</a> <? } ?>
        <div style="float:none; margin-left:4px; margin-top:6px"><a href="#" class="popup enbl_btn_desktop <? if ($SETTINGS[desc_9]==1) {echo "enbl_btn_desktop2";} ?>" num="9"></a> Рабочий сайт</div><br>
    </div>
</div> 


<div style="width:173px; position:relative; <? echo $d4; ?> padding:5px; float:right" class='div2_left5 dop_podmenu'>
    <div class="menu1 pod_link_left">
        <div class="menu_title">
            Инсайт
        </div>
        <? if ($MODULS[6]==1) { ?><a href="?page=zayvki" <? if ($p=="zayvki" || $p=="zayvka_inf") {echo "class='now_page'";} ?>>Заявки</a> <? } ?>
        <? if ($MODULS[7]==1) { ?><a href="?page=obr_svyz" <? if ($p=="obr_svyz" || $p=="obr_svyz_inf") {echo "class='now_page'";} ?>>Обратная связь</a> <? } ?>
        <? if ($MODULS[3]==1) { ?><a href="?page=comment" <? if ($p=="comment") {echo "class='now_page'";} ?>>Комментарии</a> <? } ?>
        <? if ($MODULS[11]==1) { ?><a href="?page=vopros_otvet" <? if ($p=="vopros_otvet") {echo "class='now_page'";} ?>>Вопрос ответ</a> <? } ?>
        <? if ($MODULS[10]==1) { ?><a href="?page=otziv" <? if ($p=="otziv") {echo "class='now_page'";} ?>>Отзывы</a> <? } ?>
        <? if ($MODULS[9]==1) { ?><a href="?page=rassilka" <? if ($p=="rassilka") {echo "class='now_page'";} ?>>Рассылка</a> <? } ?>
        <a href="?page=users" <? if ($p=="users" || $p=="user_inf" || $p=='add_users') {echo "class='now_page'";} ?>>Пользователи</a>
    </div>
</div> 


<div style="width:173px; position:relative; <? echo $d5; ?> padding:5px; float:right" class='div2_left6 dop_podmenu'>
    <div class="menu1 pod_link_left">
        <div class="menu_title">
            Статистика
        </div>
        
        <? if ($MODULS[21]==1) { ?><a href="?page=stat_zakaz">Анализ заказов</a><? } ?>
        <!--<a href="#" onClick="alert('Функция недоступна!')">Анализ посещений</a>-->
        <a href="?page=statistika_cms">Статистика CMS</a>
    </div>
</div> 