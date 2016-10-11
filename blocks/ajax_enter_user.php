<?

//добавление в корзину товаров

include("db.php");
include("f_data.php");
include("shifr_pass.php");
include("send_sms.php");


$phone = f_data ($_POST['phone'], 'text', 0);
$phone = clearPhone($phone);
$pass = f_data ($_POST['pass'], 'text', 0);
$pass = md5(md5($pass));

$result = mysql_query("SELECT * FROM users WHERE phone='$phone' && pass='$pass' ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
//echo "$_POST[pass] | $_POST[pass]";
if ($num_rows!=0)
{
    setcookie("uid",$myrow[uid],time()+36000000,"/");
    setcookie("token",$myrow[token],time()+36000000,"/");
    echo "1";
    exit;
}
else
{
    echo "0";
    exit;
} 



?>