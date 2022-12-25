<?php
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		if (empty($_SESSION['member_username'])) {
			servePage('index', '', 'Home', '', false);
		} else {
			servePage('index', '', 'Home', '', true);
		}
	} else {
		echo '<h1 style="align: center; text-align: center;">POST request not allowed</h1>';
	}
?>
