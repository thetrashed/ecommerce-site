<?php
	$SQL_DIR = 'sql/';

	class sqlDB extends SQLite3 {
		function __construct($dbname) {
			$this->open($dbname);
		}
	}

	function getData($fields, $fieldvals, $table, $dbname) {
		global $SQL_DIR;
		$db = new sqlDB($SQL_DIR.$dbname);
		$query = 'SELECT '.$fields.' FROM '.$table.' WHERE '.$fieldvals.';';

		$ret = $db->query($query);
		$data = array();
		while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
			array_push($data, $row);
		}
		echo json_encode($data);
		$db->close();
	}
?>
