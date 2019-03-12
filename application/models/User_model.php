<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();

	}

	public function new_user($value='')
	{
		# code...
    if($value['sexo']===$this->config->item('male')){
          $img=$this->config->item('itm_no_img_m');
    }else{
        $img=$this->config->item('itm_no_img_f');
    }
		$this->db->trans_start();
		$sql="INSERT INTO usuario (alias_usuario,cuenta_activa,mailing,key_word,avatar) VALUES('".$value['id']."',".$value['activa'].",".$value['mailing'].",'".$value["clave"]."','".$img."');";
		$this->db->query($sql);

			$ref_usr=$this->db->insert_id();
			$sql2="INSERT INTO persona (usuario_id,nombre,apellido_1,apellido_2,data_nacimiento,mail,observacion,sexo) VALUES(".$ref_usr.",'".$value['name']."','".$value['apell1']."','".$value["apell2"]."','".$value['dob']."','".$value['email']."','','".$value['sexo']."');";
			$this->db->query($sql2);
         $this->db->trans_complete();
         if ($this->db->trans_status() === FALSE) {
         	return 0;
         }else{
         	return $ref_usr;
         }

	}
  public function get_user($user='')
  {
  	$sql="SELECT * from usuario , persona WHERE usuario.alias_usuario='".$user."' and usuario.usuario_id = persona.usuario_id;";
    $resp=$this->db->query($sql);
    if ($resp->num_rows() > 0) {
      $resp = $resp->row();
      $userInfo['success']  = TRUE;
      $userInfo['id']  = $resp->usuario_id;
      $userInfo['alias']  = $resp->alias_usuario;
      $userInfo['active']  = $resp->cuenta_activa;
      $userInfo['rol']  = $resp->rol;
      $userInfo['confirmado']  = $resp->confirmado;
      $userInfo['since']  = $resp->miembro_hace;
      $userInfo['name']  = $resp->nombre;
      $userInfo['lastname']  = $resp->apellido;
      $userInfo['dob']  = $resp->data_nacimiento;
      $userInfo['lastname']  = $resp->apellido;
      $userInfo['email']  = $resp->mail;
      $userInfo['notes']  = $resp->observacion;
      $userInfo['gender']  = $resp->sexo;
      if ($resp->avatar == 'null') {
        $userInfo['avatar'] = $this->config->item('itm_no_img_m');
      }
    } else {
      $userInfo = 0;
    }
    
  	return $user;
  }
  public function update_user($value='')
  {
  	$sql='UPDATE persona SET nombre=\''.$value['name'].'\', apellido_1=\''.$value['cog1'].'\', apellido_2=\''.$value['cog2'].'\', data_nacimiento=\''.$value['datana'].'\', sexo=\''.$value['sexo'].'\' WHERE usuario_id='.$value['id'].';';
  	$resp=$this->db->query($sql);
  	return $resp;
  }
  public function update_avatar($value='')
  {
  	 $sql='UPDATE usuario set avatar=\''.$value['img'].'\' WHERE usuario_id='.$value['id'].';';
  	 $resp=$this->db->query($sql);
  	 return $resp;
  }
  public function update_mail($value='')
  {
    $sql='UPDATE persona set mail=\''.$value['mail'].'\' WHERE usuario_id='.$value['id'].';';
     $resp=$this->db->query($sql);
     if($resp===TRUE){
      $sql2='UPDATE usuario set confirmado=0 WHERE usuario_id='.$value['id'].';';
       $resp=$this->db->query($sql2);
     }
     return $resp;
  }
  public function update_key($value='')
  {
    $sql="UPDATE usuario set key_word='".$value['new_pass']."' WHERE alias_usuario='".$value['usr']."' ;";
    $resp=$this->db->query($sql);
     return $resp;
  }
  public function mailing($value='')
  {
     $sql="UPDATE usuario set mailing=".$value['mailing']." WHERE usuario_id=".$value['usr']." ;";
    $resp=$this->db->query($sql);
     return $resp;
  }
  public function block_user($value='')
  {
  	$status=0;
  	if ($value['flag']===1)
  	{
   		$status=1;
  	}

   	$sql="UPDATE usuario set cuenta_activa=".$status." WHERE usuario_id=".$value['usr']." ;";
    $resp=$this->db->query($sql);
     return $resp;
  }
  public function destroy_user($value='')
  {
    $sql="UPDATE usuario set confirmado=0 , cuenta_activa=0 WHERE usuario_id=".$value." ;";
    $resp=$this->db->query($sql);
    if($resp==TRUE){
      $resp=$sql_2="DELETE FROM persona WHERE usuario_id=".$value." ;";
       $resp=$this->db->query($sql_2);
    }
     return $resp;
  }
  public function statics_user($value='')
  {
    $sql="SELECT (

SELECT count( id_registro )
FROM item_archivo
WHERE id_user =".$value."
) AS total, (

SELECT SUM( visto )
FROM item_archivo
WHERE id_user =".$value."
) AS visuali, (

SELECT MAX( visto )
FROM item_archivo
WHERE id_user =".$value."
) AS max_vist, (

SELECT id_registro
FROM item_archivo
WHERE id_user =".$value."
AND visto = max_vist LIMIT 0,1
) AS id_reg_max, (

SELECT titulo
FROM item_archivo
WHERE id_user =".$value." AND
id_registro=id_reg_max
) AS titulo_i
";
    $resp=$this->db->query($sql);
     return $resp;
  }
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */