<?php
	@unlink("../../../.htaccess");
	@copy("../../backup/.htaccess", "../../../.htaccess");
	Header("location:../../?page=vnedrenie&num=2&msg=Операция прошла успешно!");	
	exit;
?>