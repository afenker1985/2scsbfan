<?php
	class scsb_db {
		var $db;
		
		function __construct() {
			include $_SERVER['DOCUMENT_ROOT'].'db/mydb.php';
			$this->db = new MyDB();
		}
		
		public function album_info($id) {
			if(!$db){
			   echo $this->db->lastErrorMsg();
			} else {

				$result = $this->db->query("SELECT * FROM albums WHERE slug='" . $id . "'");
	
				if(!$result){
				   echo $this->db->lastErrorMsg();
				} else {
					$album=$result->fetchArray(SQLITE3_ASSOC);
			
					$length = intval(gmdate("g", $album['total_length']));
			
					if ($length == 1 || $length == 2) {
						$t_length = gmdate("g:i:s", $album['total_length']);
					} else {
						$t_length = gmdate("i:s", $album['total_length']);
					}
			
				}
				$db->close();
			}
		}
		
		public function create_menu() {
			if(!$this->db){
			   echo $this->db->lastErrorMsg();
			} else {

				$result = $this->db->query('SELECT slug, title FROM albums WHERE is_active=1 ORDER BY release_date ASC');
	
				if(!$result){
				   echo $this->db->lastErrorMsg();
				} else {
					$album_list = '';
					while($row=$result->fetchArray(SQLITE3_ASSOC)) {
						$album_list .= '<li><a href="/albums/' . $row['slug'] . '"><span>- </span>' . $row['title'] . '</a></li>';
					}

				}
				
				return $album_list;
				$this->db->close();
			}
		}
		
	}
?>