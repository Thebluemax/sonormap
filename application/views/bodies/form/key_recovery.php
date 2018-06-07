<div class="row">
<div class="col-lg-8 col-lg-offset-2">
<div class="panel panel-primary">
<div class="panel-heading">
<h2><?=$this->lang->line('s_re_cs')?></h2>
</div>
<div class="panel-body">
<div class="well">
<p class="lead"><?=$this->lang->line('s_re_ins')?></p>
<p>

<form action="<?=site_url('keylost')?>" method="post" class="form-horizontal">
  <div class="col-lg-10 col-lg-offset-1">
    <div class="input-group input-group-lg">
   <span class="input-group-addon" id="sizing-addon1">@</span>
      <input type="text" class="form-control" id="emai_id" name="email_id" placeholder="Email de registro">
      <span class="input-group-btn">
        <input type="submit" class="btn btn-info"  class="form-control" value="<?=$this->lang->line('s_re_env')?>">
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->

</form>
</p>

	<p> <a href="<?=site_url('registrar') ?>">Crea una nueva cuenta para ti</a></p>
</div>
</div>
</div>