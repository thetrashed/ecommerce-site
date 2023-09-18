<?php
	$SQL_DIR = 'sql/site_data.sqlite';

	class sqlDB extends SQLite3 {
		function __construct($dbname) {
			$this->open($dbname);
		}
	}

	function getDBData($fields, $fieldvals, $table) {
		global $SQL_DIR;
		$db = new sqlDB($SQL_DIR);
		if (!empty($fieldvals)) {
			$query = 'SELECT '.$fields.' FROM '.$table.' WHERE '.$fieldvals.';';
		} else {
			$query = 'SELECT '.$fields.' FROM '.$table.';';
		}

		$ret = $db->query($query);
		$data = array();
		while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
			array_push($data, $row);
		}
		$db->close();
		return json_encode($data);
	}

	function setDBData($fields, $fieldvals, $table) {
		global $SQL_DIR;
		$db = new sqlDB($SQL_DIR);
		$query = 'INSERT INTO '.$table.'('.$fields.')'.' VALUES '.'('.$fieldvals.');';

		$db->exec($query);
		$db->close();
	}

	function updateDBData($udpated_fields, $search_fields, $table) {
		global $SQL_DIR;
		$db = new sqlDB($SQL_DIR);

		$query = 'UPDATE '.$table.' SET '.$udpated_fields.' WHERE '.$search_fields.';';

		$db->exec($query);
		$db->close();
	}
?> 
