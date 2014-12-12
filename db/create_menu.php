<?php

$db = new SQLite3('2scsb.db');

$result = $db->query('SELECT slug FROM albums');

var_dump($result->fetchArray(SQLITE3_ASSOC));

?>