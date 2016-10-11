<? 
	//меню для редактирования страницы
	if ($status_user==1) {include("blocks/edit_button.php");} 

	//если сайт выключен
	if ($SETTINGS[desc_9]==0) {
		echo "<div class='desabl_site'>Сайт в режиме обновления. Скоро все заработает. ".$SETTINGS[desabl_site]."</div></body></html>";
		exit;
	}
?>