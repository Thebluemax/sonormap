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
 * @filesource
 *
 */
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package		Sonormap
 * @author		Maximiliano Fernández - @mxml13
 * @copyright	under GNU/GPL licence 2013.
 * @license		http://  /license.html
 * @link		http://
 * @since		Version 0.0
 */
class Acceptfile extends CI_Controller {

	public function __construct($value="")
	{
		parent::__construct();

	}
	/**
	 * captura un archivo de audio y lo guarda en el servidor.
	 * @return [type] [description]
	 */
	public function index($value="")
	{
		if ($this->uri->segment(3) === FALSE)
			{
			    $filename = 0;
			}
			else
			{
			    $_REQUEST['filename']=$this->uri->segment(3);
			}
	$upload_path = "./upload";

   $filename = $_REQUEST['filename'];

   $fp = fopen($upload_path."/".$filename.".wav", "wb");

   fwrite($fp, file_get_contents('php://input'));

   fclose($fp);
   echo 1;
	}

}

/* End of file acepptfile.php */
/* Location: ./application/controllers/acepptfile.php */