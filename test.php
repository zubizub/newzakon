<?php

include("blocks/db.php");
include("blocks/f_data.php");

/*
$result = mysql_query("SELECT * FROM vopros ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		$name = $myrow[name];
        $name_m = translit($name)."_".rand(11111,99999);
        $result_edit = mysql_query("UPDATE vopros SET name_m='$name_m' WHERE id='$myrow[id]'", $db);
        
	}while($myrow = mysql_fetch_assoc($result));
}

*/


$ARR = array ("Марина", "Света", "Андрей", "Николай", "Константин", "Вячеслав", "Кузьма", "Стас", "Егор", "Роман", "Александр", "Марго", "Кира", "Снежана", "Александра");



//$result = mysql_query("SELECT * FROM vopros_comment WHERE (uid='7a249ea187372ad6da0cd67b78d4b8cb' || uid='71905dc413326b63e1268576ff8665bc') && fakeName=''");

/*
$result = mysql_query("SELECT * FROM vopros_comment WHERE uid='41e6dd91615de786db11577036fdbd77' && fakeName=''");
echo "SELECT * FROM vopros_comment WHERE uid='41e6dd91615de786db11577036fdbd77' && fakeName=''<Br><Br>";
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
echo "Изменено: $num_rows записей<Br><Br>";
if ($num_rows!=0)
{
	do
	{
        $idR = rand(0,14);
        $name = $ARR[$idR];

        $result_edit = mysql_query("UPDATE vopros_comment SET fakeName='$name' WHERE id='$myrow[id]'", $db);
        
	}while($myrow = mysql_fetch_assoc($result));
}
*/




$result = mysql_query("SELECT * FROM vopros WHERE uid='41e6dd91615de786db11577036fdbd77' && fakeName=''");
echo "SELECT * FROM vopros WHERE uid='41e6dd91615de786db11577036fdbd77' && fakeName=''<Br><Br>";
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
echo "Изменено: $num_rows записей";
if ($num_rows!=0)
{
	do
	{
        $idR = rand(0,14);
        $name = $ARR[$idR];

        $result_edit = mysql_query("UPDATE vopros SET fakeName='$name' WHERE id='$myrow[id]'", $db);
        
	}while($myrow = mysql_fetch_assoc($result));
}



//$result_edit = mysql_query("UPDATE vopros SET numOtvet='1'", $db);


?>