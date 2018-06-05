<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MY_Controller {

	function __construct() {
		  parent::__construct();

		$this->page= $this->uri->segment(1)."/".$this->uri->segment(2);
	}
	public function index()
	{

	}
	//Lost page
	public function not_found_404()
	{
		$this->js_script='';
	}
	// User blocked for security
	public function user_blocked()
	{
		$this->section=$this->load->view('spare_part/notice/user_blocked', '', TRUE);
		$this->send_error();
	}
	public function send_error()
	{
		           //seguridad
        $us_st = array(
                'user' =>$this->_username,
                'mRol'=>$this->_userrole,
                'page'=>$this->page,
                'mSecurity'=>$this->_security,
                'fb_sdk'=>TRUE,
                'avatar'=>$this->_avatar,
                'gMap'=>FALSE
                      );
        // creamos la página.
        $this->show_page($this->head_html,$us_st,$this->section,$this->aside,$this->js_script);
	}
}

/* End of file error.php */
/* Location: ./application/controllers/error.php */