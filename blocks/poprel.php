<? 
// всплывающие окна на сайте

//обрабатываем сообщение приходящие в msg, чтобы в дальнейшем вырезать его из строки
if (isset($_GET[msg]) || isset($_GET[msgtype])) { 

    $url_now = $_SERVER['REQUEST_URI'];

    if ($url_now!="") 
    {
        
        
        if (substr_count($url_now, "?")!=0 && substr_count($url_now, "&")==0)
        {
            $pos = strripos($url_now, "?"); //позиция вхождления "?"
            //echo "Позиция".strlen($url_now);
            $url_now = substr($url_now,0,$pos);
        }
        
        if (substr_count($url_now, "&")!=0)
        {
            $pos = strpos($url_now, "&"); //позиция вхождления "&"
            $url_now = substr($url_now,0,$pos);
        }
    } 
    else {$url_now="/";}    
    
    //$msg = f_data ($_GET[msg], 'text', 0);
    $msg = $_GET[msg];
?>

<? switch ($_GET[msgtype]) {
    case '1':
        $msg = "Вопрос отправлен на проверку, но его сначала надо подтвердить через e-mail";
        break;
     case '11':
        $msg = "Вопрос отправлен на проверку!";
        break;
     case '111':
        $msg = "Вопрос отправлен на проверку, как только администратор его проверит, он появится на сайте.";
        break;
    
    default:
        # code...
        break;
}?>

<noindex>
<div class="poprel">
    <div class="poprel_title">ВАЖНАЯ ИНФОРМАЦИЯ!</div>
    <div class="box_text_poprel"><? echo $msg; ?></div>
    <a href="#" class='popup' id="but_per">закрыть</a>
    <input type="hidden" class="url_now" value="<? echo $url_now; ?>"/>
</div>
</noindex>
<? 
} 
?>

<? if ($page=='new_question') { ?>
<!--Форма авторизации для вопроса-->
<noindex>
    <div class="boxAuthEmail">
        <div class="boxAuthEmail-title">Введите свой e-mail</div>
        <input type="text" class="mailUserVopros" placeholder="admin@mail.ru"/>
        <div class="boxAuthEmail-btn">Готово</div>
    </div>
</noindex>
<!--Форма авторизации для вопроса конец-->
<? } ?>


<!--Форма регистрации-->
<noindex>
<div class="box_reg">
    <div class="div_reg">
        <div class="div_reg-title">Регистрация</div>
        <div class="div_reg-desc">Все данные конфиденциальны ничего не будет использоваться в коммерческих целях.</div>
        
        <a href="/regpeople/" class="div_reg-btnUser">Пользователь</a>
        <a href="/reg/" class="div_reg-btnUrist">Исполнитель</a>
    </div>
</div>
</noindex>


<? if ($page!='im') { ?>
<!--Форма сообщения-->
<? $uid = f_data ($_GET[uid], 'text', 0); ?>
<noindex>
<div class="boxFormSendMsgUser">
    <div class="FormSendMsgUser">
        <div class="boxFormSendMsgUser-title">Отправить сообщение</div>
        <form name="frmSendMsg" method="post" action="#" class="frmSendMsg">
            <textarea name="frmSendMsg-text" class="frmSendMsg-text" placeholder="Введите текст сообщения"></textarea>
            <div class="boxFrmSendMsg-btn"><div class="frmSendMsg-btn">отправить</div></div>
            <input type="hidden" name="uid_from" value="<? echo $uid; ?>"/>
        </form>
    </div>
</div>
</noindex>
<? } ?>


<!--Форма отзыва-->
<? $idz = f_data ($_GET[id], 'text', 0); ?>
<noindex>
<div class="boxFormSendOtziv">
    <div class="FormSendOtziv">
        <div class="boxFormSendOtziv-title">Оставить отзыв исполнителю</div>
        <form name="formSendOtziv" method="post" action="#" class="frmSendOtziv">
            Оцените работу исполнителя: 
            <select name="bal" class="formSendOtziv-bal">
                <option value="-2">Ужасно</option>
                <option value="-1">Плохо</option>
                <option value="0" selected="">Нормально</option>
                <option value="1">Хорошо</option>
                <option value="2">Отлично</option>
            </select><Br>
            <textarea name="formSendOtziv-text" class="formSendOtziv-text" placeholder="Введите текст отзыва"></textarea>
            <div class="boxformSendOtziv-btn"><div class="formSendOtziv-btn">отправить</div></div>
            <input type="hidden" name="idz" value="<? echo $idz; ?>"/>
        </form>
    </div>
</div>
</noindex>


<!--Форма покупки документа-->
<noindex>
<div class="boxFormGetDoc">
    <div class="formGetDoc">
        <div class="formGetDoc-title">Чтобы купить документ заполните поля формы</div>
        <form name="frmGetDoc" method="post" action="#" class="frmGetDoc">
            <input type="text" name="mail" required="" class="mailUserDoc" placeholder="Ваш e-mail"/>
            <textarea name="formSendOtziv-text" class="formGetDoc-text" placeholder="Введите комментарий"></textarea>
            <div class="boxFrmGetDoc-btn"><div class="formGetDoc-btn">отправить</div></div>
            <input type="hidden" name="fileDoc" class="fileDoc" value=""/>
        </form>
    </div>
</div>
</noindex>


<!--Форма выбора города-->
<noindex>
<div class="boxFormCity">
    <div class="formCity">
        <div class="frmNewZadanie-name">Выберите свой город: </div>
        
        <div class="boxCityPole">
            <input name="city" class="inpCityPop" type="text" placeholder="<? echo $city_head; ?>">
            <div class="listCityPop">
                
            </div>
        </div>
        
        <div class="frmNewZadanie-btn">подтвердить</div>
    </div>
</div>
</noindex>




<!--Фон затемнения страницы-->
<div class="bg_page"></div>


<? if ($adapt==1) { ?>
<!--Адаптивное меню-->
<noindex>
<div class="menu_ico_mob hidden-lg hidden-md"></div>

<div class="box_nav_mob type_devel">
    <div class="nav_mob">
        <div class="nav_mob-title"><span>МОЙ</span>ЗАКОН</div>
        <a href="/" rel="nofollow">Главная</a>
        <a href="/new_question/" rel="nofollow">Задать вопрос</a>
        <a href="/new_zadanie/" rel="nofollow">Создать задание</a>
        <a href="/topics/" rel="nofollow">Все темы</a>
        <a href="/zadaniy/" rel="nofollow">Все задания</a>
        <a href="/urists/" rel="nofollow">Исполнители</a>
        <a href="/docs/" rel="nofollow">Формы документов</a>
        <a href="/docs/" rel="nofollow">Формы документов</a>
        <a href="/urmarket/" rel="nofollow">Юрмаркет</a>
        <span class="close_box_nav_mob"></span>
    </div>
    
    <div class="nav_mob-podpis">
        Интерактивный сервис юридических консультаций.
    </div>
</div>
</noindex>
<!--Адаптивное меню конец-->
<? } ?>




<div class="boxAlert">
    <div class="innerAlert">
        <div class="innerAlert-title">Оповещение</div>
        <div class="innerAlert-text">Сообщение</div>
        <div class="innerAlert-ok">Закрыть</div>
    </div>
</div>

