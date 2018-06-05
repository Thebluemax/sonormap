/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package   Sonormrmap
 * @author    Maximiliano Fernández - @mxml13
 * @copyright under GNU/GPL licence 2013.
 * @license   http://  /license.html
 * @link    http://
 * @since   Version 0.0
 * @filesource  /js/js_ver
 */
$(document).ready(function(){

              do_map();
    });

function do_map()
{
	map= new Gmaps('map',{lat: latitud, lng: longitud},18);
			//marks();
	map.add_mark({lat: latitud, lng: longitud},icon_png,true,'');
}