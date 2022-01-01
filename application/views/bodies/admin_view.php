      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->

              <div class="row">
                  <div class="col-lg-9 main-chart">

                  	<div class="row mtbox">
                  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
					  			<span class="li_news"></span>
					  			<h3><?=$total_items?></h3>
                  			</div>
					  			<p><?=$total_items?> Artículos en La web</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_cloud"></span>
					  			<h3><?=$file_num?></h3>
                  			</div>
					  			<p><?=$file_num?> número de archivos guardados en disco.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_user"></span>
					  			<h3><?=$total_usr?></h3>
                  			</div>
					  			<p><?=$total_items?> usuarios registrados.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_stack"></span>
					  			<h3><?=$total_por_confir?></h3>
                  			</div>
					  			<p><?=$total_por_confir?> articulos para revistas y publicar.</p>
                  		</div>
						<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_eye"></span>
					  			<h3><?=$total_vistos?></h3>
                  			</div>
					  			<p><?=$total_vistos?> visitas han leido articulos.</p>
                  		</div>
                  	</div><!-- /row mt -->


                      <div class="row mt">
                      <!-- SERVER STATUS PANELS -->

	<div class="col-md-4 mb">
                      		<div class="darkblue-panel pn">
                      			<div class="darkblue-header">
						  			<h5>ESPACIO EN DISCO</h5>
                      			</div>
								<canvas id="serverstatus02" height="120" width="120"></canvas>
								<script>

								</script>
								<p><?=date('d-m-Y',time())?></p>
								<footer>
									<div class="pull-left">
										<h5><i class="fa fa-hdd-o"></i> <?=$total_spd?> GB</h5>
									</div>
									<div class="pull-right">
										<h5><?=$avg_file?>% Usado</h5>
									</div>
									<script>var doughnutData = [
											{
												value: <?=$avg_file?>,
												color:"#68dff0"
											},
											{
												value : <?=100-$avg_file?>,
												color : "#444c57"
											}
										];</script>
								</footer>
                      		</div><!-- /darkblue panel -->
						</div><!-- /col-md-4 -->

                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5>TOP ARTICULO</h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-eye"></i> <?=$top_item_visto?></p>
									</div>
									<div class="col-sm-6 col-xs-6"></div>
	                      		</div>
	                      		<div class="centered">
										<img src="upload/thumb/<?=$top_item_img?>" width="120">
	                      		</div>
	                      		<div class="col-md-8">
										<p class="small mt"><?=$top_item?></p>
										<p>></p>
									</div>
                      		</div>
                      	</div><!-- /col-md-4 -->

						<div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>TOP USER</h5>
								</div>
								<p><img src="img/user_img/thumb/<?=$top_user_avatar?>" class="img-circle" width="80"></p>
								<p><b><?=$top_user?></b></p>
								<div class="row">
									<div class="col-md-6">
										<!--<p class="small mt">MEMBER SINCE</p>
										<p>2012</p>-->
									</div>
									<div class="col-md-6">
										<p class="small mt">total de visitas</p>
										<p><?=$top_user_visto?></p>
									</div>
								</div>
							</div>
						</div><!-- /col-md-4 -->


                    </div><!-- /row -->


					<div class="row">
						<!-- TWITTER PANEL -->



						<div class="col-md-4 mb">
							<!-- INSTAGRAM PANEL -->
							<div class="instagram-panel pn">
								<i class="fa fa-instagram fa-4x"></i>
								<p>@THISISYOU<br/>
									5 min. ago
								</p>
								<p><i class="fa fa-comment"></i> 18 | <i class="fa fa-heart"></i> 49</p>
							</div>
						</div><!-- /col-md-4 -->

						<div class="col-md-4 col-sm-4 mb">
							<!-- REVENUE PANEL -->
							<div class="darkblue-panel pn">
								<div class="darkblue-header">
									<h5>REVENUE</h5>
								</div>
								<div class="chart mt">
									<div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
								</div>
								<p class="mt"><b>$ 17,980</b><br/>Month Income</p>
							</div>
						</div><!-- /col-md-4 -->

					</div><!-- /row -->

					<div class="row mt">
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                          <h3>VISITS</h3>
                      </div>
                      <div class="custom-bar-chart">
                          <ul class="y-axis">
                              <li><span>10.000</span></li>
                              <li><span>8.000</span></li>
                              <li><span>6.000</span></li>
                              <li><span>4.000</span></li>
                              <li><span>2.000</span></li>
                              <li><span>0</span></li>
                          </ul>
                          <div class="bar">
                              <div class="title">JAN</div>
                              <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">FEB</div>
                              <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">MAR</div>
                              <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">APR</div>
                              <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
                          </div>
                          <div class="bar">
                              <div class="title">MAY</div>
                              <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">JUN</div>
                              <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
                          </div>
                          <div class="bar">
                              <div class="title">JUL</div>
                              <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
                          </div>
                      </div>
                      <!--custom chart end-->
					</div><!-- /row -->

                  </div><!-- /col-lg-9 END SECTION MIDDLE -->


      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->

                  <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
						<h3>En Espera</h3>
						<?php if ($edit_item->num_rows()>0):?>
						<?php foreach ($item_ck->result() as $key ):?>
							<div class="desc" id="art_<?=$key->id_registro?>">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
						<div class="details">
                      		<p><muted></muted><br/>
                      			<a href="<?=site_url('historia').'/'.$key->url?>"><?=html_entity_decode($key->titulo)?></a> En espera para validar.<br/>
                      		</p>
							<?php if($key->revisado!=2): ?>

								En edició

							<?php else: ?>

								<button class="btn btn-default btn-sm" onclick="val_itm(<?=$key->id_registro?>,event);"><?=$this->lang->line('s_adm_vl')?></button>

							<?php endif; ?>


                      	</div>
                      </div>
			<!--<a  class="list-group-item">
					<p>
						<span></span><br><?=$this->lang->line('s_adm_at').$key->alias_usuario?>
					</p>
					<p>
						<?=$this->lang->line('s_adm_dc')?><br>
						<?=html_entity_decode($key->descripcion)?>
					</p>
					<div class="btn-group" role="group">
						<button class="btn btn-default"  onclick="ver_art(<?=$key->id_registro?>);"><?=$this->lang->line('s_adm_vr')?></button>



					</div>
				</a>-->
			<?php endforeach; ?>

                       <!-- USERS ONLINE SECTION -->
						<h3>USUARIOS EDITANDO</h3>
                      <!-- First Member -->
                      	<?php foreach ($edit_item->result() as $key ):?>
                      		<div id="usr_<?=$key->usuario_id?>" class="desc">
                      	<div class="thumb">
                      		<img class="img-circle" src="img/user_img/thumb/<?=$key->avatar?>" width="35px" height="35px" align="">
                      	</div>
                      	<div class="details">
                      		<p><a href="#"><?=$key->alias_usuario?></a><br/>
                      		   <muted>Editando <?=$key->number_rows?></muted>
                      		</p>
                      	</div>
                      </div>
                      <!-- Second Member -->
			<?php endforeach; ?>
			<?php else: ?>
				<p><?=$this->lang->line('s_adm_na')?></p>
		    <?php endif; ?>
                        <!-- CALENDAR-->
                        <div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div><!-- / calendar -->

                  </div><!-- /col-lg-3 -->
              </div><!--/row -->