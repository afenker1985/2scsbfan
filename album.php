<?php	
echo $_SERVER['DOCUMENT_ROOT'];
include $_SERVER['DOCUMENT_ROOT'].'/db/album_info.php'; ?>	
	<article id="latest-article" class="container" style="min-height: 400px;">
		  <h2><?=$id?></h2>
		  <div class="dcontentc cf">
			  <img src="<?=$path?>imgs/<?=$id?>.jpg" width="280"/>
		  </div>
	  </article>