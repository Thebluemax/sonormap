<div id="slc_itm_cont">
	<?php foreach ($list_t as $key)?>
	<div class="itm_slc_bx">
		<h4><?=$key->titulo?></h4>
		<p><?=$key['descripcion']?></p>
		<ul class="lt_slc">
			<li><a href="">ver</a></li>
			<li><a href="">mapa</a></li>
			<li><a href="">ver</a></li>
			<li></li>
		</ul>
	</div>
	<?php endforeach; ?>
</div>