<?php
	require_once('helpers.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (!empty($_SERVER['QUERY_STRING'])) {
			echoBody(substr($_SERVER['QUERY_STRING'], 2, null));
		} else {
			if (empty($_SESSION['member_username'])) {
				servePage('contact', 'form', 'Contact Us', "contact", false);
			} else {
				servePage('contact', 'form', 'Contact Us', "contact", true);
			}
		}

	} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
	}
?>
