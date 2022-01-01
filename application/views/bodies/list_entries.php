<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div id=" panel-body">
				<div class="text-center slc_itm_cont">
					<?php foreach ($list_t as $key):?>
					<a class="inner-box" href="<?=site_url('historia').'/'.$key->url?>" ><div class="itm_slc_bx panel">
						<div class="exp_holder">
	<?php if($key->file_image!=='0'): ?>
						<img src="<?=base_url('upload').'/'.$key->file_image?>" alt="<?=html_entity_decode($key->titulo)?>" width="100%">
	<?php else:?>
					<img src="<?=base_url('upload').'/'.$this->config->item('no_image_file')?>" alt="<?=html_entity_decode($key->titulo)?>" width="100%">
	<?php endif; ?>
						<div class="ico_inf">
							<h3><?=strtoupper(html_entity_decode($key->titulo))?></h3>
						</div>
						</div>
					</div>
					</a>
					<?php endforeach;?>
				</div>
				</div>
			<div class="panel-footer text-center">
				<?=$pagination?>
			</div>
		</div>
	</div>
</div>