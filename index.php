<?php
	require_once('helpers.php');
	require_once('sql_connection.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		if (empty($_SERVER['QUERY_STRING'])) {
			servePage('index', 'products', 'Home', 'products', loginStatus(), 'hp');
		} else { 
			echo getDBData('name,price,sale,stock,img,prodid', 'feature != 0', 'products');
		}
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
		sleep(2);
		header('Location: /index');
		exit();
	}
?>
