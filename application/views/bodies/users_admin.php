<div class="row-fluid">
	<div class="col-md-9">
		    	<div class="row mtbox">
                  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
					  			<span class="li li_user" style="color:grey"></span>
					  			<h3><?=$total_usr?></h3>
                  			</div>
					  			<p><?=$total_usr?> Usuarios registrados</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li li_user" style="color:green"></span>
					  			<h3><?=$activos?></h3>
                  			</div>
					  			<p><?=$activos?> Usuarios activos.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li li_user" style="color:orange"></span>
					  			<h3><?=$no_conf?></h3>
                  			</div>
					  			<p><?=$no_conf?> usuarios por confirmar.</p>
                  		</div>
						<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li li_user" style="color:red"></span>
					  			<h3><?=$bloque?></h3>
                  			</div>
					  			<p><?=$bloque?> Usuarios Bloqueados.</p>
                  		</div>
                  			<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li li_user" style="color:black;text-decoration: line-through;"></span>
					  			<h3><?=$cancel?></h3>
                  			</div>
					  			<p><?=$cancel?> Usuarios cancelados.</p>
                  		</div>
                  	</div><!-- /row mt -->
	</div>

</div>
<!--<div class="navbar navbar-inverse">
<ul class="nav navbar-nav">
  <li><a href="<?=site_url('administracio/usuaris/2')?>">Espera Confirmar<span class="badge"></span></a></li>
  <li><a href="<?=site_url('administracio/usuaris/1')?>">Total Usuarios<span class="badge"></span></a></li>
  <li><a href="<?=site_url('administracio/usuaris/1')?>">Activos<span class="badge"></span></a></li>
  <li><a href="<?=site_url('administracio/usuaris/3')?>">Bloqueados<span class="badge"></span></a></li>
  <li><a href="<?=site_url('administracio/usuaris/4')?>">Cancelados<span class="badge"></span></a></li>
</ul>
</div>
</div>-->
<div class="row-fluid">

<div id="mensaje" style="display:none;"></div>

<div id="usr_zn" >
          	<!-- SORTABLE TO DO LIST -->
	<div class="row mt mb">
		<div class="col-md-12">
			<section class="task-panel tasks-widget">
				<div class="panel-body">
					<div class="task-content">
						<div id="mensaje" style="display:none;"></div>

						<ul id="user-list" class="task-list">
					<?php if ($items->num_rows()>0):?>
					<?php foreach ($items->result() as $key ):?>
							<li id="usr_<?=$key->usuario_id?>" class="list-primary">
							<div class="task-checkbox">
								<input type="checkbox" class="list-child" value=""  />
							</div>
							<div class="task-title">
								<img class="avatar-icon" src="<?=base_url('img/user_img/thumb').'/'.$key->avatar ?>" alt="" >
								<span onclick="$('#user_modal').modal();ver_user(<?=$key->usuario_id?>);return false;" class="task-title-sp"><?= strtoupper($key->alias_usuario)?></span>
								<div class="pull-right hidden-phone">
									<button  data-userid="<?=$key->usuario_id?>" class="btn-card btn btn-default btn-xs fa fa-eye"></button>

					<?php if($key->confirmado==1): ?>
					<?php if($key->cuenta_activa>0): ?>
									<button onclick="conf_user(<?=$key->usuario_id?>,event);return false;" href="<?=site_url('list/edicio/historia').'/'.$key->usuario_id?>" class="btn btn-warning btn-xs fa fa-ban" data-userid="<?=$key->usuario_id?>"></button>
					<?php else: ?>
									<button onclick="conf_user(<?=$key->usuario_id?>,event);return false;" href="<?=site_url('list/edicio/historia').'/'.$key->usuario_id?>" class="btn btn-info btn-xs fa fa-user" data-userid="<?=$key->usuario_id?>"></button>
					<?php endif; ?>
					<?php else: ?>
									<button onclick="conf_user(<?=$key->usuario_id?>,event);return false;" href="<?=site_url('list/edicio/historia').'/'.$key->usuario_id?>" class="btn btn-success btn-xs fa fa-user-plus"></button>
					<?php endif; ?>
									<button class="btn btn-primary btn-xs fa fa-envelope-o  btn-contact" data-userid="<?=$key->usuario_id?>"></button>
								</div>
								</div>
							</li>
					<?php endforeach; ?>
					<?php else: ?>

						<p><?=$this->lang->line('s_adm_na')?></p>
						<?php endif; ?>
						</ul>
					</div>
					<div class=" add-task-row">
					<a class="btn btn-success btn-sm pull-left" href="<?=site_url('administracio/histories/1') ?>"><?=$this->lang->line('s_adm_pra')?></a>
					<a class="btn btn-success btn-sm pull-left" href="<?=site_url('administracio/histories/2') ?>"><?=$this->lang->line('s_adm_pre')?></a>
					<a class="btn btn-success btn-sm pull-left" href="<?=site_url('administracio/histories/3') ?>"><?=$this->lang->line('s_adm_prv')?></a>
					<a class="btn btn-success btn-sm pull-left" href="<?=site_url('administracio/histories/4') ?>"><?=$this->lang->line('s_adm_prd')?></a>
					<a class="btn btn-success btn-sm pull-left" href="<?=site_url('administracio/histories/5') ?>"><?=$this->lang->line('s_adm_prt')?></a>
					<a class="btn btn-success btn-sm pull-left" href="<?=site_url('administracio/histories/6') ?>"><?=$this->lang->line('s_adm_pru')?></a>

					</div>
				</div>
			</section>
		</div><!--/col-md-12 -->
	</div><!--
/row -->         </div> <div class="col-md-4">         <div id="usr-card"></div>

 </div>
 <div id="for_use" style="display:none">
 	<form action="">
 		<fieldset>
 		<input type="hidden" name="id_user" id="id_user" value="">
 		<textarea name="msj" id="msj" cols="30" rows="6" ></textarea>
 		<input type="button" value="send" onclick="env_mail();">
 		</fieldset>
 	</form>
 </div>
	</div>

</div>
<div class="modal fade" id="modal-mail" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id='title-mail' class="modal-title">Contactar con </h4>
      </div>
      <div class="modal-body">
        <p>
        </p>
        <div id="mail-status"></div>
		<form class="form_r" >
			<fieldset>
				<label for="asump"><?=$this->lang->line('s_new_vd5')?></label>
		    	<input type="text" id="asump" value="" placeholder="">
		    	<input type="hidden" value="" id="user-id" name="user-id">
		    	<label for="msj-mail">Contenido</label>
		    	<textarea name="msj-mail" id="msj-mail" cols="30" rows="10"></textarea>
			</fieldset>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="mail-btn" class="btn btn-primary">send</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->