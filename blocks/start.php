<?
	ob_start();
    
    /*Конфигурация*/
    
	$ROOT_DIR = __DIR__;
    date_default_timezone_set('Europe/Moscow');
    $adapt = 1; // адаптивность
    

	include("blocks/db.php");
	include("blocks/f_data.php");
    include("mailto.php");
    
	//Переадресация (редиректы)
	$main_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	
	$result = mysql_query("SELECT * FROM pereadresat WHERE url='$main_url'");
	if (mysql_num_rows($result)!=0)
	{
		$myrow = mysql_fetch_assoc($result);
		header("HTTP/1.1 301 Moved Permanently");
		Header("location:http://$myrow[url_to]");	
		exit;		
	}
	
	
	//если не существует объекта или он был удален
	include("blocks/404error.php");
	
	//если переименовали товар (изменили m_link)
	if ($_GET[page]=='goods')
	{
		$name = f_data ($_GET[name], 'text', 0);
		$id = f_data ($_GET[id], 'text', 0);
		
		$result = mysql_query("SELECT * FROM goods WHERE id='$id'");
		$myrow = mysql_fetch_assoc($result); 
		if ($name!=$myrow[m_link])
		{
			header("HTTP/1.1 301 Moved Permanently");
			Header("location:/goods/$id/$myrow[m_link]/");	
			exit;
		}
	}
	 	
	
	//////////////////////статистика/////////////////////////////////////
	//если пользователь зашел первый раз на сайт
	$md5_user = substr(md5(date("H:i d.m.Y").rand(11111,99999)),0,20);
	if (!isset($_COOKIE[user]))  {setcookie("user",$md5_user,  time() + 100000, "/"); $enter_new_user=1;}
	
	
	if ($enter_new_user==1) 
	{
		include("blocks/ftn.php");
		if (isBot()==false)
		{
			$ip = $_SERVER["REMOTE_ADDR"];
			$date = date("d.m.Y");
			$result_add = mysql_query ("INSERT INTO stat_vizit (ip,date) VALUES ('$ip','$date')");
		}
	}
	///////////////////////////////////////////////////////////////////////
	
	$result_config = mysql_query("SELECT * FROM settings");
	$SETTINGS = mysql_fetch_assoc($result_config); 

	$status_user = 0; //статус юзера
	
	if (isset($_COOKIE[uid]))
	{
		$uid = f_data ($_COOKIE[uid], 'text', 0);
		$token = f_data ($_COOKIE[token], 'text', 0);		
		$result = mysql_query("SELECT * FROM users WHERE uid='$uid' && token='$token'");
		$guest=0;
		
		if (mysql_num_rows($result)!=0) 
		{
			$myrow = mysql_fetch_assoc($result);
			$user_enter=1;
			$USER[1]=$myrow[fio];
			$USER[2]=$myrow[mail];
			$USER[3]=$myrow[phone];
			$USERARR = $myrow;
			if ($myrow[status]=="Администратор" || $myrow[status]=="Модератор") {$status_user=1;}
            if ($USERARR[u_status]!='') {$urist = 1;}
		}
		else
		{
			setcookie("uid",'');
			setcookie("token",'');
			$user_enter=0;	
		}
	}
	else
	{
		if (!isset($_COOKIE[uid_cart]))
		{
			$uid = md5(date("d.m.Y H:i")."eurosites".rand(1111,9999999));
			setcookie('uid_cart', $uid, time()+(30*24*3600), '/');
		}
		else
		{
			$uid = $_COOKIE[uid_cart];
		}
		
		$guest=1;		
	}
	
	
	
	
	//преобразование стоимости
	function price_convert($price)
	{
		if ($price>=1000 && $price<10000) //1 000
		{
			$price.="";
			$price = $price[0]." ".$price[1].$price[2].$price[3];
		}
		elseif ($price>=10000 && $price<100000) //10 000
		{
			$price.="";
			$price = $price[0].$price[1]." ".$price[2].$price[3].$price[4];
		}
		elseif ($price>=100000 && $price<1000000) //100 000
		{
			$price.="";
			$price = $price[0].$price[1].$price[2]." ".$price[3].$price[4].$price[5];
		}
		
		return $price;
	}
	
	
	//источник перехода на сайт (директ, авито и т.п.)
	if (isset($_GET[advert]))
	{
		$advert = f_data ($_GET[advert], 'text', 0);
		setcookie("advert",$advert, time()+(30*24*3600), '/');
	}
	
	
	//расшифровка данных для Робокассы (creat_pass($pass) и get_pass($pass))
	include("cms/modul/settings/shifr_pass.php");
	
	
	//Генератор динамических форм
	function show_gen_form($id_form)
	{
		if ($id_form!='' && $id_form!=0)
		{
			$result_f = mysql_query("SELECT * FROM forms WHERE id='$id_form'");
			$myrow_f = mysql_fetch_assoc($result_f); 
			$forma = str_replace("удалить", "", "$myrow_f[forma]");
			
			echo "<form action='/blocks/obr_form.php' method='post'>
			<div id='form_preview' class='$myrow_f[palitra]'>
		    <div class='form_preview_head'>$myrow_f[f_title]</div>
		    <div class='pole_editor'>$forma</div>
		    <div style='text-align:right; position:relative'>
		        <input name='reset' type='button' value='очистить' class='button_cancel aaa'> 
		        <input name='button' type='submit' value='отправить' class='button_save'>
				<div style='position:absolute; top:15px; left:5px; color:#F00; font-size:10px'>* - обязательное поле для заполнения</div>  
		    </div>
		    <input type='hidden' name='id' value='$id_form'>
			</div></form>";			
		}
	}
	
    
    
    function newMsg()
    {
        $result_sms = mysql_query("SELECT * FROM sms_user WHERE uid_to='$_COOKIE[uid]' && prochitano='0'");
        $num_rows_sms = mysql_num_rows($result_sms);
        return $num_rows_sms;
	}
    
    function newOtklik()
    {
        $result_otklik = mysql_query("SELECT * FROM otklik WHERE neprochitan='0' && idz IN (SELECT id FROM zadaniy WHERE uid='$_COOKIE[uid]')");
        $num_rows_otklik = mysql_num_rows($result_otklik);
        return $num_rows_otklik;
	}
    
    $numUvedomlen = '';
    $numUvedomlen = newMsg()+newOtklik();
    if ($numUvedomlen!='')
    {
        $numUvedomlen = "<span class='numUvedomlen' title='новых уведомлений'>$numUvedomlen</span>";
    }
    
?>