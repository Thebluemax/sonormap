<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('make_json'))
{

	 function make_json($res='')
	{

          for ($i=0; $i < count($res) ; $i++) {
               $imag="";
               if($res[$i]['file_image']==0){
                    $image="img/fond_item.png";

               }else{
                    $image="upload/thumb/".$res[$i]['file_image'];

               }
          	   $url_tlt=$res[$i]['titulo'];
                  $texto_html='<div class="" style="width:250px;overflow:hidden"><div class="panel panel-default"><div class="panel-body">';
                  $texto_html.='<figure><img src="'.$image.'"></figure>';
          	  $texto_html.='<a style="color:orange;background:rgba(0,0,0,.5);width:100%;display:block" href="'.site_url('ver/historia'.'/'.$res[$i]['url']).'" title="'.$res[$i]['titulo'].'"><h4 class="ttl">'.html_entity_decode($res[$i]['titulo']).'</h4></a>';
          	   $texto_html.='</div> </div></div>';
          	   //$title=html_entity_decode($res[$i]['titulo']);
          	   $title=htmlspecialchars_decode($res[$i]['titulo']);
                 $marker=array(
                 			'html'=>$texto_html,
                 			'title'=>$title,
          	  				'latitude'=>$res[$i]['latitud'],
          	  				'longitude'=>$res[$i]['longitud'],
          	  				'icon'=>base_url('/img')."/".$res[$i]['ico_punt']
          	  	);

          	  $data[$i]=$marker;
          }

		$jonson=json_encode($data);
		return $jonson;
	}
}
/* End of jonson_helper.php */
/* Location: ./application/helpers/jonson_helper.php */