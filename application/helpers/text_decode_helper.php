<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('text_to_decode')){
	function text_to_decode($text_to_decode,$direction)
	{
		//instanciamos el objeto principal.
		$ci =& get_instance();
		$A_BASE_DATOS=true;
		$text="";
		// evaluamos en que dirección se sealizará la conversión
		if ($direction==$A_BASE_DATOS) {
		 	//remplazamos los caracters, para hacer las conversiones.
		 	$remplazo_t = array(
        	/**'À'=>'&Agrave;', 'à'=>'&agrave;', 'Á'=>'&Aacute;', 'á'=>'&aacute;', 'Â'=>'&Acirc;', 'â'=>'&acirc;', 'Ã'=>'&Atilde;', 'ã'=>'&atilde;', 'Ä'=>'&Auml;', 'ä'=>'&auml;', 'Å'=>'&Aring;', 'å'=>'&aring;', 'Æ'=>'&AElig;', 'æ'=>'&aelig;', 'Ç'=>'&Ccedil;', 'ç'=>'&ccedil;', 'Ð'=>'&ETH;', 'ð'=>'&eth;', 'È'=>'&Egrave;', 'è'=>'&egrave;', 'É'=>'&Eacute;', 'é'=>'&eacute;', 'Ê'=>'&Ecirc;', 'ê'=>'&ecirc;', 'Ë'=>'&Euml;', 'ë'=>'&euml;', 'Ì'=>'&Igrave;', 'ì'=>'&igrave;', 'Í'=>'&Iacute;', 'í'=>'&iacute;', 'Î'=>'&Icirc;', 'î'=>'&icirc;', 'Ï'=>'&Iuml;', 'ï'=>'&iuml;', 'Ñ'=>'&Ntilde;', 'ñ'=>'&ntilde;', 'Ò'=>'&Ograve;', 'ò'=>'&ograve;', 'Ó'=>'&Oacute;', 'ó'=>'&oacute;', 'Ô'=>'&Ocirc;', 'ô'=>'&ocirc;', 'Õ'=>'&Otilde;', 'õ'=>'&otilde;', 'Ö'=>'&Ouml;', 'ö'=>'&ouml;', 'Ø'=>'&Oslash;', 'ø'=>'&oslash;', 'Œ'=>'&OElig;', 'œ'=>'&oelig;', 'ß'=>'&szlig;', 'Þ'=>'&THORN;', 'þ'=>'&thorn;', 'Ù'=>'&Ugrave;', 'ù'=>'&ugrave;', 'Ú'=>'&Uacute;', 'ú'=>'&uacute;', 'Û'=>'&Ucirc;', 'û'=>'&ucirc;', 'Ü'=>'&Uuml;', 'ü'=>'&uuml;', 'Ý'=>'&Yacute;', 'ý'=>'&yacute;', 'Ÿ'=>'&Yuml;', 'ÿ'=>'&yuml;',**/
        		"'"=> '&#039;', "<"=>'&lt;', ">"=>  "&gt;",'"'=>'&#34;'
						);
        $text=htmlentities($text_to_decode,ENT_QUOTES  );
        $text=strtr($text,$remplazo_t);
		$text=utf8_encode($text);
		} else {
       		$text=utf8_decode($text_to_decode);
			$remplazo = array( '&#039;'=> "'",'&lt;' =>"<",  "&gt;"=>  ">",'&#34;'=>'"');
          	$text=strtr($text,$remplazo);
         	$text=html_entity_decode($text);
         //$text=html_entity_decode($text);
		}
		return $text;
	}
}
if (! function_exists('textToUrl')) {
	function textToUrl($text='')
	{
		$change=array(
	    		'á'=>'a',
	    		'Á'=>'A',
	    		'à'=>'a',
	    		'À'=>'A',
	    		'é'=>'e',
	    		'è'=>'e',
	    		'É'=>'E',
	    		'È'=>'E',
	    		'í'=>'i',
	    		'ì'=>'i',
	    		'Í'=>'I',
	    		'Ì'=>'I',
	    		'ï'=>'i',
	    		'Ï'=>'i',
	    		'ä'=>'a',
	    		'Ä'=>'a',
	    		'Ü'=>'u',
	    		'ü'=>'u',
	    		'e'=>'e',
	    		'Ë'=>'e',
	    		'ö'=>'o',
	    		'Ö'=>'O',
	    		'ó'=>'o',
	    		'ò'=>'o',
	    		'Ó'=>'O',
	    		'Ò'=>'O',
	    		'ú'=>'u',
	    		'ù'=>'u',
	    		'Ù'=>'u',
	    		'Ú'=>'u',
	    		'Ç'=>'c',
	    		'ç'=>'c',
	    		' '=>'_',
	    		"'"=>'-',
	    		"`"=>'-',
	    		"´"=>'-',
	    		"="=>'',
	    		":"=>'',
	    		";"=>'',
	    		","=>''
	    	);
	    $url_title=strtr($text,$change);
	    return $url_title;
	}
}
/* End of text_decode.php */
/* Location: ./application/helpers/text_decode.php */	