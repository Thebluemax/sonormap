<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package		Sonormap/application/list/
 * @author		Maximiliano Fernández - @mxml13
 * @copyright	under .
 * @license		http://  /license.html
 * @link		http://
 * @since		Version 0.0
 * @filesource file_comp.php
 */
class File_comp extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_securePage=TRUE;
	}

	public function check($value='')
	{
		if ($this->uri->segment(4) === FALSE)
		{
		    $filename = "lost.wav";
		}
		else
		{
		    $filename=$this->uri->segment(4).".wav";
		}
		$upload_path = "./upload";

		$path_file='./upload/'.$filename;
		$resp=is_file($path_file);
	 	$data=array('flag'=>$resp);
	 	//$this->load->view('spare_part/notice/db_return_view',$data, FALSE);
	 	$this->output
    	->set_content_type('application/json')
    	->set_output(json_encode($data));
	}
	/**
	 * retorna el valor de la id de un usuario
	 * @return [type] [description]
	 */
	public function getId(){
		$user=$this->session->userdata('id_user');
		$query = $this->db->get_where('usuario', array('alias_usuario' => $user));
		$id_usr=$query->row();
		return $id_usr->usuario_id;

	}
	public function upload_pic()
	{
		/**
 * EXAMPLE OF UPLOADING A FILE WITH JQUERY.
 * THIS EXAMPLE REQUIRES PHP 5.2 OR NEWER.
 *
 * TIP:
 * PHP 4 USERS CAN ACHIEVE THE SAME RESULT BY DOING THE FOLLOWING:
 * echo '{"status":"success","msg":"this action completed correctly.","filename":"'.$file_strip.'"}';
*/

/**
 * CONFIGURATION VARIABLES
*/
$max_filesize = 44442097152; // Maximum filesize in BYTES.
$allowed_filetypes = array('.jpg','.jpeg','.gif','.png','.JPG'); // These will be the types of file that will pass the validation.
$filename = $_FILES['qqfile']['name']; // Get the name of the file (including file extension).
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
$new_name=substr(md5($filename),0,8).$ext;
$file_strip = str_replace(" ","_",$filename); //Strip out spaces in filename
$upload_path = './upload/'; //Set upload path
//$upload_path = '/uploads/'; //Set upload path

/**
 * NO NEED TO MODIFY BEYOND THIS POINT UNLESS YOU ARE NOT RUNNING PHP 5.2 OR NEWER.
*/

// Check if the filetype is allowed, if not DIE and inform the user.
if(!in_array($ext,$allowed_filetypes)) {
	$output= array('status' => 'error', 'msg' => 'The file you attempted to upload is not allowed.', 'filename' => $file_strip);
} elseif(filesize($_FILES['qqfile']['tmp_name']) > $max_filesize) {
	// Now check the filesize, if it is too large then DIE and inform the user.
    $output= array('status' => 'error', 'msg' => 'The file you attempted to upload is too large.', 'filename' => $file_strip);
} elseif(!is_writable($upload_path)) {
    // Check if we can upload to the specified path, if not DIE and inform the user.
    $output= array('status' => 'error', 'msg' => 'You cannot upload to the /uploads/ folder. The permissions must be changed.', 'filename' => $file_strip);
} else {
    // Move the file if eveything checks out.
    if(move_uploaded_file($_FILES['qqfile']['tmp_name'],$upload_path . $new_name)) {
		$output= array('success' => true, 'usr' => $this->getId(), 'filename' => $new_name);
		$this->rezize_img($new_name);
    } else {
		$output= array('status' => 'error', 'msg' => $this->getId().' was not uploaded.  Please try again.', 'filename' => $file_strip);
    }
}
	$this->output($output);
	}

		public function upload_audio()
	{
		/**
 * EXAMPLE OF UPLOADING A FILE WITH JQUERY.
 * THIS EXAMPLE REQUIRES PHP 5.2 OR NEWER.
 *
 * TIP:
 * PHP 4 USERS CAN ACHIEVE THE SAME RESULT BY DOING THE FOLLOWING:
 * echo '{"status":"success","msg":"this action completed correctly.","filename":"'.$file_strip.'"}';
*/

/**
 * CONFIGURATION VARIABLES
*/
$max_filesize = 44442097152; // Maximum filesize in BYTES.
$allowed_filetypes = array('.wav'); // These will be the types of file that will pass the validation.
$filename = $_FILES['qqfile']['name']; // Get the name of the file (including file extension).
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
$new_name=substr(md5($filename),0,8).$ext;
$file_strip = str_replace(" ","_",$filename); //Strip out spaces in filename
$upload_path = './upload/'; //Set upload path
//$upload_path = '/uploads/'; //Set upload path

/**
 * NO NEED TO MODIFY BEYOND THIS POINT UNLESS YOU ARE NOT RUNNING PHP 5.2 OR NEWER.
*/

// Check if the filetype is allowed, if not DIE and inform the user.
if(!in_array($ext,$allowed_filetypes)) {
	echo json_encode(array('status' => 'error', 'msg' => 'The file you attempted to upload is not allowed.', 'filename' => $file_strip));
} elseif(filesize($_FILES['qqfile']['tmp_name']) > $max_filesize) {
	// Now check the filesize, if it is too large then DIE and inform the user.
    echo json_encode(array('status' => 'error', 'msg' => 'The file you attempted to upload is too large.', 'filename' => $file_strip));
} elseif(!is_writable($upload_path)) {
    // Check if we can upload to the specified path, if not DIE and inform the user.
    echo json_encode(array('status' => 'error', 'msg' => 'You cannot upload to the /uploads/ folder. The permissions must be changed.', 'filename' => $file_strip));
} else {
    // Move the file if eveything checks out.
    if(move_uploaded_file($_FILES['qqfile']['tmp_name'],$upload_path . $new_name)) {
		echo json_encode(array('success' => true, 'usr' => $this->getId(), 'filename' => $new_name));
    } else {
		echo json_encode(array('status' => 'error', 'msg' => $this->getId().' was not uploaded.  Please try again.', 'filename' => $file_strip));
    }
}
	}
	 /**
       * captura un archivo de audio y lo guarda en el servidor.
       * @return [type] [description]
       */       public function sv_aud($value="")
       {
               if ($this->uri->segment(4) === FALSE)
                      {
                           $filename = 0;
                       }
                      else
                      {                           $_REQUEST['filename']=$this->uri->segment(4);                       }       $upload_path = "./upload";

  $filename = $_REQUEST['filename'];

   $fp = fopen($upload_path."/".$filename.".wav", "wb");

   fwrite($fp, file_get_contents('php://input'));

   fclose($fp);
    $data=array('flag'=>1);
	 	$this->load->view('spare_part/notice/db_return_view',$data, FALSE);
       }


private function rezize_img($value)
{
	$config['image_library'] = 'gd2';
                          $config['source_image'] = 'upload/'.$value;
                          $config['new_image']='upload/thumb/'.$value;
                          $config['maintain_ratio'] = TRUE;
                          $config['width'] = 200;
                          $config['height'] = 105;

                          $this->load->library('image_lib', $config);

                            $this->image_lib->resize();

                            $this->image_lib->clear();

}
private function output($array_resp='')
{
	$this->output
    	->set_content_type('application/json')
    	->set_output(json_encode($array_resp));
}

}
/* End of file file_comp.php */
/* Location: ./application/controllers/list/file_comp.php */