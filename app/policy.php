<?php
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		$page_name = substr($_SERVER['QUERY_STRING'], 2, null);
		servePage($page_name, 'policy', 'Policy', '', loginStatus(), '');
	} else {
		echo '<p><strong>Page does not support POST requests</strong></p>';
	}
?>
