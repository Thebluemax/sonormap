<div class="modal fade" id="modal-audio" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?=$this->lang->line('s_new_fga')?></h4>
      </div>
      <div class="modal-body">
        <div id="fl_rc">
		</div>
  		<p> <?=$this->lang->line('s_new_ga1')?><br><?=$this->lang->line('s_new_ga2')?></p>
  <form class="form_r"  accept-charset="utf-8">
    <fieldset>
      <div>
        <p><?=$this->lang->line('s_new_grvc')?></p>
        <div style="background-color: #eeeeee;border:1px solid #cccccc">

            Temps: <span id="time">00:00</span>

         </div>


        <div>
          Level: <span id="level"></span>
        </div>

<div id="levelbase" style="width:200px;height:20px;background-color:#ffff00">

  <div id="levelbar" style="height:19px; width:2px;background-color:red"></div>

</div>

<div>
  Status: <span id="status"></span>
</div>
      </div>
      <input type="button" id="record"  value="<?=$this->lang->line('s_new_gbr')?>">
      <input type="button" id="stop" value="<?=$this->lang->line('s_new_stp')?>">
      <input type="button" id="send" value="<?=$this->lang->line('s_new_sts')?>">
      </fieldset>

  </form>
   <p><?=$this->lang->line('s_new_aud2')?></p>
  <form class="form_r" >
<fieldset>
           <div id="aud-uploader" class="bot-upl">
       <h6><?=$this->lang->line('s_new_fgac')?></h6>
     </div>
</fieldset>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal-video" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?=$this->lang->line('s_new_vd4')?></h4>
      </div>
      <div class="modal-body">
        <p><?=$this->lang->line('s_new_vd1')?><br>
        <em style="font-size:.7em;color:#000"> http://www.youtube.com/watch?v=<em style="background-color:orange;padding:3px">h6xfbBAD_HE</em></em>
        <br><?=$this->lang->line('s_new_vd2')?>
        </p>
        <div id="mensaje-video"></div>
		<form class="form_r" >
			<fieldset>
				<label for="video_tag"><?=$this->lang->line('s_new_vd5')?></label>
		    	<input type="text" id="video_tag" value="" placeholder="">
			</fieldset>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="video-btn" class="btn btn-primary">Guardar enlace</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal-image" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?=$this->lang->line('s_new_img1')?></h4>
      </div>
      <div class="modal-body">
		<p><?=$this->lang->line('s_new_imgt')?></p>
		<div id="mensaje-img"></div>
  		<form class="form_r" action= method="get" enctype="multipart/form-data">
    		<fieldset>
     			<div id="jquery-uploader" class="bot-upl">
       				<h6><?=$this->lang->line('s_new_img2')?></h6>
     			</div>
			</fieldset>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal-text" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?=$this->lang->line('s_new_txt1')?></h4>
      </div>
      <div class="modal-body">
        <p><?=$this->lang->line('s_new_txth')?></p>
        <form class="form_r" >
        <div id="mensaje-txt"></div>
			<fieldset>
    			<textarea name="tex_item" id="text_item" cols="50" rows="10"></textarea>
			</fieldset>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="text-btn" class="btn btn-primary">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="container-fluid">

       <div class="col-lg-8 col-lg-offset-1">
       <div class="panel panel-info">
       	<div class="panel-heading">
       		<h3 class="panel-title"><?=$this->lang->line('s_new_ttl')?></h3>
       	</div>
       	<div class="panel-body">
       	<div id="mensaje" class="row"></div>
    <div id="card" class="row">
       			    <div id="title-div"></div>
	    <div id="description-value"></div>
	    <div class="map-ref"><div id="smal-map" style="width:100%"></div></div>
	    <div id="img-div"></div>
	    <div id="video-div" class="embed-responsive"></div>
	    <div id="history-txt"></div>
				<div class="form_card panel panel-default">
					<div class="panel-body">
		   				<form  class="form_r" id="title-form">
		   					<label for="titol"><?=$this->lang->line('s_new_tul')?></label><br>
		   					<input type="hidden" name="" value="<?=$this->_id ?>">
		        			<input type="text" id="titol" name="titol" placeholder="<?=$this->lang->line('s_new_tul')?>"><span data-toggle="tooltip" data-placement="right" title=" <?=$this->lang->line('s_new_ps1')?>" class="glyphicon glyphicon-info-sign"></span><br>
		   					<div class="btn-group btn-group-justified">
		            			<a id="next0" class="btn btn-default next" data-pos='1' href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>
		        			</div>
		   				</form>
					</div>
				</div>
				<div class="form_card panel panel-default">
		    		<div class="panel-body">
		  				<form class="form_r" >
		        			<fieldset>
		       			 		<legend><?=$this->lang->line('s_new_tyd')?></legend><br>
								<label for="description"><?=$this->lang->line('s_new_des')?></label><br>
		            			<textarea id="description" name="description"></textarea><span data-toggle="tooltip" data-placement="right" title="<?=$this->lang->line('s_new_ps2')?>" class="glyphicon glyphicon-info-sign"></span><br>
		            			<label for=""><?=$this->lang->line('s_new_cat')?></label><br>
		            			<?=$categoria?><br>
		            			<div id="ico_cont"></div>
		            			<div class="btn-group btn-group-justified">
		            				<a id="next1" class="btn btn-default next" data-pos="2" href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>
		            			</div>
		        			</fieldset>
		     			</form>
		     		</div>
				</div>
				<div class="form_card panel panel-default">
		  				<form class="form_r" >
							<fieldset>
		  						<legend><?=$this->lang->line('s_new_mpp')?></legend>
		 					 <div id="choose_map" style="height:300px; width:90%;"></div>
		    					<div class="inputs">
		  							<input id="lat" type="text" class="cardinal">
		 							<input id="lon" type="text" class="cardinal"><span data-toggle="tooltip" data-placement="right" title="<?=$this->lang->line('s_new_map1')?>" class="glyphicon glyphicon-info-sign"></span><br>
		  						</div>
		  						 <div class="btn-group btn-group-justified">
									  <a class="btn btn-default" href="#" onclick="next(2);" ><span class="glyphicon glyphicon-arrow-left"></span></a>
									  <a class="btn btn-default next" data-pos="3" href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>
								  </div>
							</fieldset>
						</form>
				</div>
				<div class="form_card panel panel-default">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6"><div class="button-big" data-media="audio"><span class="glyphicon glyphicon-bullhorn"></span></div><span data-toggle="tooltip" data-placement="right" title="<?=$this->lang->line('s_new_aud1')?>" class="glyphicon glyphicon-info-sign"></span></div>
							<div class="col-md-6"><div class="button-big" data-media="image"><span class="glyphicon glyphicon-picture"></span></div></div>
						</div>
						<div class="row">
							<div class="col-md-6"><div class="button-big" data-media="video"><span class="glyphicon glyphicon-film"></span>    <span data-toggle="tooltip" data-placement="right" title="<?=$this->lang->line('s_new_aud2')?>" class="glyphicon glyphicon-info-sign"></span></div></div>
							<div class="col-md-6"><div class="button-big" data-media="text"><span class="glyphicon glyphicon-pencil"></span></div></div>
						</div>
						<div class="row">
							<div class="btn-group btn-group-justified">
								<a class="btn btn-default next" href="#" data-pos="4"  >
									<span class="glyphicon glyphicon-arrow-left"></span>
								</a>
								<a class="btn btn-default" id="send-to"  href="#">Guardar Historia</a>
							</div>
						</div>
					</div>
				</div>
  </div>

     </div>
<div id="final_adv" style="display:none">
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>La teva història ha estat guardada.</strong> Per veure-la la trobessis en el teu espai privat al costat de les teves altres històries.
Allí podràs fer els canvis i correccions que desitgis o necessitis.
Quan vulguis que es publiqui, fes clic en la icona de publicar i nosaltres et validarem la història i estarà disponible per a tots en el mapa de Salt
 <div class="que" style="text-align:center">
  <a style="color:#800;font-size:1.5em;margin-left:20px" href="<?=site_url('user/perfil') ?>">tornar al teu espai personal</a>
  <a style="color:#800;font-size:1.5em;margin-left:20px" href="<?=site_url('inici') ?>">tornar al Inici</a>
  <a style="color:#800;font-size:1.5em;margin-left:20px" href="<?=site_url('arxivar') ?>">Compartir una història</a>
</div>
</div>


</div>
       	</div>
       </div>



<!-- <div class="row">

<div id="itm_pth">
  <div class="itm_sta">
    <div class="h_sta">1</div>
    <div class="dcr"><img src="<?='img/til.png'?>" alt="" width="35px" height="29px"></div>
  </div>
  <div class="dir_fl"></div>
  <div class="itm_sta">
    <div class="h_sta">2</div>
    <div class="dcr"><img src="<?='img/com.png'?>" alt="" width="35px" height="29px"></div>
  </div>
  <div class="dir_fl"></div>
  <div class="itm_sta">
    <div class="h_sta">3</div>
    <div class="dcr"><img src="<?='img/mic.png'?>" alt="" width="35px" height="29px"></div>
  </div>
  <div class="dir_fl"></div>
  <div class="itm_sta">
    <div class="h_sta">4</div>
    <div class="dcr"><img src="<?='img/caf.png'?>" alt="" width="35px" height="29px"></div>
  </div>
  <div class="dir_fl"></div>
  <div class="itm_sta">
    <div class="h_sta">5</div>
    <div class="dcr"><img src="<?='img/cam.png'?>" alt="" width="35px" height="29px"></div>
  </div>
  <div class="dir_fl"></div>
  <div class="itm_sta">
    <div class="h_sta">6</div>
    <div class="dcr"><img src="<?='img/his.png'?>" alt="" width="35px" height="29px"></div>
  </div>
</div>
</div>-->

</div>
</div>