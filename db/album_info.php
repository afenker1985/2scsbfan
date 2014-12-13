<?php

	$db = new MyDB();

	if(!$db){
	   echo $db->lastErrorMsg();
	} else {

		$result = $db->query("SELECT * FROM albums WHERE slug='" . $id . "'");
	
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