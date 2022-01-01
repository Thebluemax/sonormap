
	<tr>
			<td ><?=$this->lang->line('s_mail_u7').' '.$this->lang->line('s_h1_site')?>, <?=$to_name?>.  <?=$this->lang->line('s_mail_u8').$this->config->item('conf_key_limit')?> hs.<br><?=$this->lang->line('s_mail_u9')?>
				.<br>
				<a href="<?=site_url('login/new_key').'/'.$hash?>"><?=site_url('login/new_key').'/'.$hash?></a>		<br><?=$this->lang->line('s_mail_u10')?>

			</td>

	</tr>