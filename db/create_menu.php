<?php

$db = sqlite_open('2scsb.db', 0666);

$result = sqlite_query($db, 'SELECT slug FROM albums');

echo "PASS";
var_dump(sqlite_fetch_array($result);

?>