<?php 

	//подключение файлов в зависимости от раздела
	
	if (isset($_GET['page']) && trim($_GET['page']) != "")
	{
		$page = $_GET['page'];
		
		if ($page == 'o-nas') {include("blocks/about.php"); $ok = 1;}
		if ($page == 'news') {include("blocks/news.php"); $ok = 1;}
		if ($page == 'news_inf') {include("blocks/news_inf.php"); $ok = 1;}
		if ($page == 'galery' && !isset($_GET[id])) {include("blocks/galery.php"); $ok = 1;}
		if ($page == 'galery' && isset($_GET[id])) {include("blocks/galery_inf.php"); $ok = 1;}
		
        if ($page == 'article' || $include_type=='article') {include("blocks/article.php"); $ok = 1;}
        
        if ($page == 'podtverdit') {include("blocks/podtverdit.php"); $ok = 1;}
		if ($page == 'feedback') {include("blocks/feedback.php"); $ok = 1;}
		if ($page == 'vopros_otvet') {include("blocks/vopros_otvet.php"); $ok = 1;}
		if ($page == 'otziv') {include("blocks/otziv.php"); $ok = 1;}
		if ($page == 'katalog') {include("blocks/katalog.php"); $ok = 1;}
		if ($page == 'goods') {include("blocks/goods.php");	$ok = 1;}
		if ($page == 'firm') {include("blocks/firm.php"); $ok = 1;}
		if ($page == 'zayvka') {include("blocks/zayvka.php"); $ok = 1;}
		if ($page == 'carts') {include("blocks/carts.php"); $ok = 1;}
		if ($page == 'search') {include("blocks/search.php"); $ok = 1;}
		if ($page == 'pay') {include("blocks/pay.php"); $ok = 1;}		
		if ($page == 'pages' && (!isset($_GET['id']))) {include("blocks/pages.php"); $ok = 1;}
		if ($page == 'who_pass') {include("blocks/who_pass.php"); $ok = 1;}
		if ($page == 'reg') {include("blocks/reg.php"); $ok = 1;}
		if ($page == 'reg_ok') {include("blocks/reg_ok.php"); $ok = 1;}
		if ($page == 'kontakty') {include("blocks/contacts.php"); $ok = 1;}
		if ($page == 'buy') {include("blocks/buy.php"); $ok = 1;}
		if ($page == 'zayvka2') {include("blocks/zayvka2.php"); $ok = 1;}
		if ($page == 'inform') {include("blocks/inform.php"); $ok = 1;}
		if ($page == 'enter') {include("blocks/enter.php"); $ok = 1;}
		if ($page == 'oformit_zakaz') {include("blocks/oformit_zakaz.php"); $ok = 1;}
		if ($page == 'podzakaz') {include("blocks/podzakaz.php"); $ok = 1;}
		if ($page == 'favorites') {include("blocks/favorites.php"); $ok = 1;}
		if ($page == 'blog') {include("blocks/blog.php"); $ok = 1;}
		if ($page == 'inf_zakaz') {include("blocks/inf_zakaz.php"); $ok = 1;}
		if ($page == 'pay_old_zakaz') {include("blocks/pay_old_zakaz.php"); $ok = 1;}
		if ($page == 'new_zadanie') {include("blocks/new_zadanie.php"); $ok = 1;}
		if ($page == 'new_order') {include("blocks/new_order.php"); $ok = 1;}
        if ($page == 'new_question') {include("blocks/new_question.php"); $ok = 1;}
        if ($page == 'question') {include("blocks/question.php"); $ok = 1;}
        if ($page == 'zadaniy') {include("blocks/zadaniy.php"); $ok = 1;}
        if ($page == 'zadaniy_inf') {include("blocks/zadaniy_inf.php"); $ok = 1;}
        if ($page == 'urmarket') {include("blocks/urmarket.php"); $ok = 1;}
        if ($page == 'userinf') {include("blocks/userinf.php"); $ok = 1;}
        if ($page == 'goldstatus') {include("blocks/goldstatus.php"); $ok = 1;}
        
        if ($page == 'faq') {include("blocks/faq.php"); $ok = 1;}
        
        if ($page == 'urists') {include("blocks/urists.php"); $ok = 1;}
        if ($page == 'docs') {include("blocks/docs.php"); $ok = 1;}
        if ($page == 'regpeople') {include("blocks/regpeople.php"); $ok = 1;}
        if ($page == 'topic') {include("blocks/topic.php"); $ok = 1;}
        
        if ($page == 'topics') {
            if (!isset($_GET[name]))
            {
                include("blocks/topics_all.php"); 
            }
            else
            {
               include("blocks/topics.php"); 
            }
            
            $ok = 1;
        }
        
        if ($page == 'im') {if ($user_enter==1) {include("blocks/im.php"); $ok = 1;}}
        
		if ($page == 'cabinet')
		{
			if ($user_enter==1)
			{
				include("blocks/cabinet.php"); $ok = 1;
			}
			else
			{
				include("blocks/error.php");	
				$ok = 1;
			}
		}
	
		
		if ($ok == 0)
		{
			
			$id = f_data($_GET['id'],'text',0);	
			$page = f_data($_GET['page'],'text',0);			
			$res_main = mysql_query("SELECT * FROM pages where id='$id' || m_link='$page'",$db);
			$myrow = mysql_fetch_assoc($res_main); 
            
            
            
			if (mysql_num_rows($res_main)!=0)
			{
                if ($myrow[url] == '76/77' || $myrow[url] == '76/78' || $myrow[url] == '76/79' || $myrow[url] == '76/80') 
                {
                    include("blocks/faq.php"); 
                }
                else
                {
                    include("blocks/page.php");
                }
				
			}
			else
			{
				ob_end_clean();
				//header("HTTP/1.1 301 Moved Permanently");
				//header("location:/");

				header("HTTP/1.0 404 Not Found");
				header('Status: 404 Not Found');
				include("error404.php");
				exit;	
			}
		}
	}
	else
	{
		include("blocks/main.php");
		
	}
?>

