<?php

	$db = new MyDB();

	if(!$db){
	   echo $db->lastErrorMsg();
	} else {

		$result = $db->query("SELECT * FROM albums WHERE slug='" . $id . "'");
	
		if(!$result){
		   echo $db->lastErrorMsg();
		} else {
			$album=$result->fetchArray(SQLITE3_ASSOC);
			
			$length = intval(gmdate("g", $album['total_length']));
			
			if ($length == 1 || $length == 2) {
				$t_length = gmdate("g:i:s", $album['total_length']);
			} else {
				$t_length = gmdate("g:i:s", $album['total_length']);
			}
			
		}
	
		$db->close();
	}
?>