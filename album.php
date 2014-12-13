<?php include $_SERVER['DOCUMENT_ROOT'].'db/album_info.php'; ?>	
	<article id="latest-article" class="container" style="min-height: 400px;">
		  <h2><?=$row['title']?></h2>
		  <h4><?=$row['sub_title']?></h4>
		  <div class="dcontentc cf">
			  <div class="album_info">
				  <img src="<?=$path?>imgs/<?=$id?>.jpg" width="280"/>
				  <br />
				  <strong>Album Length:</strong> <?=$t_length?>
				  <br />
				  <strong>Release Date:</strong> <?=date("F j, Y", strtotime($row['release_date']))?>
				  <br />
				  <strong>Label:</strong> <?=$row['label']?>
				  <br />
				  <strong>Copyright:</strong>
			  </div>
		  </div>
	  </article>