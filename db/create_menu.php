<?php
$db = new SQLite3('2scsb.db');

$results = $db->query('SELECT slug FROM albums');

while ($row = $results->fetchArray()) {
    var_dump($row);
}
?>