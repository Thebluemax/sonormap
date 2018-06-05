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

class Home extends MY_Controller
{
/**
*
*
* Controlador de inicio;
* Carga mapa principal, lista de puntos de historias.
*
**/

	function __construct()
	{
		parent::__construct();
	    $this->load->helper('text_decode');
		$this->load->model('list_model');
		$this->load->library('category');

	   if($this->uri->segment(1)==='inici')
	   {
	    	$this->page=$this->uri->segment(1);
		}
	}

	public function index()
	{
	// variables generales.
	// seguridad.
		$this->array_page['gMap']=TRUE;
	    $this->array_page['page']=$this->page;
		//$this->array_page['name'] =$this->_username;

	    //cargando datos de la DB.
		$list_t=$this->list_model->give_all();
		$list_t=$list_t['ret']->result();

		// TODO: libreria que realice las tareas de saneamiento de entradas y conversión de caracteres especiales.

	    //$list_t->titulo=text_to_decode($list_t->titulo,FALSE);
	    // Corregimos todos los cambios con un loop.

		foreach ($list_t as $key)
		{
		  $key->titulo=mb_strtoupper( html_entity_decode($key->titulo));
		  $key->descripcion=html_entity_decode($key->descripcion);
		  if ($key->file_image == 0 || $key->file_image == '0')
		  {
		  	$key->file_image = $this->config->item('no_image_file');
		  }
		}
		$this->array_page['list_t']=$list_t;
		//montamos el selector de categorias, listas y aniversarios..
		$this->array_page['categoria']=$this->load->view('bodies/select_view',$this->category->selec_cat() , TRUE);
		$this->section=$this->load->view('maps/home_map',$this->array_page, TRUE);

		//Mantaner hasta que jQuery realice el trabajo.
		$this->array_page['select_day']='';//add_day_select();
		//cargamos las demás vistas
		// carga de vistas.
	    $this->head_html[]=site_url($this->STATIC_FOLDER.'homestyle.css');
	    $this->js_script[]=site_url('js/homescript');
		$this->aside=$this->load->view('bodies/modals_home',$this->array_page ,TRUE);
		//enviamos la página a la función.
		$this->show_page();
	}
}
/* End of file inici.php */
/* Location: ./application/controllers/inici.php */