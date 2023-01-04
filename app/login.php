<?php
	require_once('helpers.php');
	require_once('sql_connection.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		servePage('login', 'form', 'Login', 'login', loginStatus(), '');
	} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
		session_start();
		$pwd = sanitiseInput($_POST['password']);
		$uname = sanitiseInput($_POST['username']);

		$db_data = json_decode(getDBData('password', 'username = "'.$uname.'"', 'customers'), true);
		if (!empty($db_data) && $pwd == $db_data[0]['password']) {
			$_SESSION['member_username'] = $uname;
			header('Location: /index');
			exit();
		} else {
			header('Location: /index/login.php');
			exit();
		}
	}	else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
		sleep(2);
		header('Location: /index/login');
		exit();
	}
?>
