<? include("blocks/start.php"); ?>
<!DOCTYPE HTML> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<meta name="author" content="www.eurosites.ru">
<meta name="copyright" content="ЕвроCMS">
<meta http-equiv="Cache-Control" content="no-cache">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
<meta name='yandex-verification' content='40e024c25b0029aa' />
<meta name="yandex-verification" content="93b94947ab5e1099" />

<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

<link href="/font/stylesheet.css" type="text/css" rel="stylesheet">
<link href="/css/reset.css" type="text/css" rel="stylesheet">
<link href="/css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="/css/style.css?v=2.5555" type="text/css" rel="stylesheet">
<link href="/css/user.css" type="text/css" rel="stylesheet" >
<? if ($adapt==1) { ?><link href="/css/adaptive.css" type="text/css" rel="stylesheet"><? } ?>
<link href="/cms/modul/formmanager/css.css" rel="stylesheet" type="text/css">
<link href="/fancybox/source/jquery.fancybox.css?v=2.1.5" rel="stylesheet" type="text/css" media="screen" />
<link href="/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>

<script type="text/javascript">

/*$(document).ready(function(){
    $(body).hide();
});*/

$(window).load(function() {
      console.log ('loaded');
});
</script>

<!--[if IE]>
<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<? include("blocks/date_pars.php"); include("blocks/description.php"); ?>
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="description" content="<?php echo $description; ?>">
<title><?php echo $title; ?></title>
</head>


<?


if (isset($_COOKIE['city']))
{
    $result = mysql_query("SELECT * FROM city WHERE id='$_COOKIE[city]'");
    $myrow = mysql_fetch_assoc($result); 
    $num_rows = mysql_num_rows($result);

    if ($num_rows!=0)
    {
        $city_head = $myrow['name'];
    }
    else
    {
        $city_head = "Ростов-на-Дону";
    }
}
else
{
    $city_head = "Ростов-на-Дону";
}

?>

<body>
<div id="body">

<div class="up_menu">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <a href="/" class="logo"><img src="/img/logo.png"/></a>
            </div>
            
            <div class="col-lg-6 col-md-6 hidden-sm hidden-xs menu_up_site">
                <a href="/new_question/" <? if ($page=='new_question') {echo "class='m_active'";} ?>>Задать вопрос</a>
                <a href="/topics/" <? if ($page=='topics') {echo "class='m_active'";} ?>>Вопросы</a>
                <a href="/zadaniy/" <? if ($page=='zadaniy') {echo "class='m_active'";} ?>>Задания</a>
                <a href="/urists/" <? if ($page=='urists') {echo "class='m_active'";} ?>>Исполнители</a>
                <a href="/docs/" <? if ($page=='docs') {echo "class='m_active'";} ?> class='nav_doc'>Документы</a>
                <a href="/urmarket/" <? if ($page=='urmarket') {echo "class='m_active'";} ?>>Юрмаркет</a>
            </div>
             
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 sity_up_site">
                    
                <img src="/img/ico_maps.png" /> 
                <a href="#" rel="nofollow" class="selectSity"><? echo $city_head; ?></a>

            </div>
            
           
            
            
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 incab_up_site">
                <? include("blocks/form_user.php"); ?>

            </div>
        </div>
    </div>
</div>


<? if (!isset($_GET['page']) && $urist!=1) { ?>
<header>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="titleHead1">Удобный способ заказать юридическую услугу</div>
            <div class="descHead1">Наши юристы помогут Вам максимально быстро в решении любых правовых проблем!</div>
            
            <div class="boxHeadSearch">
                <img src="/img/ico_lupa.png" class="icoSearchHead"/>
                <input type="text" class="boxHeadSearch-pole" placeholder="Поиск по сайту..." required/>
                <span class="boxSearchSelect">
                    <input type="text" class="boxHeadSearch-select" value="Везде" readonly=""/>
                    <img src="/img/for_option_up.png" class="imgListSelect0" />
                    <div class="listSearchSelect">
                        <a href="#" rel="nofollow" class="popup" data-value="По исполнителям">По исполнителям</a>
                        <a href="#" rel="nofollow" class="popup" data-value="По заданиям">По заданиям</a>
                        <a href="#" rel="nofollow" class="popup" data-value="По документам">По документам</a>
                        <a href="#" rel="nofollow" class="popup" data-value="По вопросам">По вопросам</a>

                        <a href="#" rel="nofollow" class="popup" data-value="Везде">Везде</a>
                    </div>
                </span>
                <div class="boxHeadSearch-btn boxHeadSearch-btnm">Найти</div>
            </div>
            
            
            <div class="titleHead2">Найдите юриста</div>
            <div class="descHead2">для выполнения работы на Ваших условиях</div>
            
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                    <span class="boxHeadFormZayvka">
                        <div class="mainBoxheadFormZayvka">
                        <form action='#' class="mainFrmUserZadanie" method="post">
                            <textarea name="textZ" class="headFormZayvka" placeholder="Опишите подробнее Вашу ситуацию для решения которой требуется юридическая помощь"></textarea>
                        </form>
                        
                        </div>
                        
                        
                        <a href="#" rel="nofollow" class="headFormZayvka-btn popup">Отправить</a>
                        
                        <div class="regMainEtap1">
                            <div class="regMainEtap1-title regMainEtap1-title2">Чтобы Ваш вопрос опубликовался на сайте необходимо 
                            <a href='#' class="popup btnChengMainReg">зарегистрироваться</a> или <a href='#' class="popup btnChengMainEnter">войти</a></div>
                            
                            <div class="regMainEtap1Inner">
                                <div class="row">
                                    <div class="boxMainReg1">
                                        <input type="text" placeholder="Введите телефон" class="phone phoneRegUser"/>
                                        <div class="regMainEtap1-btn">зарегистрироваться</div>
                                    </div>
                                    <div class="boxMainEnter1">
                                        <input type="text" placeholder="Телефон" class="phone enter-phoneEnterUser"/>
                                        <input type="text" placeholder="Пароль" class="enter-passEnterUser"/>
                                        <div class="regMainEtap15-btn">войти</div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="regMainEtap2">
                            <div class="regMainEtap1-title">Чтобы завершить регистрацию введите код подтверждения, мы отправили его Вам на телефон!</div>
                            <div class="regMainEtap1Inner">
                                <input type="text" placeholder="Введите код" class="kodRegUser"/>
                                <div class="regMainEtap2-btn">подтвердить</div>
                            </div>
                        </div>
                        
                        <div class="regMainEtap3">
                            <div class="regMainEtap3-title">
                            <Br><span class="regMainEtap3-title-inner">Регистрация завершена! </span>Спасибо!<Br>
                            Мы проверим Ваш вопрос и опубликуем его!
                            <Br><Br><a href="/zadaniy/">Список заданий</a></div>
                        </div>
                    </span>
                </div>
                
                <div class="col-lg-5 hidden-md hidden-sm hidden-xs rightInfFormZayvka">
                    МОЙЗАКОН помогает:<br>
                    - найти юриста для решения проблемы<br>
                    - задать бесплатно вопрос юристу<br>
                    - получить юридическую консультацию онлайн<br>
                    - скачать образцы документов<br>
                    - заказать разработку документов у юриста
                </div>
            </div>    
        </div>
    </div>
</div>
<img src="/img/mouse.png" class="icoMouse"/>
</header>
<? } ?>




<? if ($page=='new_zadanie') { ?>

<div class="upBlockNewZadach">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="upBlockNewZadach-title">Ищете юриста?</div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="upBlockNewZadach-number">1</div>
                <div class="upBlockNewZadach-text">
                    <div>Заполните форму</div>
                    И Ваша задача появится в ленте<Br>
                    после модерации
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="upBlockNewZadach-number">2</div>
                <div class="upBlockNewZadach-text">
                    <div>Получите отклики</div>
                    Заинтересованные исолнители<Br>
                    предложат свою помощь
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="upBlockNewZadach-number">3</div>
                <div class="upBlockNewZadach-text">
                    <div>Выберите исполнителя</div>
                    Выберите подходящего для Вас<Br>
                    исполнителя по цене и качеству
                </div>
            </div>
        </div>
    </div>
</div>
<Br><Br>
<? } ?>

<? if (!isset($_GET[page]) && $urist==1) { ?>

<? } else { ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="center_div2">
            <main>
                <? 
                    if ($typePage=='' && $page!='faq')
                    {
                        if ($history!='') {echo "<div class='histor'>$history</div>";} //история
                        if ($_GET[page]!='goods' && isset($_GET[page]) && !$_GET['header']) {echo "<h1>$name_page</h1>";}
                        //elseif ($_GET['header'] == 'usluga') { echo '<h1>Заказать услугу</h1>'; }
                        elseif ($_GET['header'] == 'usluga') { echo "<h1>$name_page</h1>"; }
                        
                        
                    }
                     
                ?>
                <? include("blocks/include.php"); ?>
            </main>
        </div>    
    </div>
</div>        

<? } ?>









<? if ($urist!=1) { ?>

<div class="banMainRazmestit">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class='banMainRazmestit-title1'>ЗАДАЙТЕ ВОПРОС СПЕЦИАЛИСТУ<Br>или</div>
                <div class='banMainRazmestit-title2'>РАЗМЕСТИТЕ ЗАДАНИЕ</div>
                
                <div class='banMainRazmestit-title3'>
                Чтобы оставить заявку на сайте, достаточно заполнить небольшую форму, 
                где следует указать возникшую ситуацию, задать вопрос и оставить контактные данные.
                Даже неопытный пользователь сможет оформить свое обращение к специалистам. 
                Мы гарантируем максимальное внимание и бескорыстность по отношению к каждому, кто обратится к нам за помощью и поддержкой. 
                </div>
                
                <a href="/new_zadanie/" class='banMainRazmestit-title4'>
                СОЗДАТЬ ЗАДАНИЕ
                </a>
            </div>
        </div>
    </div>    
</div>

<? } else { ?>

<br>

<? } ?>


<?

if (!isset($_GET[page]))
{
    include("blocks/main2.php");
}

?>




<footer>
<div class="container">
    <div class="row">
       
       <div class="col-md-3 col-sm-3 hidden-xs">
            <div class="footer-text">
                <a href="/"><img src="/img/logo.png" alt="МОЙ ЗАКОН" /></a>
            </div>
       </div>
       
       <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="menu_futer menu_futer1">
                <div>Как тут всё устроено</div>
                <a href="/faq/" rel="nofollow">Как это работает</a>
                <a href="/bezopasnost-i-garantii/" rel="nofollow">Безопасность и гарантии</a>
                <a href="/dlya-yuristov/" rel="nofollow">Как стать исполнителем</a>
            </div>
       </div>
        
       <div class="col-md-3 col-sm-3 col-xs-12">
           <div class="menu_futer menu_futer2">
                <div>Компания</div>
                <a href="/blog/" rel="nofollow">Наш блог</a>
                <a href="/reklama/" rel="nofollow">Реклама</a>
                <a href="/feedback/" rel="nofollow">Контакты</a>
            </div> 
       </div>
        
       <div class="col-md-3 col-sm-3 col-xs-12">
           <div class="menu_futer menu_futer2">
                <div>Служба поддержки</div>
                <a href="/obshchie-polozheniya/" rel="nofollow">Правила сервиса</a>
                <a href="/faq/" rel="nofollow">Частые вопросы</a>
                <a href="/reklama/" rel="nofollow">Реклама на сайте</a>
                <address>
                    Создание сайта: 
                    <a href="https://eurosites.ru" title="создание сайтов" target="_blank" <? if ($_GET[page]) {echo "rel='nofollow'";} ?>>ЕВРОСАЙТЫ</a>
                </address>
           </div> 
           
            
       </div>   
    </div>
</div>
</footer> 


<div id="myElement"></div>

<a href="#" id="toTop"></a>

<? include("blocks/poprel.php"); ?>

<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="/js/jquery.mobile.custom.min.js"></script>
<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="/js/jquery.nicescroll.js"></script>
<script type="text/javascript" src="/js/jquery.timer.js"></script>
<script type="text/javascript" src="/js/script_default.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/script.js"></script>
<? echo html_entity_decode($SETTINGS[add_code], ENT_QUOTES); //вывод счетчиков ?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter39774150 = new Ya.Metrika({
                    id:39774150,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/39774150" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</div>
</body>
</html>