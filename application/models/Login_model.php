<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();

	}
	public function checkin($value='')
	{
		$sql="SELECT u.* , p.mail FROM usuario u, persona p WHERE u.alias_usuario='".$value['usr']."' AND u.key_word='".md5($value['pass'])."' AND p.usuario_id=u.usuario_id;";
		$conf=$this->db->query($sql);
		return $conf;
	}
	public function mail_update($values='')
	{
		$sql="UPDATE persona set mail='".$values['new_mail']."' WHERE usuario_id=( SELECT usuario_id from usuario WHERE alias_usuario='".$values['usr']."') AND mail='".$values['mail']."' ;";
		 $conf=$this->db->query($sql);
		return $conf;
	}
	/**
	 * [confirmation de los mails y los hash.
	 * @param  array $value valores para la cpomparación
	 * @return [ci_db object]        objeto de database.
	 */
    public function confirmation($value='')
    {
    	 //antes boramos las vencidas.
    	 if ($value['type']===$this->config->item('mail_conf')) {
    	 	$hour_limit=$this->config->item('conf_mail_limit');
    	 } else if($value['type']===$this->config->item('key_chg')) {
    	 	$hour_limit=$this->config->item('conf_key_limit');
    	 }

        $limit=time()-(60*60*$hour_limit);
        $date_limit=date('Y-m-d',$limit);
        $sql_v="DELETE FROM confirmacion WHERE type='".$value['type']."' AND stamp<'".$date_limit."'";
        $this->db->query($sql_v);
        //comprobamos

        $sql="SELECT c.id_user as id_us, c.stamp as stp, p.nombre as nom,p.mail as email,u.alias_usuario as alias FROM confirmacion c, persona p, usuario u WHERE c.hash='".$value['hash']."' AND c.type='".$value['type']."' AND c.id_user=p.usuario_id AND c.id_user=u.usuario_id;";

        $response=$this->db->query($sql);
        return $response;
    }
    public function get_usr($value='')
    {
    	$sql_1="SELECT u.usuario_id as id,p.nombre as nom, p.mail as email FROM usuario u, persona p WHERE u.usuario_id=p.usuario_id AND u.alias_usuario='".$value."';";
     $respose=$this->db->query($sql_1);
     return $respose;
    }
    public function get_usr_m($mail='')
    {
       $sql="SELECT u.usuario_id as id, p.mail as email, u.alias_usuario as alias, p.nombre as nom FROM usuario u, persona p WHERE u.usuario_id=p.usuario_id AND p.mail='".$mail."';";
                return $this->db->query($sql);
    }
    /**
     * activacion del usuario.
     * @param  int $user [id del usuario]
     * @return [int]       [1 ó 0 , dependiendo de la respuesta del MySQL]
     */
public function activate($user='')
{
	       $sql_2="UPDATE usuario SET confirmado=1 WHERE usuario_id=".$user.";";
           $resp=$this->db->query($sql_2);
           return $resp;
}
/**
 * funcion para prevenir posibles duplicidades de hash
 * y renovar fechas de nuevos poedidos.
 * @param  int $value [id del usuario]
 * @return [int]        [1 ó 0, dependiendo de la respuesta del MySQL]
 */
   public function delet_old($value='')
    {
      $sql="DELETE FROM confirmacion WHERE id_user=".$value." ;";
       $respose=$this->db->query($sql);
    }
public function update_lost_k($value='')
{
     $new_key=md5($value['stp']);
          $new_key=substr($new_key,0,7);
          $cript=md5($new_key);
          //actulizamos la BD.
            $sql_a="UPDATE usuario SET key_word='".$cript."' WHERE usuario_id=".$value['usr_id'].";";
             $res=$this->db->query($sql_a);
             if ($res!==FALSE) {
                return $new_key;
             }else{
                    return '0';
             }
}
}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */