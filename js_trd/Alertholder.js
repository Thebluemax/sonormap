var AlertHolder=function () {

}
AlertHolder.prototype.loading_bar= function  (block) {
  var html_alert_top="<div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>"+
  "<div class=\"progress progress-striped active\"><div class=\"progress-bar\" style=\"width: 100%\"></div></div>"+"</strong>"+
  "</div>";
  block.css('display','block');
  block.html(html_alert_top);
}
AlertHolder.prototype.alert_error=function  (block,msj) {
  var alert_error="<div class=\"alert alert-dismissable alert-danger\">"+
  "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>"+
  "<strong>Oh hay un error</strong><br>"+
  msj+"</div>";
  block.html(alert_error);
}
AlertHolder.prototype.alert_success=function  (block,msj) {
  var alert_success="<div class=\"alert alert-success\">"+
    "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+
    "<strong>"+msj+"</strong></div>";
  block.html(alert_success);
}

var AjaxRq=function (rute,callBack,dataR) {
	 var req = $.ajax({
		            url: rute,
		            type: "POST",
		            data: dataR
            		});
	 req.done(callBack);

	 req.fail(function(jqXHR, textStatus)
		{
          alert( "Request failed: " + textStatus );
        });
}