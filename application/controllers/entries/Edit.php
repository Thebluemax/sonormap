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

class Edit extends MY_Controller {

    protected $id_s;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('text_decode');
		$this->load->library('category','form_validation');
		$this->load->model('list_model');
       	$this->page= $this->uri->segment(1);
       	$this->securePage=TRUE;
	}

	/**
	 * Furmulario rellenos con la historia a editar.
	 *
	 * 	$value : int ; ID de la historia
	 */
	public function entry($value='')
	{
			$resp=$this->list_model->give_edit($value);

			if ($resp->num_rows()>0)
			{
				$resp=$resp->row_array();
				//echo var_dump($resp);
				if(($resp['id_user']==$this->_id)){
				//$resp['texto']=utf8_decode(html_entity_decode($resp['texto']));
					$resp['titulo']=html_entity_decode($resp['titulo']);
					$resp['descripcion']=text_to_decode($resp['descripcion'],false);
					$resp['texto']=text_to_decode($resp['texto'],false);
				//echo json_encode($resp)."aqui";
					$resp['jSon']=json_encode($resp);
					$this->section=$this->load->view('bodys/form/form_edit_view',$resp, TRUE);
				}else{
					$this->section='no tienes permiso para cambiar este historia';
				}
				$this->head_html[]=site_url('stylesheet/editar');
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
/**
* Metodo para realiar un update de los items que componen una entrada,
* Recibe una peticón del controlador ajax.
* @return [json] un objeto con la respuesta de si fue bien o mal.
*/
	public function update()
	{
  		$this->load->library('form_validation');
		$tipo=$this->input->post('action');
		switch ($tipo)
		{
			case 'descrip':
				$this->form_validation->set_rules('contenido_desc','contenido_desc' , 'required|max_length[140]');
			break;
			case 'mapform':
				$this->form_validation->set_rules('lat','Latitud' , 'required');
				$this->form_validation->set_rules('lon','Longitud' , 'required');
			break;
			case 'hist':
				$this->form_validation->set_rules('text_item','el texto' , 'required');
			break;
			case 'video_lk':
				$this->form_validation->set_rules('youtu','link' , 'required');
			break;
			case 'upl_img':
				$this->form_validation->set_rules('image','imagen' , 'required');
			break;
			case 'hist_new':
				$this->form_validation->set_rules('relato','el texto' , 'required');
			break;
			case 'upl_aud':
				$this->form_validation->set_rules('audio','l\'àudio' , 'required');
			break;
			default:
			# code...
			break;
		}
		if ($this->form_validation->run() === FALSE) {
			$msj=validation_errors('<p class="error">', '</p>');
		}else{
			switch ($tipo) {
				case 'descrip':
				    $desc=text_to_decode($this->input->post('contenido_desc'),TRUE);
				    $id=$this->input->post('id_rgtro');
					$resp=$this->list_model->des_update($id,$desc);
				break;
				case 'mapform':
					$lat=$this->input->post('lat');
					$lon=$this->input->post('lon');
				    $id=$this->input->post('id_rgtr_m');
					$resp=$this->list_model->des_coordenadas($id,$lat,$lon);
				break;
				case 'hist':

					//$text=htmlentities($this->input->post('text_item'),ENT_QUOTES);
					$text=text_to_decode($this->input->post('text_item'),true);
						// igual que en otros espacios donde se usa esta función si funcina se han de borrar las lineas comentadas.
				    $id=$this->input->post('hist_id');
					$resp=$this->list_model->des_hist($id,$text);
				break;
				case 'video_lk':

					$video=$this->input->post('youtu');
				    $id=$this->input->post('id_vdo');
					$resp=$this->list_model->vdo_update($id,$video);
				break;
				case 'upl_img':

					$img=$this->input->post('image');
					$id=$this->input->post('id_rgtro');

					$resp=$this->list_model->img_update($id,$img);
				break;
				case 'hist_new':
					$arr['escr']=text_to_decode($this->input->post('relato'),TRUE);
					$arr['id_item']=$this->input->post('item_id');
					$resp=$this->list_model->new_story($arr);

				break;
				case 'upl_aud':

					$aud=$this->input->post('audio');
					$id=$this->input->post('id_rgtro');
					$resp=$this->list_model->aud_update($id,$aud);
				break;
				default:
					# code...
				break;
			}
			$msj=$resp;

		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('msj' => $msj)));
	}
/**
* Publicar la entrada
* @param  string $value [id _entrada]
* @return [type]        [void?]
*/
	public function publicar($value)
	{

		$resp=$this->list_model->publ($value);
		if ($resp=1) {
			// mail a la administración.
     		$this->load->helper('email');
     		$this->load->library('mail_sender');
         	$mail_dat = array(
                          'id_us' =>1,
                          'name_us'=>"admin",
                          'to_mail'=>$this->list_model->adm_mail(),
                          'to_name'=>"name",
                          'limit'=>$this->config->item('conf_mail_limit'),
                          'subject'=>$this->lang->line('s_mail_nu8'),
                          // corta y pega para optimizar.
                          'titulo'=>'',
                          'mensaje'=>''
                           );
 			$mail_dat['html_mail']=$this->load->view('email/new_itm_adv', $mail_dat, TRUE);
 			$this->mail_sender->build_mail($mail_dat);
            $respose=$this->mail_sender->send_mail();
			$this->section=$this->load->view('bodys/notice/wait_for','', TRUE);
		}else{
			$this->section=$this->load->view('bodys/notice/salve_data_error','', TRUE);
		}
		$this->head_html[]=base_url('js_trd/fineuploader-3.5.0.css');
		$this->head_html[]=site_url('stylesheet/editar');

		$this->show_page();
	}
	/**
	 * esto va aquí?
	 *
	 * Si para que lo borre un usuario antes de publicar
	 * */

	public function erase ()
	{
       //variables generales.
       	$val;
       	//seguridadERFGERGRGRGRFGHDFGHDFGDFGD
		$name = array(
					'name' =>$this->username,
					'security'=>TRUE,
					'user'=>$this->username,
					'rol'=>$this->userrole
					);
		$this->load->model('list_model');

		$val=$this->list_model->eliminar_h($this->input->post('elim_v'));

		$dato= array('flag' =>$val );
		$this->load->view('bodys/notice/db_return_view', $dato, FALSE);
	}
}
/* End of file edicio.php */
/* Location: ./application/controllers/list/edicio.php */