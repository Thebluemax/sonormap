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
 * @since   Version 0.2
 */
class Admin_model extends CI_Model {
/**
 * Modelo para la administración de
 * datos por parte del usuario administrador
 * dentro del sistema.
 **/
/**
 * Devuelve las entradas sin validar.
 * @return [type] [description]
 */
public function i_edit_status()
{
	$sql="SELECT count(a.id_user) as number_rows, u.usuario_id as usuario_id, u.alias_usuario, u.avatar as avatar, a.revisado as checked FROM item_archivo a, usuario u WHERE a.revisado=0 AND a.id_user=u.usuario_id GROUP BY a.id_user;";
	$res=$this->db->query($sql);
	return $res;
}
public function i_no_chck()
{
  $sql="SELECT a.url, a.id_registro, a.id_user, a.titulo, a.descripcion, u.alias_usuario, a.revisado FROM item_archivo a, usuario u WHERE
   a.revisado=2 AND a.id_user=u.usuario_id;";
  $res=$this->db->query($sql);
  return $res;
}
/**
 * Ganador de más leido
 */
public function user_winner()
{
	$sql="SELECT sum(a.visto) as vistos, u.alias_usuario as alias, u.avatar as avatar  FROM item_archivo a, usuario u WHERE a.revisado=1 AND a.id_user=u.usuario_id GROUP BY u.usuario_id ;";
  $res=$this->db->query($sql);
  return $res->row();
}
public function item_winner()
{
	$sql="SELECT a.id_user as id, a.visto as visto, a.titulo as titulo, a.file_image as file, u.alias_usuario as alias FROM item_archivo a, usuario u WHERE a.revisado=1 AND a.id_user=u.usuario_id AND a.visto=(select MAX(visto) from item_archivo) ;";
  $res=$this->db->query($sql);
  return $res->row();
}
/**
 *
 */
public function status ()
{

	$sql="SELECT (
				SELECT count(*) FROM usuario
				) AS total_usr,
				(
				SELECT count(*) FROM usuario WHERE confirmado=0 AND cuenta_activa=1
				) AS total_usr_no_conf,
				(
				SELECT count(*) FROM item_archivo
				) AS total_items,
            (SELECT count(*) From item_archivo WHERE revisado=2 )
            AS total_por_confir,
            (SELECT sum(visto) FROM item_archivo
    ) AS vistos;";
     $response=$this->db->query($sql);
     return $response->row();
}
/**
 * Valida la entrada.
 * @param  int $value id_de la entrada
 *
 * @return int      resultado de la operación true=1; false=0;
 */
public function ckc_valid($value='')
{
	$sql="UPDATE item_archivo SET revisado=1 WHERE id_registro=$value ;";
	$res=$this->db->query($sql);
	return $res;
}
/**
 *  Bloquea un item
 *  @param int $value numero de registro de la entrada a bloquear.
 **/
public function ckc_bloq($value='')
{
  $sql="UPDATE item_archivo SET revisado=0 WHERE id_registro=$value ;";
  $res=$this->db->query($sql);
  return $res;
}

/**
 * Devuelvelos usuarios separados por su status.
 *
 * @return [type]        [description]
 */
public function usr_obj()
{
	$sql="SELECT(
			SELECT count(*) FROM usuario
		) AS total,
			(
				SELECT count(*) FROM usuario WHERE confirmado=0 AND cuenta_activa=1
				) AS no_conf,
			(
			SELECT count(*) FROM usuario WHERE cuenta_activa=0 AND confirmado=1
			)
AS bloque,
            (SELECT count(*) From usuario u, persona p WHERE u.usuario_id=p.usuario_id )
            AS activos,
            (SELECT count(*) FROM usuario WHERE confirmado=0 AND cuenta_activa=0
    ) AS cancels;";
     $response=$this->db->query($sql);
     return $response;
}
	/**
	 *  Dame todas las entardas
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
  public function give_all($value='')
   {
   	$sql="SELECT i.*, u.alias_usuario, u.usuario_id as usuario_id, u.avatar,u.usuario_id FROM item_archivo i, usuario u WHERE i.id_user=u.usuario_id";
      switch ($value) {
      	case '1':
      		$sql.=' AND i.revisado=1';
      		break;
      	case '2':
      		$sql.=' AND i.revisado=2';
      		break;
      		case '3':
      		$sql.=' ORDER BY i.visto DESC';
      		break;
      	case '4':
      		$sql.=' ORDER BY i.data_creacion ASC';
      		break;
      	case '5':
      		$sql.=' ORDER BY i.titulo ASC';
      		break;
      	case '5':
     		 $sql.=' ORDER BY u.alias_usuario ASC';
     		 break;
      	default:
      		# code...
      		break;
      }

      $ret= $this->db->query($sql);
       return $ret;
   }

   /**
	 *  dame todas los Usuarios
	 * @param  string $value filtra por tipo de usuario u otra característica
	 * @return [type]        El objeto con la respuesta SQL
	 */
  public function give_all_users($value='')
   {
   	$sql="SELECT u.*, p.nombre, p.mail FROM persona p, usuario u WHERE p.usuario_id=u.usuario_id";
      switch ($value) {
      	case '1':
      		$sql.=' AND u.confirmado=1 AND u.cuenta_activa=1';
      		break;
      	case '2':
      		$sql.=' AND u.confirmado=0 AND u.cuenta_activa=1';
      		break;
      		case '3':
      		$sql.=' AND u.cuenta_activa=0 AND u.confirmado=1';
      		break;
          case '4':
          $sql='SELECT * FROM  usuario u WHERE u.confirmado=0 AND u.cuenta_activa=0';
          break;
      	default:
      		# code...
      		break;
      }

      $ret= $this->db->query($sql);
       return $ret;
   }

   /**
    * encuentra un usuario
    * @param  int       $id la id del usuario en la base de datos
    * @return [type]    El objeto con los datos del usuario
    */
   public function give_usr($id="")
{
  $sql="SELECT * FROM persona p, usuario u WHERE
   p.usuario_id=u.usuario_id AND u.usuario_id=".$id;
  $res=$this->db->query($sql);
  if ($res->num_rows() > 0) {
    $res = $res->row();
    $user['success']  = TRUE;
    $user['id']  = $res->usuario_id;
    $user['alias']  = $res->alias_usuario;
    $user['active']  = $res->cuenta_activa;
    $user['rol']  = $res->rol;
    $user['confirmado']  = $res->confirmado;
    $user['since']  = $res->miembro_hace;
    $user['name']  = $res->nombre;
    $user['lastname']  = $res->apellido_1.' '.$res->apellido_2;
    $user['dob']  = $res->data_nacimiento;
    //$user['lastname']  = $res->apellido;
    $user['email']  = $res->mail;
    $user['notes']  = $res->observacion;
    $user['gender']  = $res->sexo;
    if ($res->avatar == 'null') {
      $user['avatar'] = $this->config->item('itm_no_img_m');
    }else {
      $user['avatar'] = $res->avatar;
    }
  } else {
    $user = 0;
  }
  return $user;
}
/**
 * Envio masivo de correo.
 * @return [type] [description]
 */
public function mass_mail()
{
  $sql="SELECT mail FROM  persona, usuario WHERE usuario.mailing=1 and usuario.usuario_id=persona.usuario_id";
  $res=$this->db->query($sql);
  if ($res->num_rows()==0) {
    $res=0;
  } else{
    $res=$res->result_array();
    $res_arr;
    foreach ($res as $key => $value) {
      $res_arr[]=$value['mail'];
    }
  }
    return $res_arr;
  }
  public function url_item($value='')
  {
   $sql="SELECT url FROM item_archivo WHERE id_registro =".$value." ;";
   $res=$this->db->query($sql);
   if ($res->num_rows()>0) {
     $res=$res->row();
     $res=$res->url;
   } else {
     $res=0;
   }
   return $res;
  }


}
/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */