
<?

//вперед назад по товарам, показывает предыдущий товар и следующий в карточке товара


$result = mysql_query("SELECT * FROM goods WHERE enabled='1' && url='$url_g' && id>'$id_g' LIMIT 1");
$myrow = mysql_fetch_assoc($result); 
$m_link = explode("/",$myrow[m_link]);
$m_link = $m_link[(count($m_link)-1)];


if ($myrow[name]!='')
{
$back_g = "
<a href='/goods/$myrow[id]/$m_link/' rel='nofollow' style='font-size:14px; text-decoration:none; color:#333'><b>< $myrow[name]</b></a>
";
}

$result = mysql_query("SELECT * FROM goods WHERE enabled='1' && url='$url_g' && id<'$id_g' ORDER BY id DESC LIMIT 1");
$myrow = mysql_fetch_assoc($result); 
$m_link = explode("/",$myrow[m_link]);
$m_link = $m_link[(count($m_link)-1)];


if ($myrow[name]!='')
{
$next_g = "
<a href='/goods/$myrow[id]/$m_link/' rel='nofollow' style='font-size:14px; text-decoration:none; color:#333'><b>$myrow[name] ></b></a>
";
}
?>


<table width="100%" border="0">
  <tr>
    <td style="text-align:left">
        <? echo $back_g; ?>
    </td>
    <td style="text-align:right">
    	<? echo $next_g; ?>
    </td>
  </tr>
</table>
<br><br>
