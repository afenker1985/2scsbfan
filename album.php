<?php include $_SERVER['DOCUMENT_ROOT'].'db/album_info.php'; ?>	
	<article id="latest-article" class="container" style="min-height: 400px;">
		  <h2><?=$album['title']?></h2>
		  <h4><?=$album['sub_title']?></h4>
		  <div class="dcontentc cf">
			  <div class="album_info">
				  <img src="<?=$path?>imgs/<?=$id?>.jpg" width="280"/>
				  <br />
				  <strong>Album Length:</strong> <?=$t_length?>
				  <br />
				  <strong>Release Date:</strong> <?=date("F j, Y", strtotime($album['release_date']))?>
				  <br />
				  <strong>Label:</strong> <?=$album['label']?>
				  <br />
				  <strong>Copyright:</strong> <?=$album['copyright']?>, <?=$album['artist']?>
			  </div>
		  </div>
	  </article>