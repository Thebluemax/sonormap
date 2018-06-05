<div class="container">
	<div class="row">
		<h2></h2>

	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?=$this->lang->line('s_reg_ttl')?></h3>
			</div>
			<div class="panel-body">
				<p><?=$this->lang->line('s_reg_d1')?><br><?=$this->lang->line('s_reg_d2')?><br><?=$this->lang->line('s_reg_d3')?></p>
	<div class="container">
			<form id="registrer" action="" method="post" accept-charset="utf-8" class="form-horizontal">
				<div class="col-md-5">
					<div class="well">
						<legend><?=$this->lang->line('s_reg_fi1')?></legend>
						<fieldset>
							<div class="form-group">
								<label for="user" class="col-lg-2 control-label"><?=$this->lang->line('s_reg_uinp')?></label>
								<div class="col-lg-8">
									<input type="text" id="user" name="user"  class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label for="mail" class="col-lg-2 control-label"><?=$this->lang->line('s_reg_minp')?></label>
								<div class="col-lg-8">
									<input type="email" id="mail" name="mail"  class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label for="confir_mailing" class="col-lg-8 control-label">
									<input id="confir_mailing" type="checkbox" name="mailing" value="m" checked>
									<?=$this->lang->line('s_reg_mck')?></label>
								</div>
								<div class="form-group">
									<label for="pass" class="col-lg-2 control-label"><?=$this->lang->line('s_reg_cinp')?></label>
									<div class="col-lg-8">
										<input type="password" id="pass" name="pass"   class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label for="passconf" class="col-lg-2 control-label"><?=$this->lang->line('s_reg_ccinp')?></label>
									<div class="col-lg-8">
										<input type="password" id="passconf"  class="form-control" required>
									</div>
								</div>
							</fieldset>
						</div>
				</div>
					<div class="col-md-5">
						<div class="well">
							<legend><?=$this->lang->line('s_reg_dinp')?></legend>
							<fieldset>
								<div class="form-group">
									<label for="nom" class="col-lg-2 control-label"><?=$this->lang->line('s_reg_duinp')?></label>
									<div class="col-lg-8"><input type="text" id="nom" name="nom"  class="form-control" ></div>
								</div>
								<div class="form-group">
									<label for="cognom" class="col-lg-2 control-label"><?=$this->lang->line('s_reg_dcinp')?></label>
									<div class="col-lg-8"><input id="cognom" type="text" id="cognom" name="cog"  class="form-control" ></div>
								</div>
								<div class="form-group">
									<label for="cognom2" class="col-lg-2 control-label"><?=$this->lang->line('s_reg_dccinp')?></label>
									<div class="col-lg-8"><input id="cognom2" type="text" id="cognom2" name="cog2"  class="form-control" ></div>
								</div>
								<div class="form-group">
									<label for="sexo" class="col-lg-2 control-label">Sexo</label>
									<div class="col-lg-8">
										<select name="sexo" id="sexo" class="form-control ">
											<option value="<?=$this->config->item('male')?>"><?=$this->lang->line('s_reg_sexhom')?></option>
											<option value="<?=$this->config->item('female')?>"><?=$this->lang->line('s_reg_sexdon')?></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="datepicker" class="col-lg-2 control-label"><?=$this->lang->line('s_reg_dobinp')?></label>
									<div class="col-lg-6">
										<input id="datepicker" type="text" >
										<input id="d-o-b" type="hidden">
									</div>
								</div>
								<div class="form-group">
									<label for="confir_license" class="">
										<input id="confir_license" type="checkbox" name="license" value="s" requiredt>
										<?=$this->lang->line('s_reg_dscinp')?><a href="<?=site_url('avis_legal')?>"><?=$this->lang->line('s_reg_dscisv')?></a>
									</label>
								</div>
							</fieldset>
							</div>
						</div>
						<div class="col-md-12">
						<div class="form-group">
							<div id="recaptcha_p"></div>
						</div>
						</div>
						<div id="mensaje" style="display:none"></div>
							<div class="col-md-3" role="group" >
								<input type="submit" class="btn btn-primary btn-lg launch_bt" value="<?=$this->lang->line('s_reg_drinp')?>">
						</div>
			</form>
		</div>
			</div>
		</div>

		</div>
	</div>
</div>