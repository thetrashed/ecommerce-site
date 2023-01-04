<?php
	require_once('helpers.php');
	require_once('sql_connection.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
		if (empty($_SERVER['QUERY_STRING'])) {
			servePage('cart', 'cart', 'Cart', 'cart', loginStatus(), '');
		} else {
			$query = substr($_SERVER['QUERY_STRING'], 2, null);
			if ($query == '1') {
				global $SQL_DIR;
				$uname = $_SESSION['member_username'];

				$db = new sqlDB($SQL_DIR);

				$query = 'SELECT orders.prodid,orders.quantity,products.sale,products.img,products.name,products.name,products.size,products.price FROM orders INNER JOIN products ON products.prodid = orders.prodid WHERE orders.username = "'.$uname.'" AND orders.order_placed = 0';
				$ret = $db->query($query);
				$data = array();
				while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
					array_push($data, $row);
				}

				$db->close();
				echo json_encode($data);
			} else  {
				$uname = $_SESSION['member_username'];

				updateDBData('order_placed = 1', 'username = "'.$uname.'" AND order_placed = 0', 'orders');
				foreach ($_REQUEST as $key => $prodid) {
					$stock = json_decode(getDBData('stock', 'prodid = "'.$prodid.'"', 'products'), true)[0]['stock'] - 1;
					updateDBData('stock = '.$stock, 'prodid = "'.$prodid.'"', 'products');
				}
				echo 'Done';
			}
		}
	} else {
		echo '<h1 style="align: center; text-align: center;">Request Method Not Supported</h1>';
		sleep(2);
		header('Location: /index');
		exit();
	}
?>
