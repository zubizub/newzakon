<?

// обработчик сгенерированой формы

include("db.php");
include("mailto.php");
include("../cms/blocks/f_data.php");
include("f_data.php");


$i=0;
foreach ($_POST as $key=>$value)
{
	if ($key!='button' && $key!='id' && substr_count($key,"f_chek_name")==0 && substr_count($key,"f_chek_h")==0) 
	{$ARRVAL[$i] = f_data($value,'text',0);$i++;}
}

$k=0;
foreach ($_POST as $key=>$value)
{
	if ($key!='button' && $key!='id' && (substr_count($key,"f_chek_name")!=0 || substr_count($key,"f_chek_h")!=0)) 
	{$ARRCHEK[$k] = f_data($value,'text',0); $k++;}
	
}


//чекбоксы
$x=0;
for ($j=$k;$j>0;$j=$j-2)
{
	if ($ARRCHEK[$j]=='') {$CHECK[$x]=$ARRCHEK[($j-1)].": да";  $x++;}
}
//////////////////////////////////////

$z=0;
for ($j=$i-1;$j>0;$j=$j-2)
{
	$TEXT[$z]="$ARRVAL[$j]: ".$ARRVAL[($j-1)]; $z++;
}


for ($i=count($TEXT); $i>=0;$i--)
{
	$text .= $TEXT[$i]."<br>";
}

for ($i=count($CHECK); $i>=0;$i--)
{
	$text2 .= $CHECK[$i]."<br>";
}

$id = f_data ($_POST[id], 'text', 0);
$result_f = mysql_query("SELECT * FROM forms WHERE id=$id");
$myrow_f = mysql_fetch_assoc($result_f); 
$mail_to = $myrow_f[f_mail];


$text = "<b>$myrow_f[f_title]</b><br>
$text
$text2
";

mailto($text,$myrow_f[f_title],$mail_to);
Header("location:$_SERVER[HTTP_REFERER]?msg=Ваша заявка отправлена!");
exit;

?>