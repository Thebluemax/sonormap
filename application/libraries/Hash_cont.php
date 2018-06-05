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

class Hash_cont
{
  protected 	$ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}
	public function mailHash($value='')
	{
		$user=$value['id_us'];
		$hash=$this->crearHash($value['name_us']);
		$type=$this->ci->config->item('mail_conf');
		$query="INSERT INTO confirmacion (hash,type,id_user,stamp) VALUES ('".$hash."','".$type."',".$user.",DEFAULT);";
		$resp=$this->ci->db->query($query);
		if($resp>0){
			return $hash;
		}else{
			return $resp;
		}
		
		
	}
	public function keyHash($value='')
	{
		$user=$value['id_us'];
		$hash=$this->crearHash($value['name_us']);
		$type=$this->ci->config->item('key_chg');
		$query="INSERT INTO confirmacion (hash,type,id_user,stamp) VALUES ('".$hash."','".$type."',".$user.",DEFAULT);";
		$resp=$this->ci->db->query($query);
		if($resp>0){
			return $hash;
		}else{
			return $resp;
		}
	}

	public function crearHash ($value='')
	{	$time=time();
		$has_1=$value+$time;
		return hash("md5",$has_1);
	}

}

/* End of file hash_cont.php */
/* Location: ./application/libraries/hash_cont.php */
