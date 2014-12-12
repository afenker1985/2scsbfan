<?php

$db = new SQLite3('2scsb.db');

$result = $db->query('SELECT slug FROM albums');

echo "PASS";
var_dump($result->fetchArray());

?>