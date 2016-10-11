<Br>
<? 

$url_cat = f_data ($_GET[url], 'text', 0);
$url_cat = str_replace("-","/",$url_cat);
//$url_cat = explode("-",$url_cat);
//$url_cat = $url_cat[count($url_cat)-1];
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="link_all_topics">
            <?
                $result_topick = mysql_query("SELECT * FROM pages WHERE url='$url_cat' ORDER BY name ASC");
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
        </div>
    </div>
</div>


<?
$url_cat = explode("/",$url_cat);

$result_fm = mysql_query("SELECT * FROM folder_materials WHERE id = '$url_cat[1]'");
$myrow_fm = mysql_fetch_assoc($result_fm); 
$num_rows_fm = mysql_num_rows($result_fm);
echo $myrow_fm[text];


?>