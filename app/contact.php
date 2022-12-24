<?php
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (!empty($_SERVER['QUERY_STRING'])) {
			echoBody(substr($_SERVER['QUERY_STRING'], 2, null));
		} else {
			servePage('contact', 'Contact Us', "contact.js");
		}
	} else {
		echo '<h1 style="align: center; text-align: center;">TODO</h1>';
	} 
?>
