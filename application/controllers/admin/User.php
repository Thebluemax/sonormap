<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package   Sonormap
 * @author    MaximilianoFernández
 * @copyright Creative Commons Atribución-NoComercial-CompartirIgual 3.0 - 2013
 * @license   http://creativecommons.org/licenses/by-nc-sa/3.0/.
 * @link    https://github.com/Thebluemax/Sonormap
 * @since   Version 0.0
 *
 */

class User extends MY_Controller {

    function __construct ()
    {
		parent::__construct ();
		$this->_securePage=TRUE;
		$this->page= $this->uri->segment(1);
		 $this->load->model('user_model');
	   // $this->head_html=$this->load->view('headers/perfil_header','', TRUE);
		$this->head_html[]=site_url('stylesheet/admstyle');
		$this->head_html[]=base_url('assets/css/user.css');


		$this->js_script[]=base_url('assets/js/pagination.js');
		//$this->js_script[]=site_url('js/usjs');
	}

	public function index()
	{
        $usr_data = array();
        //seguridad

        $response=$this->user_model->get_user($this->_username);
        if ( $response->num_rows() > 0 )
        {
        //si es usuario.
            $response=$response->row();
            $usr_data = array(
                    'alias'=>$response->alias_usuario,
                    'name' =>$response->nombre,
                    'cog1'=>$response->apellido_1,
                    'cog2'=>$response->apellido_2,
                    'sexo'=>$response->sexo,
                    'email'=>$response->mail,
                    'datana'=>$response->data_nacimiento,
                    'avatar'=>$response->avatar,
                    'mailing'=>$response->mailing
                    );


			$this->js_script[]=site_url('js/perfil');

            $this->section=$this->load->view('bodys/user', $usr_data, TRUE);
		} else
		{

			//redirect 404.
		}
		 $this->show_page('admin','user');
	}

	public function my_list()
	{
		$this->load->library('category');
	    $this->session->set_userdata('user_list',$this->_username);
        $usr_data = array();
        $this->array_page['gMap']=TRUE;

            //seguridad
        $this->load->model('list_model');
       	$lista=$this->list_model->give_all_user($this->_id);
            	//echo  $lista->num_rows;
        if ($lista->num_rows()>0)
        {
          $lista=$lista->result();
        }else
        {
          $lista=0;
        }
        $usr_data['lista']=$lista;
        $usr_data['categoria'] = $this->load->view('bodys/select_view',$this->category->selec_cat() , TRUE);
        $this->section=$this->load->view('bodys/list_user_view', $usr_data, TRUE);
        $this->head_html[]=site_url('stylesheet/arxivar');
        $this->head_html[]=base_url('js_trd/fineuploader-3.5.0.css');
		$this->js_script[]=base_url('js_trd/jquery.fineuploader-3.5.0.js');
		$this->js_script[]=base_url('js_trd/jRecorder.js');
		$this->js_script[]='http://js.nicedit.com/nicEdit-latest.js';
        $this->js_script[]=site_url('js/usjs');
        $this->js_script[]=site_url('js');
	    $this->show_page('admin');
	}
	/**
	 * Actualizar perfil formulario
	 */
	public function update()
	{
        //cargo las views.
        $this->load->helper('birthday');
		//echo $us_st['avatar'];
		//  Comprobación de si es el administrador

       $resp=$this->user_model->get_user($this->_username);
        if ($resp->num_rows()>0) {
			$resp=$resp->row();
			$data_user=array(
			  	'id'=>$resp->usuario_id,
			  	'name'=>ucfirst($resp->nombre),
			  	'alias'=>ucfirst($resp->alias_usuario),
			  	'cog1'=>ucfirst($resp->apellido_1),
			  	'cog2'=>ucfirst($resp->apellido_2),
			  	'datana'=>$resp->data_nacimiento,
			  	'sexo'=>$resp->sexo,
			  	'avatar'=>$resp->avatar,
	    		'mailing'=>$resp->mailing
			  	);
			$data_user['msj']='';
			 // echo $resp->data_nacimiento;
			$this->section=$this->load->view('bodys/form/user_update',$data_user,TRUE);

   		}
   		else
   		{
   			// error base de datos
        }
        $this->array_page['page']='Update user';
        $this->js_script[]=site_url('js/actualizar_perfil');
      //enviamos la página a la función.
        $this->show_page('admin');
    }
	/**
	 *
	 */
	public function update_perfil()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom',$this->lang->line('s_reg_uinp'),'required|max_length[16]');
	    $this->form_validation->set_rules('cog1',  'apellido'.$this->lang->line('s_reg_minp'), 'required|max_length[16]');
	 	$this->form_validation->set_rules('cog2',   'ap4'.$this->lang->line('s_reg_cinp'),'max_length[16]');
	  	$this->form_validation->set_rules('sexo',  'sexo'.$this->lang->line('s_reg_cinp'),'max_length[1]');
	          //comprobamos
	    $data_user=array(
       			  	'id'=>$this->input->post('ref'),
       			  	'name'=>$this->input->post('nom'),
       			  	'alias'=>$this->input->post('alias'),
       			  	'cog1'=>$this->input->post('cog1'),
       			  	'cog2'=>$this->input->post('cog2'),
       			  	'datana'=>$this->input->post('date-to-db'),
       			  	'sexo'=>$this->input->post('sexo'),
       			  	'avatar'=>$this->_avatar,
       			  	);

	    if ($this->form_validation->run() == FALSE)
	    {
	    	//echo validation_errors();
	        $data_user['msj']=validation_errors();
	        $data_user['msj']=$this->load->view('bodys/notice/salve_data_error', $data_user, TRUE);
	    }else
	    {
	        $resp=$this->user_model->update_user($data_user);
	        //echo $resp;
	        if( $resp === TRUE)
	        {
	            $data_user['msj']=$this->load->view('bodys/notice/user_data_ok','', TRUE);
	        }
	        else
	        {
	            $data_user['msj']=$this->load->view('bodys/notice/salve_data_error','', TRUE);
	        }
	    }
	    $this->section.=$this->load->view('bodys/form/actuli_perfil',$data_user,TRUE);

    	$this->aside='';
    	$this->array_page['page']='Update perfil';
      	//enviamos la página a la función.
      	$this->show_page('admin');
   }
}
/* End of file perfil.php */
/* Location: ./application/controllers/perfil.php */