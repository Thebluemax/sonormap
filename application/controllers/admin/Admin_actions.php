<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package   applications/controllers/admin/Admin_actions.php
 * @author    MaximilianoFernández
 * @copyright Creative Commons Atribución-NoComercial-CompartirIgual 3.0 - 2013
 * @license   http://creativecommons.org/licenses/by-nc-sa/3.0/.
 * @link    https://github.com/Thebluemax/Sonormap
 * @since   Version 0.0
 */
class Admin_actions extends MY_Controller {
	/**
	 * Constructor
	 */
	function __construct ()
	{
		parent::__construct();
		$this->_securePage=TRUE;
		$this->load->helper('file');
		$this->load->model('admin_model');
		$this->load->language('default_adm');
		//$this->head_html[]=base_url('assets/css/admin.css');

	}
	/**
	 * Página principal del panel de administración.
	 * @return HTML
	 */
	public function index()
	{

	}
	/**
	 * Método para válidar una entrada y activarla para que esté publicada.
	 * @param  int $value El id de la entrada a evaluar
	 * @return [type]        [description]
	 */
	public function validate ($value = '')
	{
		$value = intval($value);

		if ($this->_security > 0 && $this->_userrole == 3) {
			$resp = $this->admin_model->ckc_valid($value);
			$data = array('success' => $resp,
							'id' => $value  );
			$this->send_json($data);
		}
	}
	/**
	 *  Método para bloquear una historía, las historias no se borran
	 *
	 * @return JSON
	 */
	public function block_entry()
{
	$value=$this->input->post('hist');
	if ($this->security>0 && $this->userrole==3)
	{
		$resp=$this->admin_model->ckc_bloq($value);
		if($resp>0){
		//histori bloqueada

			$output=json_encode(array('succes' =>'true'));
		} else {
			$output=json_encode( array('succes' =>'false'  ));
		}
	}else{
		$section=$this->load->view('bodys/notice/you_not_root','', TRUE);
	}
	$this->send_json($output);
	}
}

/* End of file Admin_actions.php */
/* Location: ./application/controllers/admin/Admin_actions.php */