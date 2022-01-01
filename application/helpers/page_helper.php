<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('crear_pagination')){
	 function crear_pagination($value='',$place='',$paginat='4')
	{
		//instanciamos el objeto principal.
		$ci =& get_instance();
		$ci->load->library('pagination');
           //configuración para boosttrap.
          $config['full_tag_open'] = '<ul class="pagination pagination-lg">';
          $config['full_tag_close'] = '</ul>';
          $config['first_link'] = '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
          $config['first_tag_open'] = '<li>';
          $config['first_tag_close'] = '</li>';
          $config['last_link'] = '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';

          $config['last_tag_open'] = '<li>';

          $config['last_tag_close'] = '</li>';
          $config['cur_tag_open'] = '<li class="active disabled"><a >';

          $config['cur_tag_close'] = '</a></li>';

          $config['next_link'] = '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';

          $config['next_tag_open'] = '<li>';

          $config['next_tag_close'] = '</li>';
          $config['prev_link'] = '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';

          $config['prev_tag_open'] = '<li>';

          $config['prev_tag_close'] = '</li>';
          $config['num_tag_open'] = '<li>';

          $config['num_tag_close'] = '</li>';
          $config['use_page_numbers'] = TRUE;
          $config['uri_segment'] = 3;
          $config['base_url'] = site_url($place);
          $config['total_rows'] = $value;
          $config['per_page'] = $paginat;

          $ci->pagination->initialize($config);

      return $ci->pagination->create_links();
	}
}
/* End of page_helper.php */
/* Location: ./application/helpers/page_helper.php */