<?

$page = $_GET[page];

if ($page=='fmanager') {$name_page="Файловый менеджер"; }
elseif ($page=='news') {$name_page="Новости";}
elseif ($page=='add_news') {$name_page="Добавление/редактирование новости";}
elseif ($page=='formmanager') {$name_page="Редактор форм";}
elseif ($page=='materials') {$name_page="Материалы";}
elseif ($page=='add_folder_materials') {$name_page="Добавление/редактирование папки материала";}
elseif ($page=='add_pages') {$name_page="Добавление/редактирование страницы";}
elseif ($page=='katalog') {$name_page="Каталог";}
elseif ($page=='add_folder_katalog') {$name_page="Добавление/редактирование категории";}
elseif ($page=='add_goods') {$name_page="Добавление/редактирование товара";}
elseif ($page=='goods_stamp') {$name_page="Выделеные товары";}
elseif ($page=='goods_harakteristiki') {$name_page="Каталог характеристик";}
elseif ($page=='add_cat_harakteristika') {$name_page="Добавление/редактирование категории характеристики";}
elseif ($page=='harakter_all') {$name_page="Свойства характеристик";}
elseif ($page=='goods_firms') {$name_page="Производители";}
elseif ($page=='goods_price') {$name_page="Цены";}
elseif ($page=='goods_newprice') {$name_page="Наценки";}
elseif ($page=='yml') {$name_page="Генерация YML";}
elseif ($page=='goods_zakaz') {$name_page="Заказы";}
elseif ($page=='inf_zakaz') {$name_page="Информация о заказе";}
elseif ($page=='kupon') {$name_page="Купоны";}
elseif ($page=='add_kupon') {$name_page="Добавление купона";}
elseif ($page=='goods_export') {$name_page="Экспорт товаров";}
elseif ($page=='config') {$name_page="Конфигурация";}
elseif ($page=='vnedrenie') {$name_page="Внедрение";}
elseif ($page=='moduls') {$name_page="Модули";}
elseif ($page=='license') {$name_page="Лицензия";}
elseif ($page=='main_adm') {$name_page="Настройки";}
elseif ($page=='admin_contacts') {$name_page="Контакты администратора";}
elseif ($page=='users') {$name_page="Пользователи";}
elseif ($page=='add_users') {$name_page="Добавление/редактирование пользователя";}
elseif ($page=='user_inf') {$name_page="Информация о пользователи";}
elseif ($page=='dostup') {$name_page="Доступ";}
elseif ($page=='domain') {$name_page="Домен и хостинг";}
elseif ($page=='statistika_cms') {$name_page="Статистика CMS";}
elseif ($page=='config_magazin') {$name_page="Конфигурация магазина";}
elseif ($page=='antivir') {$name_page="Антивирус";}
elseif ($page=='zayvki') {$name_page="Заявка";}
elseif ($page=='zayvka_inf') {$name_page="Информация о заявке";}
elseif ($page=='obr_svyz') {$name_page="Обратная связь";}
elseif ($page=='obr_svyz_inf') {$name_page="Информация о сообщении обратной связи";}
elseif ($page=='galery') {$name_page="Галерея";}
elseif ($page=='add_galery_cat') {$name_page="Добавление/редактирование папки галереи";}
elseif ($page=='galery_img') {$name_page="Изображения галереи";}
elseif ($page=='comment') {$name_page="Комментарии";}
elseif ($page=='vopros_otvet') {$name_page="Вопрос-ответ";}
elseif ($page=='otziv') {$name_page="Отзывы";}
elseif ($page=='rassilka') {$name_page="Рассылка";}
elseif ($page=='statistika') {$name_page="Статистика";}
elseif ($page=='stat_zakaz') {$name_page="Статистика заказов";}
elseif ($page=='search_site') {$name_page="Поиск по сайту";}
elseif ($page=='zadaniy') {$name_page="Задания";}
elseif ($page=='zadaniy_inf') {$name_page="Задание, полное описание";}
else {$name_page="Рабочий стол";}
?>