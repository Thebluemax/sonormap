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

class Search extends MY_Controller {
/**
 * la funcion html genera una busqueda i la devuelve como un fragmento html
 * @return string fragmento html.
 */
	public function html()
	{
		$this->load->model('list_model');

        $r=array();
        if($this->input->post('tipo')){
		    $resp=$this->list_model->search($this->input->post('tipo'), $this->input->post('termino'));//general();
           	if ($resp->num_rows()>0) {
           		$r['data']=$resp->result();
           		$r['success']=True;
           	}else{
           		$r['success']=FALSE;
           	}
		}else{
			$r['success']=FALSE;
		}
		if(isset($r['success'])&&$r['success']==FALSE){

		}else{

       	}

       	$r=json_encode($r);
       	 $this->output
    ->set_content_type('application/json')
    ->set_output($r);
	}
  /**
   * esta funcion hace lo mismo que la anterior pero enviando una respuesta json
   * @return json json con el resultado de la misma.
   */
public function json_r()
{
  $this->load->helper('jsonresp');
  $r=array();
            if($this->input->post('tipo')){
          $resp=$this->general();
        }
          $resp=$resp->result_array();
           $jonson=make_json($resp);
           $this->output
    ->set_content_type('application/json')
    ->set_output($jonson);
}
/**
 * función interna del controlado
 * @return ci_db object objeto Ci_db con el resultado de la busqueda.
 */
private function general()
{


      $tipo=$this->input->post('tipo');
      $search=$this->input->post('termino');

         switch ($tipo) {
          case 1:
            $sql="SELECT * FROM item_archivo WHERE  revisado=1 AND ( descripcion like '%".$search."%' or titulo like '%".$search."%' );";
            break;
          case 2:

            $sql="SELECT a.* FROM item_archivo a ,categorias c WHERE c.id_categoria=a.categoria and c.id_categoria =".$search." AND revisado=1;";

            break;
            case 3:

            $sql="SELECT a.* FROM item_archivo a  WHERE  a.ico_punt ='".$search."' AND revisado=1;";
            break;
               case 41:

            $sql="SELECT a.* FROM item_archivo a  WHERE  DATE(a.data_creacion) <'".$search."' AND revisado=1;";
            break;
              case 42:

            $sql="SELECT a.* FROM item_archivo a  WHERE  DATE(a.data_creacion) >'".$search."' AND revisado=1;";
            break;
              case 43:

            $sql="SELECT a.* FROM item_archivo a  WHERE  DATE(a.data_creacion) ='".$search."' AND revisado=1;";
            break;
         }
           $resp=$this->db->query($sql);
           return $resp;
}
}

/* End of file search.php */
/* Location: ./application/controllers/list/search.php */