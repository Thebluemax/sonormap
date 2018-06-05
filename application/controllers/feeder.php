<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package       Sonormap
 * @author        MaximilianoFernández
 * @copyright     Creative Commons Atribución-NoComercial-CompartirIgual 3.0 - 2013
 * @license       http://creativecommons.org/licenses/by-nc-sa/3.0/.
 * @link          https://github.com/Thebluemax/Sonormap
 * @since         Version 0.0
 * 
 */

class Feeder extends CI_Controller {

	public function index()
	{
       $feedrss = file_get_contents("http://arxiumunicipaldesalt.wordpress.com/feed/");
     
       $page = simplexml_load_string($feedrss,null, LIBXML_NOCDATA| LIBXML_NOENT);
       $rss_array = array();
       $limit=0;
       foreach ($page->channel->item as $key ) {
      
       $link=$key->guid;
       $title= $key->title;
       
       $replarray=array('/<a(.)*>(.)*<\/a>/','/<img(.)*>/');
        $description= preg_replace($replarray,'',$key->description);
       
       preg_match('/<img(.)*>/', $key->children("content", true),$match);
       preg_match('/src\=\".*\.jpg/', $match[0],$src);
       if(isset($src[0])){
      $img_src=$src[0].'"';
}else{$img_src='';}
       $item=array(
            'title'=>$title,
            'link'=>$link,
            'description'=>$description,
            'img'=>$img_src
            );
       $rss_array[]=$item;
       $limit ++;
       if ($limit>=$this->config->item('limit_rss_entries')) {
             break;
       }
       }

       $data=array('rss_array'=>$rss_array);
       $this->load->view('spare_part/feeder_rss_view', $data, FALSE);
	}
}
/* End of file feeder.php */
/* Location: ./application/controllers/feeder.php */