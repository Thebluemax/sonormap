$(document).ready(function  () {
	init();
});
var boxAlert;
function init() {
	boxAlert = new AlertHolder();
	$('#key-btn').click(function (evt) {
			evt.preventDeault();
			var dataR=$('#key-form').serialize();
			boxAlert.loading_bar($('#alert-box'));
			var request= new AjaxRq  ("<?=site_url('user/actualizar/mail')?>",showRequest,dataR);
	});
	$('#mail-btn').click(function (evt) {
			evt.preventDefault();
			var dataR=$('#mail-form').serialize();
			boxAlert.loading_bar($('#alert-box'));
			var request= new  AjaxRq  ("<?=site_url('user/actualizar/mail')?>",showRequest,dataR);
	});

}
function showRequest(msj) {
	if (msj.success==true)
	{
		boxAlert.alert_success($('#alert-box'),msj.msj);
	}
	else
	{
		boxAlert.alert_error($('#alert-box'),msj.msj);

	}
}