<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package		Sonormap
 * @author		Maximiliano Fernández
 * @copyright	Creative Commons Atribución-NoComercial-CompartirIgual 3.0 - 2013
 * @license		http://creativecommons.org/licenses/by-nc-sa/3.0/.
 * @link		https://github.com/Thebluemax/Sonormap
 * @since		Version 0.0
 *
 */

class Admin extends MY_Controller {
/**
 * Clase Administració , página de gestión general del sitio.
 */

	function __construct ()
	{
		parent::__construct();
		$this->_securePage=TRUE;
		$this->load->helper('file');
		$this->load->model('admin_model');
		$this->load->language('default_adm');
		$this->head_html[]=base_url('assets/css/admin.css');

	}
	/**
	 * Metodo principal que carga automáticamente la página de Administración.
	 * @return [type] [description]
	 */
	public function index  ()
	{
		//variables generales.
       	//seguridad
       	if ($this->_userrole == 3)
       	{
        	$nochck = $this->admin_model->i_no_chck();
            $this->array_page['edit_item'] = $this->admin_model->i_edit_status();
            $user_info = $this->admin_model->usr_obj();
            $general_status=$this->admin_model->status();
            $top_user=$this->admin_model->user_winner();
            $top_item=$this->admin_model->item_winner();

       				$this->array_page['item_ck'] = $nochck ;

           	if ($user_info->num_rows() > 0)
           	{
           		$user_info = $user_info->row();
           		$this->array_page['total_usr'] = $user_info->total;
           		$this->array_page['no_conf'] = $user_info->no_conf;
           		$this->array_page['bloque'] = $user_info->bloque;
           		$this->array_page['activos'] = $user_info->activos;
           		//archivos tamaño.
           		//$tal_b=realpath('upload');
           		//$tal_b=filesize($tal_b);
           		$array_dir = get_dir_file_info('upload' , $top_level_only = TRUE);
           		$size_t = 0;
           		$file_num = 0;
           		foreach ($array_dir as $key )
           		{
           			$size_t += $key['size'];
           			$file_num ++;
           		}
           		$this->array_page['total_spd'] = $this->config->item('web_disk_spc');
           		$this->array_page['total_file'] = number_format((($size_t/1024)/1024)/1024,3);
           		$this->array_page['avg_file'] = number_format(($this->array_page['total_file']*100)/$this->array_page['total_spd'],3);
           		$this->array_page['file_num'] = $file_num;
           	}else
           	{
           		# code...
           	}
           	// status
           	$this->array_page['total_usr'] = $general_status->total_usr;
           	$this->array_page['total_usr_no_conf'] = $general_status->total_usr_no_conf;
           	$this->array_page['total_items'] = $general_status->total_items;
           	$this->array_page['total_por_confir'] = $general_status->total_por_confir;
           	$this->array_page['total_vistos'] = $general_status->vistos;
           	$this->array_page['top_user'] = $top_user->alias;
           	$this->array_page['top_user_avatar'] = $top_user->avatar;
           	$this->array_page['top_user_visto'] = $top_user->vistos;
           	$this->array_page['top_item'] = $top_item->titulo;
           	$this->array_page['top_item_visto'] = $top_item->visto;
           	$this->array_page['top_item_id'] = $top_item->id;
           	$this->array_page['top_item_img'] = $top_item->file;
           	$this->array_page['top_item_alias'] = $top_user->alias;



           	$this->section = $this->load->view('bodys/admin_view',$this->array_page, TRUE);
        }else{
        	$this->section = $this->load->view('bodys/notice/you_not_root' , '' , TRUE);
        }
			//monto la pagina segun petición.
		$this->js_script[] = base_url('assets/js/jquery.dcjqaccordion.2.7.js');
		$this->js_script[] = base_url('assets/js/jquery.scrollTo.min.js');
		$this->js_script[] = base_url('assets/js/jquery.nicescroll.js');
		$this->js_script[] = base_url('assets/js/jquery.sparkline.js');
		$this->js_script[] = base_url('assets/js/gritter/js/jquery.gritter.js');
		$this->js_script[] = base_url('assets/js/gritter-conf.js');
		$this->js_script[] = base_url('assets/js/chart-master/Chart.js');
		$this->js_script[] = base_url('assets/js/sparkline-chart.js');
		$this->js_script[] = base_url('assets/js/zabuto_calendar.js');


		$this->js_script[] = site_url('assets/js/pagination.js');
		$this->js_script[] = site_url('js/js_eng/admin');
       	$this->array_page['page'] = $this->urlSegments[1];
		$this->show_page('admin');
		}


	public function entries ($value='')
	{
		if ( $this->_userrole == 3) {

			$resp=$this->admin_model->give_all($value);
			if($resp->num_rows()>0 ){
				$data = array('items' =>$resp  );
			}else{
				$data = array('items' =>$resp  );
			}
			$this->section.=$this->load->view('bodies/entries_admin', $data, TRUE);
		}else{
			$this->section=$this->load->view('bodies/notice/you_not_root','', TRUE);
		}

		//array con el contenido

		$this->js_script[]=site_url('assets/js/pagination.js');
		$this->js_script[]=site_url('assets/js/entriesAdmin.js');
		//monto la pagina segun petici

		$this->show_page('admin');
	}
	/**
	 * Método para editar un artículo, pero con derechos de administrador
	 * por lo que puede editar cualquier articulo
	 * @param  string $value el ID del artículo a editar
	 */
	public function edit($value='')
	{
		$this->load->helper('text_decode');
		$this->load->model('list_model');
		$resp=$this->list_model->give_edit($value);

		if ($resp->num_rows()>0)
		{
			$resp=$resp->row_array();
			//echo var_dump($resp);
			if(($this->_userrole>1)){
			//$resp['texto']=utf8_decode(html_entity_decode($resp['texto']));
				$resp['titulo']=html_entity_decode($resp['titulo']);
				$resp['descripcion']=text_to_decode($resp['descripcion'],false);
				$resp['texto']=text_to_decode($resp['texto'],false);
			//echo json_encode($resp)."aqui";
				$resp['jSon']=json_encode($resp);
				$this->section=$this->load->view('bodies/form/edit_admin',$resp, TRUE);
			}else{
				$this->section='no tienes permiso para cambiar este historia';
			}
			$this->head_html[]=base_url('assets/css/admin_edit.css');
			$this->js_script[]=site_url('js_trd/jquery.fineuploader-3.5.0.js');
			$this->js_script[]=site_url('js_trd/jRecorder.js');
			$this->js_script[]='http://js.nicedit.com/nicEdit-latest.js';
			$this->js_script[]=site_url('js/edit_engine');
			$this->array_page['gMap']=TRUE;
		}else{
			redirect('404');
		}

		$this->show_page('admin');
	}


	public function users($value='')
	{
		if ( $this->_userrole == 3 )
		{
			$user_info=$this->admin_model->usr_obj();
			$resp=$this->admin_model->give_all_users($value);
			if( $resp->num_rows() > 0 )
			{
				if ($user_info->num_rows()>0)
				{
		   			$user_info=$user_info->row();
		   			$data['total_usr']=$user_info->total;
		   			$data['no_conf']=$user_info->no_conf;
		   			$data['bloque']=$user_info->bloque;
		   			$data['activos']=$user_info->activos;
		   			$data['cancel']=$user_info->cancels;
		   		}
   				else
   				{
   					$data['total_usr']=0;
		   			$data['no_conf']=0;
		   			$data['bloque']=0;
		   			$data['activos']=0;
		   		}
				$data['items'] =$resp;
			}else{
				$data = array('items' =>$resp  );
			}
			$this->array_page['page']="Administ-users";
			$this->section.=$this->load->view('bodys/users_admin', $data, TRUE);
		}
		else
		{
			$this->section=$this->load->view('bodys/notice/you_not_root','', TRUE);
		}
		//$head_html=$this->load->view('headers/secr_hed_view','',TRUE);
		$this->js_script[] = base_url('assets/js/pagination.js');
		$this->js_script[] = base_url('assets/js/usersAdmin.js');
	//monto la pagina segun petición.
		$this->show_page('admin');
	}
public function ver_user()
{
	$resp=$this->admin_model->give_usr($this->input->post('usr'));
	if ($resp->num_rows()>0) {
		$output=json_encode($resp->result_array());
	} else {
		$output=json_encode( array( 'succes' => 'false' ));
	}
	$this->output->set_content_type('application/json')->set_output($output);
}
public function val_user()
{     $user=$this->input->post('us');
	 $this->load->model('login_model');
	 $final=$this->login_model->activate($user);
	    if($final>0){
            //si todo fue bien borramos el hash.
                  $this->login_model->delet_old($user);
                  $output=json_encode(array('succes' =>'true'));
	} else {
		$output=json_encode( array('succes' =>'false'  ));
         }
 $this->output->set_content_type('application/json')->set_output($output);
}
/**
 * Bloqueo i desbloqueo de usuarios.
 * $flag  [boolean] If true bloquea al user; false Desbloquea
 * @return [json] []
 */
public function block_user()
{   $data['usr']=$this->input->post('us');
   	$data['flag']=(int)$this->input->post('flag');
	$this->load->model('user_model');

		// Bloquea usuario
	$final=$this->user_model->block_user($data);
	if($final>0){
       	$output=json_encode(array('succes' =>'true','userId'=>$data['usr']));
	} else {
		$output=json_encode( array('succes' =>'false'));
    }
 	$this->output->set_content_type('application/json')->set_output($output);
}
public function mail_user()
{
	$this->load->library('mail_sender');
	$user=$this->input->post('us');
	$mensaje=$this->input->post('msj');
	$this->load->model('user_model');
	$resp=$this->admin_model->give_usr($user);

	if ($resp->num_rows() > 0)
	{
 		$resp=$resp->row();
 		// el correo
 		$mail_dat = array(
                          'id_us' =>$resp->usuario_id ,
                          'name_us'=>$resp->alias_usuario,
                          'to_mail'=>$resp->mail,
                          'to_name'=>$resp->nombre." ".$resp->apellido_1,
                          'limit'=>$this->config->item('conf_mail_limit'),
                          'subject'=>'Avis per l\'usuari, '.$resp->alias_usuario,
                          'titulo'=>'',
                          'mensaje'=>$mensaje
                           );
 		$mail_dat['html_mail']=$this->load->view('email/admin_cont_mail', $mail_dat, TRUE);
 		$this->mail_sender->build_mail($mail_dat);
        $respose=$this->mail_sender->send_mail();
            //
		if ($respose > 0)
		{
		    $output=json_encode( array('succes' =>'true'  ));
		}
		else
		{
			$output = $json_encode( array('succes' =>'false'  ));
		}
	}
	else
	{
		$output=json_encode( array('succes' =>'false'  ));
    }
 $this->output->set_content_type('application/json')->set_output($output);
}
public function send_mass($value)
{

	$this->load->library('mail_sender');

	$this->load->model('admin_model');
	$url=$this->admin_model->url_item($value);
	$mail_url = array('titulo' => site_url('ver/historia')."/".$url, );
	$mensaje=$this->load->view('email/new_item_mail',$mail_url,TRUE);
	$mail_data = array(
                              'subject'=>$this->lang->line('s_adm_mel'),
                              'html_mail'=>$mensaje,
                              'titulo'=>$this->lang->line('s_adm_mel')
                               );
	$this->mail_sender->send_mass($mail_data);
	echo $this->mail_sender->send_mail();

}
}
/* End of file administracio.php */
/* Location: ./application/controllers/administracio.php */