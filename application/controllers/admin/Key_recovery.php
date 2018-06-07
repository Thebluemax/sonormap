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

class Key_recovery extends MY_Controller {
	 /*
	 *
	 * Guarda un usuario y envia un mail al admin.
	 *
	 *
	 */
  public function index()
  {
        //cargo las views.
        //$this->head_html=$this->load->view('headers/login_head_view','',TRUE);
        $this->section=$this->load->view('bodies/form/key_recovery','',TRUE);
		$this->array_page['page']='recuperar contraseña';
        $this->show_page();
  }
  	/**
	 * Procesa el formulario de recuperar, emite erores, sino crea uno formulario
	 * Con uin mensaje de que no está en el sistema.
	 * @return [type] [description]
	 */
public function key_lost()
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
		$this->load->model('login_model');
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
				$this->section.=$this->load->view("bodies/notice/mail_send",'',TRUE);
			}
			else
			{
				$this->section.=$this->load->view("bodies/notice/mail_not_send",'',TRUE);
			}
		}
		else
		{
			$this->section.=$this->load->view("bodies/notice/no_registred",'',TRUE);
		}
	}
	$this->section.=$this->load->view("bodies/form/key_recovery",'',TRUE);

	//cargo las views.
	$this->array_page['page']='Recuperar contrasenya';

	$this->show_page();
}

public function new_key($value)
{

  if ($value==FALSE) {
		  $this->section=$this->load->view("bodies/notice/you_not_user",'',TRUE);
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
					  $this->section=$this->load->view("bodies/notice/mail_send",'',TRUE);
					}else{
					  $this->section=$this->load->view("bodies/notice/mail_not_send",'',TRUE);
					}

		  } else {
			//error guardando los cambios
			$this->section=$this->load->view("bodies/notice/the_server_is_mad",'',TRUE);
		  }

	} else {
	$this->section=$this->load->view("bodies/notice/hash_lost",'',TRUE);# code...
	}

  }
	//cargo las views.
	$head_html=$this->load->view("headers/login_head_view",'',TRUE);

	  $this->show_page();

 }

	/**
	 * Recuperar el password perdido.
	 * @return [type] [description]
	 */
/*/public function key_lost ()
{
	$head_html="";
	$aside="" ;
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
				$this->section.=$this->load->view("bodies/notice/mail_send",'',TRUE);
			}
			else
			{
				$this->section.=$this->load->view("bodies/notice/mail_not_send",'',TRUE);
			}
		}
		else
		{
			$this->section.=$this->load->view("bodies/notice/no_registred",'',TRUE);
		}
	}
	$this->section.=$this->load->view("bodies/form/key_back_form",'',TRUE);

	//cargo las views.
	$data_p=array(
			'name' =>'guest',
			'mSecurity' =>FALSE,
			'user' =>'guest',
			'rol'=>-1,
			'security'=>FALSE,
			'page'=>'Recuperar contrasenya',
			'fb_sdk'=>FALSE,
			'gMap'=>FALSE
		  );
	$head_html=$this->load->view("headers/login_head_view",'',TRUE);
	$this->show_page($head_html,$data_p,$this->section,$aside);
}/*/
/**
 * Renovación de la contraseña.
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
/*public function new_key($value)
{
  $head_html="";
	$header="";
	$navegation="";
	$section="";
	$aside="" ;
	$footer="";
  if ($value==FALSE) {
		  $section=$this->load->view("bodies/notice/you_not_user",'',TRUE);
		  $section='nova';
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
					  $section=$this->load->view("bodies/notice/mail_send",'',TRUE);
					}else{
					  $section=$this->load->view("bodies/notice/mail_not_send",'',TRUE);
					}

		  } else {
			//error guardando los cambios
			$section=$this->load->view("bodies/notice/the_server_is_mad",'',TRUE);
		  }

	} else {
	$section=$this->load->view("bodies/notice/hash_lost",'',TRUE);# code...
	}

  }
	//cargo las views.
	$head_html=$this->load->view("headers/login_head_view",'',TRUE);
	  $header=$this->load->view("bodies/header_free",'',TRUE);
	  $navegation=$this->load->view("bodies/nav_view",'',TRUE);
	   $footer=$this->load->view('bodies/footer_view','', TRUE);

	  $this->show_page($head_html,$header,$section,$navegation,$aside,$footer);

 }/*/
}

/* End of file registro.php */
/* Location: ./application/controllers/user/registro.php */