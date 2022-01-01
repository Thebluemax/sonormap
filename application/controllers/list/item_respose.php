<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package     Sonormap
 * @author      MaximilianoFernández
 * @copyright   Creative Commons Atribución-NoComercial-CompartirIgual 3.0 - 2013
 * @license     http://creativecommons.org/licenses/by-nc-sa/3.0/.
 * @link        https://github.com/Thebluemax/Sonormap
 * @since       Version 0.0
 *
 */

class Item_respose extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('list_model');
        $this->load->helper('text_decode');
	}

	public function get($value="")
	{
        $resp=$this->list_model->give_uno($value);
        $res_r= $this->list_model->have_t($value);
         $res_v= $this->list_model->have_v($value);
         if ($res_r->num_rows()>0) {
         	$res_r->result();
         	$res_r=$res_r->row();
         	$res_r=$res_r->texto;
         } else {
         	$res_r=0;
         }
          if ($res_v->num_rows()>0) {
                $res_v->result();
                $res_v=$res_v->row();
                $res_v=$res_v->video;
         } else {
                $res_v=0;
         }
                    $this->load->helper('date');
                 $stn_date=mdate('%d %F del %Y',$resp->creation_t);
        $data = array('user_a' =>$resp->alias_usuario ,
                       'user_avt'=>$resp->avatar,
        				'ttl_a' =>html_entity_decode($resp->titulo)  ,
        				'txt_a' =>html_entity_decode($res_r),
                       'vdo_a' => $res_v,
        				'file_a' =>$resp->file_image ,
        				 'desc_a' =>utf8_decode(html_entity_decode($resp->descripcion)) ,
                         'data_c'=>$stn_date,
        				 'file_s' =>$resp->file_sound,
        				 'lat' =>$resp->latitud ,
        				 'lon' =>$resp->longitud ,
        				 'ctg' =>$resp->categoria );

        $this->load->view('spare_part/item_view', $data, FALSE);

	}

        public function get_adm($value="")
    {
        $resp=$this->list_model->give_uno($value);
        $res_r= $this->list_model->have_t($value);
         $res_v= $this->list_model->have_v($value);
         if ($res_r->num_rows()>0) {
            $res_r->result();
            $res_r=$res_r->row();
            $res_r=$res_r->texto;
         } else {
            $res_r=0;
         }
          if ($res_v->num_rows()>0) {
                $res_v->result();
                $res_v=$res_v->row();
                $res_v=$res_v->video;
         } else {
                $res_v=0;
         }
                    $this->load->helper('date');
                 $stn_date=mdate('%d %F del %Y',$resp->creation_t);
        $data = array('user_a' =>$resp->alias_usuario ,
                       'user_avt'=>$resp->avatar,
                        'ttl_a' =>html_entity_decode($resp->titulo)  ,
                        'txt_a' =>text_to_decode($res_r,FALSE),
                       'vdo_a' => $res_v,
                       'ico_punt'=>$resp->ico_punt,
                        'file_a' =>$resp->file_image ,
                         'desc_a' =>html_entity_decode($resp->descripcion) ,
                         'data_c'=>$stn_date,
                         'file_s' =>$resp->file_sound,
                         'lat' =>$resp->latitud ,
                         'lon' =>$resp->longitud ,
                         'ctg' =>$resp->categoria );

        $this->load->view('spare_part/item_adm_view', $data, FALSE);

    }

}

/* End of file item_respose.php */
/* Location: ./application/controllers/list/item_respose.php */