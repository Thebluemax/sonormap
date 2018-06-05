<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package		Sonormap
 * @author		MaximilianoFernández
 * @copyright	Creative Commons Atribución-NoComercial-CompartirIgual 3.0 - 2013
 * @license		http://creativecommons.org/licenses/by-nc-sa/3.0/.
 * @link		https://github.com/Thebluemax/Sonormap
 * @since		Version 0.0
 * 
 */

class Publicar extends CI_Controller {

     protected $security;
     protected $username;
     protected $userrole;
     protected $page;
     protected $id_s;



	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('category','form_validation');
		$this->load->model('list_model');
		$this->security=$this->session->userdata('autorizado');
		$this->username=$this->session->userdata('id_user');
       	$this->userrole=$this->session->userdata('fun_user');
       	$this->id_u=$this->session->userdata('id_ref');
       	//$this->page= $this->uri->segment(1);
       	$this->item= $this->uri->segment(3);
	}
	public function index($value)
	{
		$aside="";
		if ($this->security > 0) {
			$resp=$this->list_model->publ($this->item);
			if ($resp=1) {
				// mail a la administración.
            if($val>0){
         $this->load->helper('email');
         $this->load->library(
                                'mail_sender'
                                );
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
             }
				$section=$this->load->view('spare_part/notice/wait_for','', TRUE);
					}else{
						$section=$this->load->view('spare_part/notice/salve_data_error','', TRUE);
					}
				$head_html=$this->load->view('headers/edit_head_view','', TRUE);


					
			
		} else {
				$section=$this->load->view('spare_part/notice/error_404','', TRUE);
			}
			$head_html=$this->load->view('headers/head_view', '', TRUE);
				$name = array(
							'name' =>$this->username,
							'security'=>TRUE,
							'user'=>$this->username,
							'rol'=>$this->userrole
							);
				$name['page']=$this->page;
			$name['fb_sdk']=FALSE;
			$name['slide']='<figure class="slide_cont"><img src="img/slide/parr.jpg" alt="" class="slide_img"><captation class="cap_slide"></captation></figure>';	
			show_page($head_html,$name,$section,$aside);
	}
	/**
	 * funciones de update items, controlador ajax.
	 * @return [type] [description]
	 */
public function update()
{
  $this->load->library('form_validation');
	$tipo=$this->input->post('action');
	switch ($tipo) {
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
			    $desc=htmlentities($this->input->post('contenido_desc'),ENT_QUOTES);
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
				
				$text=htmlentities($this->input->post('text_item'),ENT_QUOTES);
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
				$arr['escr']=htmlentities($this->input->post('relato'),ENT_QUOTES);
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
}

/* End of file publicar.php */
/* Location: ./application/controllers/list/publicar.php */