<?php
	require_once('helpers.php');
	require_once('sql_connection.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		if (empty($_SESSION['member_username'])) {
			echo 'NotLoggedIn';
		} else {
			echo getDBData('cus_fname,cus_lname,cus_phone,con_po_no,email_addr', 'username = "'.$_SESSION['member_username'].'"', 'customers'); 
		}
	} else {
		echo '<h1 style="align: center; text-align: center;">POST request not allowed</h1>';
	}
?>
