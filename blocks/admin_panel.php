<? 
	//���� ��� �������������� ��������
	if ($status_user==1) {include("blocks/edit_button.php");} 

	//���� ���� ��������
	if ($SETTINGS[desc_9]==0) {
		echo "<div class='desabl_site'>���� � ������ ����������. ����� ��� ����������. ".$SETTINGS[desabl_site]."</div></body></html>";
		exit;
	}
?>