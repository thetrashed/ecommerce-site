<?php
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		servePage('about_us', '', 'About Us', '', loginStatus(), '');
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
		sleep(2);
		header('Location: /index/about_us');
		exit();
	}
?>
