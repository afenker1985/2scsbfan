<!-- JS -->
<script type="text/javascript">
  $(document).ready(function($) {
    $('#accordion').find('.accordion-toggle').click(function(){

      //Expand or collapse this panel
      $(this).next().slideToggle('slow');

      //Hide the other panels
      $(".accordion-content").not($(this).next()).slideUp('slow');

    });
	
	$('#accordion').find('.accordion-content').click(function(){
		$(".accordion-content").slideUp('slow');
	});
  });
</script>

<!-- CSS -->
<style>
  .accordion-toggle {cursor: pointer;}
  .accordion-content {display: none; cursor:pointer;}
</style>
<?php $album = $scsb->album_info($id); ?>
	<article id="latest-article" class="container" style="min-height: 400px;">
		  <h2><?=$album['title']?></h2>
		  <h4><?=$album['sub_title']?></h4>
		  <div class="dcontentc cf">
			  <div class="album_info">
				  <img src="<?=$path?>imgs/<?=$id?>.jpg" width="280"/>
				  <br />
				  <strong>Album Length:</strong> <?=$album['total_length']?>
				  <br />
				  <strong>Release Date:</strong> <?=date("F j, Y", strtotime($album['release_date']))?>
				  <br />
				  <strong>Label:</strong> <?=$album['label']?>
				  <br />
				  <strong>Copyright:</strong> <?=$album['copyright']?>, <?=$album['artist']?>
			  </div>
			  <div class="track_info">
				  <div id="accordion" style="display: inline-block; text-align: left; border: 1px solid #D5D5D7;">
					  <?=$scsb->track_list($id)?>
				  </div>
			  </div>
		  </div>
	  </article>