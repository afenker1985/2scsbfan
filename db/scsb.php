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
			$res = $this->db->query("SELECT * FROM song_lyrics WHERE song_id=" . $song_id);
			
			$lyric_id = $res->fetchArray(SQLITE3_ASSOC);
						
			$res = $this->db->querySingle("SELECT lyrics FROM lyrics WHERE lyric_id=" . $lyric_id['lyric_id']);
						
			return $res;
						
		}
		
		public function track_list($id) {
			$result = $this->db->query("SELECT album_id FROM albums WHERE slug='" . $id . "'");
			
			$album_id = $result->fetchArray(SQLITE3_ASSOC);
			
			$result = $this->db->query("SELECT * FROM album_songs WHERE album_id=" . $album_id['album_id']);
			
			$track_list = array();
			
			$i = 1;
			
			while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
								
				$r = $this->db->query("SELECT title, song_length, track_number FROM songs WHERE song_id= " . $row['song_id']);
				
				if(!$r) {
				   echo "Error # " . $this->db->lastErrorCode() . ": " . $this->db->lastErrorMsg() . "<br />";
				   print_r($r);
				   echo "<br />";
				} else {
				
				$track_list[$i] = $r->fetchArray(SQLITE3_ASSOC);
				
				$lyrics_list[$i] = $this->pull_lyrics($row['song_id']);
							
				$i++;
				}
			}
			
			$i = 1;
			
			$t = '';
						
			foreach($track_list as $track) {
				
				$track['song_length'] = ($track['song_length'] < 60 ? gmdate("0:s", $track['song_length']) : ltrim(gmdate("i:s", $track['song_length']), 0) );
				
				if ($lyrics_list[$i] == '') {
					$t .=<<<EOHTML
						<div id="track-list" style="display: table;">
							<div class="tracks" style="width: 50px; text-align: center;"><strong>{$track['track_number']}</strong></div>
							<div class="tracks" style="width: 450px;"><strong>{$track['title']}</strong></div>
							<div class="tracks" style="width: 50px;"><strong>{$track['song_length']}</strong></div>
						</div>
EOHTML;
				} else {
				$t .=<<<EOHTML
					<div class="accordion-toggle" id="track-list" style="display: table;">
						<div class="tracks" style="width: 50px; text-align: center;"><strong>{$track['track_number']}</strong></div>
						<div class="tracks" style="width: 450px;"><strong>{$track['title']}</strong></div>
						<div class="tracks" style="width: 50px;"><strong>{$track['song_length']}</strong></div>
					</div>
					<div class="accordion-content" style="padding-left: 10px;">
						{$lyrics_list[$i]}
					</div>
EOHTML;
				}
				
				$i++;
			}
			
			return $t;
			
		}
		
		public function create_menu() {
			if(!$this->db){
			   echo $this->db->lastErrorMsg();
			} else {

				$result = $this->db->query("SELECT slug, title FROM albums WHERE is_active=1 ORDER BY release_date ASC");
	
				if(!$result){
				   echo $this->db->lastErrorMsg();
				} else {
					$album_list = '';
					while($row=$result->fetchArray(SQLITE3_ASSOC)) {
						$album_list .=<<<EOHTML
							<li><a href="/albums/{$row['slug']}"><span>- </span>{$row['title']}</a></li>
EOHTML;
					}

				}
				return $album_list;
				$this->db->close();
			}
		}
		
	}
?>