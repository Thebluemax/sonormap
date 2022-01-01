<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package     Sonormap
 * @author      MaximilianoFernández
 * @copyright   Creative Commons Atribución-NoComercial-CompartirIgual 3.0 - 2013
 * @license     http://creativecommons.org/licenses/by-nc-sa/3.0/.
 * @link        https://github.com/Thebluemax/Sonormap
 * @since       Version 0.0
 *
 */

class Js extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$output=$this->load->view('js_script/enjine', "", TRUE);
        $this->jsOut($output);
	}
    public function homescript()
    {
    	$output=$this->load->view('js_script/home_script', "", TRUE);
        $this->jsOut($output);
    }
     public function adm($level)
    {
        $flag['level']='';
        switch ($level) {
            case 'admin':
                $flag['level']=1;
                break;
            case 'user':
                $flag['level']=2;
                break;
            case 'list':
                $flag['level']=3;
                break;
        }
    	$output=$this->load->view('js_script/admenj',$flag, TRUE);
        $this->jsOut($output);
    }
     public function rgtr()
    {
    	$output=$this->load->view('js_script/regt_js',"", TRUE);
        $this->jsOut($output);
    }
    public function resend_mail()
    {
        $output=$this->load->view('js_script/resend',"", TRUE);
        $this->jsOut($output);
    }
    public function ver_js()
    {
        $output=$this->load->view('js_script/js_ver','',TRUE);
        $this->jsOut($output);
    }
    public function modernizr()
    {
        $output=$this->load->view('js_script/modernizr',"", TRUE);
        $this->jsOut($output);
    }
    public function ver_hist()
    {
        $output=$this->load->view('js_script/js_ver', "", TRUE);
        $this->jsOut($output);
    }
    public function cycle()
    {
       $output=$this->load->view('js_script/cycle_min', "", TRUE);
       $this->jsOut($output);
    }
    public function contacto()
    {
         $output=$this->load->view('js_script/contacto', "", TRUE);
         $this->jsOut($output);
    }
    public function edit_engine()
    {
         $output=$this->load->view('js_script/edit_engine', "", TRUE);
         $this->jsOut($output);
    }
     public function actualizar_perfil()
    {
         $output=$this->load->view('js_script/editar_perfil', "", TRUE);
         $this->jsOut($output);
    }
    public function usjs()
    {
         $output=$this->load->view('js_script/user_js', "", TRUE);
         $this->jsOut($output);
    }
    public function mapengine()
    {
         $output=$this->load->view('js_script/map_controller', "", TRUE);
         $this->jsOut($output);
    }
    public function pagination()
    {
         $output=$this->load->view('js_script/pagination_js', "", TRUE);
         $this->jsOut($output);
    }
     public function admin()
    {
         $output=$this->load->view('js_script/secr_inici', "", TRUE);
         $this->jsOut($output);
    }
     public function admin_usr()
    {
         $output=$this->load->view('js_script/secr_usr', "", TRUE);
         $this->jsOut($output);
    }
     public function perfil()
    {
         $output=$this->load->view('js_script/perfil_js', "", TRUE);
         $this->jsOut($output);
    }
   /* public function admin_usr()
    {
         $output=$this->load->view('js_script/secr_usr', "", TRUE);
         $this->jsOut($output);
    }*/
    public function admin_hist()
    {
         $output=$this->load->view('js_script/secr_hist', "", TRUE);
         $this->jsOut($output);
    }
    public function jsOut($output='')
    {
        $this->output
    ->set_content_type('js')
    ->set_output($output);

    }
}
/* End of file js_eng.php */
/* Location: ./application/controllers/js.php */