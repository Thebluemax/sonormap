<div id="cont_rss">
<?php foreach ($rss_array as $key) : ?>
	<div class="feed_item">
		<h6><?=$key['title']?></h6>
		<img <?=$key['img']?> width="80%">
		<p><?=$key['description']?><br>
			<a href="<?=$key['link']?>"><?=$this->lang->line('s_asd_art')?></a></p>
	</div>
<?php endforeach; ?>
</div>