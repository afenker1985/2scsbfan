<?php

	$db = new MyDB();

	if(!$db){
	   echo $db->lastErrorMsg();
	} else {

		$result = $db->query("SELECT * FROM albums WHERE slug='" . $id . "'");
	
		if(!$result){
		   echo $db->lastErrorMsg();
		} else {
			$row=$result->fetchArray(SQLITE3_ASSOC);
		}
	
		$db->close();
	}
?>