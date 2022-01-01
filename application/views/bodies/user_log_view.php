
	<div id="header_user" class="radio10">
	<?=$name.$this->lang->line('s_usr_mess')?><br>
	<a href="<?=site_url('user/login/out')?>" title=""><?=$this->lang->line('s_usr_clos')?></a>
</div>
	

<div id="header_log">
	<form action=<?='"'.site_url('login').'"'?> method="post" accept-charset="utf-8">
		<div id="inputs">
		<label for="usr_id"><?=$this->lang->line('s_lbl_usr')?></label>
		<input type="text" id="usr_id" name="usr_id" placeholder="<?=$this->lang->line('s_plh_usr')?>">
		<label for="password"><?=$this->lang->line('s_lbl_clv')?></label>
		<input type="password" name="password" value="" placeholder="<?=$this->lang->line('s_plh_clv')?>">	
		</div>
		<div id="bot_sub">
		<input type="submit" name="" value="<?=$this->lang->line('s_bttn')?>"><br>	
		<a href="<?=site_url('user/recuperar_key') ?>"><?=$this->lang->line('s_usr_rckp')?></a>
		</div>				
	</form>
</div>
