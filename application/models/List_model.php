<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 15-05-2013
 *
 * modelo que maneja los datos ingresados.
 *
 * @autor Maximiliano Fernandez - @ maxm13.
 *
 *
 */
class List_model extends CI_Model {

	 /**
    * Comprueba que el titulo dado no existe.
    * @param  string $value [String: titulo a comprobar]
    * @return [type]        [int]
    */
   public function check_title($value='')
	{
		$sql="SELECT * FROM item_archivo WHERE titulo='".$value."';";
		$res=$this->db->query($sql);
		return $res;
   }
   /**
    * Ingresa un nuevo item
    * @param  string $values [array ]
    * @return [type]         [description]
    */
   function new_item($values="")
   {
   	$sql="INSERT INTO item_archivo (id_user,titulo,descripcion,file_image,file_sound,latitud,longitud,ico_punt,categoria,revisado,data_creacion,url)
   	VALUES
   	(".$values['id_u'].",'".$values['tlt']."','".$values['dcp']."','".$values['fil_a']."','".$values['fil_s']."',".$values['lat'].",".$values['lon'].",'".$values['ico']."',".$values['categ'].",0,DEFAULT,'".$values['url']."')";
      $oper =	$this->db->query($sql);
   if ($oper>0) {
      # code...
        return $this->db->insert_id();
   }else
   {
      return 0;
   }
   }
   /**
    * Inseta un nuevo video en la base de datos.
    * @param  string $value [description]
    * @return [type]        [description]
    */
   public function new_video($value='')
   {
      $sql="INSERT INTO youtube (id_registro,video,data_creacion) VALUES (".$value['id_item'].",'".$value['ytb']."',DEFAULT)";
      $ret= $this->db->query($sql);
      return $ret;
   }
   /**
    * Inserta una nueva historia en la base de datos
    * @param  string $value [description]
    * @return [type]        [description]
    */
   public function new_story($value='')
   {
       $sql="INSERT INTO relato (id_registro,texto,data_creacion) VALUES (".$value['id_item'].",'".$value['escr']."',DEFAULT)"
;      $ret= $this->db->query($sql);
 return $ret;
   }
   /**
    * Retorna todos los items.
    * @param  string $value [description]
    * @return [type]        [description]
    */
   public function give_all($inici=0,$fin=0)
   {
      # code...
      $sql="SELECT * FROM item_archivo WHERE revisado=1;";
      $num= $this->db->query($sql);
      $num=$num->num_rows();
      $cola;
      if ($fin==0) {
        $cola="";
      } else {
        $cola="DESC LIMIT $inici,$fin";
      }

      $sql1="SELECT * FROM item_archivo WHERE revisado=1 ORDER BY data_creacion $cola";
      $ret= $this->db->query($sql1);
      $send['ret']=$ret;
      $send['num']=$num;
      return $send;
   }
   /**
    * Lista todas las entradas de un usuario
    * @param  string $id [ID del usuario]
    * @return [type]        [description]
    */
   public function give_all_user($id='')
   {
      # code...
      $sql="SELECT * FROM item_archivo WHERE id_user=".$id;
      $ret= $this->db->query($sql);
       return $ret;
   }
   public function give_uno($value='')
   {

      $sql="SELECT i.*, u.alias_usuario, u.avatar, UNIX_TIMESTAMP(i.data_creacion) as creation_t FROM item_archivo i ,usuario u WHERE id_registro=".$value." AND u.usuario_id=i.id_user;";
      $ret= $this->db->query($sql);
       return $ret->row();
   }
    public function give_edit($value='')
   {

      $sql="SELECT *,i.id_registro as registro , UNIX_TIMESTAMP( i.data_creacion ) AS creation_t
FROM (SELECT *
FROM item_archivo
WHERE id_registro =$value
) i
LEFT JOIN relato r ON r.id_registro = i.id_registro
LEFT JOIN youtube t ON t.id_registro = i.id_registro;";
      $ret= $this->db->query($sql);
       return $ret;
   }
   public function have_v($value='')
   {
      # code...
      $sql="SELECT * FROM youtube WHERE id_registro=".$value.";";
      $ret= $this->db->query($sql);
       return $ret;
   }
    public function have_t($value='')
   {

      $sql="SELECT * FROM relato WHERE id_registro=".$value.";";
      $ret= $this->db->query($sql);
      return $ret;
   }
   public function get_title($value='')
   {
     //$value=str_replace(array('_','-'), array(' ' ,"'" ), $value);
	//
  	//   $value=htmlentities($value,ENT_QUOTES);
      $this->db->trans_start();
      $sql="SELECT i.*, u.alias_usuario,u.avatar, UNIX_TIMESTAMP(i.data_creacion) as creation_t FROM item_archivo i ,usuario u WHERE i.url='".$value."' AND u.usuario_id=i.id_user;";
      $ret= $this->db->query($sql);
      if ( $this->session->userdata('user_list') === '' || is_null( $this->session->userdata('user_list') ) )
      {
      $sql_u="UPDATE item_archivo set visto=visto+1 WHERE url='".$value."';";
      $visto=$this->db->query($sql_u);
      }
      $this->db->trans_complete();
       return $ret;

   }
   ///todos los updates de los items.
   public function des_update($id='',$value='')
   {
     $sql="UPDATE item_archivo set descripcion='".$value."' WHERE id_registro=".$id;
      $resp=$this->db->query($sql);
      return $resp;
   }
   public function des_coordenadas($id,$lat,$long)
   {
      $sql="UPDATE item_archivo set latitud=".$lat." ,longitud=".$long." WHERE id_registro=".$id;
      $resp=$this->db->query($sql);
      return $resp;
   }
   public function img_update($id,$img)
   {
      $sql="UPDATE item_archivo set file_image='".$img."' WHERE id_registro=".$id;
      $resp=$this->db->query($sql);
      return $resp;
   }
   public function aud_update($id,$aud)
   {
      $sql="UPDATE item_archivo set file_sound='".$aud."' WHERE id_registro=".$id;
      $resp=$this->db->query($sql);
      return $resp;
   }
   public function des_hist($id,$text)
   {
     $sql="UPDATE relato set texto='".$text."' WHERE id_relato=".$id;

      $resp=$this->db->query($sql);
      return $resp;
   }
    public function vdo_update($id,$video)
   {
     $sql="UPDATE youtube set video='".$video."' WHERE id_video=".$id;

      $resp=$this->db->query($sql);
      return $resp;
   }
   public function adm_mail()
   {
     $sql="SELECT mail FROM persona p, usuario u WHERE p.usuario_id=u.usuario_id and u.rol=3;";
     $resp=$this->db->query($sql);
     if($resp->num_rows()>0){
      $resp=$resp->result_array();
      $mails="";
      foreach ($resp as $key ) {
        $mails.=$key['mail'].',';
      }
      $mails=substr($mails,0,-1);
     }
      return $mails;
   }
      /**
    * eiminar un item
    * @param  string $value [en número de id del item]
    * @return [type]        [description]
    */
   public function eliminar_h($value='')
{
  $sql='DELETE FROM item_archivo WHERE id_registro='.$value;
   $res=$this->db->query($sql);
   if ($res>0) {
       $sql='DELETE FROM relato WHERE id_registro='.$value;
       $res1=$this->db->query($sql);
       $sql='DELETE FROM youtube WHERE id_registro='.$value;
       $res2=$this->db->query($sql);
   }
   return $res;
 }
 /**
  * marca para publicar
  * @param  string $value [description]
  * @return [type]        [description]
  */
 public function publ($value='')
 {
  $sql='UPDATE item_archivo SET revisado=2 WHERE id_registro='.$value;
  $resp=$this->db->query($sql);
  return $resp;
 }
 /**
  * Función de búsqueda
  */
 public function search($tipo, $search)
{


      //$tipo=$this->input->post('tipo');
     // $search=$this->input->post('termino');

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
/* End of file list_model.php */
/* Location: ./application/models/list_model.php */