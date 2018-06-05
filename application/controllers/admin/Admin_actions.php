<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_actions extends MY_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->_securePage=TRUE;
		$this->load->helper('file');
		$this->load->model('admin_model');
		$this->load->language('default_adm');
		//$this->head_html[]=base_url('assets/css/admin.css');

	}

	public function index()
	{

	}
	/**
	 * Método para válidar una entrada
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
	 * Mátodo para bloquear una historía, las historias no se borran
	 *
	 * */
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