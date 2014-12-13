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
			SELECT slug, title FROM albums WHERE is_active=1;
EOF;

		$result = $db->query($sql);
	
		if(!$result){
		   echo $db->lastErrorMsg();
		} else {
			print_r($result->fetchArray());
			
			$album_list = '';
			foreach ($result as $row) {
				$album_list .= '<li><a href="/albums/' . $row[0] . '"><span>- </span>' . $row[2] . '</a></li>';
			}
			print_r($album_list);
		}
	
		$db->close();
	}
?>