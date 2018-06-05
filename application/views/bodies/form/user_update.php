<div class="container-fluid">
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Actualización de datos</h3>
	</div>


<div class="panel-body">

<div class="container">
	<div class="row">
		<div class="col-lg-10">
		<div><?=$msj ?></div>

		</div>
	</div>
	<div class="col-lg-5">
		<div class="well">
			<?php if(isset($avatar)): ?>
			<form action="<?=site_url('user/actualizar/update_avatar')?>" method="post" enctype='multipart/form-data' role="form">
			<fieldset>
				<legend><?=$this->lang->line('s_usr_atz')?></legend>
				<img src="<?=base_url('img/user_img').'/'.$avatar?>" alt="">
				<input type="file" name="userfile" id="userfile" size="20">
				<input type="hidden" value="<?=$id?>" id="ref" name="ref" class="form-control">
				<input type="submit" value="<?=$this->lang->line('s_usr_ati')?>" class="btn btn-info">
			</fieldset>
		</form>
		<?php endif; ?>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="well">
		<form action="<?=site_url('user/perfil/update_perfil')?>" method="post" enctype='multipart/form-data' role="form">
			<fieldset>
				<input type="hidden" value="<?=$id?>" id="ref" name="ref">
			<legend><?=$this->lang->line('s_usr_hola')?> <?=$alias?>, <?=$this->lang->line('s_usr_msj')?></legend>
				<label for="nom"><?=$this->lang->line('s_reg_duinp')?></label>
				<input type="text" id="nom" name="nom" value="<?=$name?>" class="form-control">
				<label for="cognom"><?=$this->lang->line('s_reg_dcinp')?></label>
				<input id="cognom" type="text" name="cog1" value="<?=$cog1?>" class="form-control">
				<label for="cognom2"><?=$this->lang->line('s_reg_dccinp')?></label>
				<input id="cognom2" type="text" name="cog2" value="<?=$cog2?>" class="form-control">
				<label for="sexo"><?=$this->lang->line('s_usr_s')?></label>
				<select name="sexo" id="sexo" class="form-control">
					<option value="m" <?php if ($sexo=='m'):?>
						   selected
						<?php endif; ?>
						><?=$this->lang->line('s_usr_h')?></option>
					<option value="f" <?php if ($sexo=='f'):?>
						   selected
						<?php endif; ?>
						><?=$this->lang->line('s_usr_d')?></option>
				</select>
				<label for=""><?=$this->lang->line('s_reg_dobinp')?></label>
				<input type="text" id="dob" class="form-control" value="<?=$datana?>">
				<input type="hidden" id="date-to-db" name="date-to-db" value="<?=$datana?>">
				<input type="submit" value="<?=$this->lang->line('s_usr_dd')?>" class="btn btn-info">
			</fieldset>
		</form>
		</div>
	</div>
</div>
</div>
</div>
		</div>
	</div>
</div>