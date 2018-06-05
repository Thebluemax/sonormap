<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<div class="panel panel-success">
				<div class="media">
				 <div class="media-left">
      				<img src="img/user_img/<?=$avatar_u?>" data-src="..." class="media-object" alt="<?=$avatar_u?>">
      			</div>
      				<div class="media-body">
        			<h3  class="media-heading"><?=$alias_u?></h3>
        			
        			<ul class="list-group">
				    	<li class="list-group-item">Nombre:<?=$name_u ?> </li>
				    	<li class="list-group-item">
				    	<?php if ($sexo_u==='m'):?>
				    		Hombre
				    	<?php else: ?>
				    		Mujer
				    	<?php endif; ?>
				    	 </li>
				    	<li class="list-group-item">Mes visitado<br><em><?=strtoupper($mes_vist_t)?></em> <span class="badge"><?=$mes_total_num?></span></li>

				    	<li class="list-group-item">Historias compartidas<strong class="badge"><?=$total_i?></strong><br><a href="#" >Ver historias de este usuario</a></li>
        			</ul>
        			
      				</div>
    			</div>
			</div>
		</div>
</div>