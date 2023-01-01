<?php
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		servePage('login', 'form', 'Login', '', loginStatus(), '');
	} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
	}
?>
