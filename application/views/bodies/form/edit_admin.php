<div class="container-fluid">
<script>
	var jSonObject=<?=$jSon?>;
</script>
<div class="row">

<div class="col-lg-10">
	<div class="well">
		<h1><?=$this->lang->line('s_edt_tl')?> - <?=$titulo?> -</h1>
		<p>
			<?=$this->lang->line('s_edt_m1')?>
		</p>
	</div>
	<!--tabs-->
	<ul class="nav nav-tabs">
		<li><a data-toggle="tab" href="#description"><span class="glyphicon glyphicon-info-sign" aria-hidde="true"></span></a></li>
		<li><a data-toggle="tab" href="#map-point"><span class="glyphicon glyphicon-map-marker" aria-hidde="true"></span></a></li>
		<li><a data-toggle="tab" href="#image"><span class="glyphicon glyphicon-camera" aria-hidde="true"></span></a></li>
		<li><a data-toggle="tab" href="#audio"><span class="glyphicon glyphicon-text-background" aria-hidde="true"></span></a></li>
		<li><a data-toggle="tab" href="#video"><span class="glyphicon glyphicon-facetime-video" aria-hidde="true"></span></a></li>
		<li><a data-toggle="tab" href="#text-content"><span class="glyphicon glyphicon-text-background" aria-hidde="true"></span></a></li>
	</ul>
	<!--fin tabs-->
	<!--Content tabs-->
	<div class="tab-content">
		<div class="tab-pane fade" id="description">
				<form class="form-vertical form-edit"  id="descripcion_for" >
				<fieldset>
				<legend><?=$this->lang->line('s_edt_m2')?></legend>
					<input type="hidden" name="action" value="descrip">
					<input type="hidden" name="id_rgtro" value="<?=$registro?>">
					<div class="input-group">
					<div class="col-lg-12">
					<textarea name="contenido_desc" id="contenido_desc" class="form-control" rows="3"><?=$descripcion?></textarea>
					</div>
					</div>
					<div class="msje" style="display:none"></div>
					<div class="form-actions input-group">
					<input type="button" class="btn btn-default" value="reset" onclick="reset_descr();">
					<input type="submit" class="btn btn-success">
					</div>
				</fieldset>
				</form>
		</div>

			<div class="tab-pane fade" id="image">
				<form class="form-vertical"  id="imagen_form">
				<fieldset>
					<legend><?=$this->lang->line('s_edt_m4')?></legend>
					<div class="panel panel-default">

					<?php if($file_image!='0'): ?>
					<figure ><img src="<?='/upload/'.$file_image?>" alt="<?=$file_image?>" width="50%"></figure>
					<?php else: ?>
				    <p><?=$this->lang->line('s_edt_m7')?></p>
					<?php endif; ?>
					</div>
					<div class="msje" style="display:none;"></div>
					<input type="hidden" name="action" value="img_ch">
					<input type="hidden" name="id_rgtro" value="<?=$registro?>">
					<button id="boton_img" class="btn btn-success btn-lg"><?=$this->lang->line('s_edt_m8')?></button>
				</fieldset>
			</form>
		</div>
		<div class="tab-pane fade" id="map-point">
			<form class="form-vertical form-edit"  id="coordenada_form" >
				<fieldset>
					<legend><?=$this->lang->line('s_edt_m3')?></legend>
					<input type="hidden" name="action" value="mapform">
					<div class="msje" style="display:none;"></div>
					<div id="map"></div>
					<input type="hidden" name="id_rgtr_m" value="<?=$registro?>">
					<div class="form-group">
					<label for="lat" class="control-label">Latitud:</label>
					<input class="input-control" type="text" id="lat" name="lat" value="<?=$latitud?>">
					<label for="lon" class="control-label">Longitud:</label>
					<input class="input-control" type="text" id="lon" name="lon" value="<?=$longitud?>">
					</div>
					<div class="form-actions">
					<input type="button" class="btn btn-default" value="reset" onclick="reset_marks();">
					<input type="submit" class="btn btn-success">
					</div>
				</fieldset>
			</form>
		</div>
		<div class="tab-pane fade" id="audio">
			<form class="form-vertical"  id="audi_form">
		<fieldset>
		<legend><?=$this->lang->line('s_edt_m5')?></legend>
	<div class="panel panel-default">
		<?php if($file_sound!=='0'): ?>
      <div id="audioholder">
      	<audio autobuffer  controls>
	<!--	<source src="/media/audio.oga">-->
		<source src="<?=base_url('upload').'/'.$file_sound?>">
		<object type="audio/x-wav" data="<?=base_url('upload').'/'.$file_sound?>" width="290" height="45">
			<param name="src" value="<?=base_url('upload').'/'.$file_sound?>">
			<param name="autoplay" value="false">
			<param name="autoStart" value="0">
			<p><a href="<?=base_url('upload').'/'.$file_sound?>">Download this audio file.</a></p>
		</object>
	</audio>
      </div>
  <?php else: ?>
  <p><?=$this->lang->line('s_edt_m6')?></p>
	<?php endif; ?>
	</div>
	<div class="msje" style="display:none;"></div>
		<input type="hidden" name="action" value="img_ch">
		<input type="hidden" name="id_rgtro" value="<?=$registro?>">
		</fieldset>
	</form>
	<button id="boton_aud" class="btn btn-success btn-lg"><?=$this->lang->line('s_edt_m14')?></button>
		</div>
		<div class="tab-pane fade" id="video">
			<form class="form-vertical form-edit"  id="youtu_form">
				<fieldset>
					<legend><?=$this->lang->line('s_edt_m9')?></legend>

		<?php if($video==null): ?>
						<p><?=$this->lang->line('s_edt_m10')?></p>
		<?php else: ?>
						<div id="youtu">
							<iframe width="460px" height="258px" src="http://www.youtube.com/embed/<?=$video?>" frameborder="0" allowfullscreen></iframe>
						</div>
		<?php endif; ?>
						<div class="msje" style="display:none;"></div>
						<input type="hidden" name="action" value="video_lk">
						<input type="hidden" name="id_vdo" value="<?=$id_video?>">
						<div class="form-group">
							<label for="youtu"><?=$this->lang->line('s_edt_m11')?></label>
							<input class="form-control" type="text" id="youtu" name="youtu">
						</div>
						<div class="form-actions">
							<input type="submit" class="btn btn-success">
							<input type="button" class="btn btn-inverse" value="reset" onclick="//reset_marks();">
						</div>
					</fieldset>
				</form>
		</div>
		<div class="tab-pane fade" id="text-content">
			<div class="text">
				<em><?=$this->lang->line('s_edt_m12')?></em>
		<?php if($texto==null): ?>
				<p><?=$this->lang->line('s_edt_m13')?></p>
			</div>
			<form class="form-vertical"  id="nw_hist_form">
				<div class="msje" style="display:none;"></div>
	 			<input type="hidden" name="action" value="hist_new">
				<textarea name="relato" id="text_item" cols="70" rows="10"></textarea>
				<input type="hidden" name="item_id" value="<?=$registro?>">
				<div class="form-actions">
					<input type="submit" class="btn btn-success">
				</div>
			</form>
		<?php else: ?>
			<form class="form-vertical"  id="hist_form">
				<div class="msje" style="display:none;"></div>
				<input type="hidden" name="action" value="hist">
				<input type="hidden" name="hist_id" value="<?=$id_relato?>">
				<textarea name="text_item" id="text_item" class="form-control" cols="70" rows="10"><?=$texto?></textarea>
				<div class="form-actions">
					<input type="submit" class="btn btn-success">
					<input type="button" value="reset" class="btn btn-inverse" onclick="reset_text();">
				</div>
			</form>
		<?php endif; ?>
		</div>
	</div>
	<!-- fin content tabs-->

</div>
</div>
