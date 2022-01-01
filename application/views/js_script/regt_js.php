/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package   Sonormamap
 * @author    Maximiliano Fernández - @mxml13
 * @copyright under GNU/GPL licence 2013.
 * @license   http://  /license.html
 * @link    http://
 * @since   Version 0.0
 * @filesource  /js/
 */
 var alertBox;
 $(document).ready(function(){
  init();
});
function init(){
  //made_captcha();
  $("#datepicker").datepicker(
    { 
      changeMonth: true,
      changeYear: true,
      altField: "#d-o-b",
      altFormat: "yy-mm-dd"
    });
  $('#registrer').submit(function (event){

  	event.preventDefault();
    var id_m = $('#user').val();
 		 var cla=$('#pass').val();
			var c_clv=$('#passconf').val();
  
if(id_m.length>4){
	
 if((cla==c_clv)&&cla.length>6){
   if($('#confir_license').prop("checked")){
    
         var datos=$('#registrer').serialize();
          	  $.ajax({
              		   type:"POST",
              		  url:"<?=site_url('user/registro')?>",
               			 data:datos,
                     beforeSend: function(){
                      $('#mensaje').html('Carregan les dades...<br><img src="<?=base_url('img/loading.gif')?>">').css('display','block');
                     },
             		   success: function(respuesta){
                                    if (respuesta==1) {
                                    		lanzar_mensaj(ok_tg+"<?=$this->lang->line('s_msr_1')?>"+end_tg);
                                        $('#registrer')[0].reset(); 
                                         Recaptcha.destroy();

          	         }else{
                      lanzar_mensaj(error_tg+respuesta+end_tg);
                      Recaptcha.reload();
                     }
                                    }
                  			
              										  
           				 });
          	         }else{

          	         	lanzar_mensaj(error_tg+"<?=$this->lang->line('s_err_u4')?>"+end_tg);
          	         }
     			   }else{
     			   			          	       
          	         	lanzar_mensaj(error_tg+"<?=$this->lang->line('s_err_u5')?>"+end_tg);
      					  }
      		  }else{
              			lanzar_mensaj(error_tg+"<?=$this->lang->line('s_err_u6')?>"+end_tg);
      			   } 
     return false;
   });
}
function made_captcha(){
  <?php $this->config->load('recaptcha')?>
  grecaptcha.render(
    "recaptcha_p",
    {
      'sitekey':'<?=$this->config->item('recaptcha_sitekey')?>'
    }
  );
}
  function lanzar_mensaj(t){
$('#mensaje').html(t).css('display','block').fadeOut(15000);
}
function onloadCallback() {
        made_captcha();
    }