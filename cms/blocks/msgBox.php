

<div id="msgBox_del">
	<div style="position:relative">
        <div class="msgBox_head_del">Информация</div>
        <div class="msgBox_content_del">
        	Вы действительно хотите произвести удаление?<br>
			<a href="obr_main.php?del=" class="button_yes">ДА</a> <a href="#" class="button_no popup">НЕТ</a>
        </div>
        <a href="#" class="msgBox_close_windows_del popup">X</a>
    </div>
</div>


<? 

$flash_session = Session::flash('success');
if ($flash_session!='')
{
    $msg = $flash_session;
    $msg_box = 1;
}

if (isset($_GET[msg]))
{
    $msg_box = 1;
    $msg = $_GET[msg];
}


if ($msg_box==1) { 

?>

<div id="msgBox">
	<div style="position:relative">
        <div class="msgBox_head">Информация</div>
        <div class="msgBox_content">
			<? echo $msg; ?>
        </div>
        <a href="#" class="msgBox_close_windows popup">X</a>
        <div align="center"><a href="#" class="msgBox_close_windows2 popup">закрыть</a></div>
    </div>
</div>


<? } ?>