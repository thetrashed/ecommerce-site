<?php
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		servePage('index', '', 'Home', '', loginStatus());
	} else {
		echo '<h1 style="align: center; text-align: center;">POST request not allowed</h1>';
	}
?>
