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

class Check_title extends CI_Controller {
/**
 * Controlador que comprueba que 
 * el titulo no este repetido.
 */
	public function __construct()
	{
		parent::__construct();
		
		//Do your magic here
	}
	public function index()
	{   $this->load->model('list_model');
		$title=$this->input->post('titulo');
		$title=htmlentities($title,ENT_QUOTES);
		$resp= $this->list_model->check_title($title);
		$obj=$resp->result();
		if($resp->num_rows()==0)
		{
            $data=array('flag'=>1);
		}else{
            $data=array('flag'=>0);			
		}
          $this->load->view('spare_part/notice/db_return_view',$data, FALSE);
	}

}

/* End of file check_title.php */
/* Location: ./application/controllers/list/check_title.php */