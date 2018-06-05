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

class Contact extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('email'));
		$this->load->library(array(
                        'form_validation',
                        'recaptcha',
                        'mail_sender'
                                )
                );
       	//$this->load->model('login_model');
       	$this->page=$this->uri->segment(1);
    	$this->head_html[]=base_url('assets/css/contact.css');
	}
	public function index()
	{
		$data=array(
      			'captcha'=>''//$this->recaptcha->recaptcha_get_html()
    			);
		$this->section=$this->load->view('bodys/form/contacta_form', $data, TRUE);
		$this->array_page ['page']=$this->page;
		$this->show_page();
	}

	public function mail()
	{
		$data=array('captcha'=>'');//$this->recaptcha->recaptcha_get_html());
		$this->form_validation->set_message('requiered',$this->lang->line('s_ctc_msj1'));
        $this->form_validation->set_rules('nom', $this->lang->line('s_reg_uinp'),'required|xss_clean');
        $this->form_validation->set_rules('mail',  $this->lang->line('s_reg_minp'), 'required|valid_mail');

           //preparamos la evaluación del captcha.
       // $this->recaptcha->recaptcha_check_answer(
                                       //   $_SERVER['REMOTE_ADDR'],
                                       //   $this->input->post('recaptcha_challenge_field'),
                                        //  $this->input->post('recaptcha_response_field')
                                         // );
                  //validamos el captcha, si no es humano..
        if ($data['captcha']!==FALSE){
      //$this->recaptcha->getIsValid()!==FALSE) {
      		if ($this->form_validation->run() == FALSE)
            {
                $this->section.=validation_errors();
                $data=array('captcha'=>'');//$this->recaptcha->recaptcha_get_html());
            }else{
                $data=array('captcha'=>'');//$this->recaptcha->recaptcha_get_html());
                $mail_dat = array(
                          //'to_mail'=>$this->lang->line('site_mail'),
                          //'to_name'=>$this->config->item('s_h1_site'),
			              'to_mail'=>$this->input->post('mail'),
			              'to_name'=> $this->input->post('nom'),
                          'subject'=>$this->input->post('asunto'),
                          'mensaje'=>$this->input->post('text_cuerpo'),
                          'titulo'=>''.$this->input->post('nom')
                           );
                $mail_dat['html_mail']=$this->load->view('email/contacto_mail', $mail_dat, TRUE);
                //escribo el mensaje.
                // echo $this->input->post('asunto');
                $mensaje=$this->lang->line('s_frmc_msj2').'<br/>';
                $mensaje.=$this->lang->line('s_frmc_msj3').'<br/>'.$this->input->post('nom').'<br/>';
               	$mensaje.=$this->lang->line('s_frmc_msj4').'<br/>'.$this->input->post('mail').'<br/>';
               	$mensaje.=$this->lang->line('s_frmc_as').'<br/>'.$this->input->post('asunto').'<br/>';
               	$mensaje.=$this->lang->line('s_frmc_msj5').'<br/>'.$this->input->post('text_cuerpo');
               	//enviamos mail
               	//// To send HTML mail, the Content-type header must be set
                $headers_m  = 'MIME-Version: 1.0' . "\r\n";
          		$headers_m .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
           		if(mail($this->config->item('site_mail'), $this->input->post('asunto'), $mensaje,$headers_m)){
                   	$this->mail_sender->build_mail($mail_dat);
       				$respose=$this->mail_sender->send_mail();
        			if ($respose==1) {
            			$this->section.=$this->lang->line('s_ctc_msj2');
     				} else {
                   		$this->section .= $this->lang->line('s_mlcf_u9');
        			}
      			}else{
        			$this->section .= $this->lang->line('s_mlcf_u9');
      			}
            }
      	}else{
      	    $this->section.=$this->lang->line('s_reg_msj3');
            $data=array('captcha'=>'');//$this->recaptcha->recaptcha_get_html());
      	}
        $this->section.=$this->load->view('bodys/form/contacta_form', $data, TRUE);
		$this->show_page();
	}
}

/* End of file contacta.php */
/* Location: ./application/controllers/contacta.php */