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
			
			if (gmdate("g", $row['total_length']) == '1') {
				$t_length = gmdate("g:i:s", $row['total_length']);
			} else {
				$t_length = gmdate("i:s", $row['total_length']);
			}
			
		}
	
		$db->close();
	}
?>