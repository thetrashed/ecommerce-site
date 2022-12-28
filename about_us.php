<?php
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		servePage('about_us', '', 'About Us', '', loginStatus());
	} else {
		echo '<p><strong>This page does not allow POST requests</strong></p>';
	}
?>
