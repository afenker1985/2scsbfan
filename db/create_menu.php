<?php

class MyDB extends SQLite3 {

	function __construct() {
		$this->open('2scsb.db');
	}
}

$db = new SQLite3('2scsb.db');

$result = $db->query('SELECT * FROM albums WHERE is_active = 1 ORDER BY release_date ASC');

echo "PASS";
var_dump($result);

?>