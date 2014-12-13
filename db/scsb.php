<?php
	class scsb {
		var $db;
		
		function __construct() {
			include $_SERVER['DOCUMENT_ROOT'].'db/mydb.php';
			$this->db = new MyDB();
		}
		
		public function album_info($id) {
			if(!$this->db){
			   echo $this->db->lastErrorMsg();
			} else {

				$result = $this->db->query("SELECT * FROM albums WHERE slug='" . $id . "'");
	
				if(!$result){
				   echo $this->db->lastErrorMsg();
				} else {
					$album=$result->fetchArray(SQLITE3_ASSOC);
			
					$length = intval(gmdate("G", $album['total_length']));
			
					if ($length > 0) {
						$t_length = gmdate("g:i:s", $album['total_length']);
					} else {
						$t_length = gmdate("i:s", $album['total_length']);
					}
			
				}
				
				$album['total_length'] = $t_length;
				
				return $album;
				$this->db->close();
			}
		}
		
		private function pull_lyrics($song_id) {
			$res = $this->db->querySingle("SELECT * FROM song_lyrics WHERE song_id=" . $song_id);
			
			$lyric_id = $res->fetchArray(SQLITE3_ASSOC);
			
			$res = $this->db->querySingle("SELECT lyrics FROM lyrics WHERE lyric_id=". $lyric_id['lyrics_id']);
						
		}
		
		public function track_list($id) {
			$result = $this->db->query("SELECT album_id FROM albums WHERE slug='" . $id . "'");
			
			$album_id = $result->fetchArray(SQLITE3_ASSOC);
			
			$result = $this->db->query("SELECT * FROM album_songs WHERE album_id=" . $album_id['album_id']);
			$track_list = array();
			$i = 1;
			while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
				
				$r = $this->db->query('SELECT * FROM (SELECT title, song_length, track_number, song_id FROM songs ORDER BY track_number) WHERE song_id=' . $row['song_id']);
				
				$track_list[$i] = $r->fetchArray(SQLITE3_ASSOC);
				
				$lyrics_list[$i] = $this->pull_lyrics($row['song_id']);
							
				$i++;
			}
			
			foreach($track_list as $track) {
				$track['song_length'] = ltrim(gmdate("i:s", $track['song_length']), 0);
					
				$t .=<<<EOHTML
					<div style="display: table;">
						<div class="tracks" style="width: 50px; text-align: center;">{$track['track_number']}</div>
						<div class="tracks" style="width: 400px;">{$track['title']}</div>
						<div class="tracks">{$track['song_length']}</div>
					</div>
EOHTML;
			}
			
			return $t;
			
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