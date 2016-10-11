<?

//обработка товара, который отнесен к другой категории

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

set_logs(" аталог","“овар в других категори€х",$id_goods);

$id_goods = f_data ($_POST[id_goods], 'text', 0);
$id_katalog_url = f_data ($_POST[id_katalog_url], 'text', 0);


if (isset($_POST[del]))
{
    $result = mysql_query("SELECT * FROM goods WHERE id='$id_goods' ORDER BY id DESC");
    $myrow = mysql_fetch_assoc($result); 
    $url_any = $myrow[url_any];
    if ($url_any!=",$id_katalog_url")
    {
       $url_any = str_replace(",$id_katalog_url","",$url_any); 
    }
    else
    {
        $url_any = str_replace("$id_katalog_url","",$url_any); 
    }


    $result_edit = mysql_query("UPDATE goods SET url_any='$url_any' WHERE id='$id_goods'", $db);
}


if (isset($_POST[add]))
{
    $result = mysql_query("SELECT * FROM goods WHERE id='$id_goods' ORDER BY id DESC");
    $myrow = mysql_fetch_assoc($result); 
    $url_any = $myrow[url_any];
    
    if (substr_count($url_any,",$id_katalog_url")==0)
    {
        if ($url_any!=',')
        {
             $url_any = $url_any.",$id_katalog_url";
        }
        else
        {
            $url_any = ",$id_katalog_url";
        }
    }
    
    $result_edit = mysql_query("UPDATE goods SET url_any='$url_any' WHERE id='$id_goods'", $db);
    
}


?>