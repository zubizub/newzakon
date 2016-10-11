<div class="container">
    <div class="row">
        <Br><Br>
        <div class="titleMainPage textCenter">
            Лента заданий
        </div>
        
        <?
        
        $limit_z = "LIMIT 10";
        include("blocks/zadaniy.php");
        ?>
        
        
        <div class="textCenter"><a href="/zadaniy/" class="btnAllZadach">Смотреть все задания</a></div>
        
        
        
        <? if ($urist!=1) { ?>
        <div class="row blockInfSiteMain">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mainInfUser">
                <div class="mainInfUser-name">
                    Информация для
                    <div>пользователя</div>
                </div>
                
                <div class="mainInfUser-text">
                    Задайте вопрос юристу онлайн и <br>
                    получите консультацию бесплатно. <br>
                    Оставьте задание адвокату или юристу, <br>
                    предложите свою цену и сроки на <br>
                    сервисе юридической помощи. <br>
                    
                    <a href="/dlya-polzovateley/" class="mainInfUser-btn">Подробнее</a>
                </div>
                
                <img src="/img/main1.png" class="mainInfUser-img hidden-sm hidden-xs" alt="Пользователь юридического портала"/>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mainInfUrist textRight">
                <div class="mainInfUrist-name">
                    Информация для
                    <div>Юриста</div>
                </div>
                
                <div class="mainInfUrist-text">
                    Найдите задание и станьте его <br>
                    исполнителем. Договаривайтесь с <br>
                    заказчиком о сроках и стоимости <br>
                    юридической услуги. Зарабатывайте<br>
                    репутацию на сервисе МойЗакон и <br>
                    получайте больше заказов. <br>
                    
                    <a href="/dlya-yuristov/" class="mainInfUrist-btn">Подробнее</a>
                </div>
                
                <img src="/img/men2.png" class="mainInfUrist-img hidden-sm hidden-xs" alt="Юрист юридического портала" />
            </div>
        </div>
        <? } else { echo "<Br><Br>"; } ?>
        
    </div>
</div>