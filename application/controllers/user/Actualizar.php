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

class Actualizar extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
    $this->load->helper('page');
		$this->page=$this->uri->segment(2).' '.$this->uri->segment(3);

		$this->head_html[]='';

	}

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
	        $error['msj']=validation_errors();
	        $this->section.=$this->load->view('spare_part/notice/salve_data_error', $error, TRUE);
	    }else
	    {
	        $resp=$this->user_model->update_user($data_user);
	        //echo $resp;
	        if($resp===TRUE){
	            $this->section=$this->load->view('spare_part/notice/user_data_ok', $data_user, TRUE);
	        }
	        else
	        {
	            $this->section=' aguii'.$this->load->view('spare_part/notice/salve_data_error', $data, TRUE);
	        }
	    }
	    $this->section.=$this->load->view('spare_part/form/actuli_perfil',$data_user,TRUE);

    	$us_st['mSecurity']=TRUE;
    	$us_st['name']=$this->_username;
    	$this->aside='';
    	$us_st = array(
                      'fb_sdk' =>FALSE ,
                      'gMap' =>FALSE ,
                      'user'=>$this->_username,
                      'mSecurity'=>$this->_security,
                      'mRol'=>$this->_userrole,
                      'page'=>$this->page,
                      'avatar'=>$this->session->userdata('avat_user'),
                      'slide'=>''
                     );
      	//enviamos la página a la función.
      	$this->show_page($this->head_html,$us_st,$this->section,$this->aside);
   }
	public function update_avatar()
	{
    	$config['upload_path'] = 'img/user_img';
    	$config['allowed_types'] = 'gif|jpg|png';
    	$config['max_size'] = '0';
    	$config['max_width']  = '0';
    	$config['max_height']  = '0';

    	$this->load->library('upload', $config);
    	if ( ! $this->upload->do_upload('userfile'))
    	{
        	$error['msj']=$this->upload->display_errors();
	        $this->section.=$this->load->view('spare_part/notice/salve_data_error', $error, TRUE);
    	}
	    else
	    {
        	$data_img=$this->upload->data();
        	if( $data_img['image_width']>200)
        	{
	                	$config['image_library'] = 'gd2';
                        $config['source_image'] = 'img/user_img/'.$data_img['client_name'];
                        $config['new_image']='img/user_img/'.$data_img['client_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 200;
                        $config['height'] = ($data_img['image_height']*200)/$data_img['image_width'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$this->image_lib->clear();
	                }
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'img/user_img/'.$data_img['client_name'];
                    $config['new_image']='img/user_img/thumb/'.$data_img['client_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 30;
                   	$config['height'] = ($data_img['image_height']*70)/$data_img['image_width'];
                   	$this->image_lib->initialize($config);
					$this->image_lib->resize();
	                //print_r($this->upload->data());
	                $update=array(
	                            'id'=>$this->input->post('ref'),
	                            'img'=>$data_img['client_name']
	                              );
	                $this->user_model->update_avatar($update);
	                //redirect('user/perfil');
	            }


                     $this->array_page['avatar']=$this->session->userdata('avat_user');

                      $this->array_page['msj']='ok';

	     $resp=$this->user_model->get_user($this->_username);
            if ($resp->num_rows()>0) {
       			$resp=$resp->row();
   			  	$this->array_page['id']=$resp->usuario_id;
   			  	$this->array_page['name']=ucfirst($resp->nombre);
   			  	$this->array_page['alias']=ucfirst($resp->alias_usuario);
   			  	$this->array_page['cog1']=ucfirst($resp->apellido_1);
   			  	$this->array_page['cog2']=ucfirst($resp->apellido_2);
   			  	$this->array_page['datana']=$resp->data_nacimiento;
   			  	$this->array_page['sexo']=$resp->sexo;
   			  	$this->array_page['avatar']=$resp->avatar;
            	$this->array_page['mailing']=$resp->mailing;
       		}
       		else
       		{
       			// error base de datos
            }
	    $this->section.=$this->load->view('spare_part/form/actuli_perfil',$this->array_page,TRUE);

        $this->show_page('admin');

		}
       /**
        * Actualizar correo eléctronico
        */
       public function mail()
       {
       		$output = array();
        //controlamos la seguridad.
       		echo 1;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('mail', $this->lang->line('s_reg_uinp'),'required|valid_email|is_unique[persona.mail]');

            if ($this->form_validation->run()==FALSE) {
              $output['msj']=validation_errors();
              $output['success']=FALSE;
            }else{
                $this->load->model('login_model');
                $new_mail=$this->input->post('mail');
                $data_up=array(
                      'mail'=>$new_mail,
                      'id'=>  $this->_id
                  );
                 if($this->user_model->update_mail($data_up)>0){
                      //envio el mail
                    $this->load->library(array('hash_cont','mail_sender'));
                    $mail_dat = array(
                          'id_us' =>$this->userid ,
                          'name_us'=>$this->_username,
                          'to_mail'=>$new_mail,
                          'to_name'=>$this->_username,
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
        //enviamos la página a la función.
       }
         $this->jsOut($output);
     }
       public function index()
	{
    	$output="";
    	$user;
    	$mail;
    	$header=$this->load->view('spare_part/header_free','', TRUE);
        $head_html=$this->load->view('headers/inc_head_view','', TRUE);
        $navegation=$this->load->view('spare_part/nav_view','', TRUE);
		 if($this->session->userdata('user_conf')){
        $user=$this->session->userdata('user_conf') ;
        $mail=$this->session->userdata('user_mail') ;
          //Hay que personalizar este mensaje.
        $this->form_validation->set_message('is_unique',$this->lang->line('s_reg_msj1'));
        $this->form_validation->set_rules('mail', $this->lang->line('s_reg_uinp'),'required|valid_mmail|is_unique[persona.mail]|xss_clean');
        $this->form_validation->set_rules('pass',  $this->lang->line('s_reg_cinp'),'required|min_length[6]|max_length[30]');
                             //preparamos la evaluación del captcha.
        $data=array(
  	 	  			'usr'=>$user,
  	 	  			'mail'=>$mail
  	 	  			);
        $this->recaptcha->recaptcha_check_answer(
                                          $_SERVER['REMOTE_ADDR'],
                                          $this->input->post('recaptcha_challenge_field'),
                                          $this->input->post('recaptcha_response_field')
                                          );
                  //validamos el captcha, si no es humano..
          if ($this->recaptcha->getIsValid()!==FALSE) {

          	 if ($this->form_validation->run()==FALSE) {
          	 		  $output.=validation_errors();
          	 		  	$data['recaptcha']= $this->recaptcha->recaptcha_get_html();
          	 		  // cargamos de vuelta el formulario

          	 }else{
          	 	  $this->load->model('login_model');
          	 	  $new_mail=$this->input->post('mail');
          	 	  $pass=$this->input->post('pass');
          	 	  $pass=md5($pass);

          	 	  			$data['pass']=$pass;
          	 	  			$data['new_mail']=$new_mail;

          	 	  $conf=$this->login_model->checkin($data);
          	 	  if ($conf->num_rows()>0) {
          	 	  	$conf=$conf->row();
          	 	  	$data['user_id']=$conf->usuario_id;
          	 	  	$change=$this->login_model->mail_upd($data);
          	 	  	if($change>0)
          	 	  	{
          	 	  		$data['mail']=$data['new_mail'];
          	 	  	}
          	 	  }else{
          	 	  	//un error en la base o nos estan egañando.

          	 	  	$output.=$this->load->view('you_not_user', '', TRUE);
          	 	  }
          	 }
          }else{

          	   $output.= $this->recaptcha->getError();
          	   $data['recaptcha']= $this->recaptcha->recaptcha_get_html();

          }
      }else{
      	// un aviso de que nadie existe.
      }
	    $section.=$output;
	    $section.=$this->load->view('spare_part/notice/conf_new_view',$data, TRUE);
	    $footer=$this->load->view('spare_part/footer_view','', TRUE);

	    $data = array(
				'head_html'=>$head_html,
				'page'=>$this->page,
				'header' =>$header ,
				'section'=>$section,
				'navegation'=>$navegation,
				'aside'=>$aside,
				'footer'=>$footer,
				'fb_sdk'=>TRUE //no hace falta el fb sdk en esta página.
			);
					//monto la pagina segun petición.

		$this->load->view('base_html', $data, FALSE);
	}

//}
       /**
        * Metodo encargado de actualizar la clave de acceso
        */
   public function cambio_clave()
   {
   		$output = array();
			// aquí revisamos y válidamos todo
      	$this->load->library('form_validation');
      	$this->form_validation->set_rules('key', $this->lang->line('s_reg_uinp'),'required|max_length[30]');
      	$this->form_validation->set_rules('new_key', $this->lang->line('s_reg_uinp'),'required|max_length[30]');

        $data_user=array(
              'pass'=>md5($this->input->post('key')),
              'new_pass'=>md5($this->input->post('new_key')),
              'usr'=>$this->_username
            );
        $this->load->model('login_model');

        $resp=$this->login_model->checkin($data_user);
        if ($resp->num_rows()>0)
        {
            $this->load->model('user_model');
            $resp=$this->user_model->update_key($data_user);
            if ($resp==TRUE)
            {
                $this->section.=$this->load->view('spare_part/notice/all_data_salve','',TRUE);
            }
            else
            {
                $this->section.=$this->load->view('spare_part/notice/salve_data_error','',TRUE);
            }
      	}
      	else
      	{
      		$this->section.=$this->lang->line('s_usr_eky');
    	}

     	$this->jsOut($output);
     }

     public function mailing($value)
     {
        $mailing=array(
                'usr'=>$this->_userid
            );
        if ($value==='si') {
          $mailing['mailing']=1;
        } else {
          $mailing['mailing']=0;
        }
        // usamos el modelo
        $resp=$this->user_model->mailing($mailing);
        if($resp==TRUE){
        redirect('user/perfil');
      }else{
        $section=$this->lang->line('s_act_msj2');
         $pagedata = array(
                            'fb_sdk' =>FALSE ,
                            'user'=>$this->_username,
                            'mSecurity'=>$this->_security,
                            'mRol'=>$this->_userrole,
                            'page'=>$this->page,
                            'slide'=>''
                             );

     $this->show_page($head_html,$pagedata,$section,$aside);
      }
     }
     /**
      * Eliminación de cuenta de usaurio.
      * @return [void] [Finalmente llama a la función Show page, final output]
      */
     public function eliminar_cuenta()
     {
      $aside="";
     $head_html=$this->load->view('headers/login_head_view','',TRUE);
     if(!$this->input->post('eliminar')){
         $section=$this->load->view('spare_part/form/delete_user_view','',TRUE);
     }else{
          $this->user_model->destroy_user($this->userid);
          $this->session->unset_userdata('autorizado');
          $this->session->unset_userdata('id_user');
          $this->session->unset_userdata('fun_user');
          $this->session->unset_userdata('id_ref');
          $section="$this->lang->line('s_usr_elu')";
     }
        $pagedata = array(
                          'sdk' =>FALSE ,
                          'user'=>$this->_username,
                          'mSecurity'=>$this->_security,
                          'mRol'=>$this->_userrole,
                          'page'=>$this->page,
                          'slide'=>'',
                          'fb_sdk'=>'FALSE'
                           );

     $this->show_page($head_html,$pagedata,$section,$aside);
     }

     public function jsOut($output='')
    {
       $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($output));
    }
}
/* End of file actualizar.php */
/* Location: ./application/controllers/user/actualizar.php */