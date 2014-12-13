<?php include $_SERVER['DOCUMENT_ROOT'].'db/album_info.php'; ?>	
	<article id="latest-article" class="container" style="min-height: 400px;">
		  <h2><?=$row['title']?></h2>
		  <?php if ($row['sub_title'] == 'NULL'): ?>
			  <h4><?=$row['sub_title']?></h4>
		  <?php endif; ?>
		  <div class="dcontentc cf">
			  <div class="album_info">
				  <img src="<?=$path?>imgs/<?=$id?>.jpg" width="280"/>
				  <br />
				  <strong>Release Date:</strong> <?=date("F j, Y", strtotime($row['release_date']))?>
				  <br />
				  © <?=$row['copyright']?> <?=$row['label']?>
				  <br />
				  <strong>Album Length:</strong> <?=$t_length?>
			  </div>
		  </div>
	  </article>