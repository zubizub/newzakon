<a href='?page=harakteristik' title='�����' id='back'></a><br>

<?
	if (isset($_GET['id']))
	{
		$id = f_data ($_GET[id], 'text', 0);
		$result_h = mysql_query("SELECT * FROM goods_harakteristiki WHERE id='$id'");
		$myrow_h = mysql_fetch_array($result_h);
	}
?>


<form action="modul/katalog/obr_add_harakteristika.php" method="post">
    ��������: <input name="name" type="text" style="width:363px" value="<? if (isset($myrow_h[name])) {echo $myrow_h[name];} ?>"><br><br>
    ��������:<br>
    <textarea name="descript" cols="" rows="4" style="width:440px"><? if (isset($myrow_h[descript])) {echo $myrow_h[descript];} ?></textarea><br><br>
    <?php if (isset($_GET['id'])) {echo "<input name='update' type='hidden' value='$myrow_h[id]'>";}?> 
    <input name="button" type="submit" class="button_save" value="���������">
</form>