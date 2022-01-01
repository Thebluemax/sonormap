
<!--fin modal buscador -->
<div class="modal fade" tabindex="-1" role="dialog" id="listModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      	<div id="asd_sld" class="">
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
						<a href="<?=site_url('historia').'/'.$key->url?>" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></a>
						<a href="" class="btn btn-primary map-pointer" data-ref="<?=$i?>"><span class="glyphicon glyphicon-map-marker"></span></a>
				<?php $i++; ?>
					</ul>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<!-- Search -->
	<div id="searcher" class="row" style="display:none">
   		<!-- modal buscador -->
			<ul class="nav nav-tabs">
			  	<li class="active"><a href="#buscador" data-toggle="tab" aria-expanded="false">Palabra</a></li>
			  	<li class=""><a href="#categoria" data-toggle="tab" aria-expanded="true">Categoria</a></li>
			  	<li class=""><a href="#fecha" data-toggle="tab" aria-expanded="true">Fecha</a></li>
			</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade active in" id="buscador">
		    <form class="form-vertical">
				<fieldset class="busq_l">
				<div class="col-md-10">
				<div class="input-group">
		        <input class="form-control" type="text" name="palabra" id ="palabra" value="" placeholder="">
		        <div class="input-group-btn">
		        <button data-search="palabras" class="btn btn-search btn-alert"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		        </div>
				</div>
				</div>
		      </fieldset>
		    </form>

  		</div>
		<div class="tab-pane fade  " id="categoria">
			 	<form class="form-vertical">
			    <fieldset class="busq_l">
			        <?=$categoria?>
			        <button data-search="categorias" class="btn btn-search btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
			      </fieldset>
			    </form>
		</div>
		<div class="tab-pane fade" id="fecha">
			<form class="form-vertical">
		    	<fieldset class="busq_l">
						<div  id="terminox" class="">
						<div class="radio">
						<label  for="">
							<input name="termino" type="radio" value="1"><?=$this->lang->line('s_asd_seb1') ?>
						</label>
						</div>
						<div class="radio">
						<label for="" >
							<input name="termino"  type="radio" value="2"><?=$this->lang->line('s_asd_seb2') ?>
						</label>
						</div>
						<div class="radio">
						<label for="" >
							<input  name="termino" type="radio" value="3"><?=$this->lang->line('s_asd_seb3') ?>
						</label>
						</div>
						</div>
						<br>
						<div class="form-group">
						<input type="text" id="datepicker" class="datepicker">
						<input type="hidden" id="date-to-db" value="">
						</div>
						 <button data-search="fechas" class="btn btn-search btn-default btn-lg"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<!-- modal final -->
    </div>

  <!--Final search-->
      <div class="modal-footer">
        	<div id="panel-info">

    	<div class="btn-group btn-group-justified">
		  	<a  class="btn btn-default" id="srch-btn" data-toggle="" data-target=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
		  	<a  id="rst" class="btn btn-default" data-toggle="" data-target=""><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></a>
		</div>
		</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
