<p>
	<?=$this->lang->line('s_usr_elus')?>
</p>
<form action="<?=site_url('user/actualizar/eliminar_cuenta') ?>" method="post">
	<input type="hidden" value="eliminar" name="eliminar">
	<input type="submit" value="<?=$this->lang->line('s_mrs_5')?>">
</form>