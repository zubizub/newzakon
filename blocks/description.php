<?php 
	
	// meta-данные страницы и имя страницы
	
	$description = ""; // описание страницы
	$keywords = "";	   // ключевые слова страницы
	$name_page = "";   // имя страницы H1
	$page_text = 0;    //определяет текстовая ли страница или нет	
	$block_edit_meta = 0; //запрет на изменение страницы	
	$ARR_HISTORY = array(); // массив для хлебных крошек
	$ARR_HISTOR[0] = "<a itemprop='item' href='/'><span itemprop='name'>Главная</span></a>";
    		
	if (isset($_GET['page']) && trim($_GET['page']) != "")
	{
		$page = f_data ($_GET['page'], 'text', 0);
			
		if ($page == 'feedback') {$name_page = "Обратная связь";  $title = "Обратная связь"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
        if ($page == 'podtverdit') {$name_page = "Подтверждение вопроса";  $title = "Подтверждение вопроса"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'vopros_otvet') {$name_page = "Вопрос-ответ"; $title = "Вопрос-ответ"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'otziv') {$name_page = "Отзывы"; $title = "Отзывы"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'zayvka') {$name_page = "Оформление заявки"; $title = "Оформление заявки"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'carts') {$name_page = "Корзина"; $title = "Корзина"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'search') {$name_page = "Поиск"; $title = "Поиск"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'pay') {$name_page = ""; $title = "Оплата"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'who_pass') {$name_page = "Восстановление пароля"; $title = "Восстановление пароля"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'reg') {$name_page = "Регистрация"; $title = "Регистрация"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'buy') {$name_page = "Купить в один клик"; $title = "Купить в один клик"; $page_text=1; $chpu = 1; $block_edit_meta=1;}	
		if ($page == 'zayvka2') {$name_page = "Заявка"; $title = "Заявка"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'enter') {$name_page = "Авторизация"; $title = "Авторизация"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'oformit_zakaz') {$name_page = "Оформление заказа"; $title = "Оформление заказа"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'podzakaz') {$name_page = "Оформление предзаказа"; $title = "Оформление предзаказа"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'favorites') {$name_page = "Избранные товары"; $title = "Избранные товары"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'blog') {$name_page = "Блог"; $title = "Блог"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'reg_ok') {$name_page = "Подтверждение регистрации"; $title = "Подтверждение регистрации"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
		if ($page == 'pay_old_zakaz') {$name_page = ""; $title = "Оплата заказа"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
        if ($page == 'new_zadanie') {$name_page = "Новое задание"; $title = "Новое задание"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
        if ($page == 'new_question') {$name_page = "Задать вопрос"; $title = "Задать вопрос"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
        if ($page == 'goldstatus') {$name_page = "Золотой статус"; $title = "Золотой статус"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
        
        if ($page== 'new_order') { 
			    $result_cat = mysql_query("SELECT * FROM pages WHERE m_link = '".$_GET['name']."'");
                $myrow_cat = mysql_fetch_assoc($result_cat); 
                $name_page = str_replace('Консультация', 'Услуги', $myrow_cat['h1']);
                //print_r($myrow_cat);
        $name_page = $name_page; $title = $name_page; $page_text=1; $chpu = 1; $block_edit_meta=1;
    	}

        if ($page == 'userinf') 
        {
            $uid = f_data ($_GET[uid], 'text', 0);
            $result = mysql_query("SELECT * FROM users WHERE uid='$uid'");
            $myrow = mysql_fetch_assoc($result);
                
            if ($myrow[u_status]=='')
            {
                $name_page = "Информация о пользователе"; 
                $title = "Информация о пользователе";
            }
            else
            {
                $name_page = "Информация об исполнителе"; 
                $title = "Информация об исполнителе";  
            }
            
            
            $page_text=1; $chpu = 1; $block_edit_meta=1;
        }
        
        if ($page == 'urists') {$name_page = "Юристы"; $title = "Юристы"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
        if ($page == 'docs') {$name_page = "Документы"; $title = "Документы"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
        if ($page == 'regpeople') {$name_page = "Регистрация"; $title = "Регистрация"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
        
        
        if ($page == 'question') 
        {
            $name_v = f_data($_GET['name_v'],'text',0);
            $result_m = mysql_query("SELECT * FROM vopros WHERE name_m='$name_v'");
            $myrow_m = mysql_fetch_assoc($result_m); 
            $num_rows_m = mysql_num_rows($result_m);
            
            $name_page = $myrow_m[name]; 
            $title = $myrow_m[name]; 
            $page_text=1; 
            $chpu = 1; 
            $block_edit_meta=1;
        }
        
        if ($page == 'zadaniy') {$name_page = "Список заданий"; $title = "Список заданий"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
        if ($page == 'faq') {$name_page = "Справочное руководство"; $title = "Справочное руководство"; $page_text=1; $chpu = 1; $block_edit_meta=1;}
        
        if ($page == 'topic') 
        {
            $url_cat = f_data ($_GET[url], 'text', 0);
            $url_cat = explode("-",$url_cat);
            $url_cat = $url_cat[count($url_cat)-1];
            $result_name_cat = mysql_query("SELECT * FROM folder_materials WHERE id='$url_cat'");
		    $myrow_name_cat = mysql_fetch_array($result_name_cat); 
		    $name_cat = $myrow_name_cat[name];
            $name_page = "$name_cat"; 
            $title = "$name_cat"; 
            $page_text=1; $chpu = 1; 
            $block_edit_meta=1;
        }
        
        if ($page == 'topics') {
            if (!isset($_GET[name]))
            {
                $name_page = "Темы"; 
                $title = "Темы"; 
                $page_text=1; 
                $chpu = 1; 
                $block_edit_meta=1;
            }
            else
            {
    			$name_page = f_data ($_GET[name], 'text', 0);
    
    			$result_m = mysql_query("SELECT * FROM pages WHERE m_link='$name_page'");
    			$myrow_m = mysql_fetch_array($result_m); 

    			if (substr_count($myrow_m[url],"/")!=0) 
    			{
                    $id_cat = explode("/",$myrow_m[url]); 
                    $id_cat = $id_cat[count($id_cat)-1];
                } 
                else 
                {
                    $id_cat = $myrow_m[url];
                }
                 
                $ARR_HISTOR[1] = "<a itemprop='item' href='/topics/'><span itemprop='name'>Темы</span></a>";
                 
    			$result_name_cat = mysql_query("SELECT * FROM folder_materials WHERE id='$id_cat'");
    			$myrow_name_cat = mysql_fetch_array($result_name_cat); 
    			$name_cat = $myrow_name_cat[name];
                
                $new_url = $myrow_m[url];
                $cat_id = $myrow_m[url];
                $cat_id = explode("/", $myrow_m[url]);
                $new_url = str_replace("/","-",$new_url);
                $ARR_HISTOR[2] = "<a itemprop='item' href='/topic/$new_url/'><span itemprop='name'>$name_cat</span></a>";

    			if ($myrow_m[h1]!='') {$name_page = $myrow_m[h1];} else {$name_page = $myrow_m[name];}
                $name_page_for_vopros = $myrow_m[name];
    			$title = $myrow_m[m_title];
    			$description = $myrow_m[m_description];
    			$keywords = $myrow_m[m_keywords];
    			$chpu = 0; 
    			$m_link = $myrow_m[m_link]; 
    			$tbl = "pages";
    			$tbl_where = "id='$myrow_m[id]'";
                
                if ($myrow_m[url] == '76/77' || $myrow_m[url] == '76/78' || $myrow_m[url] == '76/79' || $myrow_m[url] == '76/80') 
                {
                    //$typePage="faq";
                }
            }
            $page_text=1; 
            //var_dump($ARR_HISTOR);
            $ok = 1;
        }
        
        
        if ($page == 'zadaniy_inf') 
        {
            $idz = f_data ($_GET['id'], 'text', 0);
            $result_u = mysql_query("SELECT * FROM zadaniy WHERE id='$idz'");
	        $myrow_u = mysql_fetch_assoc($result_u);
            
            $name_page = "Задание: $myrow_u[name]"; 
            $title = "Задание: $myrow_u[name]"; 
            $page_text=1; 
            $chpu = 1; 
            $block_edit_meta=1;
        }
        
        
		if ($page == 'im') 
        {
            $from = f_data ($_GET['from'], 'text', 0);
            $result_u = mysql_query("SELECT * FROM users WHERE uid='$from'");
	        $myrow_u = mysql_fetch_assoc($result_u);

            $name_page = "Диалог с $myrow_u[fio]"; 
            $title = "Диалог с $myrow_u[fio]"; 
            $page_text=1; 
            $chpu = 1; 
            $block_edit_meta=1;
            $ARR_HISTOR[1] = "<a itemprop='item' href='/cabinet/'><span itemprop='name'>Кабинет</span></a>";
        }
		
        
		if ($page == 'inf_zakaz') {
			$id_z = f_data ($_GET[id], 'text', 0);
			$name_page = "Информация о заказе № $id_z"; $title = "Информация о заказе"; $page_text=1; $chpu = 1; $block_edit_meta=1;
		}
		
		
		if ($page == 'o-nas') {
			$result_m = mysql_query("SELECT * FROM pages WHERE id='2'");
			$myrow_m = mysql_fetch_array($result_m); 

			$name_page = $myrow_m[name]; 
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];	
			$chpu = 1; //запрещено редактировать
			$page_text=1;
			$tbl = "pages";
			$tbl_where = "id='$myrow_m[id]'";
		}


		if ($page == 'kontakty') {
			$result_m = mysql_query("SELECT * FROM pages WHERE id='3'");
			$myrow_m = mysql_fetch_array($result_m); 
			
			$name_page = $myrow_m[name]; 
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];
			$chpu = 1; //запрещено редактировать	
			$page_text=1;
			$tbl = "pages";
			$tbl_where = "id='$myrow_m[id]'";		
		}
		
				
		if ($page == 'news') {
			$result_m = mysql_query("SELECT * FROM meta_other WHERE page='news'");
			$myrow_m = mysql_fetch_array($result_m); 
			 
			$name_page = $myrow_m[m_name];
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];
			$chpu = 1; //запрещено редактировать
			$page_text=1;
			$tbl = "meta_other";
			$tbl_where = "page='news'";
		}
		
		if ($page == 'news_inf') {
			$result_m = mysql_query("SELECT * FROM meta_other WHERE page='news'");
			$myrow_m = mysql_fetch_array($result_m); 
			$name_cat = $myrow_m[m_name];
				
			$id = f_data($_GET[id],'text',0);		
			$result_m = mysql_query("SELECT * FROM news WHERE id='$id'");
			$myrow_m = mysql_fetch_array($result_m); 
			 
			$name_page = $name_page.$myrow_m[name];  
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];	
			
            $ARR_HISTOR[1] = "<a itemprop='item' href='/news/'><span itemprop='name'>$name_cat</span></a>";
			$page_text=1;	
			$tbl = "news";
			$tbl_where = "id='$myrow_m[id]'";
			$m_link = $myrow_m[m_link];
		}
		
		
		if ($page == 'galery' && !isset($_GET[id])) {
			$result_m = mysql_query("SELECT * FROM meta_other WHERE page='galery'");
			$myrow_m = mysql_fetch_array($result_m); 
			 
			$name_page = $myrow_m[m_name];
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];		
			$page_text=1;	
			$chpu = 1; //запрещено редактировать
			$tbl = "meta_other";
			$tbl_where = "page='galery'";
		}
		
		if ($page == 'galery' && isset($_GET[id])) {
			$id = f_data($_GET[id],'text',0);
			$result_m = mysql_query("SELECT * FROM galery_cat WHERE id='$id'");
			$myrow_m = mysql_fetch_array($result_m); 
			
			$name_page = $myrow_m[name]; 
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];
			
            $ARR_HISTOR[1] = "<a itemprop='item' href='/galery/'><span itemprop='name'>Галерея</span></a>";
			$page_text=1;
			$tbl = "galery_cat";
			$tbl_where = "id='$myrow_m[id]'";
		}
		
		if ($page == 'article') {
			$url = f_data($_GET[url],'text',0);
			$result_m = mysql_query("SELECT * FROM folder_materials WHERE id='$url'");
			$myrow_m = mysql_fetch_array($result_m); 
			
			$name_page = $myrow_m[name]; 
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];	
			$page_text=1;
			$chpu = 1; //запрещено редактировать
			$tbl = "folder_materials";
			$tbl_where = "id='$url'";
		}
		
	
		if ($page == 'inform') {
			$url = f_data($_GET[url],'text',0);
			$result_m = mysql_query("SELECT * FROM folder_materials WHERE id='$url'");
			$myrow_m = mysql_fetch_array($result_m); 
			
			$name_page = $myrow_m[name]; 
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];	
			$page_text=1;
			$tbl = "folder_materials";
			$tbl_where = "id='$url'";			
		}	
	
				
		if ($page == 'katalog' && !isset($_GET[url])) {
			$result_m = mysql_query("SELECT * FROM meta_other WHERE page='katalog'");
			$myrow_m = mysql_fetch_array($result_m); 
			
			$name_page = $myrow_m[m_name]; 
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];	
			$page_text=1;
			$chpu = 1; //запрещено редактировать
			$tbl = "meta_other";
			$tbl_where = "page='katalog'";
		}
		
		
		if ($page == 'katalog' && isset($_GET[url])) {
			$url = f_data($_GET[url],'text',0);
			$url_new = f_data($_GET[url],'text',0);
			$url_new = explode("-",$url_new);
			
			$where_zapr = $url_new[count($url_new)-1];
			$result_m = mysql_query("SELECT * FROM katalog WHERE id='$where_zapr'");
			$myrow_m = mysql_fetch_array($result_m); 
			
			if (isset($_GET[url])) 
			{
				$history = $_GET[url];
				$url = str_replace("-", "/", "$url");
				$where_url = "WHERE url='$url'";
				if (substr_count($history,"-")>0)
				{
					$history = explode("-",$history);
					$ARR_HISTOR[1] = "<a itemprop='item' href='/katalog/'><span itemprop='name'>Каталог</span></a>";	
					for ($i=0; $i<count($history); $i++)
					{
						$result = mysql_query("SELECT * FROM katalog WHERE id='$history[$i]'");
						$myrow = mysql_fetch_assoc($result); 	
						$num_rows = mysql_num_rows($result);
						if ($myrow[url]!="") {$new_url1 = str_replace("/", "-", "$myrow[url]") ; $back_url = "$new_url1-$myrow[id]";} 
						else {$back_url = "$myrow[id]";}
                        //$ARR_HISTOR[$i+2] = "<a itemprop='item' href='/katalog/$back_url/'><span itemprop='name'>$myrow[name]</span></a>";
                        if($back_url!=$_GET[url]){
                            $ARR_HISTOR[$i+2] = "<a itemprop='item' href='/katalog/$back_url/'><span itemprop='name'>$myrow[name]</span></a>";	
                        }	
					}
						
					$text = $myrow[text];	
				}
				else
				{
					$result = mysql_query("SELECT * FROM katalog WHERE id='$url'");
					$myrow = mysql_fetch_assoc($result); 
					$num_rows = mysql_num_rows($result);
                    $ARR_HISTOR[1] = "<a itemprop='item' href='/katalog/'><span itemprop='name'>Каталог</span></a>";
					$text = $myrow[text];				
				}
			}
			else
			{
				$where_url = "WHERE url='' && enabled='1'";
			}
						
			if ($num_rows==0)
			{
				header("HTTP/1.0 404 Not Found");
				header('Status: 404 Not Found');
				include("error404.php");
				exit;	
			}
			
			$name_page = $myrow_m[name];
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];
			$page_text=1;
			$chpu = 1; //запрещено редактировать
			$tbl = "katalog";
			$tbl_where = "id='$where_zapr'";
		}
		
		
		
		
		if ($page == 'goods') {
			$id = f_data($_GET[id],'text',0);
			$result_m = mysql_query("SELECT * FROM goods WHERE id='$id'");
			$myrow_m = mysql_fetch_array($result_m); 
			
			
			$name_page = $myrow_m[name]; 
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];
			
			
				////////////история
				
				$history = $myrow_m[url];
				$goods_url = $myrow_m[url];
				$url = str_replace("/", "-", "$myrow_m[url]");
				$goods_url = str_replace("/", "-", "$myrow_m[url]");
				//echo $goods_url;
				if (substr_count($url,"-")>0)
				{
					$history = explode("-",$url);
					$ARR_HISTOR[1] = "<a itemprop='item' href='/katalog/'><span itemprop='name'>Каталог</span></a>";
                    
					for ($i=0; $i<count($history); $i++)
					{
						$result_k = mysql_query("SELECT * FROM katalog WHERE id='$history[$i]'");
						$myrow_k = mysql_fetch_assoc($result_k); 	
						if ($myrow_k[url]!="") {$new_url1 = str_replace("/", "-", "$myrow_k[url]") ; 
						$back_url = "$new_url1-$myrow_k[id]";} else {$back_url = "$myrow_k[id]";}	
						if ($i!=(count($history)-1)) {$img_strelka=" <img src='/img/strelka_histor.png' height='11'> ";} else {$img_strelka="";}
						$new_history .= "<a href='/katalog/$back_url/' rel='nofollow'>$myrow_k[name]</a> $img_strelka ";
                        $ARR_HISTOR[$i+2] = "<a itemprop='item' href='/katalog/$back_url/'><span itemprop='name'>$myrow_k[name]</span></a>";
						$for_title_cat = $myrow_k[name]; //название последней категории
						$for_title_allcat .= $myrow_k[name]." > "; //название всех категорий
					}
					$for_title_allcat = substr($for_title_allcat,0,-3);
				}
				else
				{
					$result_k = mysql_query("SELECT * FROM katalog WHERE id='$myrow_m[url]'");
					$myrow_k = mysql_fetch_assoc($result_k); 
                    
                    $ARR_HISTOR[1] = "<a itemprop='item' href='/katalog/'><span itemprop='name'>Каталог</span></a>";
                    $ARR_HISTOR[2] = "<a itemprop='item' href='/katalog/$myrow_m[url]/'><span itemprop='name'>$myrow_k[name]</span></a>";
					
					$for_title_cat = $myrow_k[name]; 	
					$for_title_allcat .= $myrow_k[name]." > "; //название всех категорий
					$for_title_allcat = substr($for_title_allcat,0,-3);
				}
				
				
				//формула для товаров (из внедрения) 
				if ($SETTINGS[formula_title_goods]!='') {$title = $SETTINGS[formula_title_goods];};
				
				if (substr_count($SETTINGS[formula_title_goods],"[goods]")!=0)
				{
					$title = str_replace("[goods]",$name_page,$SETTINGS[formula_title_goods]); 
					$edit_t = 1;
				}
				
				if (substr_count($SETTINGS[formula_title_goods],"[cat]")!=0)
				{
					$for_title_cat = mb_strtolower($for_title_cat, 'UTF-8');
					$title = str_replace("[cat]",$for_title_cat,$title);
					$edit_t = 1;
				}
				
				if (substr_count($SETTINGS[formula_title_goods],"[allcat]")!=0)
				{
					$for_title_allcat = mb_strtolower($for_title_allcat, 'UTF-8');
					$title = str_replace("[allcat]",$for_title_allcat,$title);
					$edit_t = 1;
				}
				
				if (substr_count($SETTINGS[formula_title_goods],"[price]")!=0)
				{
					$title = str_replace("[price]",$myrow_m[price1]." руб.",$title);
					$edit_t = 1;
				}
				
				
				//если в нижнем регистре
				if (substr_count($SETTINGS[formula_title_goods],"{goods}")!=0)
				{
					$name_page = mb_strtolower($name_page, 'UTF-8');
					if ($edit_t == 1)
					{
						$title = str_replace("{goods}",$name_page,$title);
					}
					else
					{
						$title = str_replace("{goods}",$name_page,$SETTINGS[formula_title_goods]);
					}
					 
				}
				
				if (substr_count($SETTINGS[formula_title_goods],"{cat}")!=0)
				{
					$for_title_cat = mb_strtolower($for_title_cat, 'UTF-8');
					$title = str_replace("{cat}",$for_title_cat,$title);
				}
				
				if (substr_count($SETTINGS[formula_title_goods],"{allcat}")!=0)
				{
					$for_title_allcat = mb_strtolower($for_title_allcat, 'UTF-8');
					$title = str_replace("{allcat}",$for_title_allcat,$title);
				}
				
				if (substr_count($SETTINGS[formula_title_goods],"{price}")!=0)
				{
					$title = str_replace("{price}",$myrow_m[price1]." руб.",$title);
				}
				
				////////////////////////////////////////////////////
				
				$name_page = $myrow_m[name];
				//формула для description товаров (из внедрения) 
				if ($SETTINGS[formula_desc_goods]!='') {$description = $SETTINGS[formula_desc_goods];};
				
				if (substr_count($SETTINGS[formula_desc_goods],"[goods]")!=0)
				{
					$description = str_replace("[goods]",$name_page,$SETTINGS[formula_desc_goods]); 
				}
				
				if (substr_count($SETTINGS[formula_desc_goods],"[cat]")!=0)
				{
					$description = str_replace("[cat]",$for_title_cat,$description);
				}
				
				if (substr_count($SETTINGS[formula_desc_goods],"[allcat]")!=0)
				{
					$description = str_replace("[allcat]",$for_title_allcat,$description);
				}
				
				if (substr_count($SETTINGS[formula_desc_goods],"[price]")!=0)
				{
					$description = str_replace("[price]",$myrow_m[price1]." руб.",$description);
				}
				
				
				//если в нижнем регистре
				if (substr_count($SETTINGS[formula_desc_goods],"{goods}")!=0)
				{
					$name_page = mb_strtolower($name_page, 'UTF-8');
					if ($edit_t == 1)
					{
						$description = str_replace("{goods}",$name_page,$description);
					}
					else
					{
						$description = str_replace("{goods}",$name_page,$SETTINGS[formula_desc_goods]);
					}
					 
				}
				
				if (substr_count($SETTINGS[formula_desc_goods],"{cat}")!=0)
				{
					$for_title_cat = mb_strtolower($for_title_cat, 'UTF-8');
					$description = str_replace("{cat}",$for_title_cat,$description);
				}
				
				if (substr_count($SETTINGS[formula_desc_goods],"{allcat}")!=0)
				{
					$for_title_allcat = mb_strtolower($for_title_allcat, 'UTF-8');
					$description = str_replace("{allcat}",$for_title_allcat,$description);
				}
				
				if (substr_count($SETTINGS[formula_desc_goods],"{price}")!=0)
				{
					$description = str_replace("{price}",$myrow_m[price1]." руб.",$description);
				}

				////////////////////////////////////////////////////				
				
				$page_text=1;
				$chpu = 0;
				$m_link = $myrow_m[m_link]; 
				$tbl = "goods";
				$tbl_where = "id='$id'";	
		}



		if ($page == 'cabinet')
		{
			if ($user_enter==1)
			{
				$name_page = "Кабинет пользователя";
				$title = "Кабинет пользователя";
			}
			else
			{
				//include("blocks/error.php");	
				$ok = 1;
			}
			$page_text=1;
		}
		
		if ($page == 'firm') {
			$id = f_data($_GET[id],'text',0);
			$result_m = mysql_query("SELECT * FROM firms WHERE id='$id'");
			$myrow_m = mysql_fetch_array($result_m); 
			
			$name_page = $myrow_m[name]; 
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];	
			$page_text=1;
			$chpu = 1; //запрещено редактировать
			$tbl = "firms";
			$tbl_where = "id='$id'";
		}

		
		if ($page == 'pages' || $page_text==0) {
			//$id = f_data($_GET[id],'text',0);
			$id = $_GET[id];

			if (!$_GET['id'] && $_GET['name']) {

			$result_m = mysql_query("SELECT * FROM pages WHERE m_link='$_GET[name]'");
			$row = mysql_fetch_array($result_m);
			$id = $row[id]; 

			}
			$page = f_data ($_GET[page], 'text', 0);
			
			if(!$_GET[folder]) {
			$result_m = mysql_query("SELECT * FROM pages WHERE id='$id' || m_link='$page'");
			$myrow_m = mysql_fetch_array($result_m); 

			}
			else {

			$result_m = mysql_query("SELECT * FROM folder_materials WHERE id='$id'");
			$myrow_m = mysql_fetch_array($result_m); 

			}
			
			if (substr_count("-",$myrow_m[url])!=0) 
			{$id_cat = explode("-",$myrow_m[url]); $id_cat = $id_cat[count($id_cat)-1];} else {$id_cat = $myrow_m[url];}
			
			$result_name_cat = mysql_query("SELECT * FROM folder_materials WHERE id='$id_cat'");
			$myrow_name_cat = mysql_fetch_array($result_name_cat); 
			$name_cat = $myrow_name_cat[name];

			if ($myrow_m[url]!=1 && $myrow_m[url]!=2 && $myrow_m[url]!=3) 
			{
                if ($name_cat=='faq')
                {
                    $ARR_HISTOR[1] = "<a itemprop='item' href='/faq/'><span itemprop='name'>$name_cat</span></a>";
                }
                else
                {
                    $ARR_HISTOR[1] = "<a itemprop='item' href='/article/$myrow_m[url]/'><span itemprop='name'>$name_cat</span></a>";
                }
                
            } 
			else {$history="";}
			if ($myrow_m[h1]!='') {$name_page = $myrow_m[h1];} else {$name_page = $myrow_m[name];}
			$title = $myrow_m[m_title];
			$description = $myrow_m[m_description];
			$keywords = $myrow_m[m_keywords];
			$chpu = 0; 
			$m_link = $myrow_m[m_link]; 
			$tbl = "pages";
			$tbl_where = "id='$myrow_m[id]'";
            
            if ($myrow_m[url] == '76/77' || $myrow_m[url] == '76/78' || $myrow_m[url] == '76/79' || $myrow_m[url] == '76/80') 
            {
                $typePage="faq";
            }
		}
        
        
        if (count($ARR_HISTOR)==1)
        {
            //$ARR_HISTOR['1'] = "<a itemprop='item' href='/'><span itemprop='name'>$name_page</span></a>";
        }
     
            $history = "<ol itemscope itemtype='http://schema.org/BreadcrumbList'>";
            
            for ($i=0;$i<count($ARR_HISTOR);$i++)
            {
                $history .= "
                <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'>
                $ARR_HISTOR[$i]
                <meta itemprop='position' content='".($i+1)."' />
                </li><img src='/img/strelka_histor.png' height='11'>
                ";
            }
            
            
            $history .= "
                <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'>
                <span itemprop='name'>$name_page</span>
                <meta itemprop='position' content='".($i+1)."' />
                </li>
            ";
            
            $history .= "</ol>";
       

	}
	else
	{
		$result_m = mysql_query("SELECT * FROM pages WHERE id='1'");
		$myrow_m = mysql_fetch_array($result_m); 
		
		if ($myrow_m[h1]!='') {$name_page = $myrow_m[h1];} else {$name_page = $myrow_m[name];}
		$title = $myrow_m[m_title];
		$description = $myrow_m[m_description];
		$keywords = $myrow_m[m_keywords];
		$chpu = 1; //запрещено редактировать
		$tbl = "pages";
		$tbl_where = "id='1'";
	}
	
	
	//Disabled Index
	$p_name = $_GET[page];
	if ($p_name=="search" || $p_name=="enter" || $p_name=="reg" || $p_name=="pay_old_zakaz" || $p_name=="carts" || $p_name=="zayvka" || $p_name=="feedback" || $p_name=="oformit_zakaz" ||  $p_name=="favorites" || isset($_GET[sort]) || isset($_GET[msg])) 
	{
		echo '<meta name="robots" content="noindex,nofollow" />';
	} 
    
    
    
    //канонический тег
    if (isset($_GET[sort]) && $_GET[page]=='katalog')
    {
        $url = f_data($_GET[url],'text',0);
        echo "
<link rel='canonical' href='http://$_SERVER[HTTP_HOST]/katalog/$url/'/>
";
    }

?>