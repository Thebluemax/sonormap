<h2> <?=$this->lang->line('s_mlcf_u1') ?></h2>
<p> <span><?=$usr?>:</span><br><?=$this->lang->line('s_mlcf_u2') ?><em><?=$mail?></em><br><?=$this->lang->line('s_mlcf_u3') ?><br><?=$this->lang->line('s_mlcf_u4') ?><br>
<a href="#" onclick="reenvio();return false;"><?=$this->lang->line('s_mlcf_u5') ?></a></p>
<div id="mensaje" style="display:none"></div>

<form action="<?=site_url('login/change_mail')?>" method="post">
	<label for="mail"><?=$this->lang->line('s_mlcf_u6') ?></label>
	<input type="mail" id="mail" name="mail" requiered>
	<label for="pass"><?=$this->lang->line('s_mlcf_u7') ?></label>
	<input type="password" id="pass" name="pass" requiered>
	<?=$recaptcha ?>
	<input type="submit" value="enviar.">
</form>