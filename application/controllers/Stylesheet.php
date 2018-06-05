 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package		Sonormap
 * @author		MaximilianoFernández
 * @copyright	Creative Commons Atribución-NoComercial-CompartirIgual 3.0 - 2013
 * @license		http://creativecommons.org/licenses/by-nc-sa/3.0/.
 * @link		https://github.com/Thebluemax/Sonormap
 * @since		Version 0.0
 *
 */

class Stylesheet extends MY_Controller {
     /**
      * controlador general para las hojas de estilo.
      * @return [type] [description]
      */
     public function __construct()
     {
     	parent::__construct();
     	//Do your magic here
     }
     //movida
	public function inici()
	{
		//estilo básico.
		$output=$this->load->view('style_css/inic_view','',TRUE);
		//$output.=$this->load->view('style_css/float_view','',TRUE);
		$this->sendStyle($output);

	}

	public function map_style()
	{
		$output=$this->load->view('style_css/map_css','',TRUE);
		$this->sendStyle($output);
	}
	public function registro()
	{

		$output=$this->load->view('style_css/regstro_css','',TRUE);
		$this->sendStyle($output);
	}
	public function admstyle()
	{
		$output=$this->load->view('style_css/admin_view','',TRUE);
		$this->sendStyle($output);
	}
	public function arxivar()
	{
		$output=$this->load->view('style_css/arch_css','',TRUE);
		$this->sendStyle($output);
	}
	public function histories()
	{
		$output=$this->load->view('style_css/histories_css','',TRUE);
 		$this->sendStyle($output);
	}
	public function perfil()
	{
		$output=$this->load->view('style_css/perfil_css','',TRUE);
 		$this->sendStyle($output);
	}
	public function avis()
	{
		$output=$this->load->view('style_css/avis_css','',TRUE);
 		$this->sendStyle($output);
	}
	public function contacto()
	{
		$output=$this->load->view('style_css/contacto_css','',TRUE);
 		$this->sendStyle($output);
	}
	public function editar()
	{
		$output=$this->load->view('style_css/editar_css','',TRUE);
 		$this->sendStyle($output);
	}
	public function sendStyle($value='')
	{
		$output=$this->load->view('style_css/base_css','',TRUE);
		$output.=$value;
		$this->output
    ->set_content_type('css')
    ->set_output($output);
	}
	// Boostrap
	public function boostrapStyle()
	{
		$this->load->config('site_conf');
		$output='';
			//echo $this->config->item('bootstrap_style');
			$configuracion=$this->config->item('bootstrap_style');
		switch ($configuracion) {
		case 'yeti':
			$output=$this->load->view('style_css/bootstrap_yeti','',TRUE);
			break;
			case 'cosmo':
			$output=$this->load->view('style_css/bootstrap_cosmo','',TRUE);
			break;
		case 'superhero':
			$output=$this->load->view('style_css/boosttrap','',TRUE);
			break;
		default:
			$output=$this->load->view('style_css/bootstrap_yeti','',TRUE);
			break;
	}

		$this->output
    ->set_content_type('css')
    ->set_output($output);
	}
}

/* End of file stylesheet.php */
/* Location: ./application/controllers/style/stylesheet.php */