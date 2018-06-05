<div class="jumbotron">
	<div class="alert alert-danger">
		<h2>Lo sentimos, por seguridad.</h2>
    	<p>
    		<span>Tu usuario está blockeado</span><br>
    			<?=anchor('contacta','Contacta con el administrador', 'title="'.$this->lang->line('s_nav_ins').'"'); ?>
    			<br>O puedes intentar de nuevo.<a href="#" data-toggle="modal" data-target="#loginModal"><?=$this->lang->line('s_err_u3') ?></a></li>
    	</p>
  	</div>
</div>