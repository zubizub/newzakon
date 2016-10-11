<?
$t_uid='';

if (isset($_GET[t]))
{
    $t_uid = f_data ($_GET[t], 'text', 0);
    $result_user2 = mysql_query("SELECT * FROM users WHERE uid='$t_uid'");
    $myrow_user2 = mysql_fetch_assoc($result_user2); 
    
    echo "<div class='t_user'>Исполнитель: <b>$myrow_user2[fio]</b></div>";
}

$textZ='';
if (isset($_POST[textZ]))
{
    $textZ = f_data ($_POST[textZ], 'text', 0);
}
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 boxBtnVoprosZadanie">
        <a href="/new_question/">Консультация</a>
        <span>Создать задание</span>
    </div>
</div>

    
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="boxVoprosZadanie">
        <form action="#" method="post" name="frmNewZadanie" class="frmNewZadanie" enctype="multipart/form-data">
            <input type="hidden" name="ispolnitel" value="<? echo $t_uid; ?>"/>
            
        	<div class="innerFrmNewZadanie">
                <div class="frmNewZadanie-name">Вид задания</div>
                <select name="type" class="vidTask">
                    <?
                    if (isset($_GET[usluga]))
                    {
                        $usluga = f_data($_GET[usluga],'text',0);
                    }
                    $result_u = mysql_query("SELECT * FROM type_uslugi WHERE enabl='0' ORDER BY id ASC");
                    $myrow_u = mysql_fetch_assoc($result_u); 
                    $num_rows_u = mysql_num_rows($result_u);

                    if ($num_rows_u!=0)
                    {
                    	do
                    	{
                            if (($myrow_u[name]=='Консультация' && !isset($_GET[usluga])) || substr_count($usluga,$myrow_u[name])!=0)
                            {
                                echo "<option selected>$myrow_u[name]</option>";
                            }
                            else
                            {
                                echo "<option>$myrow_u[name]</option>";
                            }
                    	}while($myrow_u = mysql_fetch_assoc($result_u));
                    }
                    
                    ?>
                </select>
            </div>
            
            <div class="innerFrmNewZadanie">
                <div class="frmNewZadanie-name">Категория</div>
                <select name="cat" class="typeCatUsluga">
                    <option selected="">Не знаю</option>
                    <?
                        $result_cat = mysql_query("SELECT * FROM napravlenie ORDER BY name ASC");
                        $myrow_cat = mysql_fetch_assoc($result_cat); 
                        $num_rows_cat = mysql_num_rows($result_cat);

                        if ($num_rows_cat!=0)
                        {
                        	do
                        	{
                        		echo "<option>$myrow_cat[name]</option>";
                        	}while($myrow_cat = mysql_fetch_assoc($result_cat));
                        }
                    ?>
                </select>
            </div>
            
            <div class="innerFrmNewZadanie innerFrmNewZadanie1">
                <div class="frmNewZadanie-name">Название задания</div>
                <span>
                <input name="name" class="nameNewZadanie" type="text" placeholder="Введите заголовок задания">
                </span>
            </div>
            
            
            <div class="innerFrmNewZadanie">
                <div class="frmNewZadanie-name">Задача</div>
                <textarea name="text" class="textZadach" placeholder="Опишите какая стоит перед Вами задача и максимально подробно расскажите о её деталях"><? echo $textZ; ?></textarea>
            </div>
            
            
            <div class="innerFrmNewZadanie">
                <div class="frmNewZadanie-name">Предполагаемый бюджет</div>
                <span>
                <input name="bujet" type="text" placeholder="10000">
                <img src="/img/rub.png" class="ico_rub_pole"/>
                </span>
            </div>
            
            <div class="innerFrmNewZadanie">
                <div class="frmNewZadanie-name">Город</div>
                
                <div class="boxCityPole" style="display: inline-block">
                    <input name="city" class="inpCity" type="text" placeholder="Ростов-на-Дону">
                    <div class="listCity">
                        
                    </div>
                </div>
            </div>
            
            
            <div class="innerFrmNewZadanie">
                <div class="frmNewZadanie-name">Срок приема заявок</div>
                <span>
                <input name="date1" type="text" placeholder="10.12.2016" class="datepicker">
                <img src="/img/ico_date.png" class="ico_date_pole "/>
                </span>
            </div>
            
            <div class="innerFrmNewZadanie">
                <div class="frmNewZadanie-name">Срок исполнения заявок</div>
                <span>
                <input name="date2" type="text" placeholder="20.12.2016" class="datepicker">
                <img src="/img/ico_date.png" class="ico_date_pole"/>
                </span>
            </div>
            
            
            <? if (!isset($_COOKIE['uid']) && 1==2) { ?>
            <div class="boxRegUserNewZadach">
                <div class="boxRegUserNewZadach-title">Вы не авторизованы на сайте, заполните свои данные или войдите на сайт. <a href="/enter/">Войти на сайт</a></div>
                
                <div class="innerFrmNewZadanie">
                    <div class="frmNewZadanie-name">Ваше имя</div>
                    <input name="u_name" type="text" class="u_name">
                </div>
                
                <div class="innerFrmNewZadanie">
                    <div class="frmNewZadanie-name">Ваш телефон</div>
                    <input name="u_phone" type="text" class="phone u_phone">
                </div>
            </div>
            
            <div class="boxCodMsg">
                <div class="boxCodMsg-title">Вам на телефон был отправлен код подтверждения, введите его:</div>
                <div class="innerFrmNewZadanie">
                    <div class="frmNewZadanie-name">Код подтверждения</div>
                    <input name="u_cod" type="text" class="u_cod">
                    <div class="frmNewZadanie-btnpodtverdit">подтвердить</div>
                </div>         
            </div>
            
            <? } ?>
            
                        
            <!--Форма нового задания, авторизации-->
            <noindex>
            <div class="boxFormNewZadaniePop">
            	<div class="formNewZadaniePop">
                    <div class="boxRegUserNewZadach">
                        <div class="boxRegUserNewZadach-title">
                            Вы не авторизованы на сайте, <a href="#" rel="nofollow" class="popup btnShowAvtoriz">авторизуйтесь</a> или <a href="#" rel="nofollow" class="popup btnShowEnter">войдите на сайт</a>. 
                        </div>
                        
                        <div class="boxNewZadanieReg">
                            <div class="innerFrmNewZadanie boxInputNewZadach">
                                <div class="frmNewZadanie-name">Ваше имя</div>
                                <input name="u_name" type="text" class="u_name">
                            </div>
                            
                            <div class="innerFrmNewZadanie boxInputNewZadach">
                                <div class="frmNewZadanie-name">Ваш телефон</div>
                                <input name="u_phone" type="text" class="phone u_phone">
                            </div>
                            
                            <div class="formNewZadaniePop-btn">подтвердить</div>
                        </div>
                        
                        
                        <div class="boxNewZadanieEnter">
                            <div class="innerFrmNewZadanie boxInputNewZadach">
                                <div class="frmNewZadanie-name">Ваш телефон</div>
                                <input name="u_phone" type="text" class="phone u_phone1">
                            </div>
                            
                             <div class="innerFrmNewZadanie boxInputNewZadach">
                                <div class="frmNewZadanie-name">Пароль</div>
                                <input name="u_pass" type="text" class="u_pass">
                            </div>
                            
                            <div class="formNewZadaniePop-btnEnter">войти</div>
                        </div>
                    </div>
                        
                    <div class="boxCodMsg">
                        <div class="boxCodMsg-title">Вам на телефон был отправлен код подтверждения, введите его:</div>
                        <div class="innerFrmNewZadanie">
                            <div class="frmNewZadanie-name">Код подтверждения</div>
                            <input name="u_cod" type="text" class="u_cod">
                            <div class="frmNewZadanie-btnpodtverdit">подтвердить</div>
                        </div>         
                    </div>
            	</div>
            </div>
            </noindex>
            <!--Форма нового задания, авторизации конец-->
            
            
            
            <div class="boxAddFileZadanie">
                <a href="#" rel="nofollow" class="addFileLink"><img src="/img/pl.png"/> прикрепить файл (архив rar или zip)</a>
                <input type="file" name="doc" class="fileDoc"/>
            </div>
            
            <input type="hidden" name="bigZadanie" value="1"/>
            <input type="hidden" name="u_phone_verify" class="u_phone_verify" value=""/>
            <div class="btnSendNewZadach">создать</div>
        </form>
        </div>
    </div>
</div>