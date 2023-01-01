<?php
	require_once('sql_connection.php');
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		$prod_cat = substr($_SERVER['QUERY_STRING'], 2, null);
		if (preg_match('/_\d/', $prod_cat) == 0) {
			servePage('products', 'products', 'Products', 'products', loginStatus(), $prod_cat);
		} else {
			getData('name,price,sale,stock,img', 'category = "'.substr($prod_cat, 0, strlen($prod_cat) - 2).'"', 'products', 'products.db');
		}
	} else {
		echo '<h1 style="align: center; text-align: center;">POST request not allowed</h1>';
	}
?>
