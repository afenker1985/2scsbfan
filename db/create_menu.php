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
		$sql =<<<EOF
			SELECT * FROM albums WHERE is_active=1 ORDER BY release_date ASC;
EOF;

		$result = $db->query($sql);
	
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