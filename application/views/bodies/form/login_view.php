<div class="panel panel-default">
<div class="panel-body">
<div class="alert alert-dismissable alert-danger">
<?=$this->lang->line('s_mrs_6')?>
<?=$this->lang->line('s_log_err1')?>
</div>
<div class="alert alert-dismissable alert-warning">
<?=$mensaje?>
</div>

<div id="mensaje_ajax"></div>
<div class="container">
<div class="row">

<form role="form" action=<?='"'.site_url('login').'"'?> method="post" accept-charset="utf-8">
		<fieldset>
		 <div class="form-group">
		 <div class="col-lg-8">
		<input class="form-control" type="text" id="usr_id" name="usr_id" placeholder="<?=$this->lang->line('s_log_plc1')?>"><br>
		</div>
		</div>
		 <div class="form-group">
		 <div class="col-lg-8">
		<input class="form-control" type="password" name="password" value="" placeholder="<?=$this->lang->line('s_log_plc2')?>">	<br>
		</div>
		</div>
		 <div class="form-group">
		 <div class="col-lg-8">
		<?=$captcha?>
		</div>
		</div>
		 <div class="form-group">
		 <div class="col-lg-8">
		<input class="btn btn-primary" type="submit" name="" value="<?=$this->lang->line('s_bttn')?>">
		</div>
		</div>
		</fieldset>
</form>

</div>
</div>
</div>
</div>