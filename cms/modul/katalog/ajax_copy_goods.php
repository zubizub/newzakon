<?php

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");


if ($_POST[url_goods])
{
	
	$url_goods = $_POST[url_goods];
	$urlfolder_to = $_POST[urlfolder_to];
	$url_goods = f_data ($url_goods, 'text', 0);
	$urlfolder_to = f_data ($urlfolder_to, 'text', 0);
    
    set_logs("Каталог","Копирование товара","из $url_goods в $urlfolder_to");
    
	
	$url_goods = explode(",",$url_goods);
	
	for ($i=0;$i<count($url_goods);$i++)
	{
		$where_sql .= "id='$url_goods[$i]' || ";
	}
	
	$where_sql = substr($where_sql,0,-4);
	
	
    //смотрим последний номер порядковый
    $result_number = mysql_query("SELECT * FROM goods WHERE url='$urlfolder_to' ORDER BY number DESC LIMIT 1");
	$myrow_number = mysql_fetch_assoc($result_number); 
    $number_last = $myrow_number[number];
    
	$result = mysql_query("SELECT * FROM goods WHERE $where_sql");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);

	if ($num_rows!=0)
	{
		do
		{
			//$result_edit = mysql_query("UPDATE goods SET url='$urlfolder_to' WHERE id='$myrow[id]'", $db);
           $number_last++;
           
           
           $result_add = mysql_query ("INSERT INTO goods (name,art,date,text,form,form_position,enabled,m_title,m_description,m_keywords,m_link,number,url,price1,price2,har,presence,firm,sale,weight,width,height,length,razmer,stamp,curent,text_small,with_item,count) 
           VALUES ('$myrow[name]','$myrow[art]','$myrow[date]','$myrow[text]','$myrow[form]','$myrow[form_position]','$myrow[enabled]','$myrow[m_title]','$myrow[m_description]','$myrow[m_keywords]','$myrow[m_link]','$number_last','$urlfolder_to','$myrow[price1]','$myrow[price2]','$myrow[har]','$myrow[presence]','$myrow[firm]','$myrow[sale]','$myrow[weight]','$myrow[width]','$myrow[height]','$myrow[length]','$myrow[razmer]','$myrow[stamp]','$myrow[curent]','$myrow[text_small]','$myrow[with_item]','$myrow[count]')");
           
           $date = date("d.m.Y H:i");
           $ext = substr($myrow[img], 1 + strrpos($myrow[img], ".")); // расширение файла	
		   $img_name = md5($myrow[name].$date.rand(1111,999999)).".$ext";
        	
           $result_new_goods = mysql_query("SELECT * FROM goods WHERE url='$urlfolder_to' ORDER BY id DESC LIMIT 1");
	       $myrow_new_goods = mysql_fetch_assoc($result_new_goods); 
           $id = $myrow_new_goods[id]; 
           
           if ($myrow[img]!='')
           {
               copy("upload/img/$myrow[img]", "upload/img/".$img_name);
               copy("upload/img/mimi_$myrow[img]", "upload/img/mimi_$img_name");
               $result_edit = mysql_query("UPDATE goods SET img='$img_name' WHERE id='$id'", $db);  
           }
           
           
           
           $name_folder = $id;
           @mkdir ("upload/files/$name_folder", 0755);
           @chmod("upload/files/$name_folder", 0755);
           $new_folder = "upload/files/$name_folder";
           
           @$dir = "upload/files/$myrow[id]";
           $old_folder = "upload/files/$myrow[id]";
           @$files_img = scandir($dir);    
           $j=0;
           $x=0;
           $y=0;
                       
           for ($i=0;$i<=30;$i++)
           {
            	if ($files_img[$i]!='' && $files_img[$i]!='.' && $files_img[$i]!='..' && $files_img[$i]!="Thumbs.db") 
            	{
            		copy("$old_folder/$files_img[$i]", "$new_folder/$files_img[$i]");
            	}
           } 
                        
		}while($myrow = mysql_fetch_assoc($result));
	}
	
}




?>