<div class="modal fade" tabindex="-1" role="dialog" id="listModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
<div id="slc_itm_cont">
	<?php $i=0;
	 foreach ($list_t as $key):?>
	<div class="itm_slc_bx panel panel-default">
		<div class="panel-heading"><?=$key->titulo?></div>
		<div class="panel-body bx-item" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$key->descripcion?>">
			<img  src="<?=base_url('upload/thumb').'/'.$key->file_image?>" alt="" width="100%">
		</div>
		<div class="panel-footer">
			<ul class="btn-group btn-group-justified">
				<a href="<?=site_url('ver/historia').'/'.$key->url?>" class="btn btn-primary" onclick="ver_art(<?=$key->id_registro?>,event);return false;"><span class="glyphicon glyphicon-plus"></span></a>
				<a href="" class="btn btn-primary map-pointer" data-ref="<?=$i?>"><span class="glyphicon glyphicon-map-marker"></span></a>
		<?php $i++; ?>
			</ul>
		</div>
	</div>
	<?php endforeach; ?>
</div>
 </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->