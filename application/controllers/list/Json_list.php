<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json_list extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('list_model');
		$this->load->helper('jsonresp');
	}
	/**
	 *
	 */
	public function standar_rq()
	{
		$data=array();
		$res=$this->list_model->give_all();
		// se envia como un array.si hay entradas
		if($res['ret']->num_rows() > 0)
		{
			//$data['data'] = $resp->result();
           	$data['success'] = True;
			$data['data'] = $res['ret']->result_array();
      	}else{
      		//$jonson=0;
      		$data['data'] = 0;
           	$data['success'] = False;
      	}
        $jonson = json_encode($data);
		$this->output
    		->set_content_type('application/json')
    		->set_output($jonson);
	}
	/**
	 *
	 */
	public function user_list()
	{
		$res=$this->list_model->give_all_user($this->session->userdata('id_ref'));
		// se envia como un array.si hay entradas
		if($res->num_rows()>0){
			$res=$res->result_array();
          	$jonson=make_json($res);
      	}else{
      		$jonson=0;
      	}
		$this->output
    	->set_content_type('application/json')
    	->set_output($jonson);
	}
}

/* End of file json_list.php */
/* Location: ./application/controllers/list/json_list.php */