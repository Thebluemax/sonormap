<div class="container-fluid">
	<div class="row mtbox">
  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
  			<div class="box1">
	  			<span class="li_news"></span>
	  			<h3>89</h3>
  			</div>
	  			<p>89 Artículos en La web</p>
  		</div>
  		<div class="col-md-2 col-sm-2 box0">
  			<div class="box1">
	  			<span class="li_cloud"></span>
	  			<h3>151</h3>
  			</div>
	  			<p>151 número de archivos guardados en disco.</p>
  		</div>
  		<div class="col-md-2 col-sm-2 box0">
  			<div class="box1">
	  			<span class="li_user"></span>
	  			<h3>14</h3>
  			</div>
	  			<p>89 usuarios registrados.</p>
  		</div>
  		<div class="col-md-2 col-sm-2 box0">
  			<div class="box1">
	  			<span class="li_stack"></span>
	  			<h3>5</h3>
  			</div>
	  			<p>5 articulos para revistas y publicar.</p>
  		</div>
		<div class="col-md-2 col-sm-2 box0">
  			<div class="box1">
	  			<span class="li_eye"></span>
	  			<h3>870</h3>
  			</div>
	  			<p>870 visitas han leido articulos.</p>
  		</div>

	</div>
<div class="row">
	<div class="panel panel-info">
		<div class="panel-heading">
       		<h3 class="panel-title">Perfil - <?=$alias?></h3>
       	</div>
		<div class="panel-body">
			<div class="container">

				<div class="row">
	<div class="col-lg-3 col-md-4">
		<figure >
			<img src="<?=base_url('img/user_img').'/'.$avatar?>" width="100%" alt="avatar de <?=$alias?>">
		</figure>
	</div>
	<div class="col-lg-4 col-md-4">
		<ul class="list-group">
			<li class="list-group-item"><?=$this->lang->line('s_usr_n') ?><?=$name?> <a  href="<?=site_url('user/update')?>"><?=$this->lang->line('s_usr_dd') ?></a></li>
			<li class="list-group-item"><?=$this->lang->line('s_usr_c') ?><?=$cog1.' '.$cog2?></li>
			<li class="list-group-item"><?=$this->lang->line('s_usr_s') ?><?php if($sexo=='m'):?>
				<?=$this->lang->line('s_usr_h') ?>
			<?php else: ?>
				<?=$this->lang->line('s_usr_d') ?>
			<?php endif; ?>
			</li>
			<li class="list-group-item"><?=$this->lang->line('s_usr_dx') ?><?=$datana?></li>
			<li class="list-group-item"><?=$this->lang->line('s_usr_ct') ?><?=$email?><button  class="btn btn-info btn-xs fa fa-pencil" data-toggle="modal" data-target="#mail-modal"></button></li>
			<li class="list-group-item"><a type="button" class="" data-toggle="modal" data-target="#key-modal">
  <?=$this->lang->line('s_usr_cx') ?>
</a></li>
			<?php if($mailing==1): ?>
			<li class="list-group-item"><a  href="<?=site_url('user/actualizar/mailing/no')?>"><?=$this->lang->line('s_usr_ab') ?></a></li>
			<?php else: ?>
			<li class="list-group-item"><a  href="<?=site_url('user/actualizar/mailing/si')?>"><?=$this->lang->line('s_usr_aa') ?></a></li>
			<?php endif; ?>
			<li class="list-group-item"><a  href="<?=site_url('user/actualizar/eliminar_cuenta')?>"><?=$this->lang->line('s_usr_cl') ?></a></li>
		</ul>
	</div>
</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- modal para cambio de clave -->
<div id="key-modal" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-info"><?=$this->lang->line('s_usr_nki') ?></div >
<div class="well">

<div class="col-lg-4 col-lg-offset-4">

<form id="new-key" action="<?=site_url('user/actualizar/cambio_clave')?>" method="post">
	<label for="key"><?=$this->lang->line('s_usr_oki') ?></label>
	<input type="password" id="key" name ="key" required>
	<label for="new_key"><?=$this->lang->line('s_usr_nk') ?></label>
	<input type="password" id="new_key" name ="new_key" required>
</form>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="key-btn"  type="button" class="btn btn-primary"><?=$this->lang->line('s_usr_cx') ?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<!-- Modal -->
<div class="modal fade" id="mail-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title">Cambio de correo</h3>
        </div>
			<div class="panel-body">
				<div id="alert-box"></div>
					<p><?=$this->lang->line('s_usr_mjc') ?></p>
					<div class="well">
						<form id="mail-form"  method="post">
							<input type="mail" id="mail" name="mail">
						</form>
					</div>
      			<div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button id="mail-btn" type="button" class="btn btn-primary"><?=$this->lang->line('s_usr_cnv')?></button>
		      </div>
    		</div>
	</div>
</div>