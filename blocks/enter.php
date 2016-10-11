
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
           
            
        <?

        // форма авторизации пользователя, если пользователь авторизован, то ему показывается его ФИО и кнопка входа в личный кабинет

        if (!isset($_COOKIE[uid]))
        {
        ?>

        <div id="forma_enter">
        	<form action="/blocks/obr_enter.php" method="post">
            	<input name="name" type="text" required placeholder="E-mail или телефон">
                <input name="mail" type="password" required placeholder="Пароль">
                <div align="right"><input name="button" type="submit" value="войти в кабинет" class="btn_enter_lk"></div>
                <a href="/who_pass/" rel='nofollow' class="btnWhoPass">забыли пароль</a>
            </form>
        </div>

        <?		
        }
        else
        {
        	
        	$uid = f_data($_COOKIE[uid],'text',0);
        	$result = mysql_query("SELECT * FROM users WHERE uid='$uid'");
        	$myrow = mysql_fetch_assoc($result); 
        		
        ?>
        <div id="forma_user">
        	<b><? echo $myrow[fio]; ?></b><br>
            <? echo $myrow[mail]; ?><br>
            <a href="/cabinet/" style="color:#333; display:block; padding:3px; font-size:13px">кабинет</a>
        </div>
        <?
        }
        ?>
        
    </div>
    
    
  

</div>