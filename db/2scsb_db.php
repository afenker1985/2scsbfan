<?php
	class scsb_db {
		$db;
		
		function __construct() {
			include $_SERVER['DOCUMENT_ROOT'].'db/mydb.php';
			$this->db = new MyDB();
		}
		
		public function album_info() {
			
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
		
		public function check_active() {
			$file = $_SERVER["SCRIPT_NAME"];
			$break = Explode('/', $file);
	
			$pfile = $break[count($break) - 1];
		}
		
	}
?>