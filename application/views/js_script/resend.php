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
function reenvio(){
var jqxhr = $.get("<?=site_url('user/registro/reenviar')."/".$this->session->userdata('user_conf')?>", function(data) {
	lanzar_mensaj(data);
});
}

function lanzar_mensaj(t){
	if(t=1){
		$('#mensaje').html("<?=$this->lang->line('s_mlcf_u8')?>").css('display','block').fadeOut(7000);
		}else{
			$('#mensaje').html("<?=$this->lang->line('s_mlcf_u9')?>").css('display','block').fadeOut(7000);
			}
}
