 var alertBox = new AlertHolder();
 $(document).ready(function(){
  init();
});
function init()
{
	var	indice=new Pagination($('ul#user-list'),4);
	indice.build_list('li');
	indice.paginationBoton();
	indice.showList();
	$('button.btn-card').click(function(e)
		{	
			e.preventDefault();
			userCard($(this).data('userid'));
		});
	$('a.btn-block').click(function(e)
		{
			e.preventDefault();
			blockUser($(this).data('userid'));
		});
	$('a.btn-unblock').click(function(e)
		{
			e.preventDefault();
			unblockUser($(this).data('userid'));
		});
	$('a.btn-contact').click(function(e)
		{
			e.preventDefault();
			mailUser($(this).data('userid'));
		});
	$('button#mail-btn').click(function(e)
		{
			e.preventDefault();
			sendMail();
		});
}
/*
/ Función para ver la carta de información de un usuario.
*/
function userCard(u)
{

	var url_req ="/admin/admin/see_user";
	dates={
            'usr':u
           }
	var req=new AjaxRq(url_req,buildCard,dates);


}
function buildCard(msg) {
	
	if(msg.success){
		//msg=msg[0];
		var openBox="<div id=\"card\" class=\"alert alert-warning alert-dismissible\" role=\"alert\">";
		var closeBtn="<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
		var cardInfo="<div class=\"media-left\"><img src=\"/img/user_img/"+msg.avatar+"\" width=\"120\"></div><div class=\"media-body\">"+
		"<p id=\"usr-info\"> <h4 class=\"media-heading\">"+msg.alias+"</h4>"+
		"<span>ID: </span>"+msg.id+"<br>"+
		"<em>Nombre y Apellido: </em>"+msg.name+" "+msg.lastname+"<br>"+
		"<em>Miembro desde: </em>"+msg.since+"<br>"+
		"<em>data de naxeiment: </em>"+msg.dob+"<br><em>Email: </em>"+msg.email+"</p>";
		var closeDiv="</div></div>";
		
		//$('#usr_rol').html(msg.rol);
		$('div#usr-card').html(openBox+closeBtn+cardInfo+closeDiv).slideDown();
	}else{
		//lanzar_mensaj("<?=$this->lang->line('s_adm_meu')?>");
		console.log(msg);
            		}
}
function blockUser(u)
{
	var url_req="<?=site_url('administracio/block_user')?>";
    dates={
           		'us':u,
           		'flag':0
           }
    var req=new AjaxRq(url_req,blocked,dates);
}
function unblockUser(u) {
	var url_req="<?=site_url('administracio/block_user')?>";
    dates={
           		'us':u,
           		'flag':1
           }
    var req=new AjaxRq(url_req,unblocked,dates);
}
function blocked(msg) {
    if(msg.succes!=='false')
    {
        var box='#art_'+msg.userId+'>.msg-alert';
        alertBox.alert_success($(box),"<?=$this->lang->line('a_adm_mud')?>");
    }else{
        alertBox.alert_error($(box),"<?$this->lang->line('a_adm_mud')?>");
    }
}
function unblocked (msg) {
    if(msg.succes!=='false')
    {
        var box='#art_'+msg.userId+'>.msg-alert';
        alertBox.alert_success($(box),"<?=$this->lang->line('a_adm_mud')?>");
    }else{
        alertBox.alert_error($(box),"<?$this->lang->line('a_adm_mud')?>");
    }
}
// contactar user.
function mailUser(u)
{
	$('input#user-id').val(u);
	var selector='li#art_'+u+'>h3';
	var name=$(selector).text();
	var firstWord=$('h4#title-mail').text();
	$('h4#title-mail').text(firstWord+' '+name);
	$('#modal-mail').modal('show');
}
function sendMail () {
    var url_req="<?=site_url('administracio/mail_user')?>";
           dates={
                  'us':$('input#user-id').val(),
                  'msj':$('textarea#msj-mail').val()
           }
           var reqM=new AjaxRq(url_req,mailRespose,dates);

           $('#modal-mail').modal('hide');
           alertBox.loading_bar($('div#mensaje'));
}
function mailRespose(msg) {

	if(msg.succes!==false){
		var box=$('div#mensaje');
               alertBox.alert_success(box,"<?=$this->lang->line('s_adm_mes')?>");
            }else{
               alertBox.alert_error(box,"<?=$this->lang->line('s_adm_men')?>");

            }
}