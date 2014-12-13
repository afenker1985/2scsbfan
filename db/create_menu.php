<?php
	class MyDB extends SQLite3
	{
	   function __construct()
	   {
	      $this->open($_ENV['OPENSHIFT_DATA_DIR'] . '/2scsb.db');
		  
	   }
	}

	$db = new MyDB();

	if(!$db){
	   echo $db->lastErrorMsg();
	} else {

		$result = $db->query('SELECT slug, title FROM albums WHERE is_active=1 ORDER BY release_date DESC');
	
		if(!$result){
		   echo $db->lastErrorMsg();
		} else {
			$album_list = '';
			while($row=$result->fetchArray(SQLITE3_ASSOC)) {
				$album_list .= '<li><a href="/albums/' . $row['slug'] . '"><span>- </span>' . $row['title'] . '</a></li>';
			}

		}
	
		$db->close();
	}
?>