<?php
	require_once('sql_connection.php');
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		$prod_cat = substr($_SERVER['QUERY_STRING'], 2, null);
		if (preg_match('/_\d/', $prod_cat) == 0) {
			servePage('products', 'products', 'Products', 'products', loginStatus(), $prod_cat);
		} else {
			echo getDBData('name,price,sale,stock,img,prodid', 'category = "'.substr($prod_cat, 0, strlen($prod_cat) - 2).'"', 'products');
		}
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
		sleep(2);
		header('Location: /index/products');
		exit();
	}
?>
