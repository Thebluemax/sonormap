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

class Category {
protected $ci;
private $cat_list;
    public function __construct()
    {
        $this->ci =& get_instance();
       // $this->ci->load->model('listing_model');
     $this->cat_list=$this->ci->db->get_where('categorias', array('padre' => NULL));
    }
  // crea un <select> con los datos de las categorias en la base de datos .
  function selec_cat(){
    $select_out = array();

     $output= '<select id="categ" name="categ" class="form-control">';

     foreach ($this->cat_list->result() as $key) {
     	$output.='<option value="'.$key->id_categoria.'">'.$key->categoria.'</option>';
     	$icon[$key->categoria]=$key->icon;
      $select_out[$key->categoria]=$this->dame_subcat($key->id_categoria);
     }
     $output.="</select>";


    $salida=array(
                    'padre'=>$output,
                    'sfill'=>json_encode($select_out),
                    'cicon'=>json_encode($icon)
                    );

   return $salida;
  }

  public function dame_subcat($value='')
   {
    $categoria=$this->ci->db->get_where('categorias', array('padre' =>$value));
    $res=$categoria->result();
      $output= '<select id="subcateg" name="subcateg" class="form-control">';

     foreach ($res as $key) {
      $output.='<option value="'.$key->id_categoria.'">'.$key->categoria.'</option>';
     }
     $output.="<select>";
    return  $output;

   }
}

/* End of file category.php */
/* Location: ./application/libraries/categoty.php */