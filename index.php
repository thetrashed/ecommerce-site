<?php
	require_once('helpers.php');
	require_once('sql_connection.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		servePage('index', '', 'Home', '', loginStatus());
		$con = establishDBConnection('orders.db');
		closeDBConnection($con);
	} else {
		echo '<h1 style="align: center; text-align: center;">POST request not allowed</h1>';
	}
?>
