<?php
	require_once('sql_connection.php');
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		if (empty($_SERVER['QUERY_STRING'])) {
			servePage('sale', 'products', 'Sale', 'products', loginStatus(), 'sale');
		} else {
			getData('name,price,sale,stock,img', 'sale != price', 'products', 'products.db');
		}
	} else {
		echo '<h1 style="align: center; text-align: center;">POST request not allowed</h1>';
	}
?>
