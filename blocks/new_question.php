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
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 boxBtnVoprosZadanie2">
        <span>Консультация</span>
        <a href="/new_zadanie/">Создать задание</a>
    </div>
</div>

    
<div class="row">
    <div class="col-lg-7 col-md-8 col-sm-8 col-xs-12">
        <div class="boxVoprosZadanie">
        <form action="#" method="post" name="frmNewVopros" class="frmNewVopros" enctype="multipart/form-data">
            <input type="hidden" name="mail" value="" class="mailVoprosFrm"/>
            
            <? if (!isset($_COOKIE[uid])) { ?>
            <div class="innerFrmNewZadanie innerFrmNewZadanie1">
                <div class="frmNewZadanie-name">Ваше имя</div>
                <span>
                <input name="name_user" type="text" placeholder="Иванов Иван">
                </span>
            </div>
            <? } ?>
            
             
            <div class="innerFrmNewZadanie innerFrmNewZadanie1">
                <div class="frmNewZadanie-name">Название вопроса</div>
                <span>
                <input name="name" class="nameNewVopros" type="text" placeholder="Введите название вопроса">
                </span>
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
            
            
            
            <div class="innerFrmNewZadanie">
                <div class="frmNewZadanie-name">Описание вопроса</div>
                <textarea name="text" class="textVopros" placeholder="Опишите какая стоит перед Вами задача и максимально подробно расскажите о её деталях"><? echo $textZ; ?></textarea>
            </div>

            
            <div class="innerFrmNewZadanie">
                <div class="frmNewZadanie-name">Город</div>
                
                <div class="boxCityPole" style="display: inline-block">
                    <input name="city" class="inpCity" type="text" placeholder="Ростов-на-Дону">
                    <div class="listCity">
                        
                    </div>
                </div>
            </div>
            

            
            <div class="boxAddFileZadanie">
                <a href="#" rel="nofollow" class="addFileLink"><img src="/img/pl.png"/>  прикрепить файл (архив rar или zip)</a>
                <input type="file" name="doc" class="fileDoc"/>
            </div>
            
            <div class="btnSendNewVopros">спросить</div>
        </form>
        </div>
    </div>
    
    <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
        
        <?
        
            $result_v = mysql_query("SELECT * FROM vopros WHERE enabled='1' && podtverdit='1' ORDER BY id DESC LIMIT 15");
            $myrow_v = mysql_fetch_assoc($result_v); 
            $num_rows_v = mysql_num_rows($result_v);
            $id_vopros = $myrow[id];

            
            if ($num_rows_v!=0)
            {
                echo "<div class='title_last_ques'>Последние вопросы</div>";
                
            	do
            	{
            		echo "<a href='/question/$myrow_v[name_m]/' class='linkAll linkLastVoprosRight'>$myrow_v[name]</a>";
            	}while($myrow_v = mysql_fetch_assoc($result_v));
                
                echo "<a href='/topics/' class='linkAllVoprosRight1'>все вопросы</a>";
            }
        ?>
        
        
    </div>
</div>



