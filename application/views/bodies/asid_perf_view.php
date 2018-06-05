<div id="asid_rg">
	<div id="header_log">
	<form action=<?='"'.site_url('user/login').'"'?> method="post" accept-charset="utf-8">
		<label for="usr_id"><?=$this->lang->line('s_lbl_usr')?></label>
		<input type="text" id="usr_id" name="usr_id" placeholder="<?=$this->lang->line('s_plh_usr')?>">
		<label for="password"><?=$this->lang->line('s_lbl_clv')?></label>
		<input type="password" name="password" value="" placeholder="<?=$this->lang->line('s_plh_clv')?>">	
		<input type="submit" name="" value="<?=$this->lang->line('s_bttn')?>">					
	</form>
</div>
</div>