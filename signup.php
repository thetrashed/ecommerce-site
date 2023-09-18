<?php
	require_once('helpers.php');
	require_once('sql_connection.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		if (empty($_SERVER['QUERY_STRING'])) {
			if (loginStatus() == '') {
				servePage('signup', 'form', 'Signup', 'signup', loginStatus(), '');
			} else {
				echo '<h1 style="align-items: center; padding-top: 30px; text-align: center;">Already Logged In!</h1>';
			}
		} else {
			$search_str = sanitiseInput(substr($_SERVER['QUERY_STRING'], 2, null));
			if (!empty(getDBData('username', '', 'customers'))) {
				echo '(<strong>Invalid</strong>)';
			} else {
				echo '(<strong>Valid</strong>)';
			}
		}
	} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
		session_start();
		$fields = '';
		$fieldvals = '';
		foreach ($_POST as $key => $value) {
			$key = sanitiseInput($key);
			$value = sanitiseInput($value);
			if ($key == 'username') {
				$_SESSION['member_username'] = $value;
			}
			$fields = $fields.',"'.$key.'"';
			$fieldvals = $fieldvals.',"'.$value.'"';
		}
		$fields = substr($fields, 1);
		$fieldvals = substr($fieldvals, 1);
		
		setDBData($fields, $fieldvals, 'customers');
		header('Location: /index');
		exit();
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
		sleep(2);
		header('Location: /index/login');
		exit();
	}
?>
