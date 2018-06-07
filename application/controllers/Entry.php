<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Sonormap
*
* An open source application for archive sounds for the education and history
* of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
*
* @package   application/controllers/Entry.php
* @author    Maximiliano Fernández
* @copyright Creative Commons Atribución-NoComercial-CompartirIgual 3.0 - 2013
* @license   http://creativecommons.org/licenses/by-nc-sa/3.0/.
* @link    	 https://github.com/Thebluemax/Sonormap
* @since     Version 0.2
*
*/
class Entry extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('list_model');
		$this->load->helper(array('text_decode','page_helper'));
		// preparar este valor para que sea recogido desde una base de datos.
		$this->pagNumber = 10;
		$this->page = $this->uri->segment(1)."/".$this->uri->segment(2);
		$this->urlPagination = 'historias/pagina';
		//$this->head_html=$this->load->view('headers/ver_header_view','',TRUE);
		$this->head_html[] = base_url($this->config->item('static_style_folder'))."/"."entries.css";

	}
	/**
	 * Pagina de inicio de la lista de historias.
	 */
	public function index()
	{
		$url_site=$this->lang->line('s_hist_ttl');
		$this->array_page['page']=$url_site;
		//Pidiendo las entradas y creando el navegador de páginas.
		$list_t=$this->list_model->give_all(0,$this->pagNumber);
		$this->array_page['pagination']=crear_pagination($list_t['num'],$this->urlPagination,$this->pagNumber);
		$list_t=$list_t['ret']->result();
		$this->array_page['list_t']=$list_t;
		//preparamos las vistas.
		$this->section=$this->load->view('bodies/list_entries', $this->array_page,TRUE);
		//enviamos la página a la función.
		$this->show_page();
	}
	public function page($value = '1')
	{
		//echo $value;
		$url_site=$this->lang->line('s_hist_ttl');
		$this->array_page['gMap']=TRUE;
		$this->array_page['fb_sdk']=TRUE;
		//cargando lista  de historias de la DB.
		$inicio=($this->pagNumber*$value)-$this->pagNumber;
		$fin=$this->pagNumber;
		$this->load->model('list_model');
		$list_t=$this->list_model->give_all($inicio,$fin);
		$this->array_page['pagination']=crear_pagination($list_t['num'],'historias/pagina',$this->pagNumber);
		$list_t=$list_t['ret']->result();
		$this->array_page['list_t']=$list_t;
		//preparamos las vistas.
		$this->section=$this->load->view('bodies/list_entries', $this->array_page,TRUE);
    	//enviamos la página a la función.
		$this->show_page();
	}
/**
* Metodo para visulaizar un artículo de la base de datos.
*
* @param  string $idItem [código del articulo]
* @return [type]        [description]
*
*/

	public function show($idItem="")
	{
	//variables generales.
		$url_site=$idItem;
		$this->array_page['page']=$url_site;
		$this->array_page['fb_sdk']=TRUE;
		$this->array_page['gMap']=TRUE;
	// buscamos el articulo.
		//echo var_dump($this->session->flashdata('user_list'));
		$resp=$this->list_model->get_title($idItem);
		if($resp->num_rows()>0){
			$resp=$resp->row();
			//TODO: introducir estos metodos directamente al modelo
			$res_r= $this->list_model->have_t($resp->id_registro);
			$res_v= $this->list_model->have_v($resp->id_registro);
			if ($res_r->num_rows()>0) {
				$res_r->result();
				$res_r=$res_r->row();
	/* $remplazo = array( '&#039;'=> "'",'&lt;' =>"<",  "&gt;"=>  ">",'&#34;'=>'"');
	*$res_r=strtr($res_r->texto,$remplazo);
	*$res_r=utf8_decode(html_entity_decode($res_r));
	*/
	  			$res_r= text_to_decode($res_r->texto,false);
			} else
			{
				$res_r=0;
			}
			if ($res_v->num_rows()>0)
			{
				$res_v->result();
				$res_v=$res_v->row();
				$res_v=$res_v->video;
		        //echo $res_v;
			} else
			{
				$res_v=0;
			}
			$this->load->helper('date');
			$stn_date=mdate('%d %F del %Y',$resp->creation_t);
			 //guardo los datos ha ser inyectados.
			$data = array(
				'user_a' =>$resp->alias_usuario ,
				'user_avt'=>$resp->avatar,
				'ttl_a' =>text_to_decode($resp->titulo,FALSE)  ,
				'txt_a' =>$res_r,
				'vdo_a' => $res_v,
				'file_a' =>$resp->file_image ,
				'ico_punt'=>$resp->ico_punt,
				'desc_a' =>text_to_decode($resp->descripcion,FALSE) ,
				'data_c'=>$stn_date,
				'file_s' =>$resp->file_sound,
				'lat' =>$resp->latitud ,
				'lon' =>$resp->longitud ,
				'ctg' =>$resp->categoria
				);
			     // echo  convert_accented_characters($resp->titulo);
			$this->section=$this->load->view('bodies/entry_view', $data,TRUE);
		}else{
			redirect('404');
		}
		$this->js_script[]=site_url('js/ver_js');
	    //enviamos la página a la función.
		$this->show_page();
	}

	public function card($userId='')
	{
		$usr_data = array();
	  	$this->load->model('user_model');
	    $response=$this->user_model->get_user($userId);
	    if ($response->num_rows()>0)
	    {
	        //Busqueda del usuario consultado.
	        $response=$response->row();
            $usr_data ['alias_u']=$response->alias_usuario;
            $usr_data ['name_u'] =$response->nombre;
            $usr_data['cog1_u']=$response->apellido_1;
            $usr_data ['cog2_u']=$response->apellido_2;
            $usr_data['sexo_u']=$response->sexo;
            $usr_data['avatar_u']=$response->avatar;
            $userId=$response->usuario_id;
	    	$statics=$this->user_model->statics_user($userId);
	    	if ($statics->num_rows()>0) {
	    		$statics=$statics->row();
	    		$usr_data['total_i']=$statics->total;
          		$usr_data['mes_vist_id']=$statics->id_reg_max;
	    		$usr_data['mes_vist_t']=$statics->titulo_i;
	    		$usr_data['mes_total_num']=$statics->max_vist;
	    		$usr_data['total_v_i']=$statics->visuali;
	    	}
            $this->section=$this->load->view('bodies/card_view', $usr_data, TRUE);

	    }else
	    {
	    	redirect('404');
	    }
	    	   // echo var_dump($us_st);
     	$this->show_page();
	}
}
/* End of file ver.php */
/* Location: ./application/ver.php */