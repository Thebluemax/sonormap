<div id="container">
  <div class="well">
<div class="alert alert-danger">
  
    <p>
    <span><?=$this->lang->line('s_err_u1') ?></span><br>
    <?=$this->lang->line('s_err_u2') ?>
    <?=anchor('registrar',$this->lang->line('s_nav_ins'), 'title="'.$this->lang->line('s_nav_ins').'"'); ?>
    <br>Si ya tienes una cuenta abierta 
    <a href="#" data-toggle="modal" data-target="#loginModal"><?=$this->lang->line('s_err_u3') ?></a></li>
    </p>
  </div>
  </div>
</div>

