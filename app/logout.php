<?php
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		$_SESSION['member_username'] = '';

		header('Location: /index');
		exit();
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
		sleep(2);
		header('Location: /index/login');
		exit();
	}
