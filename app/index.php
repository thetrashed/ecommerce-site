<?php
	require_once('helpers.php');
	require_once('sql_connection.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		if (empty($_SERVER['QUERY_STRING'])) {
			servePage('index', 'products', 'Home', 'products', loginStatus(), 'hp');
		} else { 
			getData('name,price,sale,stock,img', 'feature != 0', 'products', 'products.db');
		}
	} else {
		echo '<h1 style="align: center; text-align: center;">POST request not allowed</h1>';
	}
?>
