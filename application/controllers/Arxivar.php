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
 * @since		Version 0.1
 *
 */
class Arxivar extends MY_Controller {

     protected $id_s;

	public function __construct ()
	{
		parent::__construct ();
		$this->_securePage=TRUE;
		$this->load->model('list_model');
		$this->load->library('category');
		$this->load->helper('text_decode');
	    $this->array_page['page']= $this->uri->segment(1);
	}
	public function index ()
	{
       //variables generales.

		$this->head_html[]=base_url('js_trd/fineuploader-3.5.0.css');
		$this->head_html[]=site_url('stylesheet/arxivar');
		$this->js_script[]=base_url('js_trd/jquery.fineuploader-3.5.0.js');
		$this->js_script[]=base_url('js_trd/jRecorder.js');
		$this->js_script[]='http://js.nicedit.com/nicEdit-latest.js';
		$this->js_script[]=site_url('js');
       	$select_data = array(
       		'categoria' => $this->load->view('bodys/select_view',$this->category->selec_cat() , TRUE)
       		);
        $this->section=$this->load->view('bodys/form/registre_form',$select_data, TRUE);
       //	$this->aside.=$this->load->view('bodys/aside_new_record','', TRUE);

		//array con el contenido
		$this->array_page['gMap']=TRUE;
		//monto la pagina segun petición.
		$this->show_page('admin');

	}

	public function new_item()
	{
		// aquí els mil y una comprobación antes que nada.
		// y todavía esparamos.
	    $userID=$this->_id;
	    //echo $this->id_u;
	    $title=$this->input->post('tlt');
	    //solución para la " ' " en el idioma.
	    $title_c=utf8_encode($this->db->escape_str($title));//htmlentities($title,ENT_QUOTES);

	    $url=textToUrl($title);
	    //lo mismo.
	    /*$description=utf8_encode($this->input->post('dcp'));
	    $description=htmlentities($description,ENT_QUOTES);*/
	    // función en pruebas de funcionar bien se ha de borrar las lineas de codigo de más.
	    $description=$this->db->escape_str($this->input->post('dcp'));//text_to_decode($this->input->post('dcp'),TRUE);
	    // $url=url_title($title);
		$values = array(
				'id_u' 	=>	$userID,
				'tlt' 	=>	$title_c,
				'dcp' 	=>	$description ,
				'lat' 	=>	$this->input->post('lat') ,
				'categ' =>	$this->input->post('catg') ,
				'lon' 	=>	$this->input->post('lon') ,
				'ico' 	=>	$this->input->post('icon'),
				'fil_a' =>	$this->input->post('fil_a') ,
				'fil_s' =>	$this->input->post('fil_s') ,
				'url'	=>	$url
						);
        $hist=utf8_encode($this->db->escape_str($this->input->post('text_h')));
		$video=$this->input->post('vid');

		//$hist=htmlentities($hist,ENT_QUOTES  );
		$val= $this->list_model->new_item($values);

		if ( $video !== '0' && $val > 0 )
		{

			$values=array(
					'id_item'=>$val ,
					'ytb'=>$video ,
					);

		$resp_vid=$this->list_model->new_video($values);
		}
		if ($hist!=='0'&&$val>0) {
			$values=array(
					'id_item'=>$val ,
					'escr'=>$hist ,
		);
			$resp_rel=$this->list_model->new_story($values);
		}
		$dato= array('flag' =>$val );
		$this->load->view('bodys/notice/db_return_view', $dato, FALSE);
	}
/**
 * función que guarda el enlace a un video.
 * @return [int] [resultado de la acción]
 */
	public function salve_tv()
	{
		$values=array(
						'id_item'=>$this->input->post('id_u') ,
						'ytb'=>$this->input->post('vdo') ,
						'escr'=>$this->input->post('escr')
			);

		if ($resp_vid==1&&$resp_rel==1) {
			$this->load->view('bodys/notice/all_data_salve', '', FALSE);
		} else {
				$this->load->view('bodys/notice/salve_data_error', '', FALSE);
		}
	}
	public function check_title()
	{
		$title=$this->input->post('titulo');
		$title=htmlentities($title,ENT_QUOTES);
		$resp= $this->list_model->check_title($title);
		$obj=$resp->result();
		if($resp->num_rows()==0)
		{
            $data=array('flag'=>1);
		}else{
            $data=array('flag'=>0);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));//->_display();
	}
}
/* End of file arxivar.php */
/* Location: ./application/controllers/arxivar.php */