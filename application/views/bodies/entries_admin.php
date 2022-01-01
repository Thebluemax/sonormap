<!-- contenido-->

          <h3><i class="fa fa-tasks"></i><?=$this->lang->line('s_adm_histll')?></h3>

          	<!-- SORTABLE TO DO LIST -->

              <div class="row mt mb">
                  <div class="col-md-12">
                      <section class="task-panel tasks-widget">
                          <div class="panel-body">
                              <div class="task-content">
								<div id="mensaje" style="display:none;"></div>

                                  <ul id="history-list" class="task-list">
                                  	<?php if ($items->num_rows()>0):?>
									<?php foreach ($items->result() as $key ):?>
                                      <li id="art_<?=$key->id_registro?>" class="list-primary">
                                          <i data-toggle="tooltip" data-placement="right" title="<?=html_entity_decode($key->descripcion)?>" class=" fa fa-ellipsis-v"></i>
                                          <div class="task-checkbox">
                                              <input type="checkbox" class="list-child" value=""  />
                                          </div>
                                          <div class="task-title">
                                              <span onclick="$('#user_modal').modal();ver_user(<?=$key->usuario_id?>);return false;" class="task-title-sp"><?=html_entity_decode($key->titulo)?></span><?=$this->lang->line('s_adm_at').$key->alias_usuario?>
                                            <?php if($key->revisado!=1): ?>
												<?php if($key->revisado!=2): ?>
												<!--<button class="btn btn-warning btn-sm"></button>-->
												<span class="badge bg-warning">En edición</span>
											<?php else: ?>
													<!--<button class="btn btn-primary btn-sm" onclick="val_itm(<?=$key->id_registro?>,event);return false;"><?=$this->lang->line('s_adm_vl')?></button>-->
													<span class="badge bg-danger">Para validar</span>
											<?php endif; ?>
										<?php else: ?>
												<!--<button class="btn btn-primary btn-sm" onclick="block_hist(<?=$key->id_registro?>);return false;"><?=$this->lang->line('s_adm_ds')?></button>-->
												<span class="badge bg-success">Activo</span>
										<?php endif; ?>

                                              <div class="pull-right hidden-phone">
                                        <?php if ($key->revisado == 0 ):?>
                                               	<button class="btn btn-default btn-xs fa fa-eye" disabled></button>
                                        <?php else:?>
                                         		<button  data-key="<?=$key->id_registro?>" class="btn btn-info btn-xs fa fa-eye preview"></button>
                                        <?php endif;?>
                                        <?php if ($key->revisado == 2 ):?>
                                               	<button href="#" data-key="<?=$key->id_registro?>" class="btn btn-success btn-xs fa fa-check validate"></button>
										<?php else:?>
                                               	<button href="#" data-key="<?=$key->id_registro?>" class="btn btn-default btn-xs fa fa-check " disabled></button>

										<?php endif;?>
                                        <?php if ($key->revisado != 0 ):?>

                                                <a href="/admin/admin/edit/<?=$key->id_registro?>" class="btn btn-primary btn-xs fa fa-pencil"></a>
                                                <button onclick="errase_h(<?=$key->id_registro?>);return false;" class="btn btn-danger btn-xs fa fa-trash-o"></button>
										<?php else:?>
												<button class="btn btn-default btn-xs fa fa-pencil" disabled=""></button>
                                                <button class="btn btn-default btn-xs fa fa-trash-o" disabled></button>
										<?php endif;?>

                                              </div>
                                          </div>
                                      </li>

								<?php endforeach; ?>
								<?php else: ?>

									<p><?=$this->lang->line('s_adm_na')?></p>
							    <?php endif; ?>
                                  </ul>
                              </div>
                              <div class="add-task-row">
                              		<a class="btn btn-success btn-sm pull-left" href="<?=site_url('admin/admin/entries/1') ?>"><?=$this->lang->line('s_adm_pra')?></a>
    								<a class="btn btn-success btn-sm pull-left" href="<?=site_url('admin/admin/entries/2') ?>"><?=$this->lang->line('s_adm_pre')?></a>
    						 </div>
                              <div class="add-task-row">
                              	<h4>Ordenar por</h4>
    								<a class="btn btn-success btn-sm pull-left" href="<?=site_url('admin/admin/entries/3') ?>"><?=$this->lang->line('s_adm_prv')?></a>
    								<a class="btn btn-success btn-sm pull-left" href="<?=site_url('admin/admin/entries/4') ?>"><?=$this->lang->line('s_adm_prd')?></a>
    								<a class="btn btn-success btn-sm pull-left" href="<?=site_url('admin/admin/entries/5') ?>"><?=$this->lang->line('s_adm_prt')?></a>
    								<a class="btn btn-success btn-sm pull-left" href="<?=site_url('admin/admin/entries/6') ?>"><?=$this->lang->line('s_adm_pru')?></a>

                              </div>
                          </div>
                      </section>
                  </div><!--/col-md-12 -->
              </div><!-- /row -->
<!-- End content -->
<div class="modal fade" id="user_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <div id="cont">
  	<em>usuari</em>
  	<p id="usr_alias"></p>
  	<em>nom</em>
  	<p id="usr_nom"></p>
  	<em>cognom</em>
  	<p id="usr_cog"></p>
  	<em>imatge</em>
  	<p id="usr_avt"></p>
  	<em>rol</em>
  	<p id="usr_rol"></p>
  	<em>data de n.</em>
  	<p id="usr_dob"></p>
  	<em>correu</em>
  	<p id="usr_mail"></p>

  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('s_adm_tanc')?></button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="entry-canvas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog mdal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="entry-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<div id="modal-entry" class="container-fluid">
       		<div class="row"><div class="col-12">
       			<h3 id="title-e"></h3>
       			<em id="author-e"></em>
       		</div></div>
       		<div class="row"><div class="well">
       			<p id="description-e"></p>
       		</div></div>
       		<div class="row"><div class="col-12">
       			<figure><img src="" alt="" id="image-e"></figure>
       			<span id="url-img"></span>
       		</div>
       		<div class="col12">
       			<div class="well">
       				<p id="text-e"></p>
       			</div>
       		</div></div>
       		<div class="row"></div>
       	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>