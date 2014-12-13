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

		$result = $db->query('SELECT slug, title FROM albums ORDER BY release_date ASC');
	
		if(!$result){
		   echo $db->lastErrorMsg();
		} else {
			print_r($result->fetchArray(SQLITE3_ASSOC));
			
			$album_list = '';
			foreach ($result as $row) {
				$album_list .= '<li><a href="/albums/' . $row['slug'] . '"><span>- </span>' . $row['title'] . '</a></li>';
			}
			echo $album_list;
		}
	
		$db->close();
	}
?>