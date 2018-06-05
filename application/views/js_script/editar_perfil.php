/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package   Sonormap
 * @author    Maximiliano Fernández - @mxml13
 * @copyright under GNU/GPL licence 2013.
 * @license   http://  /license.html
 * @link    http://
 * @since   Version 0.0
 * @filesource  /js/
 */

 var loader='<img src=\"<?=$this->config->item("pre_gif")?>\" alt>"';


 $(document).ready(function()
 {

 	$( "#dob" ).datepicker({
      changeMonth: true,
      changeYear: true,
      altField: "#date-to-db",
      altFormat: "yy-mm-dd"
    }).datepicker('widget');
 });
