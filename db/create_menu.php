<?php
	class MyDB extends SQLite3
	{
	   function __construct()
	   {
	      $this->open('2scsb.db');
	   }
	}

	$db = new MyDB();

	if(!$db){
	   echo $db->lastErrorMsg();
	} else {
		$sql =<<<EOF
			SELECT slug FROM albums WHERE is_active=1;
EOF;

	$result = $db->query($sql);
	
	if(!$result){
	   echo $db->lastErrorMsg();
	} else {
		echo "Query run properly";
	}
	
	$db->close();
}
?>