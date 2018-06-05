<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $_security;
	protected $_username;
	protected $_userrole;
	protected $_avatar;
	protected $page;
	public $_securePage;
	protected $STATIC_FOLDER;
	public function __construct()
	{
		parent::__construct();
		$this->_securePage=FALSE;
		$this->head_html=array( );
		$this->aside='';
		$this->section='';
		$this->js_script = array( );
		$this->_security=$this->session->userdata('autorizado');
    	$this->_username=$this->session->userdata('id_user');
    	$this->_avatar=$this->session->userdata('avatar_user');
    	$this->_userrole=$this->session->userdata('fun_user');
    	$this->_id=$this->session->userdata('id_ref');

    	$this->STATIC_FOLDER = $this->config->item('static_style_folder');

		$this->array_page = array(
			'user'=>$this->_username,
	    	'rol'=>$this->_userrole,
	    	'avatar'=>$this->_avatar,
	    	'mSecurity'=>$this->_security,
			'mRol'=>$this->_userrole,
			'fb_sdk'=>FALSE,
			'gMap'=>FALSE
			);
		$this->urlSegments=$this->uri->segment_array();
	}

	public function index()
	{

	}
	/**
	 * Metodo para imprimir la página en el documento.
	 */
	 function show_page ( $page = '' ,$position='')

	{
		$this->session->set_flashdata('tmp_url',$this->urlSegments);
		//$header=$this->load->view("bodies/header_free",'',TRUE);

         //monto la pagina segun petición.

        $this->array_page[ 'head_html' ] =$this->head_html;
        $this->array_page[ 'url_segments' ] =$this->urlSegments;
        //$page[ 'header'] =$header;
        $this->array_page[ 'section' ] =$this->section;
        $this->array_page[ 'aside' ] =$this->aside;
        $this->array_page[ 'footer' ] =$this->load->view( "bodies/footer_view",'',TRUE );
        $this->array_page[ 'js_script' ] =$this->js_script;

        if ( $page !== 'admin' )
        {
        	$this->load->view('base_html', $this->array_page, FALSE);
        }
    	else
    	{	$this->array_page['nav_position']=$position;
        	$this->load->view('base_html_admin', $this->array_page, FALSE);

    	}
	}
	/**
	 * Envia la respuesta en un objeto json
	 */
	public function send_json($value='', $type = FALSE)
	{
		if ($type) {
          	$jonson=make_json($value);
		} else {
			$jonson = json_encode($value);
		}

		$this->output
    	->set_content_type('application/json')
    	->set_output($jonson);
	}
}
/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */