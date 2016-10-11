<? if ($urist!=1) { ?>

<div class="titleMainPage textCenter">
ПОПУЛЯРНЫЕ ТЕМЫ
</div>


<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mainBigIcon1">
        <? if (1==2) { ?><a href="/konsultaciya/" class="popUslugi popUslugi1">Консультация</a><? } ?>
        <div class="name_all_topics">АВТОМОБИЛЬНОЕ ПРАВО</div>
        <div class="link_all_topics">
            <?
                $result_topick = mysql_query("SELECT * FROM pages WHERE url='85/86' ORDER BY id DESC LIMIT 5");
                $myrow_topick = mysql_fetch_assoc($result_topick); 
                $num_rows_topick = mysql_num_rows($result_topick);

                if ($num_rows_topick!=0)
                {
                	do
                	{
                		echo "<a href='/topics/$myrow_topick[m_link]/'>$myrow_topick[name]</a>";
                	}while($myrow_topick = mysql_fetch_assoc($result_topick));
                }
            ?>
            <a href='/topic/85-86/' class="linkAllTopickMain">смотреть все</a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mainBigIcon1">
        <? if (1==2) { ?><a href="/registracionnye-deystviya/" class="popUslugi popUslugi2">Регистрационные действия</a><? } ?>
        <div class="name_all_topics">НЕДВИЖИМОСТЬ</div>
        <div class="link_all_topics">
            <?
                $result_topick = mysql_query("SELECT * FROM pages WHERE url='85/87' ORDER BY id DESC LIMIT 5");
                $myrow_topick = mysql_fetch_assoc($result_topick); 
                $num_rows_topick = mysql_num_rows($result_topick);

                if ($num_rows_topick!=0)
                {
                	do
                	{
                		echo "<a href='/topics/$myrow_topick[m_link]/'>$myrow_topick[name]</a>";
                	}while($myrow_topick = mysql_fetch_assoc($result_topick));
                }
            ?>
            <a href='/topic/85-87/' class="linkAllTopickMain">смотреть все</a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mainBigIcon1">
        <? if (1==2) { ?><a href="/predstavitelstvo-v-sude/" class="popUslugi popUslugi3">Представительство в суде</a><? } ?>
        <div class="name_all_topics">СЕМЕЙНОЕ ПРАВО</div>
        <div class="link_all_topics">
            <?
                $result_topick = mysql_query("SELECT * FROM pages WHERE url='85/88' ORDER BY id DESC LIMIT 5");
                $myrow_topick = mysql_fetch_assoc($result_topick); 
                $num_rows_topick = mysql_num_rows($result_topick);

                if ($num_rows_topick!=0)
                {
                	do
                	{
                		echo "<a href='/topics/$myrow_topick[m_link]/'>$myrow_topick[name]</a>";
                	}while($myrow_topick = mysql_fetch_assoc($result_topick));
                }
            ?>
            <a href='/topic/85-88/' class="linkAllTopickMain">смотреть все</a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mainBigIcon1">
        <? if (1==2) { ?><a href="/pomoshch-pri-dtp/" class="popUslugi popUslugi4">Помощь при ДТП</a><? } ?>
        <div class="name_all_topics">КРЕДИТЫ И ЗАЙМЫ</div>
        <div class="link_all_topics">
            <?
                $result_topick = mysql_query("SELECT * FROM pages WHERE url='85/89' ORDER BY id DESC LIMIT 5");
                $myrow_topick = mysql_fetch_assoc($result_topick); 
                $num_rows_topick = mysql_num_rows($result_topick);

                if ($num_rows_topick!=0)
                {
                	do
                	{
                		echo "<a href='/topics/$myrow_topick[m_link]/'>$myrow_topick[name]</a>";
                	}while($myrow_topick = mysql_fetch_assoc($result_topick));
                }
            ?>
            <a href='/topic/85-89/' class="linkAllTopickMain">смотреть все</a>
        </div>
    </div>
</div>


<div class="textCenter boxBtnAllUslugi"><a href="/topics/" class="btnAllUslugi">Все темы</a></div>


<div class="titleMainPage22">
    <span>МОЙ ЗАКОН</span> подберет Вам наилучшего юриста
    и позволит сэкономить до 50% следующим способом:
</div>

<div class="row boxZadanieMain">

    <div class="lineEtap1">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zadanieMain zadanieMain1">
            <div><p>1.</p> Создайте задание</div>
            <span>Заполните форму вверху сайта или перейдите по ссылке</span>
            <a href="/new_zadanie/">Создайте задание</a>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs imgEtap1">
            <img src="/img/main/etap1.png"/>
        </div>
    </div>
    
    
    <div class="lineEtap2">
        <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs imgEtap2">
            <img src="/img/main/etap2.png"/>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zadanieMain zadanieMain2">
            <div><p>2.</p> Получите отклики</div>
            <span>Получайте предложения от исполнителей по вашему заданию</span>
        </div>
    </div>
    
    <div class="lineEtap3">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zadanieMain zadanieMain3">
            <div><p>3.</p> Выберите исполнителя</div>
            <span>Выберите понравившегося Вам исполнителя по рейтингу, отзывам, предложенной цене</span>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs imgEtap3">
            <img src="/img/main/etap3.png"/>
        </div>
    </div>
</div>

<Br>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mainBigIcon2">
        <img src="/img/main/ico2_main1.png" alt="Юрист" />
        <div>На сегодняшний день у нас в базе только проверенные юристы</div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mainBigIcon2">
        <img src="/img/main/ico2_main2.png" alt="Юрист" />
        <div>Наши специалисты ответят на Ваш вопрос в максимально короткий срок </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mainBigIcon2">
        <img src="/img/main/ico2_main3.png" alt="Юрист" />
        <div>Вы решаете кто будет исполнителем Вашего заказа</div>
    </div>
</div>    


<? } ?>