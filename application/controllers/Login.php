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

class Login extends MY_Controller {
/*
* Controlador de logeo de los usuarios;
* primera puerta de seguridad.
*/
 	protected $_page;

	public function __construct()
	{
   		parent::__construct();

   		$this->load->model('login_model');
   		$this->load->helper('security');

         //$this->place=$this->session->flashdata('place');
	}
	public function index()
	{
	    $captcha="";
	    $resp_capt=TRUE;

	     //cargamos los helpers y librerias para los formularios
	    $this->load->helper(array('form'));
	    $this->load->library(array('form_validation','recaptcha'));

	     //reglas para el formulario
	    $this->form_validation->set_rules('usr_id', 'Tu ID','required|max_length[16]|xss_clean');
	    $this->form_validation->set_rules('password', 'Password', 'required');
    // si ya pasaron las oportunidades sin captcha.
    /*if($this->session->userdata('fallido')>=2){
          $this->recaptcha->recaptcha_check_answer(
                                $_SERVER['REMOTE_ADDR'],
                                $this->input->post('recaptcha_challenge_field'),
                                $this->input->post('recaptcha_response_field')
                                );
          $resp_capt=$this->recaptcha->getIsValid();
          $captcha=$this->recaptcha->recaptcha_get_html();
    }/*/
    //evaluamos la funcion run().
    	if($this->session->userdata('fallido')<=2||$resp_capt===TRUE)
    	{
        	if ($this->form_validation->run() == FALSE)
        	{
           		$men=array(
            			'mensaje'=>validation_errors(),
                    	'captcha'=>$captcha
                    	);
        	}
        	else
        	{
	            //si está todo bien.
	            //comprobamos que los datos correspondan a un usuario.

	            //aqui compruebo entradas., No antes ya las compruebo.
	            //pero por si queda algo. O algú se llama Bobby Tables.
	            $repl_str=array('#','/','=',' ',"'");
	            $new_str=array('z','3','q','4','t');
	            $usr_clean=str_replace($repl_str,$new_str ,$this->input->post('usr_id') );
	            $loging = array(
	              	  'usr'=> $usr_clean ,
	              	  'pass'=> $this->input->post('password')
	                    );
	            $res=$this->login_model->checkin($loging);
                    //  echo $res->num_rows();
            	if ($res->num_rows()>0)
            	{
              		//si existe y se logea
              		$dts=$res->row();
              		$hoy=time();
               if ($dts->confirmado>0 && $dts->cuenta_activa>0)
               {
                   $this->session->set_userdata('autorizado','1');
                   $this->session->set_userdata('id_user',$dts->alias_usuario);
                   $this->session->set_userdata('id_ref',$dts->usuario_id);
                   $this->session->set_userdata('avatar_user',$dts->avatar);
                   $this->session->set_userdata('fun_user',$dts->rol);
                   //si se ha equivocado antes, borramos las oportunidades.
                   if($this->session->userdata('fallido'))
                   {
                    	$this->session->unset_userdata('fallido') ;
                   }
                   if ($this->session->userdata('place'))
                   {
                        redirect($this->session->userdata('place'));
                   }
                   else
                   {
                    	redirect($this->session->flashdata('tmp_url'));
                   }
             }else{//la cuenta no está activa o está bloqueada.
              if($this->session->userdata('fallido')){
                          $this->session->unset_userdata('fallido') ;
                    }
                    if($dts->confirmado==0 && $dts->cuenta_activa>0){
                        $this->session->set_userdata('user_conf',$dts->alias_usuario);
                        $this->session->set_userdata('user_id',$dts->usuario_id);

                        $this->session->set_userdata('user_mail',$dts->mail);
                       redirect('login/noconfirmado');
                    }else if($dts->confirmado==1 && $dts->cuenta_activa==0){
                            $this->session->set_userdata('user_conf',$dts->alias_usuario);
                             redirect('error/user_blocked');
                             }
              }

            }//fin compruebo captcha
            else{
               $men=array('mensaje'=>$this->lang->line('s_log_err2'),
                      /*'captcha'=>$captcha*/);
               if($this->session->userdata('fallido'))
                {
                     $intento=$this->session->userdata('fallido');
                     $this->session->set_userdata('fallido',$intento+1);
                }else
                    {
                      $this->session->set_userdata('fallido',1);
                     }
            }



            }//fin else de comprobación de formularios
    }else{//fin comprobación captcha.
        $men=array(
          'mensaje'=>$this->lang->line('s_log_err3'),
            'captcha'=>$captcha
                    );
    }

    $this->head_html[]='';
    $this->section=$this->load->view('spare_part/form/login_view',$men, TRUE);
      //montamos la página con el resultado.
    $this->show_page();
    }
   /**
    * función para cerrar las sesion activa del ususario
    * @return void
    */
  public function out()
      {
        # code...
        $this->session->sess_destroy();
        redirect('inici');
      }
      /**
       * Página que maneja  si el ususario no ha confirmado.
       * @return [type] [description]
       */
      public function noconfirmado()
      {

        $this->page="Confirma el teu mail.";
        $this->head_html[]=base_url('css/log_style.css');
        $this->head_html[]=site_url('stylesheet/regist');
        //comprobamos que sea un usuario válido, al menos que si llegó aqui
        //es por que está inscripto.
        if ($this->session->userdata('user_conf')) {
          $this->load->library('recaptcha');
            $us_data=array(
              'usr'=>$this->session->userdata('user_conf'),
              'mail'=>$this->session->userdata('user_mail'),

              // 'recaptcha'=> $this->recaptcha->recaptcha_get_html()
               'recaptcha'=> ''
                            );
            //echo .'###########';

            $this->section=$this->load->view('spare_part/notice/conf_new_view',$us_data, TRUE);
        }else{
          $this->section=$this->load->view('spare_part/notice/you_not_user','', TRUE);
        }
    $this->js_script[]=site_url('js/js_eng/resend_mail');
         //enviamos la página a la función.
    $this->show_page();
      }
      /**
       * Metodo para recuperar la contraseña
       *
       */
      public function recuperar_key()
  {
        //cargo las views.
        $this->head_html=$this->load->view('headers/login_head_view','',TRUE);
        $this->section=$this->load->view('spare_part/form/key_back_form','',TRUE);
		$this->array_page['page']='recuperar contraseña';
        $this->show_page($this->head_html, $this->array_page,$this->section,$this->aside);
  }
  	/**
	 * Recuperar el password perdido.
	 * @return [type] [description]
	 */
public function key_lost ()
{
	$this->load->library(array('form_validation','mail_sender'));
	$this->form_validation->set_rules('email_id','hapens', 'required|valid_email');
	//lo que se suele hacer con los formularios.
	if ($this->form_validation->run() == FALSE)
	{
		$this->section.=validation_errors();
	}
	else
	{
		$mail=$this->input->post('email_id');
		//controlamos que existe
		$resp=$this->login_model->get_usr_m($mail);
		if ( $resp->num_rows() > 0 )
		{
			$resp=$resp->row();
			$user=$resp->id;
			$email=$resp->email;
			$alias=$resp->alias;
			$name=$resp->nom;
			$hash_dat = array(
					  'id_us' =>$user ,
					   'name_us'=>$name
					   );
	//crea mos un nuevo hash y enviamos mail.

			$this->load->library('hash_cont');
			$mail_dat = array(
						'id_us' =>$user ,
						'alias_us'=>$alias,
						'to_name'=>$name,
						'to_mail'=>$email,
						'subject'=>$this->lang->line('s_usr_cvp'),
						'titulo'=>$this->lang->line('s_usr_crp')
						);
			$hash=$this->hash_cont->keyHash( $hash_dat);
			$mail_dat['hash']=$hash;
			$mail_dat['html_mail']=$this->load->view('email/renov_email', $mail_dat, TRUE);
			// Generar el mensaje en html y enviando el mail.
			$this->mail_sender->build_mail($mail_dat);
			$resp=$this->mail_sender->send_mail();
			if ($resp>0) {
				$this->section.=$this->load->view("spare_part/notice/mail_send",'',TRUE);
			}
			else
			{
				$this->section.=$this->load->view("spare_part/notice/mail_not_send",'',TRUE);
			}
		}
		else
		{
			$this->section.=$this->load->view("spare_part/notice/no_registred",'',TRUE);
		}
	}
	$this->section.=$this->load->view("spare_part/form/key_back_form",'',TRUE);

	//cargo las views.
	$this->array_page['page']='Recuperar contrasenya';

	$this->show_page();
}

public function new_key($value)
{

  if ($value==FALSE) {
		  $this->section=$this->load->view("spare_part/notice/you_not_user",'',TRUE);
		  $this->section='nova';
  } else {
	//antes boramos las vencidas.

	$values=array  ('type'=>$this->config->item('key_chg'),
					  'hash'=>$value);
	$response=$this->login_model->confirmation($values);
	//hacer algo con el resultado
	if ($response->num_rows()>0) {
	  //actualizo
	  $response=$response->row();
	  $user_id=$response->id_us;
	  $alias_us=$response->alias;
	  $nom=$response->nom;
	  $send_mail=$response->email;

		 $dat=array(
					'usr_id'=>$user_id,
					'stp'=>$response->stp
					);
		$new_key=$this->login_model->update_lost_k($dat);
		  if ($new_key!=='0') {
			//salió bien enviamos mail.
			  //preparamos para enviar la renovacion.
		  	$this->load->library('mail_sender');

					$mail_dat=array(
									'to_name'=>$nom,
									'to_mail'=>$send_mail,
									'new_key'=>$new_key,
									'alias'=>$alias_us,
									'subject'=>$this->lang->line('s_mail_u16'),
									'titulo'=>$this->lang->line('s_mail_u17')
									);

					 $mail_dat['html_mail']=$this->load->view('email/new_key', $mail_dat, TRUE);

					  $this->mail_sender->build_mail($mail_dat);
					  $resp=$this->mail_sender->send_mail();

					if($resp>0){
					  $this->login_model->delet_old($user_id);
					  $this->section=$this->load->view("spare_part/notice/mail_send",'',TRUE);
					}else{
					  $this->section=$this->load->view("spare_part/notice/mail_not_send",'',TRUE);
					}

		  } else {
			//error guardando los cambios
			$this->section=$this->load->view("spare_part/notice/the_server_is_mad",'',TRUE);
		  }

	} else {
	$this->section=$this->load->view("spare_part/notice/hash_lost",'',TRUE);# code...
	}

  }
	//cargo las views.
	$head_html=$this->load->view("headers/login_head_view",'',TRUE);

	  $this->show_page();

 }
 /**
  * Cambiar un mail mal introducido.
  *
  */
  public function change_mail()
       {
       		$output = array();
        //controlamos la seguridad.
            $this->load->library('form_validation');
            $this->form_validation->set_rules('mail', 'el correo','required|valid_email|is_unique[persona.mail]');

            if ($this->form_validation->run()==FALSE) {
              $output['msj']=validation_errors();
              $output['success']=FALSE;
            }else{
                //$this->load->model('login_model');
                $usr=$this->login_model->checkin(array('pass' => $this->input->post('pass'),'usr'=>$this->session->userdata('user_conf') ));
                if ($usr->num_rows()>0) {
                	$new_mail=$this->input->post('mail');
                $data_up=array(
                      'new_mail'=>$new_mail,
                      'mail'=>  $this->session->userdata('user_mail'),
                      'usr'=>  $this->session->userdata('user_conf')
                  );
                 if($this->login_model->mail_update($data_up)>0){
                      //envio el mail
                    $this->load->library(array('hash_cont','mail_sender'));
                    $mail_dat = array(
                          'id_us' =>$this->session->userdata('user_id'),
                          'name_us'=>$this->session->userdata('user_conf'),
                          'to_mail'=>$new_mail,
                          'to_name'=>$this->session->userdata('user_mail'),
                          'limit'=>$this->config->item('conf_mail_limit'),
                          'subject'=>$this->lang->line('s_urs_ncs'),
                          'titulo'=>$this->lang->line('s_urs_nct')
                           );
                    $hash=$this->hash_cont->mailHash( $mail_dat);
                    $mail_dat['hash']=$hash;
                    $mail_dat['html_mail']=$this->load->view('email/conf_email', $mail_dat, TRUE);

                    $this->mail_sender->build_mail($mail_dat);
                    $respose=$this->mail_sender->send_mail();
                   // echo $respose;

                  		if ($respose>0) {
                            $output['msj']='<p>'.$this->lang->line('s_usr_nco').'</p>';

                     	 } else {
                       		$output['msj']= '<p>'.$this->lang->line('s_act_msj1').'</p>';
                          }
                       		 $output['success']=TRUE;
                 		}else{
                  			$output['success']=FALSE;
                  			$output['msj']='<p>Error al cambiar el mail.</p>';
          				}
                } else {
                	 $output['success']=FALSE;
                  $output['msj']='<p>Error al cambiar contrseña.</p>'.$this->session->userdata('user_conf');
                }


        //enviamos la página a la función.
       }
         //$this->jsOut($output);
         $this->output->set_content_type('application/json')->set_output(json_encode($output));
     }
}

/* End of file login.php */
/* Location: ./application/controllers/user/login.php */