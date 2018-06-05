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
class Mail_sender
{
  protected 	$ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        $config_mail=array(
                                      'protocol' => 'smtp',
                                      'smtp_host' => 'ssl://smtp.googlemail.com',
                                      'smtp_port' => 465,
                                      'smtp_user' => $this->ci->config->item('site_mail'),
                                      'smtp_pass' => $this->ci->config->item('mail_key') ,
                                      'mailtype'  => 'html', 
                                      'charset'   => 'utf-8'
                                  );
        $this->ci->load->library('email', $config_mail);
        $this->ci->email->set_newline("\r\n");
	}
	/**
	 * Arma el correo con los parametros necesarios y los incrusta en el documento con
	 * el esquema del mail base.  
	 * @param  string $value [array con los datos de envio, subject, mensaje, ect].
	 * @return [type]        [description]
	 */
	public function build_mail($value='')
	{
		if(isset($value['sender'])){
				$this->ci->email->from($this->ci->config->item('site_mail'), $this->ci->lang->line('s_h1_site'));
			//$this->ci->email->from($value['sender'], $value['sender_name']);
		}else{
			$this->ci->email->from($this->ci->config->item('site_mail'), $this->ci->lang->line('s_h1_site'));
		}
		$this->ci->email->to($value['to_mail'],$value['to_name']);
		//cargo la vista del mail.
		$html_mail=$this->ci->load->view('email/mail_base', $value, TRUE);
		$this->ci->email->subject($value['subject']);
		//echo $value['subject'];
		$this->ci->email->message($html_mail);

	}
	/**
	 * Envio masivo de correo, para el aviso de nuevas entradas.
	 * @param  string $value [Valores del subject y mensaje]
	 * @return [json]        [respuesta jonson con nouser true/false]
	 */
	public function send_mass($value=""){
		$this->ci->load->model('admin_model');
		$list_m=$this->ci->admin_model->mass_mail();
		print_r($list_m);
		$html_mail=$this->ci->load->view('email/mail_base', $value, TRUE);
		if ($list_m!=0) {
		$this->ci->email->from($this->ci->config->item('site_mail'),$this->ci->lang->line('s_h1_site'));

		$this->ci->email->bcc($list_m);
		$value['html_mail']=$this->ci->load->view('email/mail_base', $value, TRUE);
			$this->ci->email->subject($this->ci->lang->line('s_adm_mel'));
		//echo $value['subject'];
		$this->ci->email->message($html_mail);
			return 1;
		
		} else {
			return 0;
		}
		
	}
    /**
     * envia el mail.
     * @return [int] resultado del envio.
     * envio correcto. 
     * String Mensaje de error.
     */
	public function send_mail()
	{        
		$flag=$this->ci->email->send(false);
		//echo $flag.'77--';
		if($flag>0){
			return 1;
		}else{
			return $this->ci->email->print_debugger();
		}
	}

}

/* End of file mail_sender.php */
/* Location: ./application/libraries/mail_sender.php */

