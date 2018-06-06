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
/**
 * Método de la página de administración de los datos del usuarios
 * @return html
 */
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
// Información general del usario.
        $info = $this->user_model->statics_user($this->_id);

        if ($info->num_rows() > 0) {
        	$info = $info->row();
        		$usr_data['total'] = $info->total;
        		$usr_data['seen'] = $info->visuali;
        		$usr_data['maxSeen'] = $info->max_vist;
        		$usr_data['idMax'] = $info->id_reg_max;
        		$usr_data['title'] = $info->titulo_i;

        } else {
        	# code...
        }


			$this->js_script[]=site_url('js/perfil');

            $this->section=$this->load->view('bodies/user', $usr_data, TRUE);
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
        $usr_data['categoria'] = $this->load->view('bodies/select_view',$this->category->selec_cat() , TRUE);
        $this->section=$this->load->view('bodies/list_user_view', $usr_data, TRUE);
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
	 * Método para actualizar el perfil de usurio
	 * @return HTML
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
			$this->section=$this->load->view('bodies/form/user_update',$data_user,TRUE);

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
	public function update_user()
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
	        $data_user['msj']=$this->load->view('bodies/notice/salve_data_error', $data_user, TRUE);
	    }else
	    {
	        $resp=$this->user_model->update_user($data_user);
	        //echo $resp;
	        if( $resp === TRUE)
	        {
	            $data_user['msj']=$this->load->view('bodies/notice/user_data_ok','', TRUE);
	        }
	        else
	        {
	            $data_user['msj']=$this->load->view('bodies/notice/salve_data_error','', TRUE);
	        }
	    }
	    $this->section.=$this->load->view('bodies/form/user_update',$data_user,TRUE);

    	$this->aside='';
    	$this->array_page['page']='Update perfil';
      	//enviamos la página a la función.
      	$this->show_page('admin');
   }


/**
 * Método para actualizar la foto de perfil.
 * @return HTML
 */
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
	        $this->section.=$this->load->view('bodies/notice/salve_data_error', $error, TRUE);
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
	               $this->array_page['msj']='<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'.'La imagen se ha actualizado correctamente.'.'</strong>.</div>';

	            }


                     $this->array_page['avatar']=$this->session->userdata('avat_user');


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
	    $this->section.=$this->load->view('bodies/form/user_update',$this->array_page,TRUE);

        $this->show_page('admin');

	}
/**
 *
 * @return  JSON
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
                'usr'=>$this->_id
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

	     $this->show_page('admin');
	    }
     }
     /**
      * Eliminación de cuenta de usaurio.
      * @return json
      *
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

     $this->show_page('admin');
     }
/**
 * Metodo para convertir un array, en un objeto json y enviarlo con
 * la cabecera correspondiente.
 * @param  array $output valores a enviar.
 * @return json
 */
private function jsOut($output='')
    {
       $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($output));
    }
}
/* End of file perfil.php */
/* Location: ./application/controllers/perfil.php */