<?php

function send_post($path,$data)
{
	$hostname = "$_SERVER[HTTP_HOST]";
	//$path = '/handler/action.php';
	$content = '';
	// Устанавливаем соединение с сервером $hostname
	$fp = fsockopen($hostname, 80, $errno, $errstr, 30); 
	// Проверяем успешность установки соединения
	if (!$fp) die('<p>'.$errstr.' ('.$errno.')</p>'); 

	// Данные HTTP-запроса
	//$data = 'name='.urlencode('Евгений').'&password='.urlencode('qwerty');
	// Заголовок HTTP-запроса
	$headers = 'POST '.$path." HTTP/1.1\r\n"; 
	$headers .= 'Host: '.$hostname."\r\n"; 
	$headers .= "Content-type: application/x-www-form-urlencoded\r\n";
	$headers .= 'Content-Length: '.strlen($data)."\r\n\r\n";
	// Отправляем HTTP-запрос серверу
	fwrite($fp, $headers.$data); 
	// Получаем ответ
	while ( !feof($fp) ) $content .= fgets($fp, 1024);
	// Закрываем соединение
	fclose($fp);
	// Выводим ответ в браузер  
	echo $content;
}
?>