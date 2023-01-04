<?php
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		$page_name = substr($_SERVER['QUERY_STRING'], 2, null);
		servePage($page_name, 'policy', 'Policy', '', loginStatus(), '');
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
		sleep(2);
		header('Location: /index');
		exit();
	}
?>
