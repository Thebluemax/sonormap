<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('recaptcha');
		$this->page=$this->uri->segment(1);
		$this->load->model('login_model');

	}
	public function index()
	{
		$this->head_html[]=site_url('stylesheet/registro');
		$this->array_page['recaptcha']=$this->recaptcha->render();
		// Cargamos el ayudante de fecha.
		//$this->load->helper('birthday_helper');
		$this->section=$this->load->view('bodys/form/singup_form',$this->array_page, TRUE);
		//$this->aside=$this->load->view('bodys/asid_reg_view','', TRUE);
        $this->js_script[]="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit";
        $this->js_script[]=site_url('js/js_eng/rgtr');
		//array con el contenido
		$this->array_page['page']=$this->page;
		//monto la pagina segun petición.
		$this->show_page();
	}
	/**
   * controlador  que recibe la peticion ajax y
   * guarda al usuario en la base de datos, se envia el mail.]
   * @return [type] [description]
   */
	public function new_i ()
	{
		//$this->load->helper(array('form'));
		$this->load->library(array(
								'form_validation',
								'mail_sender'
								)
	   );
	   //$this->load->model('login_model');
	   $this->page=$this->uri->segment(2);
		$output="";
		$response;
		 //reglas para el formulario
		$this->form_validation->set_message('is_unique',$this->lang->line('s_reg_msj1'));
		$this->form_validation->set_rules('user', $this->lang->line('s_reg_uinp'),'required|max_length[16]|is_unique[usuario.alias_usuario]|xss_clean');
		$this->form_validation->set_rules('mail',  $this->lang->line('s_reg_minp'), 'required|valid_mail|is_unique[persona.mail]');
		$this->form_validation->set_rules('pass',  $this->lang->line('s_reg_cinp'),'required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('nom', $this->lang->line('s_reg_duinp'),'required|max_length[16]|xss_clean');
		$this->form_validation->set_rules('cog',  $this->lang->line('s_reg_dcinp'),'required|max_length[16]|xss_clean');
		$this->form_validation->set_rules('cog2',$this->lang->line('s_reg_dcinp'),'max_length[16]|xss_clean');
		//validamos el captcha, si no es humano..
		$captcha_answer = $this->input->post('g-recaptcha-response');
		// Verify user's answer
		$response = $this->recaptcha->verifyResponse($captcha_answer);
		if ($response['successr']) {
		//evaluamos El resto del formulario.
			if ($this->form_validation->run() == FALSE)
			{
				$output.=validation_errors();
			}else
			{
				$this->load->model('user_model');
				$use_nam=$this->input->post('user');
				$sql_data=$this->input->post('d-o-b');
				$us_mail=$this->input->post('mail');
				if($this->input->post('mailing')==='m')
				{
					$mailing=1;
				}else{
					$mailing=0;
				}

				$pass_key=md5($this->input->post('pass'));
				$user_name=$this->input->post('nom');
				$data = array(
					'id' => $use_nam,
					'clave'=>$pass_key,
					'mailing'=>$mailing,
					'activa'=>1,
					'name'=>$user_name,
					'apell1'=>$this->input->post('cog'),
					'apell2'=>$this->input->post('cog2'),
					'sexo'=>$this->input->post('sexo'),
					'email'=>$us_mail,
					'dob'=>$sql_data
						 );
					 $respose=$this->user_model->new_user($data);
					 if ($respose>0) {
  //preparamos para enviar la confirmacion.
							$this->load->library('hash_cont');
							$mail_dat = array(
											  'id_us' =>$respose ,
											  'name_us'=>$use_nam,
											  'to_mail'=>$us_mail,
											  'to_name'=>$user_name,
											  'limit'=>$this->config->item('conf_mail_limit'),
											  'subject'=>$this->lang->line('s_mail_ast_c'),
											  'titulo'=>$this->lang->line('s_mail_ttl')
											   );
							$hash=$this->hash_cont->mailHash( $mail_dat);
							$mail_dat['hash']=$hash;
							$mail_dat['html_mail']=$this->load->view('email/conf_email', $mail_dat, TRUE);

							$this->mail_sender->build_mail($mail_dat);
							$respose=$this->mail_sender->send_mail();
				//
					  if ($respose>0) {
							   $output=1;
						  } else {

						  $output .= $this->lang-line('s_mlcf_u9');
							  }
		  }else{
			  //database error.
			  $output.=$this->lang->line('s_mrs_3');
		  }
		   //salida validacion campos.
  }
	  } else {
				 // $output.= $this->recaptcha->getError();
				   $output.='<div class="alert alert-dismissable alert-danger">';
				  $output.=var_dump($response);
				   $output.='<div>';

				  }
			//devuelve como json.

				 $this->output->set_output($output);

	}
	/**
	 * Función para confirmar el registro de un nuevo usuario.
	 */
public function confirmation($value='')
{

  $dates=array(
			  'hash'=>$value,
			  'type'=>$this->config->item('mail_conf')
	);
  //confirmamos
  $resp=$this->login_model->confirmation($dates);
  if($resp->num_rows()>0){
	$resp=$resp->row();
		  $user=$resp->id_us;
		  //activamos cuenta.
		   $final=$this->login_model->activate($user);
		   if($final>0){
			//si todo fue bien borramos el hash.
				  $this->login_model->delet_old($user);
				  $this->section=$this->load->view("bodys/notice/reg_ok_view",'',TRUE);
		 }else{
			  $this->section=$this->load->view("bodys/notice/the_server_is_mad",'',TRUE);
		 }
  }else{
	$this->section=$this->load->view("bodys/notice/hash_lost",'',TRUE);
  }
		  $this->head_html[]=site_url('stylesheet/regist');
  // monto la página
$this->array_page['page']='confirmación del correo';
$this->show_page();
}
/**
 * re envia la confirmación
 * @param  string $value [el alias del usuario]
 * @return [type]        [description]
 */
public function reenviar($value='')
   {
	 $resp=$this->login_model->get_usr($value);
	 if ($resp->num_rows()>0) {
			  $resp=$resp->row();
			  $user=$resp->id;
			  $email=$resp->email;
					// borrar posible viejo dato
			  $this->login_model->delet_old($user);
					//crea mos un nuevo hash y enviamos mail.

			   //preparamos para enviar la confirmacion.

			  $mail_dat = array(
					'id_us' =>$user ,
					'name_us'=>$resp->nom,
					'to_mail'=>$email,
					'to_name'=>$resp->nom,
					'limit'=>$this->config->item('conf_mail_limit'),
					'subject'=>$this->lang->line('s_mail_ast_c'),
					'titulo'=>$this->lang->line('s_mail_ttl')
					 );
				 //ceramos el hash
			  $this->load->library('hash_cont');
			  $hash_dat = array(
							  'id_us' =>$user ,
							   'name_us'=>$value
							   );
			  $hash=$this->hash_cont->mailHash($hash_dat);
			  $mail_dat['hash']=$hash;
			  $mail_dat['html_mail']=$this->load->view('email/conf_email', $mail_dat, TRUE);
			  //preparamos el mail
			  $this->mail_sender->build_mail($mail_dat);
			  $respose=$this->mail_sender->send_mail();
	 } else {
			   $respose=0;
		 }
	 //confirmacion envía la respuesta a Ajax
	$data = array('flag' =>$respose );
	$this->load->view('bodys/notice/db_return_view',$data);
   }
}
/* End of file registrar.php */
/* Location: ./application/controllers/registrar.php */
