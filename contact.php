<?php
	require_once('helpers.php');
	require_once('sql_connection.php');

	session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (!empty($_SERVER['QUERY_STRING'])) {
			echoBody(substr($_SERVER['QUERY_STRING'], 2, null));
		} else {
			servePage('contact', 'form', 'Contact Us', "contact", loginStatus(), '');
		}
	} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$fields = '';
		$fieldvals = '';
		foreach ($_POST as $key => $value) {
			$value = sanitiseInput($value);
			$key = sanitiseInput($key);

			$fields = $fields.',"'.$key.'"';
			$fieldvals = $fieldvals.',"'.$value.'"';
		}
		$fields = substr($fields, 1);
		$fieldvals = substr($fieldvals, 1);
		echo $fields;

		if (!empty($_SESSION['member_username'])) {
			setDBData($fields.',username', $fieldvals.',"'.$_SESSION['member_username'].'"', 'sug_comp');
		} else {
			setDBData($fields, $fieldvals, 'sug_comp');
		}
		header('Location: /index');
		exit();
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
		sleep(2);
		header('Location: /index');
		exit();
	}
?>
