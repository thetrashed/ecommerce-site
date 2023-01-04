<?php
	require_once('helpers.php');
	require_once('sql_connection.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		$prodid = sanitiseInput($_REQUEST['q']);
		$uname = $_SESSION['member_username'];

		$orders = json_decode(getDBData('inv_no', 'username = "'.$uname.'" AND order_placed = 0', 'orders'), true);
		if (count($orders) != 0) {
			$inv_no = $orders[0]['inv_no'];
			$prodid_count = count(json_decode(getDBData('inv_no', 'username = "'.$uname.'" AND order_placed = 0 AND prodid = "'.$prodid.'"', 'orders'), true));
			if ($prodid_count != 0) {
				updateDBData('quantity = '.($prodid_count + 1), 'username = "'.$uname.'" AND order_placed = 0 AND prodid = "'.$prodid.'"', 'orders');
			} else {
				setDBData('username,prodid,inv_no,quantity,order_placed', '"'.$uname.'","'.$prodid.'",'.$inv_no.',1,0', 'orders');
			}
		} else {
			$inv_no = count(json_decode(getDBData('DISTINCT inv_no', '', 'orders'), true)) + 1;
			setDBData('username,prodid,inv_no,quantity,order_placed', '"'.$uname.'","'.$prodid.'",'.$inv_no.',1,0', 'orders');
		}
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
		sleep(2);
		header('Location: /index');
		exit();
	}
?>
