<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<div class="well">
				
			<h2><?=$this->lang->line('s_frmc_ttl')?></h2>
			<p><?=$this->lang->line('s_frmc_msj')?></p>
			<div id="mensj"></div>
			<form id="contacta" action="<?=site_url('contacta/mail')?>" method="post">
				<fieldset>
				<label class="label-control" for="nombre"><?=$this->lang->line('s_frmc_n')?></label>
				<input type="text" id="nom" name="nom" requiered>
				<label class="label-control" for="mail"><?=$this->lang->line('s_frmc_ml')?></label>
				<input type="mail" id="mail" name="mail" requeried>
				<label class="label-control" for="por"><?=$this->lang->line('s_frmc_as')?></label>
				<input type="text" id="asunto" name="asunto" >
				<label class="label-control" for="text_cuerpo"><?=$this->lang->line('s_frmc_ms')?></label><textarea name="text_cuerpo" id="text_cuerpo" cols="30" rows="10"></textarea>
				<?=$captcha ?>
				<input type="submit" class="btn btn-success" value="<?=$this->lang->line('s_frmc_en')?>">
			</fieldset>
			</form>
			</div>
		</div>
	</div>
</div>