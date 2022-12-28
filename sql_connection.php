<?php
	define($SQL_DIR, 'sql/');

	function establishDBConnection($dbname) {
		$servername = "localhost";
		$username = "username";
		$password = "password";

		try {
			$con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Connected successfully";
			return $con;
		} catch (PDOException $e) {
			echo "Connection failed: ".$e->getMessage();
			return null;
		}
		
	}

	function closeDBConnection($con) {
		$con = null;
		echo "Disconnected successfully";
	}
?>
