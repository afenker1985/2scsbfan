<?php
	class MyDB extends SQLite3
	{
	   function __construct()
	   {
		   $this->open($_ENV['OPENSHIFT_DATA_DIR'] . '/2scsb.db');
		   $this->lastErrorMsg();
	   }
	}
	echo "pass2";
	$db = new MyDB();

	if(!$db){
	   echo $db->lastErrorMsg();
	} else {

		$result = $db->query('SELECT * FROM albums WHERE slug='. $id .' ORDER BY release_date ASC');
	
		if(!$result){
		   echo $db->lastErrorMsg();
		} else {
			$album_list = '';
			while($row=$result->fetchArray(SQLITE3_ASSOC)) {
				print_r($row);
			}

		}
	
		$db->close();
	}
?>